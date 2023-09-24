<?php
// Initialize variables to store form data
$prodId = "";
$prodName = "";
$prodCategory = "";
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
function uploadImage()
{
    global $conn; // Access the database connection object within the function
    global $prodId; // Access the product ID within the function

    $imageProcess = 0;
    if (is_array($_FILES)) {
        $fileName = $_FILES['prod_img']['tmp_name'];
        $sourceProperties = getimagesize($fileName);
        $resizeFileName = time();
        $uploadPath = 'C:/xampp/htdocs/capstone/admin/menu/includes/uploads/';
        $fileExt = pathinfo($_FILES['prod_img']['name'], PATHINFO_EXTENSION);
        $uploadImageType = $sourceProperties[2];
        $sourceImageWidth = $sourceProperties[0];
        $sourceImageHeight = $sourceProperties[1];
        switch ($uploadImageType) {
            case IMAGETYPE_JPEG:
                $resourceType = imagecreatefromjpeg($fileName);
                $imageLayer = resizeImage($resourceType, $sourceImageWidth, $sourceImageHeight);
                imagejpeg($imageLayer, $uploadPath . $resizeFileName . '.' . $fileExt);
                break;

            case IMAGETYPE_PNG:
                $resourceType = imagecreatefrompng($fileName);
                $imageLayer = resizeImage($resourceType, $sourceImageWidth, $sourceImageHeight);
                imagepng($imageLayer, $uploadPath . $resizeFileName . '.' . $fileExt);
                break;

            default:
                $imageProcess = 0;
                break;
        }
        $imageProcess = 1;
        $file_name = ($uploadPath . $resizeFileName . "." . $fileExt);
    }
    
    if ($imageProcess == 1) {
        $insert = $conn->query("INSERT into prodimage (productId, productImg, dateCreated) VALUES ('$prodId', '$file_name', NOW())");
        if ($insert) {
            $done = move_uploaded_file($fileName, $uploadPath . $resizeFileName . "." . $fileExt);
            if ($done) {
                ?>
                <script>
                    alert("Image has been successfully resized and uploaded");
                </script>
                <?php
            }
        }
    } else {
        ?>
        <script>
            alert("Invalid Image");
        </script>
        <?php
    }
    $imageProcess = 0;
}

if (isset($_POST['add_prod'])) {
    // Include the server.php file for database connection

    // Get form data
    $prodId = mysqli_real_escape_string($conn, $_POST['prod_id']);
    $prodName = mysqli_real_escape_string($conn, $_POST['prod_name']);
    $prodCategory = mysqli_real_escape_string($conn, $_POST['category']);
    $netWeight = mysqli_real_escape_string($conn, $_POST['netWeight']);
    $prodPrice = mysqli_real_escape_string($conn, $_POST['prod_price']);
    $prodDesc = mysqli_real_escape_string($conn, $_POST['prod_desc']);

    // Upload image and check if successful
    $uploadResult = uploadImage();

    if ($uploadResult === "success") {
        // Insert data into the database
        $query = "INSERT INTO product (prodId, prodImg, prodDescription, prodName, netWeight, prodPrice, prodCategory, dateCreated)
                  VALUES ('$prodId', '$file_name', '$prodDesc', '$prodName', '$netWeight', '$prodPrice', '$prodCategory', NOW())";
        $query_run = mysqli_query($conn, $query);

        if ($query_run) {
            echo '<script>alert("Product added successfully");</script>';
            // You can redirect the user or perform additional actions here
        } else {
            echo '<script>alert("Failed to add product to the database.");</script>';
        }
    } else {
        echo '<script>alert("' . $uploadResult . '");</script>';
    }
}
?>
