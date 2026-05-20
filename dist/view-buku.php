<?php
include __DIR__ . '/../konek.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['delete'])) {
        $id = $_POST['id'];
        $delete = mysqli_query($conn, "DELETE FROM buku WHERE id='$id'");

        if ($delete) {
            echo "<script>alert('Data buku berhasil dihapus.'); window.location.href = 'index.php?page=view-buku';</script>";
        } else {
            echo "<script>alert('Gagal menghapus data buku.');</script>";
        }
    }
}
?>

<div class="container-fluid px-4">
                    <h1 class="mt-4">Daftar Buku</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Daftar Buku</li>
                    </ol>

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-book me-1"></i>
                            Data Buku
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul Buku</th>
                                        <th>Penulis</th>
                                        <th>Tahun</th>
                                        <th>Foto</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $query = mysqli_query($conn, "SELECT * FROM buku");

                                    while ($row = mysqli_fetch_array($query)) {
                                        $folder = "upload/";
                                        $fotoSrc = !empty($row['foto']) ? $folder . $row['foto'] : 'https://via.placeholder.com/200x200?text=No+Image';
                                    ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= htmlspecialchars($row['judul']); ?></td>
                                            <td><?= htmlspecialchars($row['penulis']); ?></td>
                                            <td><?= !empty($row['tahun_terbit']) ? htmlspecialchars($row['tahun_terbit']) : '-'; ?></td>
                                            <td><img height="200" width="200" src="<?= htmlspecialchars($fotoSrc); ?>" alt="<?= htmlspecialchars($row['judul']); ?>"></td>
                                            <td>
                                                <a href="index.php?page=edit-buku&id=<?= $row['id']; ?>" class="btn btn-sm btn-primary mb-1">Edit</a>
                                                <form action="index.php?page=view-buku" method="post" class="d-inline">
                                                    <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                                    <button type="submit" name="delete" value="1" class="btn btn-sm btn-danger mb-1" onclick="return confirm('Yakin ingin menghapus buku ini?');">Hapus</button>
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