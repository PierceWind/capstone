<?php 
    sleep(1);
    session_start();

    
    if (!isset($_SESSION['acc_name'])) {
        $_SESSION['msg'] = "You must log in first";
        header('location:../../login/log.php');
    }
    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['acc_name']);
        header('location:../../login/log.php');
    }
    include('../users/server.php');
    include ('master/emaster.php');

    $acc_name = $_SESSION['acc_name'] ;

    // Prefill the form with existing user data
    /* $query = "SELECT account.*, accinfo.*
        FROM account
        INNER JOIN accinfo
        ON account.acc_id = accinfo.acc_id
        WHERE account.acc_name = '$acc_name'";
    $result = mysql_query($query, $conn);

    if (!$result) {
        die("Database query failed: " . mysql_error());
    }

    if (mysql_num_rows($result) == 1) {
        $row = mysql_fetch_assoc($result);
        $emp_id = $row['acc_id'];
        $emp_fname = $row['fname'];
        $emp_mname = $row['mname'];
        $emp_lname = $row['lname'];
        $emp_DOB = $row['DOB'];
        $email = $row['email'];
        $username = $row['username'];
    }
    */

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Inventory</title>
    <link rel="icon" type="image/x-icon" href="../../files/icons/tdf.png">
    <link rel="stylesheet" type="text/css" href="../style.css">

</head>
<body>
    <div class="container">
        <nav>
            <ul>
                <br>
                <li>
                    <a href="../index.php" class="logo">
                        <img src="../../files/icons/tdf.png" alt=""> 
                        <span class="nav-title">To Die For<br>FOODS</span>
                    </a>
                </li> <br>
                <li>
                    <a href="">
                        <img src="../../files/icons/admin.png" alt="" class="fas"> 
                        <span class="nav-item">Administrator</span>
                    </a>
                </li> <br>
                <hr style="border: 1px solid #700202;">
                <br>
                <li>   
                    <a href="../dash.php">
                        <img src="../../files/icons/dashboard.png" alt="" class="fas">
                        <span class="nav-item">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="../users/user.php">
                        <img src="../../files/icons/user.png" alt="" class="fas">
                        <span class="nav-item">Manage Users</span>
                    </a>
                </li>
                <li>
                    <a href="../menu/menu.php">
                        <img src="../../files/icons/menu.png" alt="" class="fas">
                        <span class="nav-item">Manage Menu</span>
                    </a>
                </li>
                <li>
                    <a href="../inventory/stock.php">
                        <img src="../../files/icons/inventory.png" alt="" class="fas">
                        <span class="nav-item">Manage Inventory</span>
                    </a>
                </li>
                <li><a href="../dash.php?logout='1'" class="logout">
                    <img src="../../files/icons/logout.png" alt="" class="fas">
                    <span class="nav-item">Sign Out</span>
                </a></li>
            </ul>
        </nav>
        <section class="view" id="view">
            <div class="view-list">
                <h1 style="text-align: center;">Administrator Settings</h1> 
                <br><hr style="border: 1px solid #808080;"><br><br>
                <form method="post" id="editusers" class="input-group" enctype="multipart/form-data" action="">
                        <div class = "group">
                            <div class = "card"> 
                                <label for="editEmpid">Employee Number</label> <br>
                                <input type="text" id="editEmp_id" name="acc_id" placeholder="ID number" value="<?php echo $emp_id;?>" required><br>
                            </div>
                            <div class = "card"> 
                                <label for="email">Email</label><br> 
                                <input type="text" id="
                                Email" name="email" placeholder="example@gmail.com" value="<?php echo $email;?>" required><br>
                            </div>
                        </div>
                        <label for="empname">Employee Name</label><br>
                        <div class = "group">
                            <input type="text" id="editEmp_fname" name="fname" placeholder="First Name" value="<?php echo $emp_fname;?>" required>
                            <input type="text" id="editEmp_mname" name="mname" placeholder="Middle Name (Leave it blank if NONE)" value="<?php echo $emp_mname;?>" >
                            <input type="text" id="editEmp_lname" name="lname" placeholder="Last Name" value="<?php echo $emp_lname;?>" required><br><br>
                        </div>  
                        <div class = "group">
                            <div class = "card"> 
                                <label for="username">Username</label>
                                <input type="text" id="editUsername" name="acc_name" placeholder="example123" value="<?php echo $username;?>" required><br>
                            </div>
                            <div class="card">
                                <label for="dob">Date of Birth</label>
                                <input type="date" class="input-group" id="editEmp_DOB" name="DOB" value="<?php echo $emp_DOB; ?>" required><br> <br>
                            </div>
                        </div> 
                        <div class = "group">
                            <div class = "card"> 
                                <label for="currentPassword">Enter Current Password</label><br>
                                <input type="password" id="currentPassword" name="currentPassword" placeholder="Current Password" required><br>
                            </div>
                            <div class = "card"> 
                                <label for="password1">Enter New Password</label><br> 
                                <input type="password" id="editPassword_1" name="Password_1" placeholder="" value="<?php echo $password_1;?>" required><br>
                            </div>
                            <div class = "card"> 
                                <label for="password2">Confirm New Password</label><br> 
                                <input type="password" id="editPassword_2" name="Password_2" placeholder="" value="<?php echo $password_2;?>" required><br>
                            </div>
                        </div>
                        <br><br>
                        <button style="color:white; background-color:#7002022;" type="submit" class="submit-btn" name="edit_emp" >Submit</button>
                    </form> 
            </div>
        </section>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        // JavaScript code here
    });
    </script>
</body>
</html>
