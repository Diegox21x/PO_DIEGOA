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
    $nombre = trim($_POST['nombre'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $fecha = $_POST['fecha'] ?? '';
    $esSocio = $_POST['es_socio'] ?? '0';
    $destino = $_POST['destino'] ?? 'login';

    $valores = [
        'nombre' => $nombre,
        'email' => $email,
        'fecha' => $fecha,
        'es_socio' => $esSocio,
        'destino' => $destino,
    ];

    if ($nombre === '') {
        $errores[] = 'El nombre es obligatorio.';
    }

    if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores[] = 'Debes introducir un email válido.';
    }

    if (strlen($password) < 6) {
        $errores[] = 'La contraseña debe tener al menos 6 caracteres.';
    }

    if ($fecha === '') {
        $errores[] = 'Debes introducir la fecha de registro.';
    }

    if (!in_array($esSocio, ['0', '1'], true)) {
        $errores[] = 'Debes indicar si eres socio.';
    }

    if (!in_array($destino, ['login', 'index'], true)) {
        $errores[] = 'Debes elegir un destino válido.';
    }

    if (!$errores) {
        $existente = $usuarioRepo->buscarPorEmail($email);
        if ($existente) {
            $errores[] = 'Ya existe un usuario con ese email.';
        } else {
            $usuario = new Usuario($nombre, $email, $password, $fecha, $esSocio === '1');
            $usuarioRepo->crear($usuario);

            if ($destino === 'index') {
                $_SESSION['usuario'] = [
                    'id' => $usuario->getId(),
                    'nombre' => $usuario->getNombre(),
                    'email' => $usuario->getEmail(),
                ];
                redirigir('/index.php');
            }

            $_SESSION['flash'] = 'Registro completado. Puedes iniciar sesión.';
            redirigir('/login.php');
        }
    }
}

require_once __DIR__ . '/../resources/views/layouts/header.php';
?>
<?php require __DIR__ . '/../resources/views/components/signup-form.php'; ?>
<?php require_once __DIR__ . '/../resources/views/layouts/footer.php'; ?>