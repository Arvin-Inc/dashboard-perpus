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
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $query = mysqli_query($conn, "SELECT * FROM anggota");
                        while ($row = mysqli_fetch_array($query)) {
                        ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $row['nama_anggota']; ?></td>
                                <td><?= $row['username']; ?></td>
                                <td><?= $row['gmail']; ?></td>
                                <td><?= $row['jk']; ?></td>
                                <td><?= $row['alamat']; ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>