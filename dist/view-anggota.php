<?php
include __DIR__ . '/../konek.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['delete'])) {
        $id = $_POST['id'];
        $delete = mysqli_query($conn, "DELETE FROM anggota WHERE id='$id'");

        if ($delete) {
            echo "<script>alert('Data buku berhasil dihapus.'); window.location.href = 'index.php?page=view-buku';</script>";
        } else {
            echo "<script>alert('Gagal menghapus anggota buku.');</script>";
        }
    }
}
?>
    
    <div class="container-fluid px-4">
        <h1 class="mt-4">Daftar Anggota</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item active">Daftar Anggota</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-book me-1"></i>
                Data Anggota
            </div>
            <div class="card-body">
                <table id="datatablesSimple" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama anggota</th>
                            <th>Username</th>
                            <th>Gmail</th>
                            <th>Jenis Kelamin</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $query = mysqli_query($conn, "SELECT * FROM anggota");
                        while ($row = mysqli_fetch_array($query)) {
                            $folder = "upload/";
                            $fotoSrc = !empty($row['foto']) ? $folder . $row['foto'] : 'https://via.placeholder.com/200x200?text=No+Image';
                        ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $row['nama_anggota']; ?></td>
                                <td><?= $row['username']; ?></td>
                                <td><?= $row['gmail']; ?></td>
                                <td><?= $row['jk']; ?></td>
                                <td><?= $row['alamat']; ?></td>
                                <td>
                                    <a href="index.php?page=edit-anggota&id=<?= $row['id']; ?>" class="btn btn-sm btn-primary mb-1">Edit</a>
                                    <form action="index.php?page=delete-anggota&id=<?= $row['id']; ?>" method="post" style="display: inline;">
                                        <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                        <button type="submit" class="btn btn-sm btn-danger mb-1" onclick="return confirm('Yakin ingin menghapus anggota ini?');">Hapus</button>
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