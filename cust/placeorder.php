<?=template_header('Place Order')?>

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

<div class="placeorder content-wrapper">
    <h1>Your Order Has Been Placed</h1>
    <p>Order Number: <?= isset($_SESSION['orderId']) ? $_SESSION['orderId'] : 'N/A' ?></p>
    <p>Queue Number: <?= isset($_SESSION['queueNumber']) ? $_SESSION['queueNumber'] : 'N/A' ?></p>
    <p>Thank you for ordering with us! We'll contact you by email with your order details.</p>
    <form method="post">
        <input type="submit" name="back_to_home" value="Back to Home">
    </form>
</div>

<?=template_footer()?>
