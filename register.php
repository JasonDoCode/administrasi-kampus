<?php
session_start();
include 'koneksi.php';

if ($_POST["role"] !== "") {
  $queryId = mysqli_query($koneksi, "SELECT max(id) as max_id FROM user");
  $dataId = mysqli_fetch_array($queryId);
  $idMax = $dataId['max_id'];

  if ($idMax) {
    $urutan = (int) $idMax;
    $urutan++;
  } else {
    $urutan = 1;
  }

  $newID = sprintf("%03s", $urutan);

  $username = mysqli_real_escape_string($koneksi, $_POST["username"]);
  $password = $_POST['password'];
  $role = mysqli_real_escape_string($koneksi, $_POST["role"]);

  $hashed_password = password_hash($password, PASSWORD_DEFAULT);

  $queryInsert = "INSERT INTO user (id, username, password, role) VALUES ('$newID', '$username', '$hashed_password', '$role')";

  if (mysqli_query($koneksi, $queryInsert)) {
    $_SESSION['login'] = true;
    $_SESSION['id'] = $newID;
    $_SESSION['username'] = $username;
    $_SESSION['role'] = $role;
    $_SESSION['alert'] = [
      'icon' => 'success',
      'title' => 'Registrasi Berhasil!'
    ];
    header("location:dashboard.php");
  } else {
    $_SESSION['alert'] = [
      'icon' => 'error',
      'title' => 'Error!',
      'text' => 'Terjadi kesalahan sistem: ' . mysqli_error($koneksi)
    ];
    header("location:login.php");
  }
} else {
  $_SESSION['alert'] = [
    'icon' => 'error',
    'title' => 'Login Gagal!',
    'text' => 'Mohon pilih role anda.',
  ];
  header("location:login.php");
  exit;
}
