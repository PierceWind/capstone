<?php
// Include your database connection here
include('../../server.php');

if (isset($_POST['categories'])) {
    $selectedCategories = $_POST['categories'];
    $products = [];

    foreach ($selectedCategories as $category) {
        $query = "SELECT * FROM product WHERE prodCategory = '$category'";
        $result = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            $products[] = $row;
        }
    }

    if (!empty($products)) {
        echo '<h3>Products:</h3>';
        foreach ($products as $product) {
            echo '<label><input type="checkbox" name="selected_products[]" value="' . $product['prodId'] . '"> ' . $product['prodName'] . '</label>
                <input type="number" name="product_quantity[' . $product['prodId'] . ']" placeholder="Quantity" min="1" required><br>';
        }
    } else {
        echo '<p>No products available for the selected categories.</p>';
    }
}
?>
