<?php 

// include database connection file
include 'koneksi.php';
$nim = $_POST['nim'];
$nama = $_POST['nama'];
$jurusan = $_POST['jurusan'];
$angkatan = $_POST['angkatan'];
$result = mysqli_query($koneksi, "UPDATE mahasiswa SET nama = '$nama', jurusan = '$jurusan', angkatan = '$angkatan' WHERE nim = '$nim'");

// redirect to homepage to display updated user in list
header("Location: mahasiswa.php?pesan=ubah");

?>