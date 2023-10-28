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

//CANCEL ORDER SQL SRIPT
if (isset($_GET['order_id'])) {
    $orderId = $_GET['order_id']; // Change the variable name to order_id to match the URL parameter

    $cancelOrderQuery = "UPDATE orders SET orderStatus='Canceled' WHERE orderID='$orderId'"; // Use $orderId to match the URL parameter
    $cancelOrderResult = mysqli_query($conn, $cancelOrderQuery);

    if ($cancelOrderResult) {
        echo '<script>alert("Order has been canceled successfully.");</script>';
    } else {
        echo '<script>alert("Failed to cancel the order. Please try again.");</script>';
    }
}

//defaulr discoModal values
$discType = isset($_GET['discType']) ? $_GET['discType'] : 'regular';
$discPercent = isset($_GET['discPercent']) ? $_GET['discPercent'] : 0; // Default to 0 if not set
$customerID = isset($_GET['customerID']) ? $_GET['customerID'] : '0'; // Default to regular if not set

// For getting discModal values
if (isset($_POST['applyDiscountBtn'])) {
    $discType = isset($_POST['discType']) ? $_POST['discType'] : '';
    $discPercent = isset($_POST['discPercent']) ? (float)$_POST['discPercent'] : 0;
    $customerID = isset($_POST['customerID']) ? (int)$_POST['customerID'] : 0;
}

?>


<?php
//DELETE RECORD
if (isset($_POST['delete_rec'])) {
    $id = mysqli_real_escape_string($conn, $_POST['delete_rec']);

    $query = "DELETE FROM order_items WHERE ProductID='$id' && OrderID = '$inProgressOrderId'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        echo '<script>alert("Sorry, Record is not Deleted. Please try Again");</script>';
    } else {
    echo '<script>alert("Sorry, Record is not Deleted. Please try Again");</script>';
    }
}

?>



<?php

$currentlyProcessingOrder = true; 
$currentlyProcessingOrderQueueNumber = "0001"; //tobereplace/update/init

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

    <script>
    function cancelOrder(orderId) {
        var confirmation = confirm("Are you sure you want to cancel the order with ID: " + orderId + "?");
        if (confirmation) {
            var input = prompt("Please enter the access code to cancel the order:");
            if (input === "12345") {
                window.location.href = "index.php?order_id=" + orderId;
            } else {
                alert("Invalid access code. Order cancellation aborted.");
            }
        }
    }
    </script>


</head>  

