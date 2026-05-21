<?php
include __DIR__ . '/../konek.php';


$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$peminjaman = null;

if ($id > 0) {
    $result = mysqli_query($conn, "SELECT * FROM peminjaman WHERE id_peminjaman='$id'");
    $peminjaman = mysqli_fetch_assoc($result);
}

if (!$peminjaman) {
    echo "<script>alert('Peminjaman tidak ditemukan.'); window.location.href = 'index.php?page=view-peminjaman';</script>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_anggota = trim($_POST['id_anggota']);
    $id_buku = trim($_POST['id_buku']);
    $tanggal_peminjaman = trim($_POST['tanggal_peminjaman']);

    if (empty($id_anggota) || empty($id_buku) || empty($tanggal_peminjaman)) {
        echo "<script>alert('Harap isi semua kolom.');</script>";
    } else {
        $update = mysqli_query($conn, "UPDATE peminjaman SET id_anggota='$id_anggota', id_buku='$id_buku', tanggal_peminjaman='$tanggal_peminjaman' WHERE id_peminjaman='$id'");

        if ($update) {
            echo "<script>alert('Data peminjaman berhasil diperbarui.'); window.location.href = 'index.php?page=view-peminjaman';</script>";
            exit;
        } else {
            echo "<script>alert('Gagal memperbarui data peminjaman.');</script>";
        }
    }
}
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Edit Data Peminjaman Buku</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
        <li class="breadcrumb-item active">Edit Data Peminjaman Buku</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-book me-1"></i>
            Form Edit Data Peminjaman Buku
        </div>
        <div class="card-body">
            <form action="tambah-peminjaman.php" method="post" enctype="multipart/form-data">
                <div class="form-floating mb-3">
                    <select class="form-select" id="inputNamaPeminjam" type="text" placeholder="Nama Peminjam"
                        name="nama_peminjaman">
                        <?php 
                        $query = mysqli_query($conn, "SELECT * FROM anggota");
                        while ($row = mysqli_fetch_array($query)) {
                        ?>
                        <option value="<?= $row['id']; ?>"><?= $row['nama_anggota']; ?></option>
                        <?php } ?>
                    </select> <label for="inputName">Nama Peminjam</label>
                </div>
                <div class="form-floating mb-3">
                    <select class="form-select" id="inputBuku" type="text" placeholder="Judul Buku" name="judul_buku">
                        <?php 
                        $query = mysqli_query($conn, "SELECT * FROM buku");
                        while ($row = mysqli_fetch_array($query)) {
                        ?>
                        <option value="<?= $row['id']; ?>"><?= $row['judul']; ?></option>
                        <?php } ?>
                    </select>
                    <label for="inputName">Nama Peminjam</label>
                </div>
                <div class="form-floating mb-3">
                    <input class="form-control" id="inputTglPeminjaman" type="date" placeholder="Tanggal Peminjaman"
                        name="tgl_peminjaman" /> <label for="inputTglPeminjaman">Tanggal Peminjaman</label>
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