<?php

include 'config.php';
$loginID = $_GET['loginID'];

$sql = "DELETE FROM user_tbl WHERE loginID  = $loginID";

 if ($connections->query($sql) === TRUE) {
    echo "<script>window.location.href='../admin/admin.php?delete_success=true';</script>";
} else {
    echo "Error: " . $sql . "<br>" . $connections->error;
}
