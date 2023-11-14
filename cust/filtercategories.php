<?php
$servername = "localhost";
$username = "root";
$password = "xoxad";
$dbname = "capstone";

$extension = "../admin/menu/";

try {
    // Create a PDO connection
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Retrieve the category parameter from the AJAX request
    $category = isset($_GET['category']) ? $_GET['category'] : '';

    // Use a prepared statement to prevent SQL injection
    $stmt = $pdo->prepare('SELECT product.*, prodimage.productImg, inventory.stock 
                        FROM product 
                        LEFT JOIN prodimage ON product.prodId = prodimage.productId
                        LEFT JOIN inventory ON product.prodId = inventory.prodCode 
                        WHERE prodCategory = :category');
    $stmt->bindParam(':category', $category, PDO::PARAM_STR);
    $stmt->execute();

    // Fetch the items
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($items as $item) {
        // Check if the 'stock' key exists in the $item array
        $stock = isset($item['stock']) ? $item['stock'] : null;
        // Check if the 'productImg' key exists in the $item array
        $productImg = isset($item['productImg']) ? $item['productImg'] : null;

    
        echo '<div class="product ' . (($item['stock'] == 0) ? 'unavailable' : '') . '">';
        if ($item['stock'] == 0) {
            echo '<div class="unavailable-message">UNAVAILABLE</div>';
        }
        

        echo '<a href="index.php?page=product&id=' . $item['prodId'] . '" class="product-link">';
        echo '<div class="product-image-container">';
        echo '<img src="' . $extension . $productImg . '" alt="' . htmlspecialchars($item['prodName']) . '">';
        echo '</div>';
        echo '<span class="name" style="color: #700202;"><strong>' . htmlspecialchars($item['prodName']) . '</strong></span><br>';
        echo '<span class="price">&#8369;' . htmlspecialchars($item['prodPrice']) . '</span><br>';
        echo '</a>';
        echo '</div>';
    }
    echo '</div>';
} catch (PDOException $e) {
    // Handle database connection or query errors
    echo 'Error: ' . $e->getMessage();
} finally {
    // Close the database connection
    $pdo = null;
}
?>
