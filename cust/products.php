<?php
$extension = "../admin/menu/";
$num_categories_on_each_page = 1;  // Number of categories to show on each page
$current_category_page = isset($_GET['cp']) && is_numeric($_GET['cp']) ? (int)$_GET['cp'] : 1;

// Select distinct categories
$categories_stmt = $pdo->query('SELECT DISTINCT prodCategory FROM product');
$categories = $categories_stmt->fetchAll(PDO::FETCH_COLUMN);

// Calculate the total number of categories
$total_categories = count($categories);
// Calculate the starting index for the current category page
$start_category_index = ($current_category_page - 1) * $num_categories_on_each_page;
// Slice the categories array to get the categories for the current page
$display_categories = array_slice($categories, $start_category_index, $num_categories_on_each_page);
?>

<?= template_header('Products') ?>

<style>
    .product-image-container {
        position: relative;
        width: 200px;
        height: 200px;
        overflow: hidden; /* To ensure fixed dimensions */
    }

    .product-image-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
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

    .products-wrapper a {
        text-decoration: none; /* Remove underlines from clickable links */
    }
</style>

<div class="products content-wrapper">
    <h1>Products</h1>

    <?php foreach ($display_categories as $category): ?>
        <h2><?= $category ?></h2>
        <div class="products-wrapper">
            <?php
            // Select products ordered by date added, with pagination and filtering by category
            $stmt = $pdo->prepare('SELECT DISTINCT product.prodId, product.prodName, product.prodPrice, product.prodDescription, product.prodCategory, prodimage.productImg, inventory.stock 
            FROM product 
            LEFT JOIN prodimage ON product.prodId = prodimage.productId
            LEFT JOIN inventory ON product.prodId = inventory.prodCode
            WHERE product.prodCategory = :category');

            // Execute the statement with named parameters
            $stmt->execute([':category' => $category]);
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($products as $product):
                $isAvailable = $product['stock'] > 0;
            ?>
                <div class="product<?= $isAvailable ? '' : ' unavailable' ?>">
                    <?php if ($isAvailable): ?>
                        <a href="index.php?page=product&id=<?= $product['prodId'] ?>">
                    <?php endif; ?>
                        <div class="product-image-container">
                            <img src="<?= $extension . $product['productImg'] ?>" alt="<?= $product['prodName'] ?>">
                            <?php if (!$isAvailable): ?>
                                <span class="unavailable-message">UNAVAILABLE</span>
                            <?php endif; ?>
                        </div>
                        <span class="name" style="color: #700202;"><strong><?= $product['prodName'] ?></strong></span>
                        <span class="price">&#8369;<?= $product['prodPrice'] ?></span>
                        <span class="description" style="color: black;"><?= $product['prodDescription'] ?></span>
                    <?php if ($isAvailable): ?>
                        </a>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endforeach; ?>

    <div class="buttons">
        <?php if ($current_category_page > 1): ?>
            <a href="index.php?page=products&cp=<?= $current_category_page - 1 ?>">Prev</a>
        <?php endif; ?>
        <?php if ($total_categories > ($current_category_page * $num_categories_on_each_page) - $num_categories_on_each_page + count($display_categories)): ?>
            <a href="index.php?page=products&cp=<?= $current_category_page + 1 ?>">Next</a>
        <?php endif; ?>
    </div>
</div>

<?= template_footer() ?>
