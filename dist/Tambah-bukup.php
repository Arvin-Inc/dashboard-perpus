<?php
include __DIR__ . '/../konek.php';

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
            $path = "upload/" . $foto_baru;

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

    $insert = mysqli_query($conn, "INSERT INTO buku (judul, pengarang, penerbit, tahun_terbit, foto) VALUES ('$judul', '$penulis', '$penerbit', '$tahun_terbit', '$foto')");

    if ($insert) {
        echo "<script>alert('Data buku berhasil ditambahkan.'); window.location.href = 'index.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan data buku.');</script>";
    }
}
?>

                <div class="container-fluid px-4">
                    <h1 class="mt-4">Tambah Buku</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Tambah Buku</li>
                    </ol>

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-book me-1"></i>
                            Form Tambah Buku
                        </div>
                        <div class="card-body">
                            <form action="Tambah-bukup.php" method="post" enctype="multipart/form-data">
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
                    </div>
                </div>