<?php

include 'config.php';
$loginID = $_POST['loginID'];
$name = $_POST['Name'];
$Email = $_POST['Email'];
$Password = $_POST['Password'];
$position = $_POST['Position'];

$sql = "UPDATE user_tbl SET Name = '$name', Email = '$Email', Password = '$Password', Position = '$position'
    WHERE loginID = $loginID";

if ($connections->query($sql) === TRUE) {
    if ($_POST['Position'] != $_POST['OldPosition']) {
        echo  "<script>window.location.href='../admin/admin.php?position_success=true';</script>";
    } else {
        echo "<script>window.location.href='../admin/admin.php?edit_success=true';</script>";
    }
} else {
    echo "Error: " . $sql . "<br>" . $connections->error;
}
?>
