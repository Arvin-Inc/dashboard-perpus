                <div class="container-fluid px-4">
                    <h1 class="mt-4">Tambah Anggota</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Tambah Anggota</li>
                    </ol>

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-book me-1"></i>
                            Form Tambah Anggota
                        </div>
                        <div class="card-body">
                            <form action="Tambah-bukup.php" method="post" enctype="multipart/form-data">
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="inputName" type="text" placeholder="Masukkan Nama" name="nama_anggota" /> <label for="inputName">nama anggota</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="inputUmur" type="text" placeholder="Masukkan umur" name="umur" /> <label for="inputUmur">umur</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="inputAlamat" type="text" placeholder="Masukkan Nama Alamat" name="alamat" /> <label for="inputAlamat">alamat</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="inputTahunLahir" type="date" placeholder="Masukkan Tahun Lahir" name="tanggal_lahir" /> <label for="inputTahunLahir">tanggal lahir</label>
                                </div>
                                <div class="mt-4 mb-8">
                                    <div class="d-flex justify-content-between">
                                        <input type="submit" class="btn btn-primary btn-block" value="Tambah Anggota">
                                        <input type="reset" class="btn btn-danger btn-block" value="reset data">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>