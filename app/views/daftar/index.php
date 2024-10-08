<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['judul'] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!--Icon-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- datatables -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

    <!-- my fontawesome -->
    <link rel="stylesheet" href="<?= BASEURL; ?>/fontawesome/css/all.css">

    <!-- Icon Google -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <!-- Fonts Google -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- my style -->
    <link rel="stylesheet" href="<?= BASEURL; ?>/css/style.css">

</head>

<body>
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-sm-5 col-md-5 mt-5 mb-5 p-3">
                <form action="<?= BASEURL ?>/daftar/daftar" method="post" class="custome-form">
                    <div class="header">
                        <h2 class="text-center mb-4">SIPIRA</h2>
                        <h4>Daftar Akun</h4>
                        <p>Buat peminjaman mu mudah dan menyenangkan!</p>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <?php Flasher::flash(); ?>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="nama_lengkap" class="form-label">Nama Lengkap:</label>
                        <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap">
                    </div>
                    <div class="form-group mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="nim" class="form-label">NIM:</label>
                        <input type="text" class="form-control" id="nim" name="nim">
                    </div>
                    <div class="form-group mb-3">
                        <label for="nama_jurusan" class="form-label">Jurusan</label>
                        <select id="nama_jurusan" class="form-control" name="id_jurusan">
                            <option value="#">-- Pilih Jurusan --</option>
                            <?php foreach ($data['dataJurusan'] as $jurusan) : ?>
                                <option value="<?= $jurusan['id_jurusan']; ?>"><?= $jurusan['nama_jurusan']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="no_telp" class="form-label">No Handphone:</label>
                        <input type="tel" class="form-control" id="no_telp" name="no_telp">
                    </div>
                    <div class="form-group mb-3">
                        <label for="password" class="form-label">Kata Sandi:</label>
                        <div class="position-relative">
                            <input type="password" class="form-control" id="password" name="password" required>
                            <div class="position-absolute top-50 end-0 translate-middle">
                                <span class="p-0 input-group-text" style="cursor:pointer; background-color: transparent; border: none;">
                                    <i class="fas fa-eye" id="togglePassword1" aria-hidden="true"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="confirm_password" class="form-label">Konfirmasi Kata Sandi:</label>
                        <div class="position-relative">
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                            <div class="position-absolute top-50 end-0 translate-middle">
                                <span class="p-0 input-group-text" style="cursor:pointer; background-color: transparent; border: none;">
                                    <i class="fas fa-eye" id="togglePassword2" aria-hidden="true"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="signin mb-3" style="background-color: #51A8B1;">Daftar</button>

                    <span>Sudah memiliki akun? <a href=" <?= BASEURL; ?>/login" class="signup text-decoration-none"> Kembali ke Login</a></span>
                </form>
            </div>
        </div>
    </div>

    <script>
        const togglePassword1 = document.getElementById('togglePassword1');
        const password = document.getElementById('password');

        togglePassword1.addEventListener('click', function() {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);

            // Toggle icon
            togglePassword1.classList.toggle('fa-eye');
            togglePassword1.classList.toggle('fa-eye-slash');
        });

        const togglePassword2 = document.getElementById('togglePassword2');
        const confirm_password = document.getElementById('confirm_password');

        togglePassword2.addEventListener('click', function() {
            const type = confirm_password.getAttribute('type') === 'password' ? 'text' : 'password';
            confirm_password.setAttribute('type', type);

            // Toggle icon
            togglePassword2.classList.toggle('fa-eye');
            togglePassword2.classList.toggle('fa-eye-slash');
        });
    </script>
</body>

</html>