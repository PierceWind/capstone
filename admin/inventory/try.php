<?php 
    sleep(0);
    session_start();

    if (!isset($_SESSION['acc_name'])) {
        $_SESSION['msg'] = "You must log in first";
        header('location:../../login/log.php');
    }
    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['acc_name']);
        header('location:../../login/log.php');
    }
    include('../users/server.php');
?>

<?php

// Fetch distinct categories
$categoryQuery = "SELECT DISTINCT prodCategory FROM product";
$categoryResult = mysqli_query($conn, $categoryQuery);

// Fetch all product
$productQuery = "SELECT prodId, prodName, prodCategory FROM product";
$productResult = mysqli_query($conn, $productQuery);

// Initialize arrays to store category and product data
$categories = [];
$product = [];

if ($categoryResult && $productResult) {
    while ($row = mysqli_fetch_assoc($categoryResult)) {
        $categories[] = $row['prodCategory'];
    }

    while ($row = mysqli_fetch_assoc($productResult)) {
        $product[] = [
            'id' => $row['prodId'],
            'name' => $row['prodName'],
            'category' => $row['prodCategory']
        ];
    }
}

if (isset($_POST['add_stock'])) {
    // Retrieve delivery information from the form
    $drNum = mysqli_real_escape_string($conn, $_POST['dr_num']);
    $drName = mysqli_real_escape_string($conn, $_POST['dr_name']);
    $drDate = mysqli_real_escape_string($conn, $_POST['dr_date']);
    $drRName = mysqli_real_escape_string($conn, $_POST['dr_Rname']);

    // Insert data into the "delivery" table
    $insertDeliveryQuery = "INSERT INTO delivery (drNum, drName, drDate, drRname, dateCreated) VALUES ('$drNum', '$drName', '$drDate', '$drRName', NOW())";
    mysqli_query($conn, $insertDeliveryQuery);
    $deliveryId = mysqli_insert_id($conn); // Get the ID of the newly inserted delivery record
    echo "deliveryId  = ", $deliveryId;

    // Retrieve and process product quantities
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'quantity_') === 0) {
            $productId = substr($key, strlen('quantity_'));
            $quantity = (int)$value;

            // Debug output
            echo "Product ID: $productId, Quantity: $quantity<br>";

            // Insert data into the "delivery_products" table
            $insertDeliveryProductsQuery = "INSERT INTO delivery_products (deliveryId, productId, quantity, dateCreated) VALUES ('$drNum', '$productId', '$quantity', NOW())";

            if (mysqli_query($conn, $insertDeliveryProductsQuery)) {
                // Successfully inserted into delivery_products
                // Check if the record exists in the inventory table
                $checkInventoryQuery = "SELECT * FROM inventory WHERE prodCode = '$productId'";
                $checkInventoryResult = mysqli_query($conn, $checkInventoryQuery);

                if (mysqli_num_rows($checkInventoryResult) > 0) {
                    // Update the existing record
                    $updateInventoryQuery = "UPDATE inventory SET stock = stock + $quantity WHERE  prodCode = '$productId'";
                    $updateResult = mysqli_query($conn, $updateInventoryQuery);

                    if (!$updateResult) {
                        echo "Error updating inventory: " . mysqli_error($conn);
                    }
                } else {
                    // Insert a new record
                    $insertInventoryQuery = "INSERT INTO inventory (prodCode, stock) VALUES ('$productId', $quantity)";
                    $insertResult = mysqli_query($conn, $insertInventoryQuery);

                    if (!$insertResult) {
                        echo "Error inserting into inventory: " . mysqli_error($conn);
                    }
                }
            } else {
                echo "Error inserting into delivery_products: " . mysqli_error($conn);
            }
            

        }
    }

    // Close the database connection
    mysqli_close($conn);

    // Redirect to a success page or display a success message
    header('location: stock.php'); // Change 'success.php' to the appropriate page
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Inventory</title>
    <link rel="icon" type="image/x-icon" href="../../files/icons/tdf.png">
    <link rel="stylesheet" type="text/css" href="../style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="includes/bootscript.js"></script>
    <script src="includes/script.js"></script>


