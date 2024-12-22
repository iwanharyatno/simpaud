<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMPAUD - Sistem Informasi PAUD</title>
    <link rel="stylesheet" href="/assets/css/fonts.css">
    <link rel="stylesheet" href="/assets/css/styles.css">
</head>

<body>
    <header class="header">
        <nav class="navigation">
            <div class="nav-toggle-group">
                <h1 class="navigation-title"><span id="title-sim">SIM</span>PAUD</h1>
                <button class="btn btn-hamburger nav-toggler" data-toggle="#mainMenu">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
                    </svg>
                </button>
            </div>
            <ul class="navigation-menu" id="mainMenu">
                <li><a class="navigation-item" href="/">Beranda</a></li>
                <li><a class="navigation-item" href="about.php">Tentang Kami</a></li>
                <li><a class="navigation-item" href="services.php">Informasi Layanan</a></li>
                <li><a class="navigation-item nav-last-item" href="contact.php">Kontak</a></li>
                <li><a class="btn btn-link" href="login.php">Login</a></li>
                <li><a class="btn btn-primary" href="register.php">Daftar</a></li>
            </ul>
        </nav>
        <section class="hero contact">
            <div class="hero-text">
                <p class="hero-title">Hubungi Kami</p>
                <form action="handler/register-handler.php" method="post">
                    <div class="form-group">
                        <label for="username" class="form-label">Nama</label>
                        <input type="text" class="form-control w-full" id="username" name="username" required value="<?= isset($oldData) ?  $oldData['username'] : '' ?>">
                    </div>
                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control w-full" id="email" name="email" required value="<?= isset($oldData) ?  $oldData['email'] : '' ?>">
                    </div>
                    <div class="form-group">
                        <label for="pesan" class="form-label">Pesan</label>
                        <textarea type="text" class="form-control w-full" id="pesan" name="pesan" rows="10"></textarea>
                    </div>
                    <br>
                    <button class="btn btn-primary w-full">Kirim</button>
                </form>
            </div>
        </section>
    </header>

    <script src="/assets/scripts/scripts.js"></script>
</body>

</html>