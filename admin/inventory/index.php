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
        <link rel="stylesheet" type="text/css" href="style.css">
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
                <div class="view-list"> <br>
                    <h1 style="text-align: center;">Sales and Inventory Report</h1>  <br>       
                        <table class="table">
                            <thead>
                                <tr class="head">
                                <form method="post" action="includes/export.php">
                                    <input type="submit" name="export" id="exportBtn" style="width:150px; color: white; background-color:#700202; float:left; padding:5px 20px; font-size:18px;"class="addrec" value="EXPORT" />
                                </form>

                                    <a href="add.php" ><button id="addBtn" style="width: 250px;   " class="addrec"><img class="button" src = "../../files/icons/add4.png">RECEIVED STOCK</button></a>
                                </tr>
                                <tr>
                                    <th style="text-align:center;">Code</th>
                                    <th style="text-align:center;">Prod Name</th>
                                    <th style="text-align:center;">Min Rqmts</th>
                                    <th style="text-align:center;">Unit Price</th>
                                    <th style="text-align:center;">Total Price</th>
                                    <th style="text-align:center;">Available Qty</th>
                                    <th style="text-align:center;">Sold Qty</th>
                                    <th style="text-align:center;">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $query = "SELECT product.prodId, product.minReq, product.prodName, product.prodPrice, 
                                    COALESCE(inventory.stock, 0) AS stock, COALESCE(SUM(sales.sales), 0) AS totalSales
                                    FROM product
                                    LEFT JOIN inventory ON product.prodId = inventory.prodCode
                                    LEFT JOIN sales ON product.prodId = sales.prodCode
                                    GROUP BY product.prodId, product.minReq, product.prodName, product.prodPrice
                                    ORDER BY stock ASC;";

                                    $query_run = mysqli_query($conn, $query);
                                    $space = " ";
                                    $g = "grams";
                                    $p = "₱";

                                    if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $row) {
                                    $totalPrice = $row['prodPrice'] * $row['stock']; // Calculate total price

                                    // Determine the status based on your conditions
                                    if ($row['stock'] <= $row['minReq'] && $row['stock'] != 0)  {
                                    $status = '<span class="attention-status">Needs Attention</span>';
                                    } else if ($row['stock'] == 0) {
                                    $status = '<span class="attention-status">Out of Stock</span>';
                                    } else {
                                    $status = 'Available';
                                    }
                                    ?>
                                    <tr>
                                        <td style="text-align:center;"><?= $row['prodId']; ?></td>
                                        <td style="text-align:center;"><?= $row['prodName']; ?></td>
                                        <td style="text-align:center;"><?= $row['minReq']; ?></td>
                                        <td style="text-align:center;"><?= $p, $row['prodPrice']; ?></td>
                                        <td style="text-align:center;"><?= $p, $totalPrice; ?></td> <!-- Display the calculated total price -->
                                        <td style="text-align:center;"><?= $row['stock']; ?></td>
                                        <td style="text-align:center;"><?= $row['totalSales']; ?></td>
                                        <td style="text-align:center;"><?= $status; ?></td> <!-- Display the calculated status -->
                                    </tr>
                                <?php
                                    }
                                }
                                else {  
                                    ?> 
                                    <tr> <td style="color:red; "> <?php echo '<strong>NO RECORD FOUND</strong>'; ?>
                                    <?php 
                                }
                                ?>
                            </tbody>
                        </table>
                </div>
            </section>
        </div>

    </body>
</html>
