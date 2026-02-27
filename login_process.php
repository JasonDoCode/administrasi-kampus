<?php
session_start();
include 'koneksi.php';

$username = mysqli_real_escape_string($koneksi, $_POST["username"]);
$password =  $_POST["password"];

$result = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username'");
$row = mysqli_num_rows($result);

if ($row > 0) {
  $data = mysqli_fetch_assoc($result);
  if (password_verify($password, $data['password'])) {
    $_SESSION['login'] = true;
    $_SESSION['id'] = $data['id'];
    $_SESSION['username'] = $data['username'];
    $_SESSION['role'] = $data['role'];
    $_SESSION['alert'] = [
      'icon' => 'success',
      'title' => 'Login Berhasil!',
    ];
    header("location:dashboard.php");
    exit();
  } else {
    $_SESSION['alert'] = [
      'icon' => 'error',
      'title' => 'Login Gagal!',
      'text' => 'Password Salah.',
    ];
    header("location:login.php");
    exit();
  }
} else {
  $_SESSION['alert'] = [
    'icon' => 'error',
    'title' => 'Login Gagal!',
    'text' => 'Username tidak ditemukan.',
  ];
  header("location:login.php");
  exit();
}
