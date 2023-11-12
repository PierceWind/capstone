<?php
$servername = "localhost";
$username = "root";
$password = "xoxad";
$dbname = "capstone";

try {
    // Create a PDO connection
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_GET['query'])) {
        $searchQuery = $_GET['query'];

        // Sanitize user input
        $searchQuery = htmlspecialchars($searchQuery);

        // Your search query
        $sql = "SELECT product.*, prodimage.productImg, inventory.stock 
                FROM product 
                LEFT JOIN prodimage ON product.prodId = prodimage.productId
                LEFT JOIN inventory ON product.prodId = inventory.prodCode
                WHERE prodName LIKE :searchQuery";
        $searchStmt = $pdo->prepare($sql);
        $searchParam = "%$searchQuery%";
        $searchStmt->bindValue(':searchQuery', $searchParam, PDO::PARAM_STR);
        $searchStmt->execute();
        $searchResult = $searchStmt->fetchAll(PDO::FETCH_ASSOC);

        // Display results
        if (count($searchResult) > 0) {
            foreach ($searchResult as $product) {
                // Output the search result content
                echo '<div class="product ' . (($product['stock'] == 0) ? 'unavailable' : '') . '">';
                if ($product['stock'] == 0) {
                    echo '<div class="unavailable-message">UNAVAILABLE</div>';
                }
                echo '<a href="index.php?page=product&id=' . $product['prodId'] . '" class="product-link">';
                echo '<div class="product-image-container">';
                echo '<img src="' . $extension . $product['productImg'] . '"';
                echo '<span class="name" style="color: #700202;"><strong>' . htmlspecialchars($product['prodName']) . '</strong></span><br>';
                echo '<span class="price">&#8369;' . htmlspecialchars($product['prodPrice']) . '</span><br>';
                echo '</div>';
                echo '</a>';
                echo '</div>';
            }
        } else {
            echo "0 results";
        }
    } else {
        echo "No search query provided";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
