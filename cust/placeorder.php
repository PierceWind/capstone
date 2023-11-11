<?php
// Check if the "Back to Home" link is clicked
if (isset($_POST['back_to_home'])) {
    // Unset and destroy the session
    session_unset();
    session_destroy();
    // Redirect back to the home page
    header('Location: index.php');
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../files/icons/tdf.png">
    <title>Thank You Page</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap">
    <style>
        body {
            background: #700202;
            color: white;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .placeorder {
            text-align: center;
        }

        h1 {
            font-size: 40px;
            margin: 20px 0;
            font-family: 'Great Vibes', cursive;
        }

        p {
            font-size: 30px;
            margin: 10px 0;
        }

        .back-to-home-button {
            margin-top: 20px;
            padding: 12px 20px;
            border: 0;
            border-radius: 10px;
            background: yellow;
            color: black;
            font-size: 20px;
            font-weight: bold;
            cursor: pointer;
            display: inline-block;
        }

        .back-to-home-button:hover {
            background: yellow;
            color: black;
        }

        hr {
            border: none;
            border-top: 2px solid white;
            margin: 20px 0;
        }

        .order-details {
            margin-top: 20px;
            text-align: left;
        }

        .order-details table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .order-details th, .order-details td {
            border: 1px solid white;
            padding: 10px;
            text-align: left;
        }

       /* Media query for print */
      /* Media query for print */
@media print {
    .placeorder {
        text-align: left;
        position: absolute;
        top: 0;
        width: 56mm;
        margin: 0;
    }

    h1, .back-to-home-button, hr {
        display: none;
    }

    body {
        background: white;
        color: black;
        width: 56mm;
        margin: 0;
        font-size: 15px; 
        line-height: 0.3em;
    }
    
    p {
        font-size: 15px;
    }

    .order-details {
        margin-top: 0;
        page-break-before: always; /* Add this line to control page feed */
    }

    .order-details th, .order-details td {
        border: none;
    }
}


    </style>
    <script>
        // Trigger printing when the page is loaded
        window.onload = function () {
            window.print();
        };
    </script>

</head>
<body>
    <div class="placeorder content-wrapper">
        <h1>Thank You For Your Order</h1>
        <hr>
        <div class="order-details">
            <strong>
                <p>Queue Number: <?= isset($_SESSION['queueNumber']) ? $_SESSION['queueNumber'] : 'N/A' ?></p>
                <p>Order Number: <?= isset($_SESSION['orderId']) ? $_SESSION['orderId'] : 'N/A' ?></p>
            </strong>
            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Fetch and display order details here
                    foreach ($_SESSION['cart'] as $productId => $quantity) {
                        // Fetch the product details from the database using $productId
                        $stmt = $pdo->prepare('SELECT prodName FROM product WHERE prodId = ?');
                        $stmt->execute([$productId]);
                        $product = $stmt->fetch(PDO::FETCH_ASSOC);

                        // Display the product name and quantity
                        echo "<tr><td>{$product['prodName']}</td><td>$quantity</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <hr>
        <h1>Bon Appetite</h1>


        <!-- Back to Home Button -->
        <form method="post" class="placeorder">
            <input type="submit" name="back_to_home" value="ORDER NOW" class="back-to-home-button">
        </form>
    </div>
</body>
</html>
