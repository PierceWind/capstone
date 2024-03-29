<?php

// If the user clicked the add to cart button on the product page we can check for the form data
if (isset($_POST['product_id'], $_POST['quantity']) && is_numeric($_POST['product_id']) && is_numeric($_POST['quantity'])) {
    // Set the post variables so we easily identify them, also make sure they are integer
    $product_id = (int)$_POST['product_id'];
    $quantity = (int)$_POST['quantity'];
    // Prepare the SQL statement, we basically are checking if the product exists in our databaser
    $stmt = $pdo->prepare('SELECT DISTINCT product.prodId, product.prodName, product.prodPrice, product.prodDescription, product.prodCategory, prodimage.productImg 
    FROM product 
    LEFT JOIN prodimage ON product.prodId = prodimage.productId WHERE prodId = ?');
    $stmt->execute([$_POST['product_id']]);
    // Fetch the product from the database and return the result as an Array
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    // Check if the product exists (array is not empty)
    if ($product && $quantity > 0) {
        // Product exists in database, now we can create/update the session variable for the cart
        if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
            if (array_key_exists($product_id, $_SESSION['cart'])) {
                // Product exists in cart so just update the quanity
                $_SESSION['cart'][$product_id] += $quantity;
            } else {
                // Product is not in cart so add it
                $_SESSION['cart'][$product_id] = $quantity;
            }
        } else {
            // There are no products in cart, this will add the first product to cart
            $_SESSION['cart'] = array($product_id => $quantity);
        }
    }
    // Prevent form resubmission...
    header('location: index.php?page=cart');
    exit;
}

// Remove product from cart, check for the URL param "remove", this is the product id, make sure it's a number and check if it's in the cart
if (isset($_GET['remove']) && is_numeric($_GET['remove']) && isset($_SESSION['cart']) && isset($_SESSION['cart'][$_GET['remove']])) {
    // Remove the product from the shopping cart
    unset($_SESSION['cart'][$_GET['remove']]);
}

// Update product quantities in cart if the user clicks the "Update" button on the shopping cart page
if (isset($_POST['update']) && isset($_SESSION['cart'])) {
    // Loop through the post data so we can update the quantities for every product in cart
    foreach ($_POST as $k => $v) {
        if (strpos($k, 'quantity') !== false && is_numeric($v)) {
            $id = str_replace('quantity-', '', $k);
            $quantity = (int)$v;
            // Always do checks and validation
            if (is_numeric($id) && isset($_SESSION['cart'][$id]) && $quantity > 0) {
                // Update new quantity
                $_SESSION['cart'][$id] = $quantity;
            }
        }
    }
    // Prevent form resubmission...
    header('location: index.php?page=cart');
    exit;
}


