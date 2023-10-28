<?php 
    sleep(0);
    session_start();

    if (!isset($_SESSION['acc_name'])) {
        $_SESSION['msg'] = "You must log in first";
        header('location:../login/log.php');
    }
    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['acc_name']);
        header('location:../login/log.php');
    }
    include('server.php');
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard</title>
        <link rel="icon" type="image/x-icon" href="../files/icons/tdf.png">
        <link rel="stylesheet" type="text/css" href="style.css">
        <!--<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>-->
        <script src="../files/assets/js/chart.js"></script>
        <script src="../files/assets/js/jquery.min.js"></script>
    </head>
    <body>
        <div class="container">
            <nav>
                <ul>
                    <br>
                    <li>
                        <a href="../loadAndLand/LaunchingPage.html" class="logo">
                            <img src="../files/icons/tdf.png" alt=""> 
                            <span class="nav-title">To Die For<br>FOODS</span>
                        </a>
                    </li> <br>
                    <li>
                        <a href="profile/settings.php">
                            <img src="../files/icons/admin.png" alt="" class="fas"> 
                            <span class="nav-item">Administrator</span>
                        </a>
                    </li> <br>
                    <hr style="border: 1px solid #700202;">
                    <br>
                    <li>   
                        <a href="">
                            <img src="../files/icons/dashboard.png" alt="" class="fas">
                            <span class="nav-item">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="users/index.php">
                            <img src="../files/icons/user.png" alt="" class="fas">
                            <span class="nav-item">Manage Users</span>
                        </a>
                    </li>
                    <li>
                        <a href="menu/index.php">
                            <img src="../files/icons/menu.png" alt="" class="fas">
                            <span class="nav-item">Manage Menu</span>
                        </a>
                    </li>
                    <li>
                        <a href="inventory/index.php">
                            <img src="../files/icons/inventory.png" alt="" class="fas">
                            <span class="nav-item">Manage Inventory</span>
                        </a>
                    </li>
                    <li><a href="index.php?logout='1'" class="logout">
                        <img src="../files/icons/logout.png" alt="" class="fas">
                        <span class="nav-item">Sign Out</span>
                    </a></li>
                </ul>
            </nav>
        
            <section class="main">
               <div class="main-top" >
                    <h2 > Admin Dashboard</h2>
               </div>
               <div class="top-box">
                <?php 
                    $query4 = "SELECT DISTINCT(orderID) FROM orders WHERE orderStatus = 'Canceled'";
                    $result4 = mysqli_query($conn, $query4);
                    $row4 = mysqli_num_rows($result4);

                    $query3 = "SELECT DISTINCT (acc_id) FROM account WHERE acc_id <> 1";
                    $result3 = mysqli_query($conn, $query3);
                    $row3 = mysqli_num_rows($result3);

                    $query2 = "SELECT DISTINCT(prodId) FROM product";
                    $result2 = mysqli_query($conn, $query2);
                    $row2 = mysqli_num_rows($result2);

                    $query1 = "SELECT DISTINCT(orderID) FROM orders WHERE orderStatus = 'Completed'";
                    $result1 = mysqli_query($conn, $query1);
                    $row1 = mysqli_num_rows($result1);
                ?>
                    <div class="boxes">
                        <span>Number of User Accounts</span>  <br> <br>
                        <b> <?php echo $row3; ?> Accounts</b> 
                    </div>
                    <div class="boxes">
                        <span>Number of Products</span>  <br> <br>
                        <b> <?php echo $row2; ?> Product</b> 
                    </div>
                    <div class="boxes">
                        <span>Completed Orders</span>  <br> <br>
                        <b> <?php echo $row1; ?> Orders</b>
                    </div>
                    <div class="boxes">
                        <span>Canceled Orders</span>  <br> <br>
                        <b> <?php echo $row4; ?> Orders</b>
                    </div>
                </div>   

                <div class="graphcal">
                    <div class="cal">
                        <h3>Customer Type</h3><br>
                        <div class="pie" style="width: 250px; height: 300px;">
                            <canvas id="customerPieChart"></canvas>
                        </div>
                    </div>
                    <div class="bar">
                        <h3>Sales Performance Graph</h3> <br>
                        <div class="line" style="max-width: 600px; height: 300px;">
                            <canvas id="salesLineChart"></canvas>
                        </div>
                    </div>
                    
                </div>

                <script>
                $(document).ready(function() {
                    $.ajax({
                    url: 'getChartData.php', // Replace with the file that fetches data from the database
                    type: 'GET',
                    success: function(response) {
                        var data = JSON.parse(response);

                        // Pie Chart for Customer Type
                        var customerPieData = {
                        labels: data.customerLabels,
                        datasets: [
                            {
                            data: data.customerData,
                            backgroundColor: ["#FF6384", "#36A2EB", "#FFCE56", "#77dd77"],
                            hoverBackgroundColor: ["#FF6384", "#36A2EB", "#FFCE56", "#77dd77"]
                            }
                        ]
                        };

                        var customerPieCanvas = document.getElementById("customerPieChart");
                        var customerPieChart = new Chart(customerPieCanvas, {
                        type: "pie",
                        data: customerPieData,
                        options: {
                            responsive: true,
                            maintainAspectRatio: false
                        }
                        });

                        // Line Chart for Sales Performance
                        var salesLineData = {
                        labels: data.salesLabels,
                        datasets: [
                            {
                            label: "Sales Performance",
                            data: data.salesData,
                            fill: false,
                            borderColor: "#4BC0C0"
                            }
                        ]
                        };

                        var salesLineCanvas = document.getElementById("salesLineChart");
                        var salesLineChart = new Chart(salesLineCanvas, {
                        type: "line",
                        data: salesLineData,
                        options: {
                            responsive: true,
                            maintainAspectRatio: false
                        }
                        });
                    }
                    });
                });
                </script>

                <div class="bottom-box">
                    <?php   
                    ?>

                    <?php 
                        $query3 = "SELECT inventory.prodCode, product.prodName, product.minReq 
                        FROM inventory 
                        INNER JOIN product ON product.prodId = inventory.prodCode 
                        WHERE inventory.stock <= product.minReq OR inventory.stock = 0
                        LIMIT 5;";
                        $result3 = mysqli_query($conn, $query3);
                        $row3 = mysqli_num_rows($result3); 

                        $query2 = "SELECT product.*, SUM(sales.sales) AS total_sales
                        FROM sales
                        INNER JOIN product 
                        ON product.prodId = sales.prodCode
                        GROUP BY product.prodId
                        ORDER BY total_sales DESC
                        LIMIT 5;
                        ";
                        $result2 = mysqli_query($conn, $query2);
                        $row2 = mysqli_num_rows($result2);

                        $query1 = "SELECT product.*, SUM(sales.sales) AS total_sales
                        FROM product
                        LEFT JOIN sales 
                        ON product.prodId = sales.prodCode
                        GROUP BY product.prodId
                        HAVING total_sales < (
                            SELECT MIN(sub.total_sales) 
                            FROM (
                                SELECT SUM(sales.sales) AS total_sales 
                                FROM sales 
                                GROUP BY prodCode
                            ) AS sub
                        )
                        ORDER BY total_sales;";
                        $result1 = mysqli_query($conn, $query1);
                        $row1 = mysqli_num_rows($result1);
                    ?>
                    <div class="boxes">
                        <h3>Critical Stock</h3> <br>
                            <?php if($row3 > 0) {
                                while ($res = mysqli_fetch_array($result3)) {
                                    echo $res['prodName'];
                                    echo "<br>";
                                }
                            }
                            ?>
                    </div>
                    <div class="boxes">
                        <h3>Top-Selling Products </h3> <br>
                            <?php if($row2 > 0) {
                                while ($res = mysqli_fetch_array($result2)) {
                                    echo $res['prodName'];
                                    echo "<br>";
                                }
                            }
                            ?>
                    </div>
                    <div class="boxes">
                        <h3>Underperforming Products</h3> <br>
                            <?php if($row1 > 0) {
                                while ($res = mysqli_fetch_array($result1)) {
                                    echo "<li>".$res['prodName']."</li>";
                                    echo "<br>";
                                }
                            }
                            ?> 
                    </div>
                </div>   
            </section>
        </div>
    </body>
</html>