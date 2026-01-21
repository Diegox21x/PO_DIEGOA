<?php
session_start();

require_once __DIR__ . '/../app/repositories/UsuarioRepository.php';

$usuarioRepo = new UsuarioRepository();

/**
 * Redirige a la ruta indicada y termina el script.
 */
function redirigir(string $ruta): void
{
    header('Location: ' . $ruta);
    exit;
}

$errores = [];
$valores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $remember = isset($_POST['remember']);

    $valores = [
        'email' => $email,
        'remember' => $remember,
    ];

    if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores[] = 'Debes introducir un email válido.';
    }

    if ($password === '') {
        $errores[] = 'Debes introducir una contraseña.';
    }

    if (!$errores) {
        $usuario = $usuarioRepo->verificarCredenciales($email, $password);
        if (!$usuario) {
            $errores[] = 'Credenciales incorrectas.';
        } else {
            $_SESSION['usuario'] = [
                'id' => $usuario->getId(),
                'nombre' => $usuario->getNombre(),
                'email' => $usuario->getEmail(),
            ];

            if ($remember) {
                setcookie('remember_me', (string) $usuario->getId(), [
                    'expires' => time() + 60 * 60 * 24 * 14,
                    'path' => '/',
                    'httponly' => true,
                    'samesite' => 'Lax',
                ]);
            }

            redirigir('/index.php');
        }
    }
}

$mensaje = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

require_once __DIR__ . '/../resources/views/layouts/header.php';
?>
<?php if ($mensaje): ?>
    <p><?= htmlspecialchars($mensaje) ?></p>
<?php endif; ?>
<?php require __DIR__ . '/../resources/views/components/login-form.php'; ?>
<?php require_once __DIR__ . '/../resources/views/layouts/footer.php'; ?>