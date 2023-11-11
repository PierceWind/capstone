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
    <title>Thank You Page</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap">
    <style>
        body {
            background: #700202;
            color: white;
            margin: 0; /* Remove default margin */
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh; /* Ensure the body takes at least the full viewport height */
        }

        .placeorder {
            text-align: center;
        }

        h1 {
            font-size: 40px;
            margin: 20px 0; /* Add some margin for spacing */
            /* Add any additional styling for your h1 element here */
            font-family: 'Great Vibes', cursive; /* Use the Google Font 'Great Vibes' */
        }

        p {
            font-size: 30px;
        }

        .back-to-home-button {
            margin-left: 5px;
            padding: 12px 20px;
            border: 0;
            border-radius: 20px;
            background: yellow;
            color: black;
            font-size: 30px;
            font-weight: bold;
            cursor: pointer;
            border-radius: 10px;
            margin-top: 20px; /* Add some top margin for spacing */
            display: inline-block;
        }

        .back-to-home-button:hover {
            background: yellow;
            color: black;
        }
    </style>
</head>
<body>
    <div class="placeorder content-wrapper">
        
        <h1>Thank You For Your Order</h1>
        <hr>
        <strong>
            <p>Order Number: <?= isset($_SESSION['orderId']) ? $_SESSION['orderId'] : 'N/A' ?></p>
            <p>Queue Number: <?= isset($_SESSION['queueNumber']) ? $_SESSION['queueNumber'] : 'N/A' ?></p>
        </strong>
        <hr>
        <h1>Bon Appetite</h1>
        <form method="post" class="placeorder">
            <input type="submit" name="back_to_home" value="ORDER NOW" class="back-to-home-button">
        </form>
    </div>
</body>
</html>
