<?php
include __DIR__ . '/../konek.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul = $_POST["judul"];
    $penulis = $_POST["penulis"];
    $penerbit = $_POST["penerbit"];
    $tahun_terbit  = $_POST["tahun_terbit"];
    $foto = null;

    if (!empty($_FILES["foto"]["name"])) {
        $foto = $_FILES["foto"]["name"];
        $tmp = $_FILES["foto"]["tmp_name"];
        $ext = strtolower(pathinfo($foto, PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png'];

        if (in_array($ext, $allowed)) {
            $foto_baru = time() . '_' . $foto;
            $path = "uploads/" . $foto_baru;

            if (move_uploaded_file($tmp, $path)) {
                $foto = $foto_baru;
            } else {
                echo "<script>alert('Gagal mengunggah foto.');</script>";
            }
        } else {
            echo "<script>alert('Format file tidak valid. Hanya JPG, JPEG, dan PNG yang diperbolehkan.');</script>";
            exit;
        }
    }

    $insert = mysqli_query($konek, "INSERT INTO buku (judul, penulis, penerbit, tahun_terbit, foto) VALUES ('$judul', '$penulis', '$penerbit', '$tahun_terbit', '$foto')");

    if ($insert) {
        echo "<script>alert('Data buku berhasil ditambahkan.'); window.location.href = 'index.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan data buku.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Tambah Buku</title>
</head>

<body>
    <h1 class="mt-4 ms-5 me-3">Tambah data buku</h1>
    <div class="breadcrumb mb-4 ms-5 me-3">
        <span class="breadcrumb-item active">
            Dashboard / tambah buku
        </span>
    </div>
    <div class="card mb-4 ms-5 me-3">
        <div class="card-header">
            <i class="fas fa-plus me-1"></i>
            form tambah data buku perpustakaan
        </div>
    </div>
    <div class="card-body">
        <form method="post" action="tambah_buku.php" enctype="multipart/form-data">
            <div class="form-floating mb-3">
                <input class="form-control" id="inputName" type="text" placeholder="Masukkan Nama Buku" name="judul" /> <label for="inputName">Judul Buku</label>
            </div>
            <div class="form-floating mb-3">
                <input class="form-control" id="inputPenulis" type="text" placeholder="Masukkan Nama Penulis" name="penulis" /> <label for="inputPenulis">Penulis</label>
            </div>
            <div class="form-floating mb-3">
                <input class="form-control" id="inputPenerbit" type="text" placeholder="Masukkan Nama Penerbit" name="penerbit" /> <label for="inputPenerbit">Penerbit</label>
            </div>
            <div class="form-floating mb-3">
                <input class="form-control" id="inputTahun" type="number" placeholder="Masukkan Tahun Terbit" name="tahun_terbit" /> <label for="inputTahun">Tahun Terbit</label>
            </div>
            <div class="form-floating mb-3">
                <input type="file" class="form-control" name="foto" accept="image/*"> <label for="inputImage">Foto Cover Buku</label>
            </div>
            <div class="mt-4 mb-8">
                <div class="d-flex justify-content-between">
                    <input type="submit" class="btn btn-primary btn-block" value="Tambah Buku">
                    <input type="reset" class="btn btn-danger btn-block" value="reset data">
                </div>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>