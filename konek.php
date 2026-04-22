<?php
$root = "localhost";
$username = "root";
$password = "";
$database = "perpus_db";

$conn = mysqli_connect($root, $username, $password, $database);
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
