<?php
session_start();

require __DIR__ . "/./constants/constants.php";
require __DIR__ . "/./db/config.php";

if (isset($_COOKIE[USER_ID_COOKIE_KEY])) {
    $login_id = $_COOKIE[USER_ID_COOKIE_KEY];
    $sql = "SELECT role FROM login WHERE id = $login_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $res_usr = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($res_usr['role'] == 'Admin') {
        header('Location: /admin/index.php', true);
    } else {
        header('Location: /registration.php', true);
    }
}

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
        <form action="handler/register-handler.php" method="post" class="register-right-side" id="formRegister">
            <h1 class="register-form-title">Daftar</h1>
            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-error">
                <?= $_SESSION['error'] ?>
                <button class="alert-dismiss">&times;</button>
            </div>
            <?php endif; ?>
            <div class="form-group">
                <label for="username" class="form-label">Nama</label>
                <input type="text" class="form-control w-full" id="username" name="username" required value="<?= isset($oldData) ?  $oldData['username'] : '' ?>">
            </div>
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control w-full" id="email" name="email" required value="<?= isset($oldData) ?  $oldData['email'] : '' ?>">
            </div>
            <div class="form-group">
                <label for="telepon" class="form-label">Telepon</label>
                <input type="text" class="form-control w-full" id="telepon" name="telepon" required value="<?= isset($oldData) ?  $oldData['telepon'] : '' ?>">
            </div>
            <div class="form-group">
                <label for="sandi" class="form-label">Sandi</label>
                <input type="password" class="form-control w-full" id="sandi" name="sandi" required>
            </div>
            <div class="form-group">
                <label for="sandi_ulang" class="form-label">Ketik ulang sandi</label>
                <input type="password" class="form-control w-full" id="sandi_ulang" required>
            </div>
            <div class="form-group">
                <input type="checkbox" id="toggleSandi">
                <label for="toggleSandi">Tampil sandi</label>
            </div>
            <p>Sudah punya akun? <a href="/login.php">Login</a></p>
            <br>
            <button class="btn btn-primary w-full">Kirim</button>
        </form>
    </main>

    <script src="/assets/scripts/alert.js"></script>

    <script>
        const formregister = document.getElementById('formRegister');
        const toggleSandi = document.getElementById('toggleSandi');

        toggleSandi.addEventListener('click', function() {
            const sandi = formregister.querySelector('#sandi');
            const sandiUlang = formregister.querySelector('#sandi_ulang');

            if (toggleSandi.checked) {
                sandi.setAttribute('type', 'text');
                sandiUlang.setAttribute('type', 'text');
            } else {
                sandi.setAttribute('type', 'password');
                sandiUlang.setAttribute('type', 'password');
            }
        });

        formregister.addEventListener('submit', function(e) {
            const sandi = formregister.querySelector('#sandi').value;
            const sandiUlang = formregister.querySelector('#sandi_ulang').value;

            if (sandi != sandiUlang) {
                alert("Ketik ulang kata sandi yang sama.")
                e.preventDefault();
            }
        });
    </script>
</body>
</html>