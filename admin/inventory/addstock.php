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
//DELETE RECORD
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
        <style>
        /* Add these styles for the layout */
        .flex-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
        }

        .fragment {
            width: 100%;
            margin-bottom: 20px;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 20px 35px rgba(0, 0, 0, 0.1);
        }

        /* Media query for smaller screens */
        @media screen and (max-width: 768px) {
            .flex-container {
                flex-direction: column;
            }
        }
    </style>
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
                    <form action="process_delivery.php" method="POST">
                        <div class="flex-container">
                            <!-- Delivery Information -->
                            <div class="fragment">
                                <h2>Delivery Information</h2>
                                <label for="delivery_receipt">Delivery Receipt Number:</label>
                                <input type="text" id="delivery_receipt" name="delivery_receipt" required>
                                <label for="delivered_by">Delivered By:</label>
                                <input type="text" id="delivered_by" name="delivered_by" required>
                                <label for="delivery_date">Delivery Date:</label>
                                <input type="date" id="delivery_date" name="delivery_date" required>
                                <label for="received_by">Received By:</label>
                                <input type="text" id="received_by" name="received_by" required>
                            </div>

                            <!-- Product Categories -->
                            <div class="fragment">
                                <h2>Product Categories</h2>
                                <label for="product_category">Select Product Category:</label>
                                <select id="product_category" name="product_category" required>
                                    <option value="category1">Category 1</option>
                                    <option value="category2">Category 2</option>
                                    <!-- Add more categories as needed -->
                                </select>
                            </div>
                        </div>

                        <!-- Delivered Products -->
                        <div class="fragment">
                            <h2>Delivered Products</h2>
                            <!-- Add delivered products form elements here -->
                            <!-- Example:
                            <label for="product_name">Product Name:</label>
                            <input type="text" id="product_name" name="product_name" required>
                            <label for="quantity">Quantity:</label>
                            <input type="number" id="quantity" name="quantity" required>
                            -->
                        </div>

                        <input type="submit" value="Submit">
                    </form>
                </div>
            </section>
        </div>
        

    </body>
</html>
