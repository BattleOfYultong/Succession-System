<?php

include 'config.php';

$name = $_POST['Name'];
$Email = $_POST['Email'];
$password = $_POST['Password'];
$position = $_POST['Position'];
$account_type = 2;

$sql = "INSERT INTO user_tbl (Name, Email, Password, Position, Account_type)
 VALUES ('$name', '$Email', '$password', '$position', $account_type)";

if ($connections->query($sql) === TRUE) {
    echo "<script>window.location.href='../admin/admin.php?create_success=true';</script>";
} else {
    echo "Error: " . $sql . "<br>" . $connections->error;
}

$connections->close();

