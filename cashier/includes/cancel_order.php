<?php 
//DO I STILLE NEED THE PAYMENT METHOD???? T~T 

//no need na isave kasi nakasave na
//update orders.orderStatus from In Progress to Paid
//set queue.queueStatus from paying to Preparing 
//for payment method 

/*$prodId = ""; 
$Quantity = ""; 

if ((isset($_POST['confirm_order']))) {
    $prodId = mysqli_real_escape_string($conn, $_POST['emp_id']);
    $Quantity = mysqli_real_escape_string($conn, $_POST['Quantity']);

    //queries
    $query = "UPDATE orders SET 
            orderStatus = 'Paid'
            WHERE orderStatus = 'In Progress'"; 
    $query_run = mysqli_query($conn, $query); 

    if ($query_run ) {
        $query1 = "UPDATE queue SET 
            orderStatus = 'Paid'
            WHERE queueStatus = 'Preparing'"; 
        $query_run1 = mysqli_query($conn, $query1); 

        $query2 = "INSERT INTO sales (code, sales, date) 
                    VALUE ('$prodId', '$Quantity', NOW())"; 
        $query_run2 = mysqli_query($conn, $query2); 
    }

 }*/
include('server.php');

if (isset($_GET['order_id'])) {
    $orderId = $_GET['order_id']; // Change the variable name to order_id to match the URL parameter

    $cancelOrderQuery = "UPDATE orders SET orderStatus='Cancelled' WHERE orderID='$orderId'"; // Use $orderId to match the URL parameter
    $cancelOrderResult = mysqli_query($conn, $cancelOrderQuery);

    if ($cancelOrderResult) {
        echo '<script>alert("Order has been canceled successfully.");</script>';
    } else {
        echo '<script>alert("Failed to cancel the order. Please try again.");</script>';
    }
}

 ?>
 