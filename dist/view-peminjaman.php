<?php
include __DIR__ . '/../konek.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['delete'])) {
        $id = $_POST['id'];
        $delete = mysqli_query($conn, "DELETE FROM peminjaman WHERE id_peminjaman='$id'");

        if ($delete) {
            echo "<script>alert('Data peminjaman berhasil dihapus.'); window.location.href = 'index.php?page=view-peminjaman';</script>";
        } else {
            echo "<script>alert('Gagal menghapus data peminjaman.');</script>";
        }
    }
}

?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Daftar Peminjaman</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
        <li class="breadcrumb-item active">Daftar Peminjaman</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-book me-1"></i>
            Data Peminjaman
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Peminjam</th>
                        <th>Buku</th>
                        <th>Tanggal Peminjaman</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $innerJoin = "SELECT anggota.nama_anggota, buku.judul, peminjaman.tanggal_peminjaman, peminjaman.id_peminjaman  FROM peminjaman INNER JOIN anggota ON peminjaman.id_anggota = anggota.id INNER JOIN buku ON peminjaman.id_buku = buku.id;";
                    $query = mysqli_query($conn, $innerJoin);

                    while ($row = mysqli_fetch_array($query)) {
                        $folder = "upload/";
                        $fotoSrc = !empty($row['foto']) ? $folder . $row['foto'] : 'https://via.placeholder.com/200x200?text=No+Image';
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars($row['nama_anggota']); ?></td>
                            <td><?= htmlspecialchars($row['judul']); ?></td>
                            <td><?= htmlspecialchars($row['tanggal_peminjaman']); ?></td>
                            <td>
                                <a href="index.php?page=edit-peminjaman&id=<?= $row['id_peminjaman']; ?>"
                                    class="btn btn-sm btn-primary mb-1">Edit</a>
                                <form action="index.php?page=view-peminjaman" method="post" class="d-inline">
                                    <input type="hidden" name="id" value="<?= $row['id_peminjaman']; ?>">
                                    <button type="submit" name="delete" value="1" class="btn btn-sm btn-danger mb-1"
                                        onclick="return confirm('Yakin ingin menghapus buku ini?');">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>