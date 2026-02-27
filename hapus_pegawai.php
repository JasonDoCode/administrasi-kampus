<?php
// include database connection file
include 'koneksi.php';
$nik = $_GET['nik'];
$result = mysqli_query($koneksi, "DELETE FROM pegawai WHERE nik = '$nik'");
header("Location: pegawai.php?pesan=hapus");
