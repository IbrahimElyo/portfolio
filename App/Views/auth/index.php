<?php
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    $title = "My Portfolio";
?>

<div class="container-connexion-page">
    <?php if (isset($error)): ?>
        <p class="auth-error"><?= htmlspecialchars($error); ?></p>
    <?php endif; ?>
    <div class="form-container">
        <form id="login-form" action="index.php?controller=auth&action=connexion" method="POST">
            <input type="hidden" name="csrf_token" value="<?php $_SESSION['csrf_token']; ?>">
            <label for="username">Username</label>
            <input type="username" name="username" autocomplete="username">
            <label for="password">Password</label>
            <input type="password" name="password" autocomplete="current-password">
            <button type="submit">Connect</button>
        </form>
    </div>
    
</div>
