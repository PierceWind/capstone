<?php
// Database configuration
$servername = "localhost";  // Replace with your database server name
$username = "root";  // Replace with your database username
$password = "xoxad";  // Replace with your database password
$dbname = "capstone";  // Replace with your database name

// Create a new database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = 'SELECT oi.OrderID, oi.OrderItemID, oi.ProductID, oi.Quantity, oi.Subtotal
    FROM order_items oi
    INNER JOIN product p ON oi.ProductID = p.prodId
    WHERE p.prodId = ?';


if (isset($_GET["id"])) {
    $prodId = $_GET["id"];
    // Use a prepared statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO order_items (ProductID) VALUES (?)");
    $stmt->bind_param("i", $prodId);

    if ($stmt->execute()) {
        // Item was added to the cart
        $cartNum = getCartItemCount(); // Implement a function to get the cart item count
        $in_cart = "added into cart";
    } else {
        // Error occurred
        $in_cart = "Error adding to cart";
    }

    echo json_encode(["numCart" => $cartNum, "in_cart" => $in_cart]);
}

function getCartItemCount() {
    // Implement a function to retrieve and return the item count in the cart (e.g., by querying the 'cart' table)
    // Return the actual cart item count here
    
}
//DELETE RECORD



if (isset($_POST['delete_rec'])) {
    $ProductID = mysqli_real_escape_string($conn, $_POST['delete_rec']);

    $query = "DELETE FROM `order_items` WHERE `order_items`.`ProductID` = '$ProductID'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        echo '<script>alert("You successfully deleted a Record ' .  $ProductID. '");</script>';
    } else {
        echo '<script>alert("Sorry, Record is not Deleted. Please try Again");</script>';
    }
}
