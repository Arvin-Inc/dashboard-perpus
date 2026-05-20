<?php
include __DIR__ . '/../konek.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$book = null;

if ($id > 0) {
    $result = mysqli_query($conn, "SELECT * FROM buku WHERE id='$id'");
    $book = mysqli_fetch_assoc($result);
}

if (!$book) {
    echo "<script>alert('Buku tidak ditemukan.'); window.location.href = 'index.php?page=view-buku';</script>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = trim($_POST['judul']);
    $penulis = trim($_POST['penulis']);
    $penerbit = trim($_POST['penerbit']);
    $tahun_terbit = trim($_POST['tahun_terbit']);
    $foto = $book['foto'];

    if (!empty($_FILES['foto']['name'])) {
        $uploadedName = $_FILES['foto']['name'];
        $tmp = $_FILES['foto']['tmp_name'];
        $ext = strtolower(pathinfo($uploadedName, PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png'];

        if (in_array($ext, $allowed)) {
            $fotoBaru = time() . '_' . basename($uploadedName);
            $path = 'upload/' . $fotoBaru;

            if (move_uploaded_file($tmp, $path)) {
                $foto = $fotoBaru;
            } else {
                echo "<script>alert('Gagal mengunggah foto.');</script>";
            }
        } else {
            echo "<script>alert('Format file tidak valid. Hanya JPG, JPEG, dan PNG yang diperbolehkan.');</script>";
        }
    }

    if (empty($judul) || empty($penulis) || empty($penerbit) || empty($tahun_terbit)) {
        echo "<script>alert('Harap isi semua kolom.');</script>";
    } else {
        $update = mysqli_query($conn, "UPDATE buku SET judul='$judul', penulis='$penulis', penerbit='$penerbit', tahun_terbit='$tahun_terbit', foto='$foto' WHERE id='$id'");

        if ($update) {
            echo "<script>alert('Data buku berhasil diperbarui.'); window.location.href = 'index.php?page=view-buku';</script>";
            exit;
        } else {
            echo "<script>alert('Gagal memperbarui data buku.');</script>";
        }
    }
}
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Edit Buku</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="index.php?page=view-buku">Daftar Buku</a></li>
        <li class="breadcrumb-item active">Edit Buku</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-book me-1"></i>
            Form Edit Buku
        </div>
        <div class="card-body">
            <form action="index.php?page=edit-buku&id=<?= $book['id']; ?>" method="post" enctype="multipart/form-data">
                <div class="form-floating mb-3">
                    <input class="form-control" id="inputName" type="text" placeholder="Masukkan Nama Buku" name="judul" value="<?= htmlspecialchars($book['judul']); ?>" />
                    <label for="inputName">Judul Buku</label>
                </div>
                <div class="form-floating mb-3">
                    <input class="form-control" id="inputPenulis" type="text" placeholder="Masukkan Nama Penulis" name="penulis" value="<?= htmlspecialchars($book['penulis']); ?>" />
                    <label for="inputPenulis">Penulis</label>
                </div>
                <div class="form-floating mb-3">
                    <input class="form-control" id="inputPenerbit" type="text" placeholder="Masukkan Nama Penerbit" name="penerbit" value="<?= htmlspecialchars($book['penerbit']); ?>" />
                    <label for="inputPenerbit">Penerbit</label>
                </div>
                <div class="form-floating mb-3">
                    <input class="form-control" id="inputTahun" type="number" placeholder="Masukkan Tahun Terbit" name="tahun_terbit" value="<?= htmlspecialchars($book['tahun_terbit']); ?>" />
                    <label for="inputTahun">Tahun Terbit</label>
                </div>
                <div class="mb-3">
                    <label for="inputGroupFile02" class="form-label">Foto Saat Ini</label><br>
                    <?php if (!empty($book['foto'])): ?>
                        <img src="upload/<?= htmlspecialchars($book['foto']); ?>" alt="<?= htmlspecialchars($book['judul']); ?>" height="150" width="150" class="mb-3" />
                    <?php else: ?>
                        <div class="mb-3">Tidak ada foto.</div>
                    <?php endif; ?>
                </div>
                <div class="input-group mb-3">
                    <input type="file" class="form-control h-50" id="inputGroupFile02" name="foto" accept="image/*">
                    <label for="inputGroupFile02" class="input-group-text">Upload</label>
                </div>
                <div class="mt-4 mb-8">
                    <div class="d-flex justify-content-between">
                        <input type="submit" class="btn btn-primary btn-block" value="Simpan Perubahan">
                        <a href="index.php?page=view-buku" class="btn btn-secondary btn-block">Kembali</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
