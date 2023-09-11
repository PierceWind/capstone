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

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard</title>
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
                    <li><a href="">
                        <img src="../files/icons/admin.png" alt="" class="fas"> 
                        <span class="nav-item">Administrator</span>
                    </a></li> <br>
                    <hr style="border: 1px solid #700202;">
                    <br>
                    <li><a href="">
                        <img src="../files/icons/dashboard.png" alt="" class="fas">
                        <span class="nav-item">Dashboard</span>
                    </a></li>
                    <li>
                        <a href="users/user.php">
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
                    </a></li>
                    <li><a href="dash.php?logout='1'" class="logout">
                        <img src="../files/icons/logout.png" alt="" class="fas">
                        <span class="nav-item">Sign Out</span>
                    </a></li>
                </ul>
            </nav>

            <!--<section class="main">
               <div class="main-top">
                    <h2> Admin Dashboard</h2>
               </div>
               <div class="top-box">
                <?php 
                    $query3 = "SELECT DISTINCT (teacher_id) FROM teachers WHERE teacher_id <> 0";
                    $result3 = mysqli_query($conn, $query3);
                    $row3 = mysqli_num_rows($result3);

                    $query2 = "SELECT DISTINCT(course_code) FROM course";
                    $result2 = mysqli_query($conn, $query2);
                    $row2 = mysqli_num_rows($result2);

                    $query1 = "SELECT DISTINCT(stud_id) FROM students";
                    $result1 = mysqli_query($conn, $query1);
                    $row1 = mysqli_num_rows($result1);
                ?>
                    <div class="boxes">
                        <span>Number of Students</span>  <br> <br>
                        <b> <?php echo $row1; ?> Students</b> 
                    </div>
                    <div class="boxes">
                        <span>Number of Classes</span>  <br> <br>
                        <b> <?php echo $row2; ?> Classes</b> 
                    </div>
                    <div class="boxes">
                        <span>Number of Teachers</span>  <br> <br>
                        <b> <?php echo $row3; ?> Teachers</b>
                    </div>
                </div>   

                <div class="graphcal">
                    <div class="cal">
                        <h3> Calendar</h3>
                        <header>
                        <p class="current-date"></p>
                        <div class="icons">
                            <i id="prev"class="fas fa-chevron-left"></i>
                            <i id="next" class="fas fa-chevron-right"></i>
                        </div>
                        </header>
                        <div class="calendar">
                            <ul class="weeks">
                                <li>Sun</li>
                                <li>Mon</li>
                                <li>Tue</li>
                                <li>Wed</li>
                                <li>Thur</li>
                                <li>Fri</li>
                                <li>Sat</li>
                            </ul>
                            <ul class="days"></ul>
                        </div>
                    </div>
                    <div class="bar" id="bar-chart">
                        <h3 style="margin-left: 35%;"> Student Status Report</h3>
                         
                            <?php
                                //attempt select query execution
                                try{
                                    $sql="SELECT * FROM timein";//need palitan dbname
                                    $result= $conn->query($sql);
                                    if( mysqli_num_rows($result)> 0) {
                                        $colname = array();
                                        
                                        while($row = mysqli_fetch_array($result)){ 
                                            $colname[] = $row["status"];
                                        }
                                    unset($result);
                                    }else{
                                        echo"no record match";
                                    }
                                }catch(PDOException $e){
                                    die("error: cant execute". $e->getMessage());
                                }
                                //close connection
                                unset($pdo);
                            ?>
                    </div>
                </div>
                <br>

                
                <div class="bottom-box">
                    <?php   
                        //$query = ("SELECT *
                        //FROM ( SELECT status from timein )
                        //PIVOT ( count(*) for status in ('Present', 'Absent', 'Tardy', 'Cutting'))");
                    ?>

                    <?php 
                        $query3 = "SELECT DISTINCT (stud_id) FROM students WHERE  stud_id  NOT IN (SELECT stud_id FROM timein) LIMIT 5";
                        $result3 = mysqli_query($conn, $query3);
                        $row3 = mysqli_num_rows($result3);

                        $query2 = "SELECT DISTINCT (stud_id) FROM timein WHERE status='Tardy' LIMIT 5";
                        $result2 = mysqli_query($conn, $query2);
                        $row2 = mysqli_num_rows($result2);

                        $query1 = "SELECT DISTINCT (stud_id) FROM timein WHERE status='Cutting' LIMIT 5";
                        $result1 = mysqli_query($conn, $query1);
                        $row1 = mysqli_num_rows($result1);
                    ?>
                    <div class="boxes">
                        <h3>TOP 5 Absentee</h3> <br>
                            <?php if($row3 > 0) {
                                while ($res = mysqli_fetch_array($result3)) {
                                    echo "<li>".$res['stud_id']."</li>";
                                    echo "<br>";
                                }
                            }
                            ?>
                    </div>
                    <div class="boxes">
                        <h3>TOP 5 Tardy Students </h3> <br>
                            <?php if($row2 > 0) {
                                while ($res = mysqli_fetch_array($result2)) {
                                    echo "<li>".$res['stud_id']."</li>";
                                    echo "<br>";
                                }
                            }
                            ?>
                    </div>
                    <div class="boxes">
                        <h3>TOP 5 Cutting Students</h3> <br>
                            <?php if($row1 > 0) {
                                while ($res = mysqli_fetch_array($result1)) {
                                    echo "<li>".$res['stud_id']."</li>";
                                    echo "<br>";
                                }
                            }
                            ?> 
                    </div>
                </div>   
            </section>-->
        </div>
    </body>
</html>