<?php
$delanteros = $delanteros ?? [];
$erroresEliminar = $erroresEliminar ?? [];
?>
<section>
    <h2>Eliminar delantero</h2>
    <?php if ($erroresEliminar): ?>
        <ul>
            <?php foreach ($erroresEliminar as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <form method="post" action="">
        <input type="hidden" name="action" value="eliminar">
        <label>
            Delantero
            <select name="delantero_id" required>
                <option value="">Selecciona un delantero</option>
                <?php foreach ($delanteros as $delantero): ?>
                    <option value="<?= (int) $delantero->getId() ?>">
                        <?= htmlspecialchars($delantero->getNombre()) ?> (#<?= (int) $delantero->getId() ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </label>
        <button type="submit">Eliminar</button>
    </form>
</section>
