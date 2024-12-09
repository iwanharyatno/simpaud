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
                        <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"/>
                    </svg>
                </button>
            </div>
            <ul class="navigation-menu" id="mainMenu">
                <li><a class="navigation-item" href="/">Beranda</a></li>
                <li><a class="navigation-item" href="#">Tentang Kami</a></li>
                <li><a class="navigation-item" href="#">Informasi Layanan</a></li>
                <li><a class="navigation-item nav-last-item" href="#">Kontak</a></li>
                <li><a class="btn btn-link" href="login.php">Login</a></li>
                <li><a class="btn btn-primary" href="register.php">Daftar</a></li>
            </ul>
        </nav>
        <section class="hero">
            <div class="hero-text">
                <p class="hero-title">Tempat pilihan untuk <span id="hero-belajar">belajar</span> dan <span id="hero-bermain">bermain</span> untuk anak!</p>
                <p class="hero-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia, voluptatibus! Praesentium, adipisci!</p>
                <a href="register.php" class="btn btn-primary hero-btn">Ayo mulai!</a>
            </div>
        </section>
    </header>

    <script src="/assets/scripts/scripts.js"></script>
</body>

</html>