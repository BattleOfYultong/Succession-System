<?php
session_start();
if (isset($_SESSION['Email'])) {
    $Email = $_SESSION['Email'];
    include 'php/config.php';

    $profSql = "SELECT Email, Name, loginID FROM user_tbl WHERE Email = '$Email'";
    $result = mysqli_query($connections, $profSql);

    if ($result && mysqli_num_rows($result)) {
        $row = mysqli_fetch_assoc($result);
        $NameSession = $row['Name'];
        $SessionloginID = $row['loginID'];
    }
} else {
    echo "<script>window.location.href='../login.php?show_error=true';</script>";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['Submit'])) {
        $position = $_POST['position'];

        $sql = "UPDATE user_tbl SET Position = '$position' WHERE loginID = $SessionloginID";
        
        if($connections->query($sql) === TRUE){
            echo "<script>window.location.href='login.php?register_success=true';</script>";
        }
        else{
            echo "Error:" .$sql. "br" .$connections->error;
        }


    } else {
        echo "<script>window.location.href='registerposition.php?show_error=true';</>";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="SweetAlert/sweetalert2.min.css">
    <link rel="stylesheet" href="fontawesome-free-6.5.2-web/css/all.min.css">
    <link rel="stylesheet" href="css/login.css">
    <title>Login</title>
</head>
<body>
   
    <section>
        <form action="registerposition.php" method="POST">
            <h1>Position</h1>
            <div class="input-wrapper">
                <div class="inputbox">
                    <select name="position" id="">
                        <option value="Chief Operating Officer (COO)">Chief Operating Officer (COO)</option>
                        <option value="Chief Financial Officer (CFO)">Chief Financial Officer (CFO)</option>
                        <option value="Director of Operations">Director of Operations</option>
                        <option value="Director of Marketing">Director of Marketing</option>
                        <option value="Director of Human Resources">Director of Human Resources</option>
                        <option value="Operations Manager">Operations Manager</option>
                        <option value="Marketing Manager">Marketing Manager</option>
                        <option value="Human Resources Manager">Human Resources Manager</option>
                        <option value="Shift Supervisor">Shift Supervisor</option>
                        <option value="Team Leader">Team Leader</option>
                        <option value="Drivers">Drivers</option>
                    </select>
                </div>
                <div class="inputsubmit">
                    <input type="submit" name="Submit" value="Submit">
                </div>
                <div class="inputregister">
                    <a href="login.php">Already Have an Account</a>
                </div>
            </div>
        </form>
    </section>

    <?php
    if (isset($_GET['register_success']) && $_GET['register_success'] == 'true') {
        echo "
        <script src='SweetAlert/sweetalert2.all.min.js'></script>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Almost There $NameSession',
                timer: 2000,
                showConfirmButton: false,
                position: 'top',
            });
        </script>
        ";
    }
    ?>

    <?php
    if (isset($_GET['show_error']) && $_GET['show_error'] == 'true') {
        echo "
        <script src='SweetAlert/sweetalert2.all.min.js'></script>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Submit Error',
                timer: 2000,
                showConfirmButton: false,
                position: 'top',
            });
        </script>
        ";
    }
    ?>
</body>
</html>
