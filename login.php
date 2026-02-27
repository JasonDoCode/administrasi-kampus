<?php
session_start();

?>

<!DOCTYPE html>
<html lang="id" data-bs-theme="dark">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">


  <style>
    body {
      background-color: #121212;
    }

    .login-container {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .card {
      background-color: #1e1e1e;
      border: 1px solid #333;
      border-radius: 8px;
    }
  </style>
</head>

<body>

  <div class="container login-container">
    <div class="card shadow-lg p-4" style="width: 100%; max-width: 400px;">
      <div class="card-body">
        <h3 class="card-title text-center mb-4 fw-bold">Login</h3>

        <form action="login_process.php" method="POST">
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Masukan username" required>
          </div>

          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Masukan password" required>
          </div>

          <div class="d-grid mt-4">
            <button type="submit" class="btn btn-primary py-2">Masuk</button>
          </div>
        </form>

        <div class="text-center mt-3 text-secondary">
          <small>Belum punya akun? <a href="#" data-bs-toggle="modal" data-bs-target="#registerModal">Registrasi</a></small>
        </div>
      </div>
    </div>
  </div>

  <!-- Tambahkan Modal Registrasi -->
  <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="POST" action="register.php">
          <div class="modal-header">
            <h5 class="modal-title" id="registerModalLabel">Registrasi Akun</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="id_user" class="form-label">ID User</label>
              <input type="text" class="form-control" name="id_user" id="id_user" required>
            </div>
            <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control" name="username" id="username" required>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="text" class="form-control" name="password" id="password" required>
            </div>
            <div class="mb-3">
              <label for="role" class="form-label">Role</label>
              <select name="role" id="role" class="form-select" required>
                <option value="admin">Admin</option>
                <option value="mahasiswa">Mahasiswa</option>
                <option value="dosen">Dosen</option>
                <option value="pegawai">Pegawai</option>
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary">Registrasi</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

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