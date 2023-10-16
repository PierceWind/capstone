<?php
// Establish a connection to the database
$conn = mysqli_connect('localhost', 'root', 'xoxad', 'capstone');

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve the queue number from the GET request
$queueNumber = $_GET['queueNumber'];

// Fetch order details from the database based on the queue number
$query = "SELECT * FROM order_items WHERE queueNumber = '$queueNumber'";
$result = mysqli_query($conn, $query);

// Create an array to store the order details
$orderDetails = array();

if (mysqli_num_rows($result) > 0) {
    // Loop through the result set and add each row to the order details array
    while ($row = mysqli_fetch_assoc($result)) {
        $orderDetails[] = array(
            'productName' => $row['productName'],
            'quantity' => $row['quantity'],
            'unitPrice' => $row['unitPrice'],
            'subtotal' => $row['subtotal']
        );
    }
}

// Convert the array to JSON and output the result
echo json_encode($orderDetails);

// Close the connection
mysqli_close($conn);
?>
