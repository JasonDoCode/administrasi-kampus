<?php
include 'koneksi.php';
$nik = $_POST['nik'];
$nama = $_POST['nama'];
$bagian = $_POST['bagian'];

$input = mysqli_query($koneksi, "INSERT INTO pegawai (nik, nama, bagian) VALUES ('$nik','$nama','$bagian')") or die(mysqli_error($koneksi));

if ($input) {
  header("Location: pegawai.php?pesan=tambah");
} else {
  header("Location: pegawai.php?pesan=gagal");
}