// Check the session variable for products in cart
$products_in_cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
$products = array();
$subtotal = 0.00;
// If there are products in cart
if ($products_in_cart) {
    // There are products in the cart so we need to select those products from the database
    // Products in cart array to question mark string array, we need the SQL statement to include IN (?,?,?,...etc)
    $array_to_question_marks = implode(',', array_fill(0, count($products_in_cart), '?'));
    $stmt = $pdo->prepare('SELECT DISTINCT product.prodId, product.prodName, product.prodPrice, product.prodDescription, product.prodCategory, prodimage.productImg, inventory.stock
    FROM product 
    LEFT JOIN prodimage ON product.prodId = prodimage.productId
    LEFT JOIN inventory ON product.prodId = inventory.prodCode
    WHERE prodId IN (' . $array_to_question_marks . ')');
    // We only need the array keys, not the values, the keys are the id's of the products
    $stmt->execute(array_keys($products_in_cart));
    // Fetch the products from the database and return the result as an Array
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Calculate the subtotal
    foreach ($products as $product) {
        $subtotal += (float)$product['prodPrice'] * (int)$products_in_cart[$product['prodId']];
    }
}

// Send the user to the place order page if they click the Place Order button, also the cart should not be empty
if (isset($_POST['placeorder']) && isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    // Retrieve the maximum queueNumber with orderStatus 'Queued'
    $stmt = $pdo->prepare('SELECT MAX(queueNumber) AS maxQueueNumber FROM orders WHERE orderStatus = "Queued"');
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $currentQueueNumber = $result['maxQueueNumber'];

    // Increment the queueNumber for the new order
    $queueNumber = $currentQueueNumber + 1;

    // Retrieve the maximum orderId for the current year
    $stmt = $pdo->prepare('SELECT MAX(orderID) AS maxOrderId FROM orders WHERE YEAR(orderDateTime) = YEAR(NOW())');
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $currentOrderId = $result['maxOrderId'];

    // If there are no orders for the current year, start with orderID 1; otherwise, increment the current orderId
    $orderId = ($currentOrderId !== null) ? $currentOrderId + 1 : 1;

    // Insert a new record with the updated queueNumber
    $stmt = $pdo->prepare('INSERT INTO orders (orderID, orderDateTime, orderStatus, queueNumber) VALUES (?, NOW(), "Queued", ?)');
    $stmt->execute([$orderId, $queueNumber]);


    // Save the orderId and queueNumber in the session
    $_SESSION['orderId'] = $orderId;
    $_SESSION['queueNumber'] = $queueNumber;

    // Insert order details into order_items table
    foreach ($products as $product) {
        $stmt = $pdo->prepare('INSERT INTO order_items (OrderID, QueueNumber, ProductID,  quantity, subtotal) VALUES (?, ?,  ?, ?, ?)');
        
        if (!$stmt) {
            // Check for errors in preparing the statement
            echo "\nPDO::errorInfo():\n";
            print_r($pdo->errorInfo());
            die();
        }
    
        $stmt->bindParam(1, $orderId);
        $stmt->bindParam(2, $queueNumber);
        $stmt->bindParam(3, $product['prodId']);
        $stmt->bindParam(4, $products_in_cart[$product['prodId']]);
        $subtotal = $product['prodPrice'] * $products_in_cart[$product['prodId']];
        $stmt->bindParam(5, $subtotal);
    
        if (!$stmt->execute()) {
            // Check for errors in executing the statement
            echo "\nPDO::errorInfo():\n";
            print_r($stmt->errorInfo());
            die();
        }
    
        // Update the product sales in the sales table
        $stmt = $pdo->prepare('INSERT INTO sales (orderId, prodCode, sales, date) VALUES (?, ?, ?, NOW())');
        $stmt->bindParam(1, $orderId);
        $stmt->bindParam(2, $product['prodId']);
        $stmt->bindParam(3, $products_in_cart[$product['prodId']]);
    
        if (!$stmt->execute()) {
            // Check for errors in executing the statement
            echo "\nPDO::errorInfo():\n";
            print_r($stmt->errorInfo());
            die();
        }
    }
    header('Location: index.php?page=placeorder');
    exit;
}


$extension = "../admin/menu/";
?>

<?=template_header('Cart')?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            .img img {
                width: 50px; 
                height: 50px; 
                object-fit: cover; /* This will maintain the aspect ratio and cover the specified dimensions */
            }
        </style>
</head>
<body>
<div class="cart content-wrapper">
    <h1>Order Details</h1>
    <form action="index.php?page=cart" method="post">
        <table>
            <thead>
                <tr>
                    <td colspan="2">Product</td>
                    <td>Price</td>
                    <td>Quantity</td>
                    <td>Total</td>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($products)): ?>
                <tr>
                    <td colspan="5" style="text-align:center;">You have no products added in your Shopping Cart</td>
                </tr>
                <?php else: ?>
                <?php foreach ($products as $product): ?>
                <tr>
                    <td class="img">
                        <a href="index.php?page=product&id=<?=$product['prodId']?>">
                            <img src="<?= $extension . $product['productImg'] ?>" alt="<?= $product['prodName'] ?>">
                        </a>
                    </td>
                    <td>
                        <a href="index.php?page=product&id=<?=$product['prodId']?>"><?=$product['prodName']?></a>
                        <br>
                        <a href="index.php?page=cart&remove=<?=$product['prodId']?>" class="remove">Remove</a>
                    </td>
                    <td class="price"> &#8369;<?=$product['prodPrice']?></td>
                    <td class="quantity">
                        <input type="number" name="quantity-<?=$product['prodId']?>" value="<?=$products_in_cart[$product['prodId']]?>" min="1" max="<?=$product['stock']?>" placeholder="Quantity" required>
                    </td>
                    <td style="font-weight: bold;s" class="price"> &#8369;<?=$product['prodPrice'] * $products_in_cart[$product['prodId']]?></td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="subtotal">
            <span class="text">Subtotal</span>
            <span class="price"> &#8369;<?=$subtotal?></span>
        </div>
        <div class="buttons">
            <input type="submit" value="Update" name="update">
            <input type="submit" value="Place Order" name="placeorder">
        </div>
    </form>
</div>
                </body>

<?=template_footer()?>