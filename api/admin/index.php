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

$sql = "SELECT biodata_murid.id as biodata_murid_id, nama_depan, nama_belakang, tanggal_lahir, jenis_kelamin, alamat FROM biodata_murid INNER JOIN login ON login.id = biodata_murid.id_login WHERE login.status = 'Diajukan'";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$res_calon_list = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT id, judul, teks, tanggal FROM pengumuman ORDER BY tanggal DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$res_pengumuman_list = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
            <h1 class="registration-title">Kelola Pendaftar</h1>
            <a href="/handler/logout-handler.php" class="btn btn-primary">Logout</a>
        </div>
        <section class="registration-box">
            <ul class="registration-tabs">
                <li><a href="#diajukan" class="registration-tab active" data-tabpage="#diajukan">Diajukan</a></li>
                <li><a href="#buat-pengumuman" class="registration-tab" data-tabpage="#buat-pengumuman">Buat Pengumuman</a></li>
            </ul>
            <div class="registration-tabpages">
                <div class="registration-tabpage" id="diajukan">
                    <h2 class="registration-tabpage-title">Data Diajukan</h2>
                    <div class="table-wrapper">
                        <table class="table w-full">
                            <tr class="table-row">
                                <th>No</th>
                                <th>Nama Depan</th>
                                <th>Nama Belakang</th>
                                <th>Tanggal Lahir</th>
                                <th>Jenis Kelamin</th>
                                <th>Aksi</th>
                            </tr>

                            <?php
                            $no = 1; 
                            foreach($res_calon_list as $res_calon): 
                            ?>
                            <tr class="table-row">
                                <td><?= $no ?></td>
                                <td><?= $res_calon['nama_depan'] ?></td>
                                <td><?= $res_calon['nama_belakang'] ?></td>
                                <td><?= date_format(date_create($res_calon['tanggal_lahir']), 'd M Y') ?></td>
                                <td><?= $res_calon['jenis_kelamin'] ?></td>
                                <td>
                                    <a href="/admin/detail-calon.php?id=<?= $res_calon['biodata_murid_id'] ?>">Detail</a>
                                </td>
                            </tr>
                            <?php
                            $no++; 
                            endforeach;
                            ?>
                        </table>
                    </div>
                </div>
                <div class="registration-tabpage hidden" id="buat-pengumuman">
                    <h2 class="registration-tabpage-title">Buat Pengumuman</h2>
                    <a href="/admin/form-pengumuman.php" class="btn btn-link">+ Pengumuman baru</a>
                    <div class="table-wrapper">
                        <table class="table w-full">
                            <tr class="table-row">
                                <th style="width: 2rem; text-align: center;">No</th>
                                <th>Judul</th>
                                <th>Tanggal</th>
                                <th style="width: 12rem;">Aksi</th>
                            </tr>

                            <?php
                            $no = 1; 
                            foreach($res_pengumuman_list as $res_pengumuman): 
                            ?>
                            <tr class="table-row">
                                <td style="text-align: center;"><?= $no ?></td>
                                <td><?= $res_pengumuman['judul'] ?></td>
                                <td style="width: 8rem;"><?= date_format(date_create($res_pengumuman['tanggal']), 'd M Y') ?></td>
                                <td>
                                    <a class="btn btn-success" href="/admin/form-pengumuman.php?id=<?= $res_pengumuman['id'] ?>">Edit</a>
                                    <form onsubmit="return confirm('Yakin ingin menghapus pengumuman ini?')" method="POST" action="/handler/announcement-handler.php" style="display: inline;">
                                        <input type="hidden" name="id" value="<?= $res_pengumuman['id'] ?>">
                                        <button class="btn btn-danger" name="delete">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            <?php
                            $no++; 
                            endforeach;
                            ?>
                        </table>
                    </div>
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
                window.location.hash = '#diajukan';
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