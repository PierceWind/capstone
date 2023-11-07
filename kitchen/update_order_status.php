<?php
include('server.php');

if (isset($_GET['queueNumber'])) {
    $queueNumber = $_GET['queueNumber'];
    $updateStatusQuery = "UPDATE `orders` SET `orderStatus` = 'Serving' WHERE queueNumber = '$queueNumber' AND orderStatus IN ('Preparing', 'Paid')";
    if (mysqli_query($conn, $updateStatusQuery)) {
        echo '"success"';// Echo "success" 
    } else {
        echo "Error updating order status: " . mysqli_error($conn);
    }
} else {
    echo "Queue number not provided";
}
?>
