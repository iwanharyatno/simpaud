<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/assets/css/fonts.css">
    <link rel="stylesheet" href="/assets/css/styles.css">
</head>

<body>
    <main class="registration-wrapper">
        <h1 class="registration-title">Pendaftaran</h1>
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
                    <form action="" method="post" class="registration-tabpage-form">
                        <div class="registration-biodata-nama-group">
                            <div class="form-group" style="flex: 1;">
                                <label for="nama_depan" class="form-label">Nama Depan</label>
                                <input type="text" class="form-control w-full" id="nama_depan" name="nama_depan" required>
                            </div>
                            <div class="form-group" style="flex: 1;">
                                <label for="nama_belakang" class="form-label">Nama Belakang</label>
                                <input type="text" class="form-control w-full" id="nama_belakang" name="nama_belakang" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_lahir">Tanggal Lahir</label>
                            <input type="date" class="form-control w-full" id="tanggal_lahir" name="tanggal_lahir" required>
                        </div>
                        <div class="form-group">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <select class="form-control w-full" id="jenis_kelamin" name="jenis_kelamin" required>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea type="date" class="form-control w-full" id="alamat" name="alamat" rows="5" required></textarea>
                        </div>
                        <button class="btn btn-primary">Simpan</button>
                        <a href="#biodata-ortu" class="btn btn-link">Lanjut</a>
                    </form>
                </div>
                <div class="registration-tabpage hidden" id="biodata-ortu">
                    <h2 class="registration-tabpage-title">Biodata Ortu</h2>
                    <form action="" method="post" class="registration-tabpage-form">
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
                            <textarea type="date" class="form-control w-full" id="alamat" name="alamat" rows="5" required></textarea>
                        </div>
                        <button class="btn btn-primary">Simpan</button>
                        <a href="#berkas-pendaftaran" class="btn btn-link">Lanjut</a>
                    </form>
                </div>
                <div class="registration-tabpage hidden" id="berkas-pendaftaran">
                    <h2 class="registration-tabpage-title">Berkas Pendaftaran</h2>
                    <form action="" method="post" class="registration-tabpage-form">
                        <div class="registration-tabpage-berkaspendaftaran-boxhint">
                            <ol>
                                <li>FC KTP OrangTua</li>
                                <li>FC KK</li>
                                <li>FC Akte Kelahiran</li>
                            </ol>
                        </div>
                        <div class="form-group">
                            <label for="nama_lengkap">Link Drive Berkas</label>
                            <input type="text" class="form-control w-full" id="nama_lengkap" name="nama_lengkap" required>
                        </div>
                        <button class="btn btn-primary">Simpan</button>
                        <a href="#status-berkas" class="btn btn-link">Lanjut</a>
                    </form>
                </div>
                <div class="registration-tabpage hidden" id="status-berkas">
                    <h2 class="registration-tabpage-title">Status Berkas</h2>
                    <p class="registration-tabpage-statusberkas-status">Belum Lengkap</p>
                    <a href="#pengumuman" class="btn btn-link">Lanjut</a>
                </div>
                <div class="registration-tabpage hidden" id="pengumuman">
                    <h2 class="registration-tabpage-title">Pengumuman</h2>
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
            changeTab(window.location.href);
        });
    </script>
</body>

</html>