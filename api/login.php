<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | SIMPAUD</title>
    <link rel="stylesheet" href="/assets/css/fonts.css">
    <link rel="stylesheet" href="/assets/css/styles.css">
</head>
<body>
    <?php
        if (isset($_SESSION['error'])) {
            $oldData = $_SESSION['data'];
            session_destroy();
        }
    ?>
    <main class="register-flex">
        <div class="register-left-side">
        </div>
        <form action="handler/login-handler.php" method="post" class="register-right-side" id="formRegister">
            <h1 class="register-form-title">Login</h1>
            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-error">
                <?= $_SESSION['error'] ?>
                <button class="alert-dismiss">&times;</button>
            </div>
            <?php endif; ?>
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control w-full" id="email" name="email" required value="<?= isset($oldData) ?  $oldData['email'] : '' ?>">
            </div>
            <div class="form-group">
                <label for="sandi" class="form-label">Sandi</label>
                <input type="password" class="form-control w-full" id="sandi" name="sandi" required>
            </div>
            <div class="form-group">
                <input type="checkbox" id="toggleSandi">
                <label for="toggleSandi">Tampil sandi</label>
            </div>
            <p>Belum punya akun? <a href="/register.php">Daftar</a></p>
            <br>
            <button class="btn btn-primary w-full">Masuk</button>
        </form>
    </main>

    <script src="/assets/scripts/alert.js"></script>

    <script>
        const formregister = document.getElementById('formRegister');
        const toggleSandi = document.getElementById('toggleSandi');

        toggleSandi.addEventListener('click', function() {
            const sandi = formregister.querySelector('#sandi');

            if (toggleSandi.checked) {
                sandi.setAttribute('type', 'text');
            } else {
                sandi.setAttribute('type', 'password');
            }
        });
    </script>
</body>
</html>