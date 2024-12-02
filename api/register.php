<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | SIMPAUD</title>
    <link rel="stylesheet" href="/assets/css/fonts.css">
    <link rel="stylesheet" href="/assets/css/styles.css">
</head>
<body>
    <main class="login-flex">
        <div class="login-left-side">
        </div>
        <form action="handler/register-handler.php" method="post" class="login-right-side" id="formLogin">
            <h1 class="login-form-title">Login</h1>
            <div class="form-group">
                <label for="username" class="form-label">Nama</label>
                <input type="text" class="form-control w-full" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control w-full" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="telepon" class="form-label">Telepon</label>
                <input type="text" class="form-control w-full" id="telepon" name="telepon" required>
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
            <br>
            <button class="btn btn-primary w-full">Login</button>
        </form>
    </main>

    <script>
        const formLogin = document.getElementById('formLogin');
        const toggleSandi = document.getElementById('toggleSandi');

        toggleSandi.addEventListener('click', function() {
            const sandi = formLogin.querySelector('#sandi');
            const sandiUlang = formLogin.querySelector('#sandi_ulang');

            if (toggleSandi.checked) {
                sandi.setAttribute('type', 'text');
                sandiUlang.setAttribute('type', 'text');
            } else {
                sandi.setAttribute('type', 'password');
                sandiUlang.setAttribute('type', 'password');
            }
        });

        formLogin.addEventListener('submit', function(e) {
            const sandi = formLogin.querySelector('#sandi').value;
            const sandiUlang = formLogin.querySelector('#sandi_ulang').value;

            if (sandi != sandiUlang) {
                alert("Ketik ulang kata sandi yang sama.")
                e.preventDefault();
            }
        });
    </script>
</body>
</html>