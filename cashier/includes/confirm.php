<?php 

//DO I STILLE NEED THE PAYMENT METHOD???? T~T 

//no need na isave kasi nakasave na
//update orders.orderStatus from In Progress to Paid
//set queue.queueStatus from paying to Preparing 
//for payment method 

$prodId = ""; 
$Quantity = ""; 

if ((isset($_POST['confirm_order']))) {
    $prodId = mysqli_real_escape_string($conn, $_POST['emp_id']);
    $Quantity = mysqli_real_escape_string($conn, $_POST['emp_id']);

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

 }
