<?php
sleep(1); // Sleep function might not be necessary, but I've left it as is

if (!isset($_SESSION['acc_name'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../login/log.php');
}

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['acc_name']);
    header('location: ../login/log.php');
}

include('../server.php'); // database connection

//init
$prodId = "";
$prodName = "";
$Quantity = ""; 
$prodPrice = "";
$errors = array();

if (isset($_POST['edit_order'])) {
    // Get form data
    $prodId = mysqli_real_escape_string($conn, $_POST['prod_id']);
    $prodName = mysqli_real_escape_string($conn, $_POST['prod_name']);
    $prodCategory = mysqli_real_escape_string($conn, $_POST['quantity']);
    $prodPrice = mysqli_real_escape_string($conn, $_POST['prod_price']);

        $query = "UPDATE product 
        SET prodDescription = '$prodDesc', 
            prodName = '$prodName', 
            netWeight = '$netWeight', 
            minReq = '$minReq',
            prodPrice = '$prodPrice', 
            prodCategory = '$prodCategory', 
            dateCreated = NOW()
        WHERE prodId = '$prodId'";
        $query_run = mysqli_query($conn, $query);

        
        if ($query_run) {
            echo '<script>alert("Product updated successfully");</script>';
        } else {
            echo '<script>alert("Failed to add product to the database: ' . mysqli_error($conn) . '");</script>';
        }
    } else {
        echo '<script>alert("' . $uploadResult . '");</script>';
    }


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Add User</title>
        <link rel="stylesheet" type="text/css" href="../../style.css">
    </head>
    <body>
    <div id="editOrderModal" class="modal">
            <div class="modal-content" style="display: flex; justify-content: space-between; align-items: center;">
                <span class="close" style="margin-left: 90%;">&times;</span>
                <br>    
                <div class="sec1">
                    <form method="post" id="users" class="input-group" enctype="multipart/form-data" action="">
                        <label for="discPercent">Description : </label> <br>
                                <?php echo $prodName; ?>
                        <label for="discType">Discount Type</label><br>

                        <select name="discType">
                            <option value="frequent">Frequent Customer</option>
                            <option value="pwd">PWD</option>
                            <option value="senior">Senior</option>
                        </select> <br>

                        <label for="discPercent">Discount Percentage</label> <br>
                            <input type="number" id="discPercent" name="discPercent" placeholder="20" value="0" min=1 max=90 required> <br>
                        <label for="customerID">Customer ID Number</label><br>
                            <input type="number" id="" name="customerID" placeholder="Just place 1 for a regular customer" required><br><br><br>

                        <div class="footer">
                            <button type="button" class="submit-btn" id="applyBtn">Apply Discount</button>
                        </div>
                    </form> 
                </div>
            </div>
        </div>
    </body>
</html>