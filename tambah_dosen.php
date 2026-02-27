<?php
include 'koneksi.php';
$nidn = $_POST['nidn'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$jabatan = $_POST['jabatan'];

$input = mysqli_query($koneksi, "INSERT INTO dosen (nidn, nama, alamat, jabatan) VALUES ('$nidn','$nama','$alamat','$jabatan')") or die(mysqli_error($koneksi));

if ($input) {
  header("Location: dosen.php?pesan=tambah");
} else {
  header("Location: dosen.php?pesan=gagal");
}
