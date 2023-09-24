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
                <div class="view-list"> <br>
                    <h1 style="text-align: center;">Manage Menu Record</h1>  <br>       
                        <table class="table">
                            <thead>
                                <tr class="head">
                                    <button id="addBtn" class="addrec"><img class="button" src = "../../files/icons/add4.png">ADD RECORD</button>
                                </tr>
                                <tr>
                                    <th style="text-align:center;">Product ID</th>
                                    <th>Product Name</th>
                                    <th>Stock Qty</th>
                                    <th>Unit Price</th>
                                    <th>Total Price</th>
                                    <th>Delivery Date</th>
                                    <th>DR Serial</th>
                                    <th style="text-align:center;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $query = "SELECT DISTINCT product.prodId, prodimage.productImg, product.prodDescription, product.prodName, product.netWeight, product.prodPrice, product.prodCategory, product.dateModified
                                                FROM product
                                                INNER JOIN prodimage
                                                ON prodimage.productId = product.prodId
                                                ORDER BY prodId ASC";

                                    $query_run = mysqli_query($conn, $query);
                                    $space = " ";
                                    $g = "grams"; 
                                    $p = "₱"; 

                                    if (mysqli_num_rows($query_run) > 0) {
                                        foreach($query_run as $row) {
                                ?>
                                <tr>
                                    <td><?php echo $row['prodId']; ?></td>
                                    <td><?php echo $row['prodName']; ?></td>
                                    <td><?php echo $row['prodDescription']; ?></td>
                                    <td><?php echo $row['netWeight'], $space, $g; ?></td>
                                    <td><?php echo $p, $space, $row['prodPrice']; ?></td>
                                    <td><?php echo $row['prodCategory']; ?></td>
                                    <td> 
                                        <button onclick="editModal('<?php echo $row['prodId']; ?>', '<?php echo $row['productImg']; ?>', '<?php echo $row['prodName']; ?>', '<?php echo $row['prodDescription']; ?>', '<?php echo $row['prodPrice']; ?>', '<?php echo $row['netWeight']; ?>','<?php echo $row['prodCategory']?>')" style="margin: 0px 2px;" class="button"><img class="button" src="../../files/icons/edit.png" alt="edit"></button>
                                        <form action="" method="POST" class="d-inline">
                                            <button type="submit" value="<?php echo $row['prodId']; ?>" class="button" name="delete_rec"><img src="../../files/icons/delete.png" alt="delete"></a>   
                                        </form>
                                    </td>
                                </tr>
                                <?php
                                    }
                                }
                                else {
                                    echo "<h5> No Record Found </h5>";
                                }
                                ?>
                            </tbody>
                    </table>
                </div>
            </section>
        </div>
        
        <?php include ('includes/addmenu.php');
              include ('includes/editmenu.php');?>
        
        <script type="text/javascript"> 
            //add re
            var modal = document.getElementById("addModal");
            var btn = document.getElementById("addBtn");
            var span = document.getElementsByClassName("close")[0];
            btn.onclick = function() {
                modal.style.display = "block";
            }
            span.onclick = function() {
                modal.style.display = "none";
            }
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }

            //edit 
            function editModal(prodId, productImg, prodName, prodDescription, prodPrice, netWeight,  prodCategory) {
                var modal1 = document.getElementById("editMenuModal");
                var span1 = document.getElementsByClassName("close")[1];
                modal1.style.display = "block";
                span1.onclick = function() {
                    modal1.style.display = "none";
                }
                document.getElementById('edit_prodId').value = prodId;
                document.getElementById('edit_category').value = prodCategory;
                document.getElementById('edit_prodName').value = prodName;
                document.getElementById('edit_prodPrice').value = prodPrice;
                document.getElementById('edit_netWeight').value = netWeight;
                
                document.getElementById('edit_prodDesc').value = prodDescription;

                window.onclick = function() {
                    if (event.target == modal1) {
                        modal1.style.display = "none";
                    }
                }
            }
            
        </script>

    </body>
</html>
