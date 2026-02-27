<?php
include 'koneksi.php';
$nim = $_POST['nim'];
$nama = $_POST['nama'];
$jurusan = $_POST['jurusan'];
$angkatan = $_POST['angkatan'];

$input = mysqli_query($koneksi, "INSERT INTO mahasiswa (nim, nama, jurusan, angkatan) VALUES ('$nim','$nama','$jurusan','$angkatan')") or die(mysqli_error($koneksi));

if ($input) {
  header("Location: mahasiswa.php?pesan=tambah");
} else {
  header("Location: mahasiswa.php?pesan=gagal");
}