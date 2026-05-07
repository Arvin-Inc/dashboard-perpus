<?php
$root = "localhost";
$username = "root";
$password = "";
$database = "db_perpustakaan";

$conn = mysqli_connect($root, $username, $password, $database);
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
