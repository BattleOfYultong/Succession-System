<?php
    session_start();
    if(isset($_SESSION['Email'])){
        $Email = $_SESSION['Email'];
            include '../php/config.php';

        $profSql = "SELECT Email, Name, loginID FROM user_tbl WHERE Email = '$Email'";
        $result = mysqli_query($connections, $profSql);

        if($result && mysqli_num_rows($result)){
            $row = mysqli_fetch_assoc($result);
            $NameSession = $row['Name'];
            $SessionloginID =$row['loginID'];
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
            
            <h1>ADMIN</h1>
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

            <div class="button-create">
                <button onclick="CreateSlot();">Create User</button>
            </div>

                <div class="table-con">
                    <table>
                        <thead>
                            <tr>
                                <th>
                                    loginID
                                </th>
                                <th>
                                    Name   
                                </th>
                                <th>
                                   Email
                                </th>

                                <th>
                                    Position
                                </th>

                                

                                <th>
                                    Action
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            include '../php/config.php';
                           $sql = "SELECT *FROM user_tbl";
                            $result = $connections->query($sql);

                            if(!$result){
                                die("Invalid Query: " .$connections->error);
                            }

                          
                        while($row = $result->fetch_assoc()){
                            $loginID = $row['loginID'];
                            
                                if($row['Account_type'] == 1){
                                    continue;
                                }

                                echo '<tr>
                                    <td>
                                        '.$row['loginID'].'
                                    </td>
                                    <td>
                                        '.$row['Name'].'
                                    </td>
                                    <td>
                                        '.$row['Email'].'
                                    </td>

                                    <td>
                                        '.$row['Position'].'
                                    </td>

                                    <td>
                                        <div class="wrapper-btn">
                                            <button onclick="editUser(\''.$loginID.'\');" class="edit-button" data-loginid="'.$loginID.'">Edit/View</button>
                                            <a href="#" onclick="confirmDelete(\''.$loginID.'\');">
                                                    <button>Delete</button>
                                            </a>
                                        </div>
                                    </td>
                                </tr>';
                            }
                            ?>

                           
                        </tbody>
                    </table>
                </div>

           <?php
include '../php/config.php';

$slotsQuery = "SELECT * FROM user_tbl";
$slotsResult = $connections->query($slotsQuery);

if (!$slotsResult) {
    die("Invalid Query: " . $connections->error);
}

while ($slot = $slotsResult->fetch_assoc()) {
    $loginID = $slot['loginID'];
    $currentPosition = $slot['Position']; // Assuming 'Position' is the column name in your database
    $containerID = 'container_' . $slot['loginID']; // Unique ID for each update container  
?>

<form action="../php/edit.php" method="post" class="edit-container" id="<?php echo $containerID; ?>">
    <div class="create-header">
        <div onclick="ExitEdit('<?php echo $containerID; ?>');" class="exitbtn" id="<?php echo $containerID . '_exitbtn'; ?>">
            <i class="fa-solid fa-circle-xmark exitbtncreate"></i>
        </div>
        <h1>Edit/Promote User</h1>
    </div>

    <div class="input-wrapper" id="edit-wrap">
        <div class="inputbox">
            <label for="">Name</label>
            <input type="text" name="loginID" placeholder="loginID" value="<?php echo $loginID; ?>" readonly>
        </div>

        <div class="inputbox">
            <label for="">Name</label>
            <input type="text" name="Name" placeholder="Name" value="<?php echo $slot['Name']; ?>">
        </div>

        <div class="inputbox">
            <label for="">Email</label>
            <input type="text" name="Email" placeholder="Email" value="<?php echo $slot['Email']; ?>">
        </div>

        <div class="inputbox">
            <label for="">Password</label>
            <input type="password" name="Password" placeholder="*****" value="<?php echo $slot['Password']; ?>">
        </div>

        <div class="inputbox">
            <label for="">Position</label>
            <select name="Position" id="">
                <option value="Chief Operating Officer (COO)" <?php if ($currentPosition == "Chief Operating Officer (COO)") echo 'selected'; ?>>Chief Operating Officer (COO)</option>
                <option value="Chief Financial Officer (CFO)" <?php if ($currentPosition == "Chief Financial Officer (CFO)") echo 'selected'; ?>>Chief Financial Officer (CFO)</option>
                <option value="Director of Operations" <?php if ($currentPosition == "Director of Operations") echo 'selected'; ?>>Director of Operations</option>
                <option value="Director of Marketing" <?php if ($currentPosition == "Director of Marketing") echo 'selected'; ?>>Director of Marketing</option>
                <option value="Director of Human Resources" <?php if ($currentPosition == "Director of Human Resources") echo 'selected'; ?>>Director of Human Resources</option>
                <option value="Operations Manager" <?php if ($currentPosition == "Operations Manager") echo 'selected'; ?>>Operations Manager</option>
                <option value="Marketing Manager" <?php if ($currentPosition == "Marketing Manager") echo 'selected'; ?>>Marketing Manager</option>
                <option value="Human Resources Manager" <?php if ($currentPosition == "Human Resources Manager") echo 'selected'; ?>>Human Resources Manager</option>
                <option value="Shift Supervisor" <?php if ($currentPosition == "Shift Supervisor") echo 'selected'; ?>>Shift Supervisor</option>
                <option value="Team Leader" <?php if ($currentPosition == "Team Leader") echo 'selected'; ?>>Team Leader</option>
                <option value="Drivers" <?php if ($currentPosition == "Drivers") echo 'selected'; ?>>Drivers</option>
            </select>
        </div>

        <div class="input-submit">
            <input type="submit" value="Submit">
        </div>
    </div>
</form>

<?php } ?>

      
<form action="../php/create.php" method="post" class="create-container">
    <div class="create-header">
        <div onclick="ExitSlot();" class="exitbtn">
            <i class="fa-solid fa-circle-xmark exitbtncreate"></i>
        </div>
        <h1>Create User</h1>
    </div>

    <div class="input-wrapper">
        
        <div class="inputbox">
            <label for="">Name</label>
            <input type="text" name="Name" placeholder="Name">
        </div>

        <div class="inputbox">
            <label for="">Email</label>
            <input type="text" name="Email" placeholder="Email">
        </div>

        <div class="inputbox">
            <label for="">Password</label>
            <input type="password" name="Password" placeholder="*****" >
        </div>

        <div class="inputbox">
            <label for="">Position</label>
             <select name="Position" id="">
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

         
        
        <div class="input-submit">
            <input type="submit" value="Submit">
        </div>
    </div>
</form>

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