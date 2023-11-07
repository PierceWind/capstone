<?php    
    
     // Get the cart data sent from the client
    
    // Database configuration
    $servername = "localhost";  // Replace with your database server name
    $username = "root";  // Replace with your database username
    $password = "xoxad";  // Replace with your database password
    $dbname = "capstone";  // Replace with your database name
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $cartData = json_decode($_POST['cartArray'], true);
    // Insert the order into the 'orders' table
    $orderInsertSQL = "INSERT INTO orders (OrderDateTime, OrderStatus, QueueNumber) VALUES (NOW(), 'Processing', NULL)";

    if ($conn->query($orderInsertSQL) === true) {
        // Get the auto-generated OrderID
        $orderID = $conn->insert_id;

        // Insert each item in the cart into the 'order_items' table, associating them with the OrderID
        foreach ($cart as $item) {
            $productID = $conn->real_escape_string($item['ProductID']);
            $quantity = $item['Quantity'];
            $price = $item['Price'];

            $itemInsertSQL = "INSERT INTO order_items (OrderID, ProductID, Quantity, Subtotal) VALUES ($orderID, '$productID', $quantity, $price)";

            if ($conn->query($itemInsertSQL) !== true) {
                die("Error inserting order item: " . $conn->error);
            }
        }

        echo "Order placed successfully!";
    } else {
        die("Error placing the order: " . $conn->error);
    
    }
     // Close the database connection
    $conn->close();
}

?>
