<?php
include __DIR__ . '/../konek.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nama_anggota = $_POST["nama_anggota"];
    $jenis_kelamin = $_POST["jenis_kelamin"];
    $alamat = $_POST["alamat"];
    $gmail = $_POST["gmail"];
    $pass = $_POST["password"];
    $username = $_POST["username"];

    if (empty($nama_anggota) || empty($jenis_kelamin) || empty($alamat) || empty($gmail) || empty($pass) || empty($username)) {
        echo "<script>alert('Harap isi semua kolom'); window.location.href = 'index.php?page=tambah-anggota'</script>";
    } else {

    $insert = mysqli_query($conn, "INSERT INTO anggota (nama_anggota, alamat, jk, gmail, password, username, nama) VALUES ('$nama_anggota', '$alamat', '$jenis_kelamin', '$gmail', '$pass', '$username', '$nama_anggota')");

        if ($insert) {
            echo "<script>alert('Data anggota berhasil ditambahkan.'); window.location.href = 'index.php?page=tambah-anggota';</script>";
        } else {
            echo "<script>alert('Gagal menambahkan data anggota.');</script>";
        }
    }
    
}
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Tambah Anggota</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
        <li class="breadcrumb-item active">Tambah Anggota</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-book me-1"></i>
            Form Tambah Anggota
        </div>
        <div class="card-body">
            <form action="Tambah_anggota.php" method="post" enctype="multipart/form-data" require>
                <div class="form-floating mb-3">
                    <input class="form-control" id="inputName" type="text" placeholder="Masukkan Nama" name="nama_anggota" require /> <label for="inputName">nama anggota</label>
                </div>
                <div class="form-floating mb-3">
                    <input class="form-control" id="inputUsername" type="text" placeholder="Masukkan Username" name="username" require /> <label for="inputUsername">Username</label>
                </div>
                <div class="input-group mb-3">
                  <label class="input-group-text p-3" for="inputGroupSelect01">Jenis Kelamin</label>
                  <select class="form-select" id="inputGroupSelect01" name="jenis_kelamin" require>
                    <option selected>Choose...</option>
                    <option value="L">Laki-Laki</option>
                    <option value="P">Perempuan</option>
                  </select>
                </div>
                <div class="form-floating mb-3">
                    <input class="form-control" id="inputGmail" type="text" placeholder="Masukkan Nama Gmail" name="gmail" require /> <label for="inputGmail">gmail</label>
                </div>
                <div class="form-floating mb-3">
                    <input class="form-control" id="inputAlamat" type="text" placeholder="Masukkan Nama Alamat" name="alamat" require /> <label for="inputAlamat">alamat</label>
                </div>
                <div class="form-floating mb-3">
                    <input class="form-control" id="inputPass" type="password" placeholder="Masukkan Password" name="password" require /> <label for="inputPass">password</label>
                </div>
                <div class="mt-4 mb-8">
                    <div class="d-flex justify-content-between">
                        <input type="submit" class="btn btn-primary btn-block" value="Tambah Anggota">
                        <input type="reset" class="btn btn-danger btn-block" value="reset data">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>