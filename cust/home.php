<?php
// Get the 4 most recently added products
$stmt = $pdo->prepare('SELECT DISTINCT product.prodId, product.prodName, product.prodPrice, product.prodDescription, product.prodCategory, prodimage.productImg 
FROM product 
LEFT JOIN prodimage ON product.prodId = prodimage.productId');
$stmt->execute();
$recently_added_products = $stmt->fetchAll(PDO::FETCH_ASSOC);
$extension = "../admin/menu/";
?>

<?= template_header('Home') ?>

<style>
    .product img {
        width: 200px; /* Adjust as needed */
        height: 200px; /* Adjust as needed */
        object-fit: cover; /* This will maintain the aspect ratio and cover the specified dimensions */
    }
</style>

<div class="featured">
    <h2>To Die For Foods</h2>
    <p>Your Cravings Satisfied Here at TDF Foods</p>
</div>
<div class="recentlyadded content-wrapper">
    <h2>Recently Added Products</h2>
    <div class="products">
        <?php foreach ($recently_added_products as $product): $extension = "../admin/menu/"; ?>
            <a href="index.php?page=product&id=<?= $product['prodId'] ?>" class="product">
                <img src="<?= $extension . $product['productImg'] ?>" alt="<?= $product['prodName'] ?>">
                <span class="name" style="color: #700202;"><strong><?= $product['prodName'] ?></strong></span>
                <span class="price">
                    &#8369;<?= $product['prodPrice'] ?>
                </span>
                <span class="description" style="color: black;"> <?= $product['prodDescription'] ?> </span>
            </a>
        <?php endforeach; ?>
    </div>
</div>

<?= template_footer() ?>
