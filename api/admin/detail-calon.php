<?php

require __DIR__ . "/../constants/constants.php";
if (!isset($_COOKIE[USER_ID_COOKIE_KEY])) {
    header('Location: /login.php', true);
}

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
    $sql = "SELECT id_login, nama_depan, nama_belakang, tanggal_lahir, jenis_kelamin, alamat, status, catatan FROM biodata_murid WHERE id = $id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $res_biodata = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$res_biodata) {
        http_response_code(404);
        exit;
    }

    $user_id = $res_biodata['id_login'];

    $sql = "SELECT status FROM login WHERE id = $user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $res_usr = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($res_usr['status'] != 'Diajukan') {
        http_response_code(404);
        exit;
    }

    $sql = "SELECT id, nama_lengkap, hubungan, alamat, status, catatan FROM biodata_ortu WHERE id_login = $user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $res_ortu_list = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!$res_ortu_list) {
        $res_ortu_list = [];
    }

    $sql = "SELECT path_berkas, status, catatan FROM berkas_pendaftaran WHERE id_login = $user_id";
    $stat = $pdo->prepare($sql);
    $stat->execute();
    
    $res_berkas = $stat->fetch(PDO::FETCH_ASSOC);
} else {
    http_response_code(404);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rincian Pendaftar | SIMPAUD</title>
    <link rel="stylesheet" href="/assets/css/fonts.css">
    <link rel="stylesheet" href="/assets/css/styles.css">
</head>

<body>
    <main class="registration-wrapper">
        <div class="registration-wrapper-header">
            <h1 class="registration-title">Detail Pendaftar</h1>
            <a href="/admin/index.php" class="btn btn-primary">Kembali</a>
        </div>
        <section class="registration-box">
            <form class="registrar-detail-container" action="/handler/review-handler.php?id=<?= $id ?>" method="post">
                <input type="hidden" name="user_id" value="<?= $user_id ?>">
                <h2 class="registrar-detail-subtitle">Biodata Murid</h2>
                <table>
                    <tr>
                        <td style="width: 12rem;"><strong>Nama Depan</strong></td>
                        <td style="width: 1rem;"><strong>:</strong></td>
                        <td><?= $res_biodata['nama_depan'] ?></td>
                    </tr>
                    <tr>
                        <td style="width: 12rem;"><strong>Nama Belakang</strong></td>
                        <td style="width: 1rem;"><strong>:</strong></td>
                        <td><?= $res_biodata['nama_belakang'] ?></td>
                    </tr>
                    <tr>
                        <td style="width: 12rem;"><strong>Tanggal Lahir</strong></td>
                        <td style="width: 1rem;"><strong>:</strong></td>
                        <td><?= $res_biodata['tanggal_lahir'] ?></td>
                    </tr>
                    <tr>
                        <td style="width: 12rem;"><strong>Jenis Kelamin</strong></td>
                        <td style="width: 1rem;"><strong>:</strong></td>
                        <td><?= $res_biodata['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan' ?></td>
                    </tr>
                    <tr>
                        <td style="width: 12rem;"><strong>Alamat</strong></td>
                        <td style="width: 1rem;"><strong>:</strong></td>
                        <td><?= $res_biodata['alamat'] ?></td>
                    </tr>
                </table>
                <br>
                <div class="form-group">
                    <label for="status_biodata" class="form-label">Status</label>
                    <select name="status_biodata" id="status_biodata" class="form-control">
                        <option value="Diproses" <?= $res_biodata['status'] == 'Diproses' ? 'selected' : '' ?>>Diproses</option>
                        <option value="Diterima" <?= $res_biodata['status'] == 'Diterima' ? 'selected' : '' ?>>Diterima</option>
                        <option value="Ditolak" <?= $res_biodata['status'] == 'Ditolak' ? 'selected' : '' ?>>Ditolak</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="catatan_biodata" class="form-label">Catatan</label>
                    <textarea name="catatan_biodata" id="catatan_biodata" class="form-control"><?= $res_biodata['catatan'] ?></textarea>
                </div>

                <h2 class="registrar-detail-subtitle">Biodata Orang Tua</h2>
                <div class="form-group table-wrapper">
                    <table class="table w-full">
                        <tr class="table-row">
                            <th style="width: 12rem">Nama Lengkap</th>
                            <th style="width: 8rem">Hubungan</th>
                            <th>Alamat</th>
                        </tr>
                        <?php foreach ($res_ortu_list as $res_ortu): ?>
                            <tr class="table-row">
                                <td><?= $res_ortu['nama_lengkap'] ?></td>
                                <td><?= $res_ortu['hubungan'] ?></td>
                                <td><?= $res_ortu['alamat'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <br>
                <div class="form-group">
                    <label for="status_ortu_list" class="form-label">Status</label>
                    <select name="status_ortu_list" id="status_ortu_list" class="form-control">
                        <option value="Diproses" <?= $res_ortu_list[0]['status'] == 'Diproses' ? 'selected' : '' ?>>Diproses</option>
                        <option value="Diterima" <?= $res_ortu_list[0]['status'] == 'Diterima' ? 'selected' : '' ?>>Diterima</option>
                        <option value="Ditolak" <?= $res_ortu_list[0]['status'] == 'Ditolak' ? 'selected' : '' ?>>Ditolak</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="catatan_ortu_list" class="form-label">Catatan</label>
                    <textarea name="catatan_ortu_list" id="catatan_ortu_list" class="form-control"><?= $res_ortu_list[0]['catatan'] ?></textarea>
                </div>
                <h2 class="registrar-detail-subtitle">BERKAS PENDAFTARAN</h2>
                <a href="<?= $res_berkas['path_berkas'] ?>" style="display: block;" target="_blank"><?= $res_berkas['path_berkas'] ?></a>
                <br>
                <div class="form-group">
                    <label for="status_berkas" class="form-label">Status</label>
                    <select name="status_berkas" id="status_berkas" class="form-control">
                        <option value="Diproses" <?= $res_berkas['status'] == 'Diproses' ? 'selected' : '' ?>>Diproses</option>
                        <option value="Diterima" <?= $res_berkas['status'] == 'Diterima' ? 'selected' : '' ?>>Diterima</option>
                        <option value="Ditolak" <?= $res_berkas['status'] == 'Ditolak' ? 'selected' : '' ?>>Ditolak</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="catatan_berkas" class="form-label">Catatan</label>
                    <textarea name="catatan_berkas" id="catatan_berkas" class="form-control"><?= $res_berkas['catatan'] ?></textarea>
                </div>
                <hr>
                <br>
                <div class="form-group">
                    <button class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </section>
    </main>
</body>

</html>