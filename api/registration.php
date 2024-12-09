<?php
session_start();

require __DIR__ . "/./constants/constants.php";
require __DIR__ . "/./db/config.php";

if (isset($_COOKIE[USER_ID_COOKIE_KEY])) {
    $user_id = $_COOKIE[USER_ID_COOKIE_KEY];

    $sql = "SELECT status FROM login WHERE id = $user_id";
    $stat = $pdo->prepare($sql);
    $stat->execute();

    $res_user = $stat->fetch(PDO::FETCH_ASSOC);
} else {
    header('Location: /login.php');
}

if (isset($_COOKIE[USER_BIODATA_ID_COOKIE_KEY]) && $_COOKIE[USER_BIODATA_ID_COOKIE_KEY] != null) {
    $biodata_id = $_COOKIE[USER_BIODATA_ID_COOKIE_KEY];

    $sql = "SELECT nama_depan, nama_belakang, tanggal_lahir, jenis_kelamin, alamat, status, catatan FROM biodata_murid WHERE id = $biodata_id";
    $stat = $pdo->prepare($sql);
    $stat->execute();

    $res_murid = $stat->fetch(PDO::FETCH_ASSOC);
} else {
    $res_murid = [
        'nama_depan' => '',
        'nama_belakang' => '',
        'tanggal_lahir' => '',
        'jenis_kelamin' => '',
        'alamat' => '',
    ];
}

if (isset($_COOKIE[USER_ID_COOKIE_KEY]) && $_COOKIE[USER_ID_COOKIE_KEY] != null) {
    $user_id = $_COOKIE[USER_ID_COOKIE_KEY];

    $sql = "SELECT id, nama_lengkap, hubungan, alamat, status, catatan FROM biodata_ortu WHERE id_login = $user_id";
    $stat = $pdo->prepare($sql);
    $stat->execute();

    $res_ortu_list = $stat->fetchAll(PDO::FETCH_ASSOC);

    if (!$res_ortu_list) {
        $res_ortu_list = [];
    }
} else {
    $res_ortu_list = [];
}

if (isset($_COOKIE[USER_BERKAS_ID_COOKIE_KEY]) && $_COOKIE[USER_BERKAS_ID_COOKIE_KEY] != null) {
    $berkas_id = $_COOKIE[USER_BERKAS_ID_COOKIE_KEY];

    $sql = "SELECT path_berkas, status, catatan FROM berkas_pendaftaran WHERE id = $berkas_id";
    $stat = $pdo->prepare($sql);
    $stat->execute();

    $res_berkas = $stat->fetch(PDO::FETCH_ASSOC);
} else {
    $res_berkas = [
        'path_berkas' => ''
    ];
}

$sql = "SELECT id, judul, teks, tanggal FROM pengumuman WHERE date_part('year', tanggal) = date_part('year', CURRENT_DATE) ORDER BY id";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$res_pengumuman_list = $stmt->fetchAll(PDO::FETCH_ASSOC);

function status_to_class($status)
{
    if ($status == 'Diproses') {
        return 'pending';
    }
    if ($status == 'Diterima') {
        return 'accepted';
    }
    if ($status == 'Ditolak') {
        return 'rejected';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proses Pendaftaran | SIMPAUD</title>
    <link rel="stylesheet" href="/assets/css/fonts.css">
    <link rel="stylesheet" href="/assets/css/styles.css">
</head>

<body>
    <main class="registration-wrapper">
        <div class="registration-wrapper-header">
            <h1 class="registration-title">Pendaftaran</h1>
            <a href="/handler/logout-handler.php" class="btn btn-primary">Logout</a>
        </div>
        <section class="registration-box">
            <ul class="registration-tabs">
                <li><a href="#biodata-murid" class="registration-tab active" data-tabpage="#biodata-murid">Biodata Murid</a></li>
                <li><a href="#biodata-ortu" class="registration-tab" data-tabpage="#biodata-ortu">Biodata Ortu</a></li>
                <li><a href="#berkas-pendaftaran" class="registration-tab" data-tabpage="#berkas-pendaftaran">Berkas Pendaftaran</a></li>
                <li><a href="#status-berkas" class="registration-tab" data-tabpage="#status-berkas">Status Berkas</a></li>
                <li><a href="#pengumuman" class="registration-tab" data-tabpage="#pengumuman">Pengumuman</a></li>
            </ul>
            <div class="registration-tabpages">
                <div class="registration-tabpage" id="biodata-murid">
                    <h2 class="registration-tabpage-title">Biodata Murid</h2>
                    <form action="/handler/biodata-handler.php" method="post" class="registration-tabpage-form">
                        <div class="registration-biodata-nama-group">
                            <div class="form-group" style="flex: 1;">
                                <label for="nama_depan" class="form-label">Nama Depan</label>
                                <input type="text" class="form-control w-full" id="nama_depan" name="nama_depan" required value="<?= $res_murid['nama_depan'] ?>">
                            </div>
                            <div class="form-group" style="flex: 1;">
                                <label for="nama_belakang" class="form-label">Nama Belakang</label>
                                <input type="text" class="form-control w-full" id="nama_belakang" name="nama_belakang" required value="<?= $res_murid['nama_belakang'] ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_lahir">Tanggal Lahir</label>
                            <input type="date" class="form-control w-full" id="tanggal_lahir" name="tanggal_lahir" required value="<?= $res_murid['tanggal_lahir'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <select class="form-control w-full" id="jenis_kelamin" name="jenis_kelamin" required value="<?= $res_murid['jenis_kelamin'] ?>">
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea type="date" class="form-control w-full" id="alamat" name="alamat" rows="5" required><?= $res_murid['alamat'] ?></textarea>
                        </div>
                        <button class="btn btn-primary">Simpan</button>
                    </form>
                </div>
                <div class="registration-tabpage hidden" id="biodata-ortu">
                    <h2 class="registration-tabpage-title">Biodata Ortu</h2>
                    <form action="/handler/ortu-handler.php" method="post" class="registration-tabpage-form" id="registrationOrtu">
                        <input type="number" style="display: none;" name="biodata_ortu_id">

                        <div class="form-group table-wrapper">
                            <table class="table w-full">
                                <tr class="table-row">
                                    <th style="width: 12rem">Nama Lengkap</th>
                                    <th style="width: 8rem">Hubungan</th>
                                    <th style="width: 15rem">Alamat</th>
                                    <th>Aksi</th>
                                </tr>
                                <?php foreach ($res_ortu_list as $res_ortu): ?>
                                    <tr class="table-row">
                                        <td><?= $res_ortu['nama_lengkap'] ?></td>
                                        <td><?= $res_ortu['hubungan'] ?></td>
                                        <td><?= $res_ortu['alamat'] ?></td>
                                        <td>
                                            <button type="button" class="btn btn-success" onclick="editOrtu(this, <?= $res_ortu['id'] ?>)">Edit</button>
                                            <button type="button" class="btn btn-danger" name="action" onclick="deleteOrtu(<?= $res_ortu['id'] ?>)">Hapus</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>
                        <div class="form-group">
                            <label for="nama_lengkap">Nama Lengkap</label>
                            <input type="text" class="form-control w-full" id="nama_lengkap" name="nama_lengkap" required>
                        </div>
                        <div class="form-group">
                            <label for="hubungan">Hubungan</label>
                            <select class="form-control w-full" id="hubungan" name="hubungan" required>
                                <option value="Ibu">Ibu</option>
                                <option value="Ayah">Ayah</option>
                                <option value="Wali">Wali</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea class="form-control w-full" id="alamat" name="alamat" rows="5" required></textarea>
                        </div>

                        <button class="btn btn-primary">Simpan</button>
                        <button class="btn btn-secondary" type="reset">Reset</button>
                    </form>
                </div>
                <div class="registration-tabpage hidden" id="berkas-pendaftaran">
                    <h2 class="registration-tabpage-title">Berkas Pendaftaran</h2>
                    <form action="/handler/berkas-handler.php" method="post" class="registration-tabpage-form">
                        <div class="registration-tabpage-berkaspendaftaran-boxhint">
                            <ol>
                                <li>FC KTP OrangTua</li>
                                <li>FC KK</li>
                                <li>FC Akte Kelahiran</li>
                            </ol>
                        </div>
                        <div class="form-group">
                            <label for="path_berkas">Link Drive Berkas</label>
                            <input type="text" class="form-control w-full" id="path_berkas" name="path_berkas" required value="<?= $res_berkas['path_berkas'] ?>">
                        </div>
                        <button class="btn btn-primary">Simpan</button>
                        <a href="#status-berkas" class="btn btn-link">Lanjut</a>
                    </form>
                </div>
                <div class="registration-tabpage hidden" id="status-berkas">
                    <?php
                    $lengkap = isset($_COOKIE[USER_BERKAS_ID_COOKIE_KEY]) && isset($_COOKIE[USER_BIODATA_ID_COOKIE_KEY]) && count($res_ortu_list) > 0;
                    ?>

                    <h2 class="registration-tabpage-title">Status Berkas</h2>
                    <p class="registration-tabpage-statusberkas-status"><?= $lengkap ? 'Lengkap' : 'Belum Lengkap' ?></p>

                    <?php if (($res_user['status'] == 'Draf' || $res_user['status'] == 'Ditolak') && $lengkap): ?>
                        <form action="/handler/pengajuan-handler.php" method="post" class="registration-tabpage-statusberkas-formajukan">
                            <button class="btn btn-primary">Ajukan berkas</button>
                        </form>
                    <?php endif; ?>

                    <hr>
                    <?php if (isset($_COOKIE[USER_BIODATA_ID_COOKIE_KEY]) && $res_user['status'] != 'Draf'): ?>
                        <div class="registration-tabpage-statusberkas-categorybox">
                            <h2 class="registration-tabpage-statusberkas-category">Biodata Murid</h2>
                            <p class="registration-tabpage-statusberkas-categorystatus <?= status_to_class($res_murid['status']) ?>"><?= $res_murid['status'] ?></p>
                            <p class="registration-tabpage-statusberkas-categorynote"><?= $res_murid['catatan'] ? $res_murid['catatan'] : 'Belum ada catatan' ?></p>
                        </div>
                    <?php endif; ?>

                    <?php if (count($res_ortu_list) > 0 && $res_user['status'] != 'Draf'): ?>
                        <div class="registration-tabpage-statusberkas-categorybox">
                            <h2 class="registration-tabpage-statusberkas-category">Biodata Orang Tua</h2>
                            <p class="registration-tabpage-statusberkas-categorystatus <?= status_to_class($res_ortu_list[0]['status']) ?>"><?= $res_ortu_list[0]['status'] ?></p>
                            <p class="registration-tabpage-statusberkas-categorynote"><?= $res_ortu_list[0]['catatan'] ? $res_ortu_list[0]['catatan'] : 'Belum ada catatan' ?></p>
                        </div>
                    <?php endif; ?>

                    <?php if (isset($_COOKIE[USER_BERKAS_ID_COOKIE_KEY]) && $res_user['status'] != 'Draf'): ?>
                        <div class="registration-tabpage-statusberkas-categorybox">
                            <h2 class="registration-tabpage-statusberkas-category">Berkas Pendaftaran</h2>
                            <p class="registration-tabpage-statusberkas-categorystatus <?= status_to_class($res_berkas['status']) ?>"><?= $res_berkas['status'] ?></p>
                            <p class="registration-tabpage-statusberkas-categorynote"><?= $res_berkas['catatan'] ? $res_berkas['catatan'] : 'Belum ada catatan' ?></p>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="registration-tabpage hidden" id="pengumuman">
                    <h2 class="registration-tabpage-title">Pengumuman</h2>
                    <br>
                    <?php foreach ($res_pengumuman_list as $res_pengumuman): ?>
                        <div class="announcement">
                            <h3 class="announcement-title"><?= $res_pengumuman['judul'] ?></h3>
                            <small class="announcement-date"><?= date_format(date_create($res_pengumuman['tanggal']), 'd M Y') ?></small>
                            <p class="announcement-text"><?= $res_pengumuman['teks'] ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    </main>

    <script>
        window.addEventListener('hashchange', function() {
            const tabId = window.location.hash;
            changeTab(tabId);
        });

        function changeTab(id) {
            if (id.length == 0) {
                window.location.hash = '#biodata-murid';
            }

            document.querySelectorAll('.registration-tabpage').forEach(el => {
                el.classList.add('hidden');
            });

            const target = document.querySelector(id);
            if (target != null) {
                target.classList.remove('hidden');

                document.querySelector('.registration-tab.active').classList.remove('active');
                document.querySelector('.registration-tab[data-tabpage="' + id + '"]').classList.add('active');
            }
        }

        window.addEventListener('DOMContentLoaded', function() {
            changeTab(window.location.hash);
        });

        function editOrtu(btnEdit, id) {
            const tr = btnEdit.parentElement.parentElement;
            const namaLengkapTd = tr.querySelectorAll('td')[0];
            const hubunganTd = tr.querySelectorAll('td')[1];
            const alamatTd = tr.querySelectorAll('td')[2];

            document.querySelector('form#registrationOrtu input[name="biodata_ortu_id"]').value = id;
            document.querySelector('form#registrationOrtu input[name="nama_lengkap"]').value = namaLengkapTd.innerText;
            document.querySelector('form#registrationOrtu select[name="hubungan"]').value = hubunganTd.innerText;
            document.querySelector('form#registrationOrtu textarea[name="alamat"]').value = alamatTd.innerText;
        }

        function deleteOrtu(id) {
            const result = confirm('Yakin hapus data ortu/wali ini?');

            if (!result) return;

            const form = document.querySelector('form#registrationOrtu');

            const url = form.getAttribute('action');
            form.setAttribute('action', url + '?delete_id=' + id);

            form.submit();
        }
    </script>
</body>

</html>