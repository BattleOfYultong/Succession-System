<?php
session_start();
    include 'config.php';

$name = $_POST['Name'];
$Email = $_POST['Email'];
$password = $_POST['Password'];
$account_type = $_POST['account_type'];

$sql = "INSERT INTO user_tbl (Email, Password, Name, Account_type) VALUES ('$Email', '$password', '$name', 
$account_type)";

if($connections->query($sql) === TRUE){
    if ($account_type == 2) {
        $_SESSION['Email'] = $Email;
        echo "<script>window.location.href ='../registerposition.php?register_success=true';</script>";
    } else {
        echo "<script>window.location.href ='../login.php?register_success=true';</script>";
    }
}
else{
    echo "error:" .$sql. "br" .$connections->error;
}

