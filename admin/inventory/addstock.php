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
                            <label for="drDate">Delivery Date</label> <br>
                            <input type="date" id="drDate" name="dr_date" required>
                        </div>
                        <div class="card"> 
                            <label for="drRName">Delivered by: </label> <br>
                            <input type="text" id="drRName" name="dr_Rname" placeholder="e.g Maria Magdalena" value="" required><br>
                        </div>
                    </div>
                    <br><hr style="border: 1px solid #808080;"><br><h3>Product Categories</h3><br>
                    <div class="group">
                        <div class="card">
                            <label>Select Category</label><br>
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
                    </div>
                    <div class="card">
                        <div class="selected-products">
                            <h3>Selected Products:</h3>
                            <div class="product-list">
                                <!-- Products will be displayed here -->
                            </div>
                        </div>
                    </div>
                    <br><br>
                    <button style="color:white; background-color:#7002022;" type="submit" class="submit-btn" name="add_stock">Submit</button>
                </form>
            </div>
        </section>
    </div>
    <script>
        // jQuery script for handling category selection and displaying products
        $(document).ready(function () {
            $('input[name="categories[]"]').change(function () {
                var selectedCategories = $('input[name="categories[]"]:checked').map(function(){
                    return this.value;
                }).get();

                $.ajax({
                    type: "POST",
                    url: "includes/get_products.php", // Create a separate PHP script to fetch products based on categories
                    data: {categories: selectedCategories},
                    success: function (response) {
                        $(".selected-products").html(response);
                    }
                });
            });
        });
    </script>
</body>
</html>
