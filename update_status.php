<?php
session_start();
include "config.php";

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_POST['id']) || !isset($_POST['status'])) {
    header("Location: home.php");
    exit;
}

$id = intval($_POST['id']);
$status = intval($_POST['status']); 

mysqli_query($conn, "UPDATE trusts SET status_checked = $status WHERE id = $id");


if ($status == 1) {
   
    header("Location: home.php");
} else {

    header("Location: checked.php");
}
exit;
