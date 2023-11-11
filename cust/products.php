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

<?=template_header('Products')?>

<style>
    .product img {
        width: 200px;
        height: 200px;
        object-fit: cover;
    }
</style>

<div class="products content-wrapper">
    <h1>Products</h1>

    <?php foreach ($display_categories as $category): ?>
        <h2><?= $category ?></h2>
        <div class="products-wrapper">
            <?php
            // Select products ordered by date added, with pagination and filtering by category
            $stmt = $pdo->prepare('SELECT DISTINCT product.prodId, product.prodName, product.prodPrice, product.prodDescription, product.prodCategory, prodimage.productImg 
            FROM product 
            LEFT JOIN prodimage ON product.prodId = prodimage.productId
            WHERE product.prodCategory = :category');

            // Execute the statement with named parameters
            $stmt->execute([':category' => $category]);
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($products as $product):
            ?>
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

<?=template_footer()?>
