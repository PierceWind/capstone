<?php
    include('../server.php');

    if (isset($_GET['orderID'])) {
        $orderID = $_GET['orderID'];

        // Perform the update query based on the $orderID
        $updateQuery = "UPDATE orders SET orderStatus='Paid' WHERE orderID='$orderID'";
        if (mysqli_query($conn, $updateQuery)) {
            // If the query is successful, send a success response
            http_response_code(200);
            echo "Order status updated to Paid";
        } else {
            // If the query fails, send an error response and log the error
            http_response_code(500);
            $error_message = "Error updating order status: " . mysqli_error($conn);
            error_log($error_message);
            echo "Failed to update order status";
        }
    }
?>
