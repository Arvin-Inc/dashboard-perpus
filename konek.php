<?php
$root = "localhost";
$username = "root";
$password = "";
$database = "db_perpus";

$conn = mysqli_connect($root, $username, $password, $database);
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
