<?php
include '../../konek.php';
session_start();

if ($_SERVER ["REQUEST_METHOD"] == "POST") {
    $nama = $_POST["nama"];
    $alamat = $_POST["alamat"];
    $jk = $_POST["jk"];
    $email = $_POST["email"];
    $password = $_POST["password"];    
    // $password2 = $_POST["password2"];

    $cekemail = mysqli_query($conn, "SELECT * FROM anggota WHERE gmail = '$email'");
    $cekusername = mysqli_query($conn, "SELECT * FROM anggota WHERE nama_anggota = '$nama'");

    if (mysqli_num_rows($cekemail) > 0) {
        echo "<script>alert('Email sudah terdaftar');</script>";
        header("Location: register.php");
    } elseif (mysqli_num_rows($cekusername) > 0) {
        echo "<script>alert('Username sudah terdaftar');</script>";
        header("Location: register1.php");
    } else {
        $query = mysqli_query($conn, "INSERT INTO anggota (nama_anggota, alamat, jk, gmail, password) VALUES ('$nama', '$alamat', '$jk', '$email', '$password')");
        if ($query) {
            echo "<script>alert('Registrasi berhasil');</script>";
            header("Location: login.php");
        } else {
            echo "<script>alert('Registrasi gagal');</script>";
            header("Location: register.php");
        }
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
        <title>Register Anggota - SB Admin</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Register Anggota</h3></div>
                                    <div class="card-body"> 
                                        <form action="register1.php" method="post">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputUsername" type="text" placeholder="name@example.com" name="nama" />
                                                <label for="inputUsername">nama</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputEmail" type="text" placeholder="name@example.com" name="alamat" />
                                                <label for="inputEmail">Alamat</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <select class="form-select" aria-label="Default select example" name="jk">
                                                    <option value="perempuan">perempuan</option>
                                                    <option value="laki laki">laki laki</option>
                                                </select>
                                                <label for="jk">jk</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputEmail" type="email" placeholder="name@example.com" name="email" />
                                                <label for="email">gmail</label>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="inputPassword" type="password" placeholder="Create a password" name="password" />
                                                        <label for="inputPassword">Password</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-4 mb-0">
                                                <div class="d-grid"><input class="btn btn-primary btn-block" type="submit" value="register"></div>
                                            </div>
                                        </form>
                                        
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="login.php">login</a></div>
                                        <div class="small"><a href="register.php">register user</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
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
    </body>
</html>
