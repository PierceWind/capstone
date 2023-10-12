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
if(isset( $_GET["id"])){
    $prodId = $_GET["id"];
    $sql = 'SELECT * FROM order_items WHERE prodId = $prodId';
    $result = $conn->query($sql);
    $totalCart = "SELECT * FROM order_items";
    $totalResult = $conn->query($totalCart);
    $cartNum = mysqli_num_rows($totalResult);

    if ($result->num_rows > 0) {
        // output data of each row
        $in_cart = "already in cart";//supposedly if the button is clicked lalabas to instead of add to cart

        echo json_encode(["numCart" => $cartNum, "in_cart" => $in_cart]);
    }else{
        $insert = "INSERT INTO cart(prodId) VALUES($prodId)";
        if ($conn->query($insert) === TRUE) {
            $in_cart = "added into cart"; // same here
            echo json_encode(["numCart" => $cartNum, "in_cart" => $in_cart]);
        } else {
            echo "<script>alert(It doesn't insert)</script>";
        }
    }
    
}

if(isset( $_GET["orderId"])){
    $prodId = $_GET["orderId"];
    $sql = "DELETE FROM order_items WHERE prodId = $prodId";
    

    if ($conn->query($sql)=== TRUE) {
        echo "REMOVED FROM CART";
    }else{
        $insert = "INSERT INTO cart(prodId) VALUES($prodId)";
        if ($conn->query($insert) === TRUE) {
            $in_cart = "added into cart"; // same here
            echo json_encode(["numCart" => $cartNum, "in_cart" => $in_cart]);
        } else {
            echo "<script>alert(It doesn't insert)</script>";
        }
    }
    
}
?>
