<?php
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

date_default_timezone_set('Asia/Manila');

$indentationLevel = 4; // Adjust the number of spaces for indentation
$indentation = str_repeat("&nbsp;", $indentationLevel);

$discType = isset($_GET['discType']) ? $_GET['discType'] : '';
$discPercent = isset($_GET['discPercent']) ? $_GET['discPercent'] : 0; // Default to 0 if not set
$customerID = isset($_GET['customerID']) ? $_GET['customerID'] : ''; // Default to 0 if not set

// For getting discModal values
if (isset($_POST['applyDiscountBtn'])) {
    $discType = isset($_POST['discType']) ? $_POST['discType'] : '';
    $discPercent = isset($_POST['discPercent']) ? (float)$_POST['discPercent'] : 0;
    $customerID = isset($_POST['customerID']) ? (int)$_POST['customerID'] : 0;
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>TDF POS</title>
    <link rel="stylesheet" href="../files/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Noto+Sans+Hebrew&amp;display=swap">
    <link rel="stylesheet" href="../filesassets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="../filesassets/css/Articles-Badges-images.css">
    <link rel="stylesheet" href="../filesassets/css/Navbar-Centered-Links-icons.css">
    <link rel="stylesheet" href="../filesassets/css/Off-Canvas-Sidebar-Drawer-Navbar.css">
    <link rel="stylesheet" href="../filesassets/css/project-card.css">
    <link rel="stylesheet" type="text/css" href="style.css" media="screen"/> 
    <link rel="icon" type="image/x-icon" href="../files/icons/tdf.png">
    <script src="../files/assets/bootstrap/js/bootstrap.min.js"></script> 
</head>  

<body>
    <div class="topnav" id="myTopnav">
        <img class="logo" src="../files/icons/tdf.png" alt="GroupLogo" href="index.html">
        <strong><h1> To Die For Foods </strong></h1> 
            <strong><a href="index.php?logout='1'">Log Out</a>
        <a href="">History</a>
        <a href="index.php">POS</a></strong>
    </div>
    <script>
        function myFunction() {
            var x = document.getElementById("myTopnav");
                if (x.className === "topnav") {
                    x.className += " responsive";
                } else {
                    x.className = "topnav";
                }
        }
    </script>

    <div class="container mt-5"> 
        <br>
        <strong><h2>Transaction History</h2></strong>
        <hr>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>Transaction ID</th>
                    <th>Date</th>
                    <th>Customer Name</th>
                    <th>Discount Type</th>
                    <th>Discount Percent</th>
                    <th>Total Bill</th>
                    <th>Cash Paid</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Retrieve and display transaction data from your database
                $query = "SELECT * FROM transac"; // Replace 'transactions' with your actual table name
                $result = mysqli_query($conn, $query);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['transaction_id'] . "</td>";
                        echo "<td>" . $row['date'] . "</td>";
                        echo "<td>" . $row['customer_name'] . "</td>";
                        echo "<td>" . $row['discount_type'] . "</td>";
                        echo "<td>" . $row['discount_percent'] . "</td>";
                        echo "<td>" . $row['totalBill'] . "</td>";
                        echo "<td>" . $row['cashPaid'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7' style='color:red;''><strong>No transactions found </strong></td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>



    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/Off-Canvas-Sidebar-Drawer-Navbar-swipe.js"></script>
    <script src="assets/js/Off-Canvas-Sidebar-Drawer-Navbar-off-canvas-sidebar.js"></script>
</body>

</html>