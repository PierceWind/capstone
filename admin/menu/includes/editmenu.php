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

include('../server.php'); // Include your database connection

// Initialize variables to store form data
$prodId = "";
$prodName = "";
$prodCategory = "";
$minReq = ""; 
$netWeight = "";
$prodPrice = "";
$prodDesc = "";
$prodImgName = "";
$prodImgSize = "";
$prodImgPath = "";
$prodImgExtension = "";
$errors = array();

include('../server.php');
// Function to handle image upload
function uploadImage1()
{
    global $conn;
    global $prodId;
    $imageProcess = 0;

    if (is_array($_FILES)) {
        $fileName = $_FILES['prod_img']['tmp_name'];
        $sourceProperties = getimagesize($fileName);
        $resizeFileName = time();
        $uploadPath = 'C:/xampp/htdocs/capstone/admin/menu/includes/uploads/';
        $path= "includes/uploads/"; 
        $fileExt = pathinfo($_FILES['prod_img']['name'], PATHINFO_EXTENSION);
        $uploadImageType = $sourceProperties[2];
        $sourceImageWidth = $sourceProperties[0];
        $sourceImageHeight = $sourceProperties[1];
        switch ($uploadImageType) {
            case IMAGETYPE_JPEG:
                $resourceType = imagecreatefromjpeg($fileName);
                $imageLayer = resizeImage1($resourceType, $sourceImageWidth, $sourceImageHeight);
                imagejpeg($imageLayer, $uploadPath . $resizeFileName . '.' . $fileExt);
                break;

            case IMAGETYPE_PNG:
                $resourceType = imagecreatefrompng($fileName);
                $imageLayer = resizeImage1($resourceType, $sourceImageWidth, $sourceImageHeight);
                imagepng($imageLayer, $uploadPath . $resizeFileName . '.' . $fileExt);
                break;

            default:
                $imageProcess = 0;
                break;
        }
        $imageProcess = 1;
        $file_name = ($path . $resizeFileName . "." . $fileExt);
    }
    
    if ($imageProcess == 1) {
        $insert = $conn->query("UPDATE prodimage 
                            SET productId = '$prodId', 
                                productImg = '$file_name', 
                                dateModified = NOW() 
                            WHERE productId = '$prodId'");
        if ($insert) {
            $done = move_uploaded_file($fileName, $uploadPath . $resizeFileName . "." . $fileExt);
            if ($done) {
                return "success"; // Return "success" when the image upload is successful
            }
        }
    } else {
        return "Image upload failed"; // Return an error message when the image upload fails
    }
    
    return "Image upload failed"; // Return an error message if the code reaches this point
}

if (isset($_POST['edit_prod'])) {
    // Get form data
    $prodId = mysqli_real_escape_string($conn, $_POST['prod_id']);
    $prodName = mysqli_real_escape_string($conn, $_POST['prod_name']);
    $prodCategory = mysqli_real_escape_string($conn, $_POST['category']);
    $minReq = mysqli_real_escape_string($conn, $_POST['min_req']);
    $netWeight = mysqli_real_escape_string($conn, $_POST['netWeight']);
    $prodPrice = mysqli_real_escape_string($conn, $_POST['prod_price']);
    $prodDesc = mysqli_real_escape_string($conn, $_POST['prod_desc']);
    $productImg = mysqli_real_escape_string($conn, $_POST['prod_img']);

    // Upload image and check if successful
    $uploadResult = uploadImage1();

    if ($uploadResult) {
        // Update data in the database
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
            echo '<script>window.location.href="index.php";</script>'; // Reload index page
        } else {
            echo '<script>alert("Failed to add product to the database: ' . mysqli_error($conn) . '");</script>';
        }
    } else {
        echo '<script>alert("' . $uploadResult . '");</script>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Product</title>
        <link rel="stylesheet" type="text/css" href="../../style.css">
    </head>
    <body>
        <div id="editMenuModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <br>    
                <div class="sec1">
                <form method="post" id="menu" class="input-group" enctype="multipart/form-data"  action="">
                        <div class = "group">
                            <div class = "card"> 
                                <label for="empid">Product Number</label> <br>
                                <input type="text" id="edit_prodId" name="prod_id" placeholder="Product ID" value="" required><br>
                            </div>
                            <div class = "card"> 
                                <label for="category">Category</label><br>
                                <select id="edit_category" name="category">
                                    <option value="Heritage">Heritage</option>
                                    <option value="Specialties">Specialties</option>
                                    <option value="Pasta">Pasta</option>
                                    <option value="Salad">Salad</option>
                                    <option value="Sweets">Sweets</option>
                                    <option value="Drinks">Drinks</option>
                                </select> <br>
                            </div>
                            <div class = "card"> 
                                <label for="minreq">Min Requirements</label> <br>
                                <input type="number" id="edit_minReq" name="min_req" placeholder="" value="" min=2 max=20 required><br>
                            </div>
                        </div>
                        <div class = "group"> 
                            <div class = "card">
                            <label for="prodname">Product Name</label><br>
                                <input type="text" id="edit_prodName" name="prod_name" placeholder="" value="" required>
                            </div>  
                            <div class = "card">
                                <label for="netWeight">Net Weight (grams)</label><br>
                                <input type="number" id="edit_netWeight" name="netWeight" placeholder="" value="" min=80 max=5000 required>
                            </div> 
                            <div class = "card">
                                <label for="prodprice">Price (₱)</label><br>
                                <input type="number" step="0.01" id="edit_prodPrice" name="prod_price" placeholder="" value="" min=30 max=10000  required>
                            </div> 
                        </div>
                        <div class = "card">
                            <label for="empname">Product Description</label><br>
                            <input type="text" id="edit_prodDesc" name="prod_desc" placeholder="" value="" required>
                        </div> 
                        <div class = "card"> 
                                <label for="prodImg">Image</label><br> 
                                <input id="edit_prodImg" class="input-group" name="prod_img" type="file" value="" required><br> <br>
                        </div>
                        <br><br>
                        <button style="color:white; background-color:#7002022;" type="submit" class="submit-btn" name="edit_prod" >Submit</button>
                    </form> 
                    <?php 
                        function resizeImage1($resourceType, $image_width, $image_height) {
                            $resizeWidth = 700;
                            $resizeHeight = 500;
                            $imageLayer = imagecreatetruecolor($resizeWidth, $resizeHeight);
                            imagecopyresampled($imageLayer, $resourceType, 0,0,0,0, $resizeWidth, $resizeHeight, $image_width, $image_height);
                            return $imageLayer;
                        }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>