</head>
<body>
    <div class="container">
        <nav>
            <ul>
                <br>
                <li>
                    <a href="../index.php" class="logo">
                        <img src="../../files/icons/tdf.png" alt=""> 
                        <span class="nav-title">To Die For<br>FOODS</span>
                    </a>
                </li> <br>
                <li>
                    <a href="">
                        <img src="../../files/icons/admin.png" alt="" class="fas"> 
                        <span class="nav-item">Administrator</span>
                    </a>
                </li> <br>
                <hr style="border: 1px solid #700202;">
                <br>
                <li>   
                    <a href="../dash.php">
                        <img src="../../files/icons/dashboard.png" alt="" class="fas">
                        <span class="nav-item">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="../users/user.php">
                        <img src="../../files/icons/user.png" alt="" class="fas">
                        <span class="nav-item">Manage Users</span>
                    </a>
                </li>
                <li>
                    <a href="../menu/menu.php">
                        <img src="../../files/icons/menu.png" alt="" class="fas">
                        <span class="nav-item">Manage Menu</span>
                    </a>
                </li>
                <li>
                    <a href="">
                        <img src="../../files/icons/inventory.png" alt="" class="fas">
                        <span class="nav-item">Manage Inventory</span>
                    </a>
                </li>
                <li><a href="../dash.php?logout='1'" class="logout">
                    <img src="../../files/icons/logout.png" alt="" class="fas">
                    <span class="nav-item">Sign Out</span>
                </a></li>
            </ul>
        </nav>

        <section class="view" id="view">
            <div class="view-list">
                <h1 style="text-align: center;">Received Stock Inventory</h1> 
                <form method="post" id="menu" class="input-group" enctype="multipart/form-data"  action="">
                    <br><hr style="border: 1px solid #808080;"><br><h3>Delivery Information</h3><br>
                    <div class="group">
                        <div class="card"> 
                            <label for="drNum">Delivery Receipt Number</label> <br>
                            <input type="text" id="drNum" name="dr_num" placeholder="Serial Number" value="" required><br>
                        </div>
                        <div class="card"> 
                            <label for="drName">Delivered by: </label> <br>
                            <input type="text" id="drName" name="dr_name" placeholder="e.g Juan dela Cruz" value="" required><br>
                        </div>
                        <div class="card"> 
                            <label for="drDate">Delivery Dsate</label> <br>
                            <input type="date" id="drDate" name="dr_date" required>
                        </div>
                        <div class="card"> 
                            <label for="drRName">Delivered by: </label> <br>
                            <input type="text" id="drRName" name="dr_Rname" placeholder="e.g Maria Magdalena" value="" required><br>
                        </div>
                    </div>
                    <br><hr style="border: 1px solid #808080; "><br><h3>Product Details</h3><br>
                    <div class="r">
                        <div class="c">
                            <h4>Categories:</h4><br>
                            <ul id="categoryList">
                                <?php foreach ($categories as $category) { ?>
                                    <li class="category" data-category="<?php echo $category; ?>"><?php echo $category; ?></li>
                                <?php } ?>
                            </ul>
                        </div>
                        <div class="c">
                            <h4>Selected Products:</h4><br>
                            <ul id="selectedProducts"></ul>
                        </div>
                    </div>

                    <!-- Quantity input fields go here -->

                    <br><br>
                    <button class="clear-btn" id="clearButton" type="button">Clear</button> 
                    <button style="color:white; background-color:#7002022;" type="submit" class="submit-btn" name="add_stock">Submit</button>
                    <br><br>
                </form>
            </div>
        </section>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const categoryList = document.getElementById("categoryList");
        const selectedProductsList = document.getElementById("selectedProducts");
        const clearButton = document.getElementById("clearButton");
        const categories = <?php echo json_encode($categories); ?>;
        const product = <?php echo json_encode($product); ?>;
        const selectedProducts = [];

        // Function to display product for a selected category
        function displayProducts(category) {
            const categoryProducts = product.filter((product) => product.category === category);
            const productItems = categoryProducts.map((product) => {
                return `
                    <li>
                        <input type="checkbox" class="product-checkbox" data-product-id="${product.id}">
                        ${product.name}
                    </li>
                `;
            });
            return productItems.join("");
        }

        // Event listener for category clicks
        categoryList.addEventListener("click", (e) => {
            if (e.target.classList.contains("category")) {
                const category = e.target.getAttribute("data-category");
                const productItems = displayProducts(category);
                selectedProductsList.innerHTML = "";
                selectedProductsList.innerHTML = productItems;
            }
        });

        // Event listener for product checkboxes

        selectedProductsList.addEventListener("change", (e) => {
            if (e.target.classList.contains("product-checkbox")) {
                const productId = e.target.getAttribute("data-product-id");
                const productName = product.find((product) => product.id === productId).name;
                if (e.target.checked) {
                    // Product is selected, add it to the selectedProducts array
                    selectedProducts.push({ id: productId, name: productName });
                } else {
                    // Product is deselected, remove it from the selectedProducts array
                    const indexToRemove = selectedProducts.findIndex((product) => product.id === productId);
                    if (indexToRemove !== -1) {
                        selectedProducts.splice(indexToRemove, 1);
                    }
                }

                // Update the selected product display
                const selectedProductItems = selectedProducts.map((product) => {
                    return `<li>${product.name} <input type="number" name="quantity_${product.id}" placeholder="Quantity"></li>`;
                });
                selectedProductsList.innerHTML = selectedProductItems.join("");
            }
        });

        // Event listener for the "Clear" button
        clearButton.addEventListener("click", () => {
            selectedProducts.length = 0; // Clear the selected product array
            selectedProductsList.innerHTML = ""; // Clear the selected product display
            // You can also clear the quantity input fields here if needed
        });
    });
    </script>
</body>
</html>
