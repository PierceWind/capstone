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

$discType = isset($_GET['discType']) ? $_GET['discType'] : "";
$discPercent = isset($_GET['discPercent']) ? (float)$_GET['discPercent'] : 0;
$customerID = isset($_GET['customerID']) ? (int)$_GET['customerID'] : 0;

?> 
<?php
// ... (previous code)

// Check if an order is currently being processed (you need to retrieve this information from your system)
$currentlyProcessingOrder = true; // Change this based on your system logic
$currentlyProcessingOrderQueueNumber = "0001"; // Replace with the actual queue number of the processing order

// Get the next queue number
$nextQueueNumber = getNextQueueNumber($currentlyProcessingOrderQueueNumber); // Implement this function

function getNextQueueNumber($currentQueueNumber) {
    // Query your database to get the next queue number based on your logic
    // For example, you can find the minimum Queue Number greater than the current one
    // Here is a sample query, but you should adapt it to your database schema:
    $query = "SELECT MIN(queueNumber) AS NextQueueNumber FROM orders WHERE queueNumber > '$currentQueueNumber'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['NextQueueNumber'];
    } else {
        return null; // No next queue found
    }
}
?>

<!-- ... (rest of your HTML code) -->



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
        <strong><h1> To Die For Foods </h1> 
        <a href="index.php?logout='1'">Log Out</a>
        <a href="transacation.php">History</a>
        <a href="">POS</a></strong>
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
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 col-xl-3 d-md-flex flex-column justify-content-xl-center" style="background: #fceca7; width: 20%;">
                <section class="d-xl-flex flex-column justify-content-xl-center align-items-xl-center">
                    <h2 class="d-xl-flex flex-column justify-content-xl-center align-items-xl-center" style="margin-bottom: 50px;">Waiting List</h2>
                    <?php
                    // Fetch the first 100 queue numbers from your database
                    $query = "SELECT orderID, QueueNumber, orderDateTime FROM orders ORDER BY orderDateTime ASC LIMIT 5";
                    $query_run = mysqli_query($conn, $query);

                    if (mysqli_num_rows($query_run) > 0) {
                        while ($row = mysqli_fetch_assoc($query_run)) {
                            $queueNumber = sprintf("%04d", $row['QueueNumber']); // Format as 4 digits
                            $orderID = $row['orderID'];
                            $isProcessing = ($currentlyProcessingOrder && $queueNumber == $currentlyProcessingOrderQueueNumber);
                    ?>
                        <button class="btn btn-primary<?php echo $isProcessing ? ' active' : ''; ?>" type="button" style="padding-right: 20px; padding-left: 20px; border-color: var(--bs-black); background: var(--bs-yellow); color: var(--bs-black); margin-bottom: 15px;">
                            <strong>#<?php echo $queueNumber; ?></strong>
                        </button>
                    <?php
                        }
                    }
                    ?>
                </section>
            </div>
            <div class="col-md-8" style="padding: 30px; width: 80%;">
                <section>
                    <h2><strong>Order Details</strong></h2>
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div>
                            <p style="font-size: 17px; font-weight: bold; margin-bottom: 0px;">Order Number: <strong><?php echo $orderID; ?></strong></p>
                            <p style="font-size: 17px; font-weight: bold; margin-top: 0px;">Date: <strong><?php echo date('F j, Y | g:i a'); ?></strong></p>
                        </div>
                        <button type="button" style="background: #700202; border: none;" id="applyDiscountBtn" class="btn btn-primary" data-toggle="modal" data-target="#applyDiscModal">
                            <strong>Apply Discount</strong>
                        </button>
                    </div>
                </section>
                <section style="padding-bottom: 20px;border-bottom-style: solid;border-bottom-color: var(--bs-black);">
                    <div class="table-responsive" style="background: #fceca7; border-radius: 10px;">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="border-bottom-color: var(--bs-black);">DESCRIPTION</th>
                                    <th style="border-bottom-color: var(--bs-table-striped-color);">QTY</th>
                                    <th style="border-bottom-color: var(--bs-table-striped-color);">UNIT PRICE</th>
                                    <th style="border-bottom-color: var(--bs-table-striped-color);">GROSS AMT</th>
                                    <th style="border-bottom-color: var(--bs-table-striped-color);">NET AMT</th>
                                    <th style="border-bottom-color: var(--bs-table-striped-color);">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                            $query ="SELECT DISTINCT product.*, order_items.* 
                                            FROM product
                                            INNER JOIN order_items ON product.prodId = order_items.ProductID
                                            INNER JOIN orders ON order_items.OrderID = orders.orderID
                                            WHERE orders.queueNumber = '$queueNumber' && orders.orderStatus = 'Queued' && orders.orderDateTime = (SELECT MIN(orderDateTime)) 
                                            ORDER BY OrderItemID DESC";
                                
                                $query_run = mysqli_query($conn, $query);

                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach($query_run as $row) {
                                        $grossAmount = $row['Quantity'] * $row['prodPrice'];
                                        $formattedGrossAmount = number_format($grossAmount, 2);
                                        ?>
                                        <tr>
                                            <td><?php echo $row['prodName']; ?></td>
                                            <td><?php echo $row['Quantity']; ?></td>
                                            <td><?php echo $row['prodPrice']; ?></td>
                                            <td><?php echo $formattedGrossAmount; ?></td>
                                            <td><?php echo $row['netAmt']; ?></td>
                                            <td> 
                                                <form action="" method="POST" class="d-inline">
                                                    <button type="submit" value="<?php echo $row['prodId']; ?>" class="button" name="delete_rec"><img src="../../files/icons/delete.png" alt="delete"></button>   
                                                </form>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                }
                                else {  
                                    ?> 
                                    <tr> <td style="color:red; "> <?php echo '<strong>NO RECORD FOUND</strong>'; ?></td> </tr>
                                <?php 
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <p style="font-weight: bold;font-size: 24px;font-style: italic;"><strong>TOTAL: 550.0</strong></p>
                </section>
            <section>
                <div class="buttones1">
                    <button class="confirm">CONFIRM</button>
                    <button class="cancel">CANCEL</button>
                </div>
            </section>
            </div>
        </div>
    </div>

    <?php include ('includes/discModal.php');?>
        
<script type="text/javascript">
    // Get the modal element
    var modal = document.getElementById("discountModal");
    
    // Get the button that opens the modal
    var btn = document.getElementById("applyDiscountBtn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the button is clicked, open the modal
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // When the <span> (x) is clicked, close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>

    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/Off-Canvas-Sidebar-Drawer-Navbar-swipe.js"></script>
    <script src="assets/js/Off-Canvas-Sidebar-Drawer-Navbar-off-canvas-sidebar.js"></script>
</body>

</html>