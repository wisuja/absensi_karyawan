<?php
session_start();

require("koneksi.php");

$username = $_POST["username"];
$password = $_POST["password"];

$data = mysqli_query($koneksi, "SELECT id, account_type, nama FROM karyawan WHERE username = '$username' AND password = '$password'");

if (mysqli_num_rows($data) < 1) {
  header("Location: index.php?msg=failed");
}

while ($d = mysqli_fetch_array($data)) {
  if ($d["account_type"] == 1) {
    $_SESSION["id"] = $d["id"];
    $_SESSION["name"] = $d["nama"];
    $_SESSION["status"] = "admin";
    header("Location: admin/index.php");
  } else if ($d["account_type"] == 2) {
    $_SESSION["id"] = $d["id"];
    $_SESSION["name"] = $d["nama"];
    $_SESSION["status"] = "karyawan";
    header("Location: karyawan/index.php");
  }
}
