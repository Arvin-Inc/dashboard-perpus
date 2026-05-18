<?php
include __DIR__ . '/../konek.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$anggota = null;

if ($id > 0) {
    $result = mysqli_query($conn, "SELECT * FROM anggota WHERE id='$id'");
    $anggota = mysqli_fetch_assoc($result);
}

if (!$anggota) {
    echo "<script>alert('Anggota tidak ditemukan.'); window.location.href = 'index.php?page=view-anggota';</script>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_anggota = mysqli_real_escape_string($conn, trim($_POST['nama_anggota'] ?? ''));
    $username = mysqli_real_escape_string($conn, trim($_POST['username'] ?? ''));
    $jenis_kelamin = mysqli_real_escape_string($conn, trim($_POST['jenis_kelamin'] ?? ''));
    $gmail = mysqli_real_escape_string($conn, trim($_POST['gmail'] ?? ''));
    $alamat = mysqli_real_escape_string($conn, trim($_POST['alamat'] ?? ''));

    if (empty($nama_anggota) || empty($username) || empty($jenis_kelamin) || empty($gmail) || empty($alamat)) {
        echo "<script>alert('Harap isi semua kolom.');</script>";
    } else {
        $sql = "UPDATE anggota SET nama_anggota='$nama_anggota', alamat='$alamat', jk='$jenis_kelamin', gmail='$gmail', username='$username' WHERE id='$id'";
        $update = mysqli_query($conn, $sql);

        if ($update) {
            echo "<script>alert('Data anggota berhasil diperbarui.'); window.location.href = 'index.php?page=view-anggota';</script>";
            exit;
        } else {
            echo "<script>alert('Gagal memperbarui data anggota: " . mysqli_error($conn) . "');</script>";
        }
    }
}
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Edit Anggota</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="index.php?page=view-anggota">Daftar Anggota</a></li>
        <li class="breadcrumb-item active">Edit Anggota</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-book me-1"></i>
            Form Edit Anggota
        </div>
        <div class="card-body">
            <form action="index.php?page=edit-anggota&id=<?= $anggota['id']; ?>" method="post" enctype="multipart/form-data">
                <div class="form-floating mb-3">
                    <input class="form-control" id="inputName" type="text" placeholder="Masukkan Nama" name="nama_anggota" value="<?= htmlspecialchars($anggota['nama_anggota']); ?>" required /> <label for="inputName">nama anggota</label>
                </div>
                <div class="form-floating mb-3">
                    <input class="form-control" id="inputUsername" type="text" placeholder="Masukkan Username" name="username" value="<?= htmlspecialchars($anggota['username']); ?>" required /> <label for="inputUsername">Username</label>
                </div>
                <div class="input-group mb-3">
                  <label class="input-group-text p-3" for="inputGroupSelect01">Jenis Kelamin</label>
                  <select class="form-select" id="inputGroupSelect01" name="jenis_kelamin" required>
                    <option value="L" <?= $anggota['jk'] === 'L' ? 'selected' : '' ?> >Laki-Laki</option>
                    <option value="P" <?= $anggota['jk'] === 'P' ? 'selected' : '' ?> >Perempuan</option>
                  </select>
                </div>
                <div class="form-floating mb-3">
                    <input class="form-control" id="inputGmail" type="text" placeholder="Masukkan Nama Gmail" name="gmail" value="<?= htmlspecialchars($anggota['gmail']); ?>" required /> <label for="inputGmail">gmail</label>
                </div>
                <div class="form-floating mb-3">
                    <input class="form-control" id="inputAlamat" type="text" placeholder="Masukkan Nama Alamat" name="alamat" value="<?= htmlspecialchars($anggota['alamat']); ?>" required /> <label for="inputAlamat">alamat</label>
                </div>
                <div class="mt-4 mb-8">
                    <div class="d-flex justify-content-between">
                        <input type="submit" class="btn btn-primary btn-block" value="Simpan perubahan">
                        <a href="index.php?page=view-anggota" class="btn btn-secondary btn-block">Kembali</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
