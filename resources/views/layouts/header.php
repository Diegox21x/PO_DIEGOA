<?php
$usuarioActivo = $_SESSION['usuario'] ?? null;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Real Madrid Fan Club</title>
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
<header>
    <h1>Real Madrid Fan Club</h1>
    <nav>
        <a href="/login.php">Login</a>
        <a href="/signup.php">Registro</a>
        <a href="/index.php">Panel</a>
        <a href="/closesession.php">Cerrar sesión</a>
    </nav>
    <?php if ($usuarioActivo): ?>
        <p>Sesión iniciada como <strong><?= htmlspecialchars($usuarioActivo['nombre']) ?></strong>.</p>
    <?php endif; ?>
</header>
<main>
