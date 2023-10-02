<?php
//database connection here
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
        echo '<h4>Select Products:</h4> <br>';
        foreach ($products as $product) {
            $productId = $product['prodId'];
            echo '<div class="d"> <label><input type="checkbox" name="selected_products[]" value="' . $productId . '"> ' . $product['prodName'] . '</label>
                <input type="number" name="product_quantity[' . $productId . ']" placeholder="Quantity" min="1" ><br></div>';
        }
    } else {
        echo '<p>No products available for the selected categories.</p>';
    }
}
?>