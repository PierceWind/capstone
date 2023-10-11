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
// DELETE RECORD
if (isset($_POST['delete_rec'])) {
    $id = mysqli_real_escape_string($conn, $_POST['delete_rec']);

    $query = "DELETE FROM product WHERE prodId='$id'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $query1 = "DELETE FROM prodimage WHERE productId='$id'";
        $query_run1 = mysqli_query($conn, $query1);
        echo '<script>alert("You successfully deleted a Record ' . $id . '");</script>';
        mysqli_rollback($conn);
    } else {
        echo '<script>alert("Sorry, Record is not Deleted. Please try Again");</script>';
    }

}

// SAVE RECORD 
// Check if the form is submitted
if (isset($_POST['add_stock'])) {
    $drNum = mysqli_real_escape_string($conn, $_POST['dr_num']);
    $drName = mysqli_real_escape_string($conn, $_POST['dr_name']);
    $drDate = mysqli_real_escape_string($conn, $_POST['dr_date']);
    $drRName = mysqli_real_escape_string($conn, $_POST['dr_Rname']);
    $categories = $_POST['categories'];
    $selectedProducts = $_POST['selected_products'];
    $productQuantities = $_POST['product_quantity'];

    // Insert delivery information into a table (replace 'your_table_name' with your actual table name)
    $deliveryQuery = "INSERT INTO delivery (drNum, drName, drDate, drRName, dateCreated) VALUES ('$drNum', '$drName', '$drDate', '$drRName', NOW())";
    mysqli_query($conn, $deliveryQuery);

    // Get the last inserted delivery ID
    $deliveryId = mysqli_insert_id($conn);

    // Insert selected products and quantities into a table (replace 'your_table_name' with your actual table name)
    foreach ($selectedProducts as $productId) {
        $quantity = $productQuantities[$productId];
        $productQuery = "INSERT INTO inventory (deliveryId, prodCode, stock) VALUES ('$deliveryId', '$productId', '$quantity')";
        mysqli_query($conn, $productQuery);
    }

    // Redirect or display a success message
    echo '<script>alert("Data saved successfully.");</script>';
    // You can redirect the user to a success page or wherever you need them to go.
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
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


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
                    <a href="../profile/settings.php">
                        <img src="../../files/icons/admin.png" alt="" class="fas"> 
                        <span class="nav-item">Administrator</span>
                    </a>
                </li> <br>
                <hr style="border: 1px solid #700202;">
                <br>
                <li>   
                    <a href="../index.php">
                        <img src="../../files/icons/dashboard.png" alt="" class="fas">
                        <span class="nav-item">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="../users/index.php">
                        <img src="../../files/icons/user.png" alt="" class="fas">
                        <span class="nav-item">Manage Users</span>
                    </a>
                </li>
                <li>
                    <a href="../menu/index.php">
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
                <li><a href="../index.php?logout='1'" class="logout">
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
                            <label for="drDate">Delivery Date</label> <br>
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
                            <h4>Select Category:</h4><br>
                            <?php
                            // Query to retrieve product categories from your database
                            $category_query = "SELECT DISTINCT prodCategory FROM product";
                            $category_result = mysqli_query($conn, $category_query);
                            while ($category_row = mysqli_fetch_assoc($category_result)) {
                                $category = $category_row['prodCategory'];
                                echo '<input type="checkbox" id="category_' . $category . '" name="categories[]" value="' . $category . '">
                                <label for="category_' . $category . '">' . $category . '</label><br>';
                            }
                            ?> 
                        </div>
                        <div class="c">
                            <div class="selected-products">
                                <!-- Products will be displayed here -->
                            </div>  
                        </div>
                    </div>
                   
                    <!-- Products will be displayed here on the right side -->
                    <div class="vertical-line"></div>
                    

                    <br><br>
                    <button style="color:white; background-color:#7002022;" type="submit" class="submit-btn" name="add_stock">Submit</button>
                </form>
            </div>
        </section>
    </div>
    <script>
    // Function to update the right side with selected products
    function updateSelectedProducts() {
        var selectedCategories = $('input[name="categories[]"]:checked').map(function () {
            return this.value;
        }).get();

        $.ajax({
            type: "POST",
            url: "includes/get_products.php",
            data: { categories: selectedCategories },
            success: function (response) {
                $(".selected-products").html(response);

                // Show the input fields when products are loaded
                $('input[type="number"]').show();
            }
        });
    }

    // Handle category selection change
    $('input[name="categories[]"]').change(function () {
        updateSelectedProducts();
    });

    // Handle product selection change
    $(document).on('change', 'input[name="selected_products[]"]', function () {
        var productCheckbox = $(this);
        var productId = productCheckbox.val();
        var quantityInput = $('input[name="product_quantity[' + productId + ']"]');

        if (productCheckbox.is(':checked')) {
            // Show the quantity input field when a product is selected
            quantityInput.show();
        } else {
            // Hide the quantity input field when a product is deselected
            quantityInput.hide();
        }
    });

    // Initial update when the page loads
    updateSelectedProducts();
</script>


</body>
</html>
