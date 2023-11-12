
<?= template_header('Home') ?>
<?php
// Assuming you have a database connection in $pdo

$stmt = $pdo->prepare('SELECT DISTINCT product.prodId, product.prodName, product.prodPrice, product.prodDescription, product.prodCategory, prodimage.productImg, inventory.stock 
FROM product 
LEFT JOIN prodimage ON product.prodId = prodimage.productId
LEFT JOIN inventory ON product.prodId = inventory.prodCode');
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

$extension = "../admin/menu/";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Page Title</title>

    <style>         
        /* Your CSS Styles Go Here */
        .product {
            position: relative;
            display: inline-block;
            width: 200px; 
            margin: 28px;
            float: center;  
        }
        .products {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr 1fr  1fr 1fr 1fr));
        gap: 20px;
        }

        .product img {
            width: 100%; 
            height: 200px; 
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
            background-color: white;
            padding: 5px;
            color: red;
            font-weight: bold;
            font-size: 16px;
        }
        .submenu {
        position: sticky;
        top: 0;
        background-color: #fff;
        z-index: 1000;
    }

    .submenu ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
        background-color: #f1f1f1; /* Background color for the submenu */
        display: flex; /* Use flexbox to create a horizontal layout */
        justify-content: space-evenly; /* Distribute items evenly */
    }

    .submenu li {
        flex: 1; /* Distribute available space equally among items */
        text-align: center;
    }

    .submenu a {
        display: block;
        color: #700202;
        padding: 14px 0; /* Adjust vertical padding */
        text-decoration: none;
    }

    .submenu a:hover {
        background-color: #ddd;
    }

    .category-section {
        margin-top: 20px;
    }
    </style>
</head>
<body>

    <div class="featured">
        <br>
        <h2>To Die For Foods</h2>
        <p>Your Cravings Satisfied Here at TDF Foods</p>
        <br>
    </div>

    <div class="submenu">
        <ul>
            <li><a href="#heritage">Heritage</a></li>
            <li><a href="#specialties">Specialties</a></li>
            <li><a href="#pasta">Pasta</a></li>
            <li><a href="#salad">Salad</a></li>
            <li><a href="#sweets">Sweets</a></li>
            <li><a href="#drinks">Drinks</a></li>
            <li><a href="#top-selling">Top Selling</a></li>
        </ul>
    </div>

    <div class="recentlyadded content-wrapper">
        <h2 style="font-size: 30px; color: #700202;">To Die For Menu</h2>

        <?php foreach ($products as $product): ?>
            <div class="product <?= ($product['stock'] == 0) ? 'unavailable' : '' ?>">
                <?php if ($product['stock'] == 0): ?>
                    <div class="unavailable-message">UNAVAILABLE</div>
                <?php endif; ?>  
                <a href="<?= ($product['stock'] > 0) ? 'index.php?page=product&id=' . $product['prodId'] : '#' ?>" class="product-link">
                    <div class="product-image-container">
                        <img src="<?= $extension . $product['productImg'] ?>" alt="<?= $product['prodName'] ?>">
                        <span class="name" style="color: #700202;"><strong><?= $product['prodName'] ?></strong></span><br>
                        <span class="price">&#8369;<?= $product['prodPrice'] ?></span><br>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Your JavaScript for smooth scrolling goes here -->

</body>
</html>


<?= template_footer() ?>
