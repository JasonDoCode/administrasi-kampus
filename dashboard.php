<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
  header("location: login.php");
  exit;
}
$role = $_SESSION['role'];

$username = $_SESSION['username'];
$jumlah_mahasiswa = 0;
$jumlah_dosen = 0;
$jumlah_pegawai = 0;

$jumlah_mahasiswa = mysqli_fetch_row(mysqli_query($koneksi, "SELECT COUNT(*) FROM mahasiswa"))[0];
$jumlah_dosen     = mysqli_fetch_row(mysqli_query($koneksi, "SELECT COUNT(*) FROM dosen"))[0];
$jumlah_pegawai   = mysqli_fetch_row(mysqli_query($koneksi, "SELECT COUNT(*) FROM pegawai"))[0];

?>
<!DOCTYPE html>
<html lang="id" data-bs-theme="dark">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ADMINISTRATOR</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

  <style>
    .sidebar {
      min-height: 100vh;
    }

    .nav-link {
      color: var(--bs-secondary-color);
    }

    .nav-link:hover,
    .nav-link.active {
      color: var(--bs-body-color);
      background-color: var(--bs-tertiary-bg);
      border-radius: 6px;
    }
  </style>
</head>

<body>

  <nav class="navbar navbar-expand-lg border-bottom bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand fw-bold" href="#">
        <i class="bi bi-person-raised-hand me-2"></i>SELAMAT DATANG <?= strtoupper($username); ?>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
  </nav>

  <div class="container-fluid">
    <div class="row">

      <div class="col-md-3 col-lg-2 bg-body-tertiary sidebar collapse d-md-block p-3" id="sidebarMenu">
        <ul class="nav flex-column gap-1">
          <li class="nav-item">
            <a class="nav-link active" href="dashboard.php"><i class="bi bi-house-door me-2"></i> Dashboard</a>
          </li>

          <?php if ($role === 'mahasiswa' || $role === 'admin'): ?>
            <li class="nav-item">
              <a class="nav-link" href="mahasiswa.php"><i class="bi bi-table me-2"></i> Daftar Mahasiswa</a>
            </li>
          <?php endif; ?>

          <?php if ($role === 'dosen' || $role === 'admin'): ?>
            <li class="nav-item">
              <a class="nav-link" href="dosen.php"><i class="bi bi-table me-2"></i> Daftar Dosen</a>
            </li>
          <?php endif; ?>

          <?php if ($role === 'pegawai' || $role === 'admin'): ?>
            <li class="nav-item">
              <a class="nav-link" href="pegawai.php"><i class="bi bi-table me-2"></i> Daftar Pegawai</a>
            </li>
          <?php endif; ?>
          <li class="nav-item">
            <a class="nav-link text-danger" href="logout_process.php"><i class="bi bi-box-arrow-left me-2"></i></i> Logout</a>
          </li>
        </ul>
      </div>

      <main class="col-md-9 col-lg-10 ms-sm-auto px-md-4 py-4">

        <div class="card border-0 shadow-sm">
          <div class="card-header bg-body-tertiary border-0 d-flex justify-content-between align-items-center py-3">
            <h5 class="mb-0 fw-semibold"><i class="bi bi-speedometer2 pe-2 text-warning"></i>Dashboard</h5>
          </div>
          <div class="card-body p-0">
            <div class="row g-0">
              <div class="col-md-4 border-end">
                <div class="d-flex align-items-center p-4">
                  <div class="d-flex align-items-center justify-content-center bg-primary-subtle text-primary rounded-3 me-3" style="width: 50px; height: 50px;">
                    <i class="bi bi-mortarboard-fill fs-4"></i>
                  </div>
                  <div>
                    <p class="text-muted mb-0 small text-uppercase fw-bold">Mahasiswa</p>
                    <h4 class="mb-0 fw-bold"><?= $jumlah_mahasiswa; ?></h4>
                  </div>
                </div>
              </div>
              <div class="col-md-4 border-end">
                <div class="d-flex align-items-center p-4">
                  <div class="d-flex align-items-center justify-content-center bg-danger-subtle text-danger rounded-3 me-3" style="width: 50px; height: 50px;">
                    <i class="bi bi-person-video3 fs-4"></i>
                  </div>
                  <div>
                    <p class="text-muted mb-0 small text-uppercase fw-bold">Dosen</p>
                    <h4 class="mb-0 fw-bold"><?= $jumlah_dosen; ?></h4>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="d-flex align-items-center p-4">
                  <div class="d-flex align-items-center justify-content-center bg-warning-subtle text-warning-emphasis rounded-3 me-3" style="width: 50px; height: 50px;">
                    <i class="bi bi-people fs-4"></i>
                  </div>
                  <div>
                    <p class="text-muted mb-0 small text-uppercase fw-bold">Pegawai</p>
                    <h4 class="mb-0 fw-bold"><?= $jumlah_pegawai; ?></h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>

  <div class="modal fade" id="tambahData" tabindex="-1" aria-labelledby="tambahDataLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="tambah_mhs.php" method="POST">
          <div class="modal-header">
            <h5 class="modal-title" id="tambahDataLabel">Tambah Data Dosen</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="nim" class="form-label">NIM</label>
              <input type="text" class="form-control" id="nim" name="nim" required>
            </div>
            <div class="mb-3">
              <label for="nama" class="form-label">Nama</label>
              <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="mb-3">
              <label for="jurusan" class="form-label">Jurusan</label>
              <input type="text" class="form-control" id="jurusan" name="jurusan" required>
            </div>
            <div class="mb-3">
              <label for="angkatan" class="form-label">Angkatan</label>
              <input type="text" class="form-control" id="angkatan" name="angkatan" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan Data</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <?php if (isset($_SESSION['alert'])): ?>
    <script>
      Swal.fire({
        icon: '<?= $_SESSION['alert']['icon']; ?>',
        title: '<?= $_SESSION['alert']['title']; ?>',
        text: <?= isset($_SESSION['alert']['text']) ? "'{$_SESSION['alert']['text']}'" : 'undefined'; ?>,
        timer: 1500,
        showConfirmButton: false
      });
    </script>
    <?php unset($_SESSION['alert']); ?>
  <?php endif; ?>
</body>

</html>