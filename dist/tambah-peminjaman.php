<?php
include __DIR__ . '/../konek.php';
$query_anggota = mysqli_query($conn, 'SELECT * FROM anggota');
$query_buku = mysqli_query($conn, 'SELECT * FROM buku');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_peminjam = $_POST['nama_peminjaman'];
    $id_buku = $_POST['judul_buku'];
    $tanggal_peminjaman = $_POST['tgl_peminjaman'];

    $insert_query = "INSERT INTO peminjaman (id_anggota, id_buku, tanggal_peminjaman) VALUES ('$id_peminjam', '$id_buku', '$tanggal_peminjaman');";

    if (mysqli_query($koneksi, $insert_query)) {
        echo "<script>alert('Data Peminjaman Berhasil Ditambahkan')</script>";
        exit();
    } else {
        echo "<script>alert('Data Peminjaman Gagal Ditambahkan')</script>";
    }
}
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Input Data Peminjaman Buku</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
        <li class="breadcrumb-item active">Input Data Peminjaman Buku</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-book me-1"></i>
            Form Input Data Peminjaman Buku
        </div>
        <div class="card-body">
            <form action="tambah-peminjaman.php" method="post" enctype="multipart/form-data">
                <div class="form-floating mb-3">
                    <select class="form-select" id="inputNamaPeminjam" type="text" placeholder="Nama Peminjam"
                        name="nama_peminjaman">
                        <option selected>Pilih Nama Peminjam...</option>
                        <?php 
                        $query = mysqli_query($conn, "SELECT * FROM anggota");
                        while ($row = mysqli_fetch_array($query)) {
                        ?>
                        <option value="<?= $row['id']; ?>1"><?= $row['nama_anggota']; ?></option>
                        <?php } ?>
                    </select> <label for="inputName">Nama Peminjam</label>
                </div>
                <div class="form-floating mb-3">
                    <select class="form-select" id="inputBuku" type="text" placeholder="Judul Buku" name="judul_buku">
                        <option selected>Pilih Judul Buku...</option>
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