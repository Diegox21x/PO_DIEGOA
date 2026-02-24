<?php
$valores = $valores ?? [];
$errores = $errores ?? [];
?>
<section>
    <h2>Crear delantero</h2>
    <?php if ($errores): ?>
        <ul>
            <?php foreach ($errores as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <form method="post" action="">
        <input type="hidden" name="action" value="crear">
        <label>
            Nombre
            <input type="text" name="nombre" required minlength="2" value="<?= htmlspecialchars($valores['nombre'] ?? '') ?>">
        </label>
        <label>
            Edad
            <input type="number" name="edad" required min="16" max="40" value="<?= htmlspecialchars($valores['edad'] ?? '') ?>">
        </label>
        <label>
            Sueldo (€)
            <input type="number" name="sueldo" required min="0" step="0.01" value="<?= htmlspecialchars($valores['sueldo'] ?? '') ?>">
        </label>
        <label>
            Goles
            <input type="number" name="goles" required min="0" value="<?= htmlspecialchars($valores['goles'] ?? '') ?>">
        </label>
        <button type="submit">Guardar delantero</button>
    </form>
</section>
