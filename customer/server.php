<?php
$servername = "localhost";  // Replace with your database server name
$username = "root";  // Replace with your database username
$password = "xoxad";  // Replace with your database password
$dbname = "capstone";  // Replace with your database name
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cartData = json_decode(file_get_contents("php://input"), true);

    // Start a transaction to ensure data consistency
    $conn->begin_transaction();

    // Find the current maximum QueueNumber for non-Queued orders
    $queueNumberQuery = "SELECT COALESCE(MAX(QueueNumber), 0) AS maxQueueNumber FROM orders WHERE OrderStatus = 'Queued'";
    $queueNumberResult = $conn->query($queueNumberQuery);

    if ($queueNumberResult) {
        $row = $queueNumberResult->fetch_assoc();
        $maxQueueNumber = $row['maxQueueNumber'];

        // Check if the maximum QueueNumber is 50, and if not, increment it; otherwise, reset it to 1
        if ($maxQueueNumber < 50) {
            $newQueueNumber = $maxQueueNumber + 1;
        } else {
            $newQueueNumber = 1;
        }

        // Insert the order with the determined QueueNumber
        $orderInsertSQL = "INSERT INTO orders (OrderDateTime, OrderStatus, QueueNumber) VALUES (NOW(), 'Queued', $newQueueNumber)";
        if ($conn->query($orderInsertSQL) === true) {
            $orderID = $conn->insert_id;

            foreach ($cartData as $item) {
                $productID = $conn->real_escape_string($item['name']);
                $quantity = $item['count'];  // Use 'count' instead of 'Quantity'
                $price = $item['price'];
            
                $itemInsertSQL = "INSERT INTO order_items (OrderID, ProductID, Quantity, Subtotal) VALUES ($orderID, '$productID', $quantity, $price)";
            
                if ($conn->query($itemInsertSQL) !== true) {
                    die("Error inserting order item: " . $conn->error);
                }
            }

            echo "Order placed successfully!";
            $conn->commit(); // Commit the transaction
        } else {
            $conn->rollback(); // Rollback the transaction in case of an error
            die("Error placing the order: " . $conn->error);
        }
    } else {
        die("Error retrieving QueueNumber: " . $conn->error);
    }

    $conn->close();
}
?>
