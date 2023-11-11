<?php
// Check to make sure the id parameter is specified in the URL
if (isset($_GET['id'])) {
    // Prepare statement and execute, prevents SQL injection
    $stmt = $pdo->prepare('SELECT DISTINCT product.prodId, product.prodName, product.prodPrice, product.prodDescription, product.prodCategory, prodimage.productImg 
    FROM product 
    LEFT JOIN prodimage ON product.prodId = prodimage.productId WHERE prodId = ?');
    $stmt->execute([$_GET['id']]);
    // Fetch the product from the database and return the result as an Array
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    // Check if the product exists (array is not empty)
    if (!$product) {
        // Simple error to display if the id for the product doesn't exists (array is empty)
        exit('Product does not exist!');
    }
} else {
    // Simple error to display if the id wasn't specified
    exit('Product does not exist!');
}

$extension = "../admin/menu/";
?>

<?=template_header('Product')?>

<style>
    .product img {
        width: 500px; /* Adjust as needed */
        height: 500px; /* Adjust as needed */
        object-fit: cover; /* This will maintain the aspect ratio and cover the specified dimensions */
    }
</style>

<div class="product content-wrapper">
    <img src="<?= $extension . $product['productImg'] ?>" alt="<?= $product['prodName'] ?>">
    <div>
        <h1 class="name"><?=$product['prodName']?></h1>
        <span class="price">
            &#8369;<?= $product['prodPrice'] ?>
        </span>
        <form action="index.php?page=cart" method="post">
            <input type="number" name="quantity" value="1" min="1" max="<?=$product['quantity']?>" placeholder="Quantity" required>
            <input type="hidden" name="product_id" value="<?=$product['prodId']?>">
            <input type="submit" value="Add To Cart">
        </form>
        <div class="description">
            <?=$product['prodDescription']?>
        </div>
    </div>
</div>

<?=template_footer()?>