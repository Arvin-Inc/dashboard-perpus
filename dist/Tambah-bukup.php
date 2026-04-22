<?php
include __DIR__ . '/../konek.php';
session_start();

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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - SB Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.php">Start Bootstrap</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Settings</a></li>
                    <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">Interface</div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Layouts
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="layout-static.html">Static Navigation</a>
                                <a class="nav-link" href="layout-sidenav-light.html">Light Sidenav</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Pages
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                    Anggota
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="Tambah-anggota.php">Tambah anggota</a>
                                        <a class="nav-link" href="Tampil-anggota.php">Tampil anggota</a>
                                    </nav>
                                </div>
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                    Buku
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="Tambah-bukup.php">Tambah Buku</a>
                                        <a class="nav-link" href="Tampilan-buku.php">Tampilan Buku</a>
                                    </nav>
                                </div>
                            </nav>
                        </div>
                        <div class="sb-sidenav-menu-heading">Addons</div>
                        <a class="nav-link" href="charts.html">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Charts
                        </a>
                        <a class="nav-link" href="tables.html">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Tables
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    <?php echo $_SESSION['username'] ?>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
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
            </main>

            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2023</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>