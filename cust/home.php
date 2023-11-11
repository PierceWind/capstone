<?php
$stmt = $pdo->prepare('SELECT DISTINCT product.prodId, product.prodName, product.prodPrice, product.prodDescription, product.prodCategory, prodimage.productImg, inventory.stock 
FROM product 
LEFT JOIN prodimage ON product.prodId = prodimage.productId
LEFT JOIN inventory ON product.prodId = inventory.prodCode');
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
$extension = "../admin/menu/";
?>

<?= template_header('Home') ?>

<style>
    .product {
        position: relative;
        display: inline-block;
        width: 200px; /* Adjust as needed to fit four products in a row */
        margin: 10px; /* Add margin for better spacing */
        text-align: center; /* Center the content */
    }

    .product img {
        width: 100%; /* Make the image fill the container */
        height: 200px; /* Adjust as needed */
        object-fit: cover;
    }

    .product-link {
        text-decoration: none;
        color: inherit;
    }

    .product.unavailable {
        pointer-events: none;
    }

    .unavailable-message {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 18px;
        font-weight: bold;
        color: red;
        text-align: center;
    }
     /* Responsive Styles */
     @media only screen and (max-width: 600px) {
        .featured h2 {
            font-size: 24px; /* Adjust the font size for smaller screens */
        }

        .recentlyadded h2 {
            font-size: 24px; /* Adjust the font size for smaller screens */
        }

        .product {
            width: 100%; /* Make products full width on small screens */
            margin: 10px 0; /* Adjust margin for better spacing */
        }

        .product img {
            height: auto; /* Allow the image to scale with its aspect ratio */
        }

        .name {
            font-size: 16px; /* Adjust font size for product names on smaller screens */
        }

        .price {
            font-size: 14px; /* Adjust font size for product prices on smaller screens */
        }

        .description {
            font-size: 12px; /* Adjust font size for product descriptions on smaller screens */
        }
    }
</style>



<div class="featured">
    <h2>To Die For Foods</h2>
    <p>Your Cravings Satisfied Here at TDF Foods</p>
</div>
<div class="recentlyadded content-wrapper">
    <h2 style="font-size: 30px;">To Die For Menu</h2>
    <div class="products">
        <?php foreach ($products as $product): ?>
            <div class="product <?= ($product['stock'] == 0) ? 'unavailable' : '' ?>">
                <?php if ($product['stock'] == 0): ?>
                    <div class="unavailable-message">UNAVAILABLE</div>
                <?php endif; ?>
                <a href="<?= ($product['stock'] > 0) ? 'index.php?page=product&id=' . $product['prodId'] : '#' ?>" class="product-link">
                    <img src="<?= $extension . $product['productImg'] ?>" alt="<?= $product['prodName'] ?>">
                    <span class="name" style="color: #700202;"><strong><?= $product['prodName'] ?></strong></span>
                    <span class="price">&#8369;<?= $product['prodPrice'] ?></span>
                    <span class="description" style="color: black;"><?= $product['prodDescription'] ?></span>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?= template_footer() ?>
