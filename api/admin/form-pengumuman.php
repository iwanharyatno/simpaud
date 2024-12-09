<?php

require __DIR__ . "/../constants/constants.php";
if (!isset($_COOKIE[USER_ID_COOKIE_KEY])) {
    header('Location: /login.php', true);
}

session_start();

require __DIR__ . "/../db/config.php";

$login_id = $_COOKIE[USER_ID_COOKIE_KEY];
$sql = "SELECT role FROM login WHERE id = $login_id";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$res_usr = $stmt->fetch(PDO::FETCH_ASSOC);

if ($res_usr['role'] != 'Admin') {
    header('Location: /registration.php', true);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT judul, teks FROM pengumuman WHERE id=$id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $res_pengumuman = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    $res_pengumuman = [
        'judul' => '',
        'teks' => ''
    ];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pendaftar | SIMPAUD</title>
    <link rel="stylesheet" href="/assets/css/fonts.css">
    <link rel="stylesheet" href="/assets/css/styles.css">
</head>

<body>
    <main class="registration-wrapper">
        <div class="registration-wrapper-header">
            <h1 class="registration-title">Buat Pengumuman Baru</h1>
            <a href="/admin/index.php#buat-pengumuman" class="btn btn-primary">Kembali</a>
        </div>
        <section class="registration-box">
            <div class="registrar-detail-container">
                <form action="/handler/announcement-handler.php" method="post">
                    <?php if (isset($_GET['id'])): ?>
                    <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
                    <?php endif; ?>
                    <div class="form-group">
                        <label for="judul" class="form-label">Judul</label>
                        <input type="text" class="form-control w-full" id="judul" name="judul" value="<?= $res_pengumuman['judul'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="teks" class="form-label">Isi Pengumuman</label>
                        <textarea name="teks" id="teks" class="form-control w-full" required><?= $res_pengumuman['teks'] ?></textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary">Simpan</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </form>
            </div>
        </section>
    </main>
</body>

</html>