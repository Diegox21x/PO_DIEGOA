<?php
$valores = $valores ?? [];
$errores = $errores ?? [];
?>
<section>
    <h2>Inicio de sesión</h2>
    <?php if ($errores): ?>
        <ul>
            <?php foreach ($errores as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <form method="post" action="">
        <label>
            Email
            <input type="email" name="email" required value="<?= htmlspecialchars($valores['email'] ?? '') ?>">
        </label>
        <label>
            Contraseña
            <input type="password" name="password" required>
        </label>
        <label>
            <input type="checkbox" name="remember" <?= !empty($valores['remember']) ? 'checked' : '' ?>>
            Permanecer conectado
        </label>
        <button type="submit">Entrar</button>
    </form>
</section>
