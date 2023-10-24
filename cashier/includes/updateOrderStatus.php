<?php
include('../server.php');
include('paymentModal.php'); 
include('index.php'); 

if (isset($_GET['orderID'])) {
    $orderID = $_GET['orderID'];

    $updateQuery = "UPDATE orders SET orderStatus='Paid' WHERE orderID='$orderID'";
    if (mysqli_query($conn, $updateQuery)) {
        // Retrieve and sanitize other necessary variables
        $customerID = isset($_POST['customerID']) ? mysqli_real_escape_string($conn, $_POST['customerID']) : '';
        $discType = isset($_POST['discType']) ? mysqli_real_escape_string($conn, $_POST['discType']) : '';
        $discPercent = isset($_POST['discPercent']) ? (float)$_POST['discPercent'] : 0;
        $totalAmount = isset($_POST['totalAmount']) ? (float)$_POST['totalAmount'] : 0;
        $cashInput = isset($_POST['cashInput']) ? (float)$_POST['cashInput'] : 0;

        // Insert data into the database
        $queryTransac = "INSERT INTO transac (date, orderID, customer_ID, discount_type, discount_percent, totalBill, cashPaid) 
        VALUES (NOW(), '$orderID', '$customerID', '$discType', '$discPercent', '$totalAmount', '$cashInput')";
        if (mysqli_query($conn, $queryTransac)) {
            foreach ($orderItems as $item) {
                $prodId = $item['prodId'];
                $querySale = "INSERT INTO sales (code, sales, date) VALUES ('$prodId', '$orderID', NOW())";
                // If the query is successful, send a success response
                if (mysqli_query($conn, $querySale)) {
                    http_response_code(200);
                    echo "Order Saved";
                } else {
                    // If the query fails, send an error response and log the error
                    http_response_code(500);
                    $error_message = "Error saving order details: " . mysqli_error($conn);
                    error_log($error_message);
                    echo "Failed to save order details";
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
