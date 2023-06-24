<?php 
    sleep(1);
    session_start();

    if (!isset($_SESSION['acc_name'])) {
        $_SESSION['msg'] = "You must log in first";
        header('location: ../login/log.php');
    }
    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['acc_name']);
        header('location: ../login/log.php');
    }

    require('server.php');
    include ('includes/header.php');

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Manage Users</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <div class="container">
            <nav>
                <ul>
                    <br>
                    <li>
                        <a href="../index.php" class="logo">
                            <img src="../files/icons/tdf.png" alt=""> 
                            <span class="nav-title">To Die For<br>FOODS</span>
                        </a>
                    </li> <br>
                    <li>
                        <a href="">
                            <img src="../files/icons/admin.png" alt="" class="fas"> 
                            <span class="nav-item">Administrator</span>
                        </a>
                    </li> <br>
                    <hr style="border: 1px solid #700202;">
                    <br>
                    <li>   
                        <a href="dash.php">
                            <img src="../files/icons/dashboard.png" alt="" class="fas">
                            <span class="nav-item">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="user.php">
                            <img src="../files/icons/user.png" alt="" class="fas">
                            <span class="nav-item">Manage Users</span>
                        </a>
                    </li>
                    <li>
                        <a href="menu.php">
                            <img src="../files/icons/menu.png" alt="" class="fas">
                            <span class="nav-item">Manage Menu</span>
                        </a>
                    </li>
                    <li>
                        <a href="stock.php">
                            <img src="../files/icons/inventory.png" alt="" class="fas">
                            <span class="nav-item">Manage Inventory</span>
                        </a>
                    </li>
                    <li><a href="dash.php?logout='1'" class="logout">
                        <img src="../files/icons/logout.png" alt="" class="fas">
                        <span class="nav-item">Sign Out</span>
                    </a></li>
                </ul>
            </nav>

            <section class="view" id="view">
                <div class="view-list"> <br>
                    <h1 style="text-align: center;">Manage User Record</h1>         
                        <table class="table">
                            <thead>
                                <tr class="head">
                                    <button type="submit" class="addrec"  name="add"><img class="button" src = "../files/icons/add4.png">ADD RECORD</button>
                                </tr>

                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Birthday</th>
                                    <th>Date Modified</th>
                                    <th style="text-align:center;">Action</th>
                                </tr>
                            </thead>
                            <tbody> <br>
                                <?php 
                                    $query = "SELECT DISTINCT * 
                                    FROM accinfo
                                    ORDER BY acc_id DESC";
                                    $query_run = mysqli_query($conn, $query);
                                    $space = " ";

                                    if (mysqli_num_rows($query_run) > 0) {
                                        foreach($query_run as $row) {
                                ?>
                                    <tr>
                                        <?php 
                                        echo "<td>".$row['acc_id']."</td>";
                                        echo "<td>".$row['fname'], $space, $row['mname'], $space, $row['lname']."</td>";
                                        echo "<td>".$row['email']."</td>";
                                        echo "<td>".$row['DOB']."</td>";
                                        echo "<td>".$row['date_modified']."</td>";
                                        ?>
                                        <td> 
                                            <a href="edit.php?stud_id=<?= $row['stud_id']; ?>" style="background-color: blue;" class="button"><img src="../files/icons/edit.png" alt="edit"> </button></a>   
                                            <form action="" method="POST" class="d-inline">
                                                <button type="submit" style="background-color: red;" value="<?=$row['stud_id'];?>" class="button" name="delete_student"><img src="../files/icons/delete.png" alt="delete"></a>   
                                        </form>                                     
                                    </tr>
                                    <?php
                                        }
                                    }
                                    else {
                                        echo "<h5> No Record Found </h5>";
                                    }
                                ?>
                                                        
                            </tbody>
                    </table>
                </div>
            </section>
        </div>
    </body>
</html>