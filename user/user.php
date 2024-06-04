<?php
    session_start();
    if(isset($_SESSION['Email'])){
        $Email = $_SESSION['Email'];
            include '../php/config.php';

        $profSql = "SELECT Email, Name, loginID, Position FROM user_tbl WHERE Email = '$Email'";
        $result = mysqli_query($connections, $profSql);

        if($result && mysqli_num_rows($result)){
            $row = mysqli_fetch_assoc($result);
            $NameSession = $row['Name'];
            $SessionloginID =$row['loginID'];
            $sessionPosition = $row['Position'];
        }
    }
    else{
        echo "<script>window.location.href='../login.php?show_error=true';</script>";
        
    }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <script src="../SweetAlert/sweetalert2.min.css"></script>
    <script src="../SweetAlert/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="../fontawesome-free-6.5.2-web/css/all.min.css" />
    <script src="../jquery/jquery.js"></script>
    <link rel="stylesheet" href="../css/dashboard.css">
    <title>Admin</title>
</head>
<body>

    <aside>
        <div class="profiles">
            
            <h1>User</h1>
        </div>

        <ul>
            <li class="li-act">
                <a href="admin.php">
                    <span>Dashboard</span>
                </a>
            </li>

            <li>
                <a href="">
                    <span>Successions</span>
                </a>
            </li>

            <li class="">
                <a href="">
                    <span>Descriptions</span>
                </a>
            </li>

            <li >
                <a href="../php/logout.php">
                    <span>Log - Out</span>
                </a>
            </li>
        </ul>
        

    </aside>

    <main>
        <nav>
            <div class="title-sys">
                 <h1>Sucession Planning </h1>
            </div>
        </nav>

        <section>
                <div class="profile-container">
                
                        <h1>Name: <?php echo "$NameSession" ?> </h1>
                        <h1>Email: <?php echo "$Email" ?> </h1>
                        <h1>Position: <?php echo "$sessionPosition" ?> </h1>
                </div>
           
        </section>
        
    </main>

                
<script>
    function confirmDelete(loginID) {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "../php/delete.php?loginID=" + loginID;
            }
        });
    }

    </script>

      <?php
if (isset($_GET['delete_success']) && $_GET['delete_success'] == 'true') {
    echo "
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Slot Deleted',
            timer: 2000,
            showConfirmButton: false,
            position: 'top',
        });
    </script>
    ";
}
?>      

 <?php
if (isset($_GET['position_success']) && $_GET['position_success'] == 'true') {
    echo "
    <script>
        Swal.fire({
            icon: 'success',
            title: 'User Has been Edited',
            timer: 2000,
            showConfirmButton: false,
            position: 'top',
        });
    </script>
    ";
}
?>      
<?php
if (isset($_GET['show_name']) && $_GET['show_name'] == 'true') {
    echo "
    <script>
        Swal.fire({
            position: 'top',
            icon: 'success',
            title: 'Welcome $NameSession',
            showConfirmButton: false,
            timer: 1500
        });
    </script>
    ";
}
?>

<?php
if (isset($_GET['edit_success']) && $_GET['edit_success'] == 'true') {
    echo "
    <script>
        Swal.fire({
            position: 'top',
            icon: 'success',
            title: 'Slot Has been Edited',
            showConfirmButton: false,
            timer: 1500
        });
    </script>
    ";
}
?>

<?php
if (isset($_GET['create_success']) && $_GET['create_success'] == 'true') {
    echo "
    <script>
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'User Has Been Created',
            showConfirmButton: false,
            timer: 1500
        });
    </script>
    ";
}
?>

    <script>
        function CreateSlot(){
            const CreateContainer = document.querySelector('.create-container');
            CreateContainer.classList.add('create-act');
        };

        function ExitSlot() {
            const CreateContainer = document.querySelector('.create-container');
            CreateContainer.classList.remove('create-act');
        };

        function editUser(loginID) {
        const editContainer = document.getElementById('container_' + loginID);
        editContainer.classList.add('create-act');
    }
    function ExitEdit(containerID) {
        const editContainer = document.getElementById(containerID);
        editContainer.classList.remove('create-act');
    }


        
        
    </script>
</body>
</html>