<body>
    <div class="topnav" id="myTopnav">
        <img class="logo" src="../files/icons/tdf.png" alt="GroupLogo" href="index.html">
        <strong><h1> To Die For Foods </strong></h1> 
            <strong><a href="index.php?logout='1'">Log Out</a>
        <a href="history.php">History</a>
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
            <div class="col-md-3 col-xl-3 d-md-flex flex-column justify-content-xl-center" style="background: #fceca7; width: 20%; height: 100vh">
            <section class="d-xl-flex flex-column justify-content-xl-center align-items-xl-center">
                <h2 class="d-xl-flex flex-column justify-content-xl-center align-items-xl-center" style="margin-bottom: 50px;">Waiting List</h2>
                <?php
                // Fetch the first 100 queue numbers from your database
                $query = "SELECT orderID, queueNumber, orderStatus, orderDateTime FROM orders WHERE orderStatus IN ('Queued', 'In Progress') ORDER BY orderStatus DESC, orderDateTime ASC LIMIT 5";
                $query_run = mysqli_query($conn, $query);

                $inProgressExist = false;

                if (mysqli_num_rows($query_run) > 0) {
                    while ($row = mysqli_fetch_assoc($query_run)) {
                        $queueNumber = sprintf("%04d", $row['queueNumber']); 
                        $orderID = $row['orderID'];
                        $orderStatus = $row['orderStatus'];

                        if ($orderStatus === "In Progress") {
                            $inProgressExist = true;
                            ?>
                            <button class="btn btn-primary queue-button" data-queue-number="<?php echo $queueNumber; ?>" data-order-id="<?php echo $orderID; ?>" style="padding-right: 20px; padding-left: 20px; border-color: var(--bs-black); background: var(--bs-yellow); color: var(--bs-black); margin-bottom: 15px;" onclick="loadOrderDetails('<?php echo $queueNumber; ?>')">
                                <strong>#<?php echo $queueNumber; ?> - In Progress</strong>
                            </button>
                            <?php
                        } else {
                            ?>
                            <button class="btn btn-primary queue-button" data-queue-number="<?php echo $queueNumber; ?>" data-order-id="<?php echo $orderID; ?>" style="padding-right: 20px; padding-left: 20px; border-color: var(--bs-black); background: var(--bs-white); color: var(--bs-black); margin-bottom: 15px;" onclick="loadOrderDetails('<?php echo $queueNumber; ?>')">
                                <strong>#<?php echo $queueNumber; ?> - Queued</strong>
                            </button>
                            <?php
                        }
                    }
                }

                // Check if an order is currently in progress
                if (!$inProgressExist) {
                    $changeStat = "UPDATE `orders` SET `orderStatus` = 'In Progress' WHERE orderStatus = 'Queued' ORDER BY orderDateTime ASC LIMIT 1";
                    $firstRecordQueryResult = mysqli_query($conn, $changeStat);
                    
                    if (!$firstRecordQueryResult) {
                        echo '<script>alert("Failed to update the order status to In Progress");</script>';
                    }
                }
                ?>
            </section>


            </div>
            <div class="col-md-8" style="padding: 30px; width: 80%;">
                <?php 
                    $inProgressOrderId = null; // Initializing the variable with a default value
                    $fetchInProgressQuery = "SELECT orderID FROM orders WHERE orderStatus IN ('In Progress', 'Queued')";
                    $fetchInProgressResult = mysqli_query($conn, $fetchInProgressQuery);

                    // Fetching the orderId if there is any In Progress Order
                    if (mysqli_num_rows($fetchInProgressResult) > 0) {
                        $row = mysqli_fetch_assoc($fetchInProgressResult);
                        $inProgressOrderId = $row['orderID'];
                    } else {
                        // Handle the case where no In Progress Order is found
                        echo '<script>alert("There is no In Progress Order Right Now");</script>';
                    }
                ?>

                <section>
                    <h2><strong>Order Details</strong></h2>
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div>
                            <p style="font-size: 17px; font-weight: bold; margin-bottom: 0px;">Order Number: <strong><?php echo $inProgressOrderId; ?></strong></p>
                            <p style="font-size: 17px; font-weight: bold; margin-top: 0px;">Date: <strong><?php echo date('F j, Y | g:i a'); ?></strong></p>
                        </div>
                        <button type="button" style="background: #700202; border: none;" id="applyDiscountBtn" class="btn btn-primary" data-toggle="modal" data-target="#applyDiscModal">
                            <strong>Apply Discount</strong>
                        </button>
                    </div>
                </section>

                <section class="tb" style="padding-bottom: 20px;border-bottom-style: solid;border-bottom-color: var(--bs-black);">
                    <div class="table-responsive" style="background: #fceca7; border-radius: 10px;">
                        <table id="order-list" class="table">
                            <thead>
                                <tr>
                                    <th style="border-bottom-color: var(--bs-black);">DESCRIPTION</th>
                                    <th style="border-bottom-color: var(--bs-table-striped-color);">QTY</th>
                                    <th style="border-bottom-color: var(--bs-table-striped-color);">UNIT PRICE</th>
                                    <th style="border-bottom-color: var(--bs-table-striped-color);">SUBTOTAL</th>
                                    <th style="border-bottom-color: var(--bs-table-striped-color);">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                            $query ="SELECT DISTINCT product.*, order_items.* 
                                            FROM product
                                            INNER JOIN order_items ON product.prodId = order_items.ProductID
                                            INNER JOIN orders ON order_items.OrderID = orders.orderID
                                            WHERE orders.orderID = '$inProgressOrderId'";
                                
                                $query_run = mysqli_query($conn, $query);

                                $totalSubtotal = 0;
                                $formattedDiscPercent = number_format($discPercent, 0);
                                $p = "₱ "; 

                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach($query_run as $row) {
                                        $subTotal = $row['Quantity'] * $row['prodPrice'];
                                        $formattedSubAmt = number_format($subTotal, 2);
                                        $totalSubtotal += $subTotal;
                                        $formattedTotalSubTotal = number_format($totalSubtotal, 2);
                                        
                                        $discAmt = 0;
                                        if ($discPercent != 0) {
                                            $discAmt = $totalSubtotal * ($discPercent / 100);
                                        }
                                        $formattedDiscAmt = number_format($discAmt, 2);
                                        
                                        $vatAmt = 0; 
                                        if(($discType == 'pwd' || $discType == 'senior')){ //excluded from VAT
                                            $vatAmt = $totalSubtotal * 0.12;
                                            $vatSales = $totalSubtotal - $vatAmt; 
                                            //CALCULATE Total Discount 
                                            $totalDisc = $vatAmt + $discAmt; 
                                            $formattedTotalDisc = number_format($totalDisc, 2);
                                        } else {  //included from VAT e.g. senior and pwd
                                            $vatAmt = $totalSubtotal * 0.12; 
                                            $vatSales = $totalSubtotal - $vatAmt; 
                                            //CALCULATE Total Discount 
                                            $totalDisc =  $discAmt; 
                                            $formattedTotalDisc = number_format($totalDisc, 2);
                                        }

                                        $formattedVatAmt = number_format($vatAmt, 2);
                                        $formattedVatSales = number_format($vatSales, 2);

                                        $discountPercent = $totalDisc;

                                        $totalBill = $totalSubtotal - $totalDisc; 
                                        $formattedTotalBill = number_format($totalBill, 2);

                                        ?>
                                        <tr>
                                            <td><?php echo $row['prodName']; ?></td>
                                            <td><?php echo $row['Quantity']; ?></td>
                                            <td><?php echo $row['prodPrice']; ?></td>
                                            <td><?php echo $formattedSubAmt; ?></td>
                                            <td> 
                                                <form action="" method="POST" class="d-inline">
                                                    <button type="submit" style="background: none;" value="<?php echo $row['prodId']; ?>" class="button" name="delete_rec"><img src="../files/icons/delete.png" alt="delete"></button>   
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
                    </div> <br> <br>
                    <div class="row">
                        <div class="col-md-6" style= "padding-left: 10%;">
                            <p style="line-height: 80%;"><strong> Customer : <?php echo  $indentation . $indentation . $indentation . $indentation . $discType . $indentation . $customerID;?></strong></p>
                            <p style="line-height: 80%;"><strong> Net Amount : <?php echo isset($formattedTotalSubTotal) ?  $indentation . $indentation . $indentation . $p . $formattedTotalSubTotal : '0.00'; ?></strong></p>
                            <p style="line-height: 80%;"><strong> Sales Discount : <?php echo isset($formattedDiscPercent) ? $indentation . $indentation . $formattedDiscPercent . ' %' : '0 %'; ?></strong></p>
                            <p style="line-height: 80%;"><strong> Discount Amount: <?php echo isset($formattedDiscAmt) ? $indentation . $p . $formattedDiscAmt : '0.00'; ?></strong></p>
                        </div>
                        <div class="col-md-6">
                            <p style="line-height: 80%;"><strong> VATable Sales : <?php echo isset($formattedVatSales) ? $indentation . $indentation . $indentation . '   ' . $p . $formattedVatSales : '0.00'; ?></strong> </p>
                            <p style="line-height: 80%;"><strong> VAT 12% Amount :  <?php echo isset($formattedVatAmt) ? $indentation . $indentation . $p . $formattedVatAmt : '0.00'; ?></strong> </p>
                            <p style="line-height: 80%;"><strong> Total Discount :  <?php echo isset($formattedTotalDisc) ? $indentation . $indentation . $indentation . $p . $formattedTotalDisc : '0.00'; ?></strong> </p>
                            <p style="font-weight: bold;font-size: 24px;font-style: italic;"><strong>TOTAL BILL :  <?php echo isset($formattedTotalBill) ? $p . $formattedTotalBill : '0.00'; ?></strong> </p>
                        </div>
                    </div>
                </section>
                <div class="buttons" style="display: flex; justify-content: center;">
                    <button type="button" style="background: blue; border: none; margin-right: 10px;" class="btn btn-primary" id="paymentBtn" name="confirm_order">
                        <strong>CONFIRM</strong>
                    </button>
                    <button type="button" style="background: red; border: none;" class="btn btn-primary" onclick="cancelOrder('<?php echo $inProgressOrderId; ?>')">
                        <strong>CANCEL</strong>
                    </button>

                </div>



            </div>
        </div>
    </div>

    
     
    
    <?php 
        include ('includes/discModal.php');
        include('includes/paymentModal.php');
        include ('includes/generate_receipt.php');


    //UPDATE ORDER STATUS & INSERT TRANSAC AND SALES SQL SCRIPT
    if (isset($_GET['orderID'])) {
        $orderID = $_GET['orderID'];
        $customerID = $_GET['customerID'];
        $discType = $_GET['discType'];
        $discountPercent = $_GET['discountPercent'];
        $totalSubtotal = $_GET['totalSubtotal'];
        $totalBill = $_GET['totalBill'];
        $products = json_decode($_GET['products'], true);
    
        $updateQuery = "UPDATE orders SET orderStatus='Paid' WHERE orderID='$orderID'";
        if (mysqli_query($conn, $updateQuery)) {
            // Transac Query INSERT 
            $queryTransac = "INSERT INTO transac (date, orderID, customer_ID, discount_type, discount_amount, netAmt, cashPaid) 
            VALUES (NOW(), '$orderID', '$customerID', '$discType', '$discountPercent', '$totalSubtotal', '$totalBill')";
            if (mysqli_query($conn, $queryTransac)) {
                foreach ($products as $product) {
                    $description = $product['description'];
                    $quantity = $product['quantity'];
                    $unitPrice = $product['unitPrice'];
                    $subtotal = $product['subtotal'];
    
                    // Retrieve prodID from the product table based on the description
                    $queryProduct = "SELECT prodId FROM product WHERE prodName = '$description'";
                    $resultProduct = mysqli_query($conn, $queryProduct);
                    if ($resultProduct && mysqli_num_rows($resultProduct) > 0) {
                        $row = mysqli_fetch_assoc($resultProduct);
                        $prodID = $row['prodId'];

                        // Insert into sales table
                        $querySale = "INSERT INTO sales (orderID, prodCode, sales, date) VALUES ('$orderID', '$prodID', '$quantity', NOW())";
                        // If the query is successful, update the inventory table
                        if (mysqli_query($conn, $querySale)) {
                            $updateInventoryQuery = "UPDATE inventory SET stock = stock - $quantity WHERE prodCode = '$prodID'";
                            if (mysqli_query($conn, $updateInventoryQuery)) {
                                http_response_code(200);
                                echo "Order Saved";
                            } else {
                                // If the query fails, send an error response and log the error
                                http_response_code(500);
                                $error_message = "Error updating inventory details: " . mysqli_error($conn);
                                error_log($error_message);
                                echo "Failed to update inventory details";
                            }
                        } else {
                            // If the query fails, send an error response and log the error
                            http_response_code(500);
                            $error_message = "Error saving order details: " . mysqli_error($conn);
                            error_log($error_message);
                            echo "Failed to save order details";
                        }
                    } else {
                        // If the query fails, send an error response and log the error
                        http_response_code(500);
                        $error_message = "Error retrieving product details: " . mysqli_error($conn);
                        error_log($error_message);
                        echo "Failed to retrieve product details";
                    }
                }
            } else {
                // If the query fails, send an error response and log the error
                http_response_code(500);
                $error_message = "Error updating transaction details: " . mysqli_error($conn);
                error_log($error_message);
                echo "Failed to update transaction details";
            }
        } else {
            // If the query fails, send an error response and log the error
            http_response_code(500);
            $error_message = "Error updating order status: " . mysqli_error($conn);
            error_log($error_message);
            echo "Failed to update order status";
        }
    }
    

    ?>
    <script>
        function loadOrderDetails(queueNumber) {
        // Make an AJAX request to fetch the order details from the server
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "fetchOrderDetails.php?queueNumber=" + queueNumber, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Update the HTML content with the fetched order details
                    var orderDetails = JSON.parse(xhr.responseText);

                    // Example: Update the HTML content with the fetched order details
                    document.getElementById('orderDetailsSection').innerHTML = `
                        <p>Order ID: ${orderDetails.orderID}</p>
                        <p>Customer Name: ${orderDetails.customerName}</p>
                        <p>Total Amount: ${orderDetails.totalAmount}</p>
                        <!-- Other details to display -->
                    `;
                } else {
                    console.error("Failed to fetch order details");
                }
            }
        };
        xhr.send();
    }

    </script>

    <script>
        var modal = document.getElementById("discountModal");
        var btn = document.getElementById("applyDiscountBtn");
        var span = document.getElementsByClassName("close")[0];
        </script>
    <script>
        var payModal = document.getElementById("paymentModal");
        var payBtn = document.getElementById("paymentBtn");
        var paySpan = document.getElementsByClassName("close")[1];

    </script>


    <script>    
        //DISCOUNT MODAL
        var modal = document.getElementById("discountModal");
        var btn = document.getElementById("applyDiscountBtn");
        var span = document.getElementsByClassName("close")[0];
        btn.onclick = function () {
            modal.style.display = "block";
        }
        span.onclick = function () {
            modal.style.display = "none";
        }
        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        //PAYMENT MODAL
        var payModal = document.getElementById("paymentModal");
        var payBtn = document.getElementById("paymentBtn");
        var paySpan = document.getElementsByClassName("close")[1];

        payBtn.onclick = function () {
            payModal.style.display = "block";
        }

        paySpan.onclick = function () {
            payModal.style.display = "none";
        }

        window.onclick = function (event) {
            if (event.target == payModal) {
                payModal.style.display = "none";
            }
        }

        //EDIT MODAL //still not use
        function editModal(prodId, prodName, Quantity, prodPrice) {
            var modal1 = document.getElementById("editOrderModal");
            var span1 = document.getElementsByClassName("close")[1];
            modal1.style.display = "block";
            span1.onclick = function() {
                modal1.style.display = "none";
            }
            document.getElementById('edit_prodId').value = prodId;
            document.getElementById('edit_prodName').value = prodName;
            document.getElementById('edit_Quantity').value = prodCategory;
            document.getElementById('edit_prodPrice').value = prodPrice;

            window.onclick = function() {
                if (event.target == modal1) {
                    modal1.style.display = "none";
                }
            }
        }

    </script>


    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/Off-Canvas-Sidebar-Drawer-Navbar-swipe.js"></script>
    <script src="assets/js/Off-Canvas-Sidebar-Drawer-Navbar-off-canvas-sidebar.js"></script>
</body>

</html>
