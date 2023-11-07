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

// Check if an order is currently being processed (you need to retrieve this information from your system)
$currentlyProcessingOrder = true; // Change this based on your system logic
$currentlyProcessingOrderQueueNumber = "0001"; // Replace with the actual queue number of the processing order

// Get the next queue number
$nextQueueNumber = getNextQueueNumber($conn, $currentlyProcessingOrderQueueNumber);

function getNextQueueNumber($conn, $currentQueueNumber) {
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


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Ordering System</title>
    <link rel="stylesheet" href="../files/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Noto+Sans+Hebrew&amp;display=swap">
    <link rel="stylesheet" href="../files/assets/css/Articles-Badges-images.css">
    <link rel="stylesheet" href="../files/assets/css/Navbar-Centered-Links-icons.css">
    <link rel="stylesheet" href="../files/assets/css/Off-Canvas-Sidebar-Drawer-Navbar.css">
    <link rel="stylesheet" href="../files/assets/css/project-card.css">
</head>

<body>
    <a href="index.php?logout='1'" class="logout">
        <img src="../files/icons/logout.png" alt="" class="fas" style="width:30px; float: right; margin: 20px;">
    </a>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-xl-4 d-md-flex flex-column justify-content-xl-center">
                <section class="d-xl-flex flex-column justify-content-xl-center align-items-xl-center"><img src="../files/icons/tdfLogo.png" style="width: 300px;">
                    <h1 style="color: #7c2128;">KITCHEN STATION</h1>
                </section>
                <section class="d-xl-flex flex-column justify-content-xl-center align-items-xl-center">
                    <h2 class="d-xl-flex flex-column justify-content-xl-center align-items-xl-center" style="margin-bottom: 50px;">Waiting List</h2>
                    <?php
                    $changeStat = "UPDATE `orders` SET `orderStatus` = 'Preparing' WHERE orderStatus = 'Paid' ORDER BY orderDateTime ASC LIMIT 4";
                    $changeStatResult = mysqli_query($conn, $changeStat);

                    if ($changeStatResult) {
                        $query = "SELECT *
                        FROM orders
                        WHERE orders.orderStatus IN ('Preparing', 'Paid', 'In Progress') 
                        ORDER BY CASE 
                            WHEN orders.orderStatus = 'Preparing' THEN 1 
                            WHEN orders.orderStatus = 'Paid' THEN 2 
                            ELSE 3 
                        END, 
                        orders.orderDateTime ASC 
                        LIMIT 4";
                        $query_run = mysqli_query($conn, $query);

                        if (mysqli_num_rows($query_run) > 0) {
                            while ($row = mysqli_fetch_assoc($query_run)) {
                                $queueNumber = sprintf("%04d", $row['queueNumber']); // Format as 4 digits
                                $orderID = $row['orderID'];
                                $isProcessing = ($currentlyProcessingOrder && $queueNumber == $currentlyProcessingOrderQueueNumber);
                    ?>
                                <button class="btn btn-primary queue-button" data-queue-number="<?php echo $queueNumber; ?>" data-order-id="<?php echo $orderID; ?>" style="padding-right: 20px; padding-left: 20px; border-color: var(--bs-black); background: var(--bs-yellow); color: var(--bs-black); margin-bottom: 15px;" onclick="loadOrderDetails('<?php echo $queueNumber; ?>')">
                                    <strong>#<?php echo $queueNumber; ?></strong>
                                </button>
                    <?php
                            }
                        }
                    } else {
                        ?>
                            <div class="col" style="text-align: center;">
                                <h3 style="color: red;">No orders in the queue</h3>
                            </div>
                        <?php
                    }
                    ?>
                </section>

            </div>
            
            <div class="col-md-8" style="margin-top: 100px;">
    <div class="row" style="margin-bottom: 15px;">
        <?php
        $query = "SELECT DISTINCT orders.queueNumber 
        FROM orders 
        WHERE orders.orderStatus IN ('Preparing', 'Paid', 'In Progress') 
        ORDER BY CASE 
                WHEN orders.orderStatus = 'Preparing' THEN 1 
                WHEN orders.orderStatus = 'Paid' THEN 2 
                ELSE 3 
                END, 
                orders.orderDateTime ASC 
        LIMIT 4"; 
        $query_run = mysqli_query($conn, $query);

        if (mysqli_num_rows($query_run) > 0) {
            $counter = 0;
            while ($row = mysqli_fetch_assoc($query_run)) {
                $queueNumber = sprintf("%04d", $row['queueNumber']); // Format as 4 digits
                $orderItemsQuery = "SELECT order_items.Quantity, product.prodName 
                FROM orders 
                INNER JOIN order_items ON orders.orderID = order_items.OrderID 
                INNER JOIN product ON order_items.ProductID = product.prodId 
                WHERE (orders.orderStatus = 'Preparing' OR orders.orderStatus = 'Paid' OR orders.orderStatus = 'In Progress') 
                AND orders.queueNumber = '$queueNumber'
                ORDER BY CASE WHEN orders.orderStatus = 'Preparing' THEN 1 WHEN orders.orderStatus = 'Paid' THEN 2 
                ELSE 3 END, orders.orderDateTime ASC
                LIMIT 4";
                $orderItemsResult = mysqli_query($conn, $orderItemsQuery);
        ?>
                <div class="col" style="width: 300px; height: 300px; overflow-y: auto;">
                    <div class="card" style="width: 100%; height: 100%;">
                        <div class="card-body d-xl-flex flex-column justify-content-xl-center">
                            <h5>Order #<?php echo $queueNumber; ?></h5>
                            <div class="table-responsive" style="max-height: 200px; overflow-y: auto;">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Qty</th>
                                            <th>Product</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (mysqli_num_rows($orderItemsResult) > 0) {
                                            while ($item = mysqli_fetch_assoc($orderItemsResult)) {
                                                $quantity = $item['Quantity'];
                                                $product = $item['prodName'];
                                        ?>
                                                <tr>
                                                    <td><?php echo $quantity; ?></td>
                                                    <td><?php echo $product; ?></td>
                                                </tr>
                                        <?php
                                            }
                                        } else {
                                            echo "<tr><td colspan='2'>No items in the order</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <button class="btn btn-primary" type="button" style="background: #7c2128;border-style: none;" onclick="updateOrderStatus('<?php echo $queueNumber; ?>')">
                                <strong>SERVED TO #<?php echo $queueNumber; ?></strong>
                            </button>
                        </div>
                    </div>
                </div>
        <?php
                $counter++;
                if ($counter == 2) {
                    echo '</div><div class="row" style="margin-bottom: 15px;">';
                }
            }
        } else {
            ?>
                <div class="col" style="text-align: center;">
                    <br><br><br><br><br><br><br><br><h3 style="color: red;">No orders in the queue</h3>
                </div>
            <?php
            }
            ?>
    </div>
</div>


        </div>
    </div>
    <script>
    function updateOrderStatus(queueNumber) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            console.log("Ready state: " + this.readyState + ", Status: " + this.status);
            if (this.readyState == 4) {
                if (this.status == 200) {
                    console.log("Response from PHP script: " + this.responseText);
                    if (this.responseText.trim() !== "success") {
                        window.alert("The customer has not paid yet.");
                    } else {
                        location.reload();
                    }
                } else {
                    console.error("Error fetching data. Status: " + this.status);
                }
            }
        };
        xmlhttp.open("GET", "update_order_status.php?queueNumber=" + queueNumber, true);
        xmlhttp.send();
    }
</script>

    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/Off-Canvas-Sidebar-Drawer-Navbar-swipe.js"></script>
    <script src="assets/js/Off-Canvas-Sidebar-Drawer-Navbar-off-canvas-sidebar.js"></script>
</body>

</html>