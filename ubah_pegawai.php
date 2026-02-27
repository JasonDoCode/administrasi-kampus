<?php

// include database connection file
include 'koneksi.php';
$nik = $_POST['nik'];
$nama = $_POST['nama'];
$bagian = $_POST['bagian'];
$result = mysqli_query($koneksi, "UPDATE pegawai SET nama = '$nama', bagian = '$bagian' WHERE nik = '$nik'");

// redirect to homepage to display updated user in list
header("Location: pegawai.php?pesan=ubah");
