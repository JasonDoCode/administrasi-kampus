<?php
session_start();
$username = $_SESSION['username'];
$role = $_SESSION['role'];
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
  header("location: login.php");
  exit;
}

if ($_SESSION['role'] !== 'pegawai' && $_SESSION['role'] !== 'admin') {
  header("location: dashboard.php");
  exit;
}
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
            <a class="nav-link" href="dashboard.php"><i class="bi bi-house-door me-2"></i> Dashboard</a>
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
              <a class="nav-link active" href="pegawai.php"><i class="bi bi-table me-2"></i> Daftar Pegawai</a>
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
            <h5 class="mb-0 fw-semibold">Daftar Pegawai</h5>
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#tambahData">
              <i class="bi bi-plus-lg"></i> Tambah Data
            </button>
          </div>

          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table table-hover align-middle mb-0">
                <thead class="table-warning">
                  <tr>
                    <th class="ps-4">No</th>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Bagian</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  include 'koneksi.php';
                  $query = mysqli_query($koneksi, "SELECT * FROM pegawai");
                  $no = 1;
                  while ($data = mysqli_fetch_assoc($query)) {
                  ?>
                    <tr>
                      <td class="ps-4"><?php echo $no++; ?></td>
                      <td><?php echo $data['nik']; ?></td>
                      <td><?php echo $data['nama']; ?></td>
                      <td><?php echo $data['bagian']; ?></td>
                      <td>
                        <button class="btn btn-success btn-sm me-1 edit-button" data-bs-toggle="modal" data-bs-target="#editDataModal" data-nik="<?= $data['nik']; ?>" data-nama="<?= $data['nama']; ?>" data-bagian="<?= $data['bagian']; ?>">
                          <i class="fas fa-edit"></i> Edit
                        </button>
                        <a href="hapus_pegawai.php?nik=<?= $data['nik']; ?>" class="btn btn-danger btn-sm" onclick="confirmDelete(event, this.href)">
                          <i class="fas fa-trash-alt"></i> Delete
                        </a>
                      </td>
                    </tr>
                  <?php
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>

  <!-- tambah data -->
  <div class="modal fade" id="tambahData" tabindex="-1" aria-labelledby="tambahDataLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="tambah_pegawai.php" method="POST">
          <div class="modal-header">
            <h5 class="modal-title" id="tambahDataLabel">Tambah Data Pegawai</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="nik" class="form-label">NIK</label>
              <input type="text" class="form-control" id="nik" name="nik" required>
            </div>
            <div class="mb-3">
              <label for="nama" class="form-label">Nama</label>
              <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="mb-3">
              <label for="alamat" class="form-label">Alamat</label>
              <input type="text" class="form-control" id="alamat" name="alamat" required>
            </div>
            <div class="mb-3">
              <label for="bagian" class="form-label">Bagian</label>
              <input type="text" class="form-control" id="bagian" name="bagian" required>
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

  <!-- edit data -->
  <div class="modal fade" id="editDataModal" tabindex="-1" aria-labelledby="editDataLabel" ariahidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editDataLabel">Edit Data Pegawai</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="ubah_pegawai.php" method="POST">
            <input type="hidden" id="edit-nik" name="nik">
            <div class="mb-3">
              <label for="edit-nama" class="form-label">Nama Pegawai</label>
              <input type="text" class="form-control" id="edit-nama" name="nama" required>
            </div>
            <div class="mb-3">
              <label for="edit-bagian" class="form-label">Bagian</label>
              <input type="text" class="form-control" id="edit-bagian" name="bagian" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const editButtons = document.querySelectorAll('.edit-button');
      editButtons.forEach(button => {
        button.addEventListener('click', function() {
          const nik = this.getAttribute('data-nik');
          const nama = this.getAttribute('data-nama');
          const bagian = this.getAttribute('data-bagian');

          document.getElementById('edit-nik').value = nik;
          document.getElementById('edit-nama').value = nama;
          document.getElementById('edit-bagian').value = bagian;
        });
      });
    });

    function confirmDelete(event, deleteUrl) {
      event.preventDefault();

      Swal.fire({
        title: 'Apakah anda yakin?',
        text: "Data yang dihapus tidak dapat dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Hapus',
        cancelButtonText: 'Cancel'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = deleteUrl;
        }
      });
    }

    // alert pesan
    const urlParams = new URLSearchParams(window.location.search);
    const pesan = urlParams.get('pesan');

    if (pesan === 'tambah') {
      Swal.fire({
        title: 'Berhasil!',
        text: 'Data pegawai berhasil ditambahkan.',
        icon: 'success',
        timer: 1800,
        showConfirmButton: false
      });
    } else if (pesan === 'ubah') {
      Swal.fire({
        title: 'Berhasil!',
        text: 'Data pegawai berhasil diperbarui.',
        icon: 'success',
        timer: 1800,
        showConfirmButton: false
      });
    } else if (pesan === 'hapus') {
      Swal.fire({
        title: 'Dihapus!',
        text: 'Data pegawai berhasil dihapus.',
        icon: 'success',
        timer: 1800,
        showConfirmButton: false
      });
    } else if (pesan === 'gagal') {
      Swal.fire({
        title: 'Dihapus!',
        text: 'Data pegawai berhasil dihapus.',
        icon: 'error',
        timer: 1800,
        showConfirmButton: false
      });
    }
    window.history.replaceState(null, null, window.location.pathname);
  </script>
</body>

</html>