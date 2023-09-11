<?php 
    sleep(1);

    if (!isset($_SESSION['acc_name'])) {
        $_SESSION['msg'] = "You must log in first";
        header('location: ../login/log.php');
    }
    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['acc_name']);
        header('location: ../login/log.php');
    }
    require('../server.php');
    include ('master/amaster.php');
    include('includes/errors.php');
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Add User</title>
        <link rel="stylesheet" type="text/css" href="../../style.css">
    </head>
    <body>
        <div id="addUserModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <br>    
                <div class="sec1">
                    <form method="post" id="users" class="input-group" enctype="multipart/form-data"  action = "">
                        <div class = "group">
                            <div class = "card"> 
                                <label for="empid">Employee Number</label> <br>
                                <input type="text" id="employee" name="emp_id" placeholder="ID number" value="<?php echo $emp_id;?>" required><br>
                            </div>
                            <div class = "card"> 
                                <label for="employee">Access Role</label><br>
                                <select name="emp_type">
                                    <?php 
                                    foreach ($options as $option) {
                                    ?>
                                        <option> <?php echo $option['acc_type']; ?> </option>
                                        <?php 
                                        }
                                    ?>
                                </select> <br>
                            </div>
                            <div class = "card"> 
                                <label for="email">Email</label><br> 
                                <input type="text" id="" name="email" placeholder="example@gmail.com" value="<?php echo $email;?>" required><br>
                            </div>
                        </div>
                        <label for="empname">Employee Name</label><br>
                        <div class = "group">
                            <input type="text" id="" name="emp_fname" placeholder="First Name" value="<?php echo $emp_fname;?>" required>
                            <input type="text" id="" name="emp_mname" placeholder="Middle Name (Leave it blank if NONE)" value="<?php echo $emp_mname;?>">
                            <input type="text" id="" name="emp_lname" placeholder="Last Name" value="<?php echo $emp_lname;?>" required><br><br>
                        </div>  
                        <div class = "group">
                            <div class = "card"> 
                                <label for="username">Username</label>
                                <input type="text" id="" name="username" placeholder="example123" value="<?php echo $username;?>" required><br>
                            </div>
                            <div class = "card"> 
                                <label for="dob">Date of Birth</label>
                                <input type="date" class=" input-group" id="DOB" name="emp_DOB" required><br> <br>
                            </div>
                        </div> 
                        <div class = "group">
                            <div class = "card"> 
                                <label for="password1">Enter New Password</label><br> 
                                <input type="password" id="" name="password_1" placeholder="" value="<?php echo $password_1;?>" required><br>
                            </div>
                            <div class = "card"> 
                                <label for="password2">Confirm New Password</label><br> 
                                <input type="password" id="" name="password_2" placeholder="" value="<?php echo $password_2;?>" required><br>
                            </div>
                        </div>
                        <br><br>
                        <button style="color:white; background-color:#7002022;" type="submit" class="submit-btn" name="add_emp" >Submit</button>
                    </form> 
                </div>
            </div>
        </div>
    </body>
</html>
