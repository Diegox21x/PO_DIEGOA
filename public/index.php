<?php
session_start();


include $_SERVER ['DOCUMENT_ROOT'] . '/app/repositories/UsuarioRepository.php';
include $_SERVER ['DOCUMENT_ROOT'] . '/app/repositories/DelanteroRepository.php';
include $_SERVER ['DOCUMENT_ROOT'] . '/app/models/Jugador.php';
include $_SERVER ['DOCUMENT_ROOT'] . '/app/models/Delantero.php';

$usuarioRepo = new UsuarioRepository();
$delanteroRepo = new DelanteroRepository();

/**
 * Redirige a la ruta indicada y termina el script.
 */
function redirigir(string $ruta): void
{
    header('Location: ' . $ruta);
    exit;
}

/**
 * Elimina la cookie de recordar sesión si existe.
 */
function limpiarCookieRecuerdo(): void
{
    if (isset($_COOKIE['remember_me'])) {
        setcookie('remember_me', '', time() - 3600, '/');
        unset($_COOKIE['remember_me']);
    }
}

$usuarioSesion = $_SESSION['usuario'] ?? null;

if (!$usuarioSesion && isset($_COOKIE['remember_me'])) {
    $usuarioDesdeCookie = $usuarioRepo->buscarPorId((int) $_COOKIE['remember_me']);
    if ($usuarioDesdeCookie) {
        $_SESSION['usuario'] = [
            'id' => $usuarioDesdeCookie->getId(),
            'nombre' => $usuarioDesdeCookie->getNombre(),
            'email' => $usuarioDesdeCookie->getEmail(),
        ];
        $usuarioSesion = $_SESSION['usuario'];
    } else {
        limpiarCookieRecuerdo();
    }
}

if (!$usuarioSesion) {
    redirigir('/login.php');
}

$erroresCrear = [];
$erroresEliminar = [];
$valoresCrear = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['action'] ?? '';

    if ($accion === 'crear') {
        $nombre = trim($_POST['nombre'] ?? '');
        $edad = (int) ($_POST['edad'] ?? 0);
        $sueldo = (float) ($_POST['sueldo'] ?? 0);
        $goles = (int) ($_POST['goles'] ?? 0);

        $valoresCrear = [
            'nombre' => $nombre,
            'edad' => (string) $edad,
            'sueldo' => (string) $sueldo,
            'goles' => (string) $goles,
        ];

        if ($nombre === '') {
            $erroresCrear[] = 'El nombre es obligatorio.';
        }

        if (!Jugador::esEdadValida($edad)) {
            $erroresCrear[] = 'La edad debe estar entre 16 y 40 años.';
        }

        if ($sueldo <= 0) {
            $erroresCrear[] = 'El sueldo debe ser mayor que 0.';
        }

        if ($goles < 0) {
            $erroresCrear[] = 'Los goles no pueden ser negativos.';
        }

        if (!$erroresCrear) {
            $delantero = new Delantero($nombre, $edad, $sueldo, $goles);
            $delanteroRepo->crear($delantero);
            $_SESSION['flash'] = 'Delantero creado correctamente.';
            redirigir('/index.php');
        }
    }

    if ($accion === 'eliminar') {
        $delanteroId = (int) ($_POST['delantero_id'] ?? 0);
        if ($delanteroId <= 0) {
            $erroresEliminar[] = 'Debes seleccionar un delantero.';
        } else {
            $eliminado = $delanteroRepo->eliminarPorId($delanteroId);
            if ($eliminado) {
                $_SESSION['flash'] = 'Delantero eliminado correctamente.';
                redirigir('/index.php');
            }

            $erroresEliminar[] = 'No se encontró el delantero seleccionado.';
        }
    }
}

$delanteros = $delanteroRepo->obtenerTodos();
$mensaje = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

include $_SERVER ['DOCUMENT_ROOT'] . '/resources/views/layouts/header.php';
?>
<section>
    <h2>Bienvenida</h2>
    <p>Bienvenide, <?= htmlspecialchars($usuarioSesion['nombre']) ?>.</p>
    <?php if ($mensaje): ?>
        <p><?= htmlspecialchars($mensaje) ?></p>
    <?php endif; ?>
</section>

<?php
include $_SERVER ['DOCUMENT_ROOT'] . '/resources/views/components/delantero-form.php';
include $_SERVER ['DOCUMENT_ROOT'] . '/resources/views/components/delete-delantero-form.php';
?>

<section>
    <h2>Listado de delanteros</h2>
    <?php if (!$delanteros): ?>
        <p>No hay delanteros registrados todavía.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Edad</th>
                    <th>Sueldo</th>
                    <th>Goles</th>
                    <th>Rendimiento</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($delanteros as $delantero): ?>
                    <tr>
                        <td><?= (int) $delantero->getId() ?></td>
                        <td><?= htmlspecialchars($delantero->getNombre()) ?></td>
                        <td><?= (int) $delantero->getEdad() ?></td>
                        <td><?= number_format($delantero->getSueldo(), 2, ',', '.') ?> €</td>
                        <td><?= (int) $delantero->getGoles() ?></td>
                        <td><?= number_format($delantero->calcularRendimiento(), 2, ',', '.') ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</section>
<?php include $_SERVER ['DOCUMENT_ROOT'] . '/resources/views/layouts/footer.php'; ?>