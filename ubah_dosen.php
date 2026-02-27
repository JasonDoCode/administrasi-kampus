<?php

// include database connection file
include 'koneksi.php';
$nidn = $_POST['nidn'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$jabatan = $_POST['jabatan'];
$result = mysqli_query($koneksi, "UPDATE dosen SET nama = '$nama', alamat = '$alamat' , jabatan = '$jabatan' WHERE nidn = '$nidn'");

// redirect to homepage to display updated user in list
header("Location: dosen.php?pesan=ubah");
