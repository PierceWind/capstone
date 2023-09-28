<?php
// Start a session to store cart data
session_start();

// Check if the action is 'add' and an item ID is provided
if (isset($_GET['action']) && $_GET['action'] === 'add' && isset($_GET['id'])) {
    $item_id = $_GET['id'];

    // Check if the item already exists in the cart
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    if (isset($_SESSION['cart'][$item_id])) {
        // Item already exists, increase the quantity
        $_SESSION['cart'][$item_id]['quantity']++;
    } else {
        // Item doesn't exist, add it to the cart
        $item = array(
            'id' => $item_id,
            'name' => $item['name'],  // You should fetch this data from your database
            'price' => $item['price'], // You should fetch this data from your database
            'quantity' => 1
        );
        $_SESSION['cart'][$item_id] = $item;
    }
}

// Function to calculate the total price of items in the cart
function calculateTotalPrice($cart) {
    $total = 0;
    foreach ($cart as $item) {
        $total += $item['price'] * $item['quantity'];
    }
    return $total;
}

// Display cart contents
?>

<!DOCTYPE html>
<html>
<head>
    <title>Shopping Cart</title>
</head>
<body>
    <h1>Shopping Cart</h1>
    
    <!-- Display cart items -->
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                foreach ($_SESSION['cart'] as $item) {
                    $total = $item['price'] * $item['quantity'];
                    echo "<tr>";
                    echo "<td>{$item['name']}</td>";
                    echo "<td>{$item['price']} /-</td>";
                    echo "<td>{$item['quantity']}</td>";
                    echo "<td>{$total} /-</td>";
                    echo "<td><a href='cart.php?action=remove&id={$item['id']}'>Remove</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Your cart is empty.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <!-- Display total price -->
    <?php
    $totalPrice = calculateTotalPrice($_SESSION['cart']);
    echo "<p>Total Price: {$totalPrice} /-</p>";
    ?>

    <!-- Continue shopping or checkout buttons -->
    <p><a href="index.php">Continue Shopping</a></p>
    <p><a href="checkout.php">Checkout</a></p>
</body>
</html>
