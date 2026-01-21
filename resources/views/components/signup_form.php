<?php
$valores = $valores ?? [];
$errores = $errores ?? [];
?>
<section>
    <h2>Registro de usuaries</h2>
    <?php if ($errores): ?>
        <ul>
            <?php foreach ($errores as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <form method="post" action="">
        <label>
            Nombre
            <input type="text" name="nombre" required minlength="3" value="<?= htmlspecialchars($valores['nombre'] ?? '') ?>">
        </label>
        <label>
            Email
            <input type="email" name="email" required value="<?= htmlspecialchars($valores['email'] ?? '') ?>">
        </label>
        <label>
            Contraseña
            <input type="password" name="password" required minlength="6">
        </label>
        <label>
            Fecha de registro
            <input type="date" name="fecha" required value="<?= htmlspecialchars($valores['fecha'] ?? '') ?>">
        </label>
        <label>
            ¿Es socio?
            <select name="es_socio" required>
                <option value="1" <?= ($valores['es_socio'] ?? '') === '1' ? 'selected' : '' ?>>Sí</option>
                <option value="0" <?= ($valores['es_socio'] ?? '') === '0' ? 'selected' : '' ?>>No</option>
            </select>
        </label>
        <label>
            ¿A dónde quieres ir después?
            <select name="destino" required>
                <option value="login" <?= ($valores['destino'] ?? '') === 'login' ? 'selected' : '' ?>>Login</option>
                <option value="index" <?= ($valores['destino'] ?? '') === 'index' ? 'selected' : '' ?>>Panel</option>
            </select>
        </label>
        <button type="submit">Registrarme</button>
    </form>
</section>
