<?php
include '../admin/server.php';

$sql = 'SELECT product.prodId, product.prodName, product.prodPrice, product.prodDescription, product.prodCategory, prodimage.productImg 
FROM product 
LEFT JOIN prodimage 
ON product.prodId = prodimage.productId
LEFT JOIN inventory 
ON inventory.prodCode = product.prodId
LEFT JOIN sales 
ON sales.code = product.prodId';
$all_product = $conn->query($sql);

?>


<!DOCTYPE html>
<html lang ="en">
<head>
     <meta charset="utf-8" name="homepage" content=width=device-width, initial-scale=1 >
        <link rel="stylesheet" type="text/css" href="style.css" media="screen"/> 
        <link rel="icon" type="image/x-icon" href="../files/icons/tdf.png">
    <div class="topnav" id="myTopnav">
        <img class="logo" src="../files/icons/tdf.png" alt="GroupLogo" href="index.html">
        <h1> To Die For Foods </h1> 
        <a href="index.html">Cart</a>
        <a href="school.html">Contact</a>
        <a href="program.html">Menu</a>
        <a href="blog.html">Home</a>
    </div>
    <script>
        function myFunction() {
            var x = document.getElementById("myTopnav");
                if (x.className === "topnav") {
                    x.className += " responsive";
                } else {
                    x.className = "topnav";
                }
        }
    </script>
</head>   
</head> 
<body>
    <br>
    <div class="banner-text-item">
        <div class="banner-heading">
            <div class="image">
                <img src="../files/icons/tdf.png" alt="TDF LOGO">
            </div>
            <div class = "content"> 
                <br> <br><br> <br>
                <h2>Your Ultimate Cravings Satisfied Exclusively </h2>
                <h1> @TDF FOODS</h1>
                <p> 1159 Zobel Roxas corner Espiritu St. </p>
                <p> Barangay 757, Manila, 1009 Metro Manila </p> 
            </div> 
        </div>
        
    </div>
    <!--search bar-->
    <div class="search">
        <input type="text" placeholder="What are you looking for?">
        <button class="search-btn">Search</button>
    </div>
    <section>
        <hr style="border: 1px solid #700202;">
        <div class="sections">
            <a button class="popularCuisines" href="#popularCuisines"> Popular Cuisines </a>
            <a button class="heritage" href="#heritage"> Heritage </a>
            <a button class="specialties" href="#specialties"> Specialties </a>
            <a button class="pastries" href="#pastries"> Pastries </a>
            <a button class="sweets" href="#sweets"> Sweets </a>
            <a button class="beverages" href="#beverages"> Beverages </a>
        </div>
        <div class="sec1" id="popularCuisines">
        
        

        <div class="row">
            <h2 class="main-title"></h2>
            <?php
            while ($row = $all_product->fetch_assoc()) {
                $id = $row['prodId'];
                $image = $row['productImg'];
                $name = $row['prodName'];
                $price = $row['prodPrice'];
                $description = $row['prodDescription'];
                $category = $row['prodCategory'];
                $extension = "../admin/menu/";
                ?>
                <div class="column">
                    <div class="card">
                        <img class="detail-img" src="<?php echo $extension, $image; ?>">
                        <div class="container">
                            <h4><?php echo $name; ?></h4>
                            <p style="font-size: 12px;"><?php echo $description; ?></p>
                            <p class="price">Php<?php echo $price; ?></p>
                            <p><a href="order.php?id=<?php echo $id; ?>"><button class="button">Add to Cart</button></a></p>
                        </div>
                    </div>
                </div>
            <?php
                }
            ?>
        </div>
        <hr>
    </div>
</section>
<br><br>
<footer>
    <div class="footer">
        <!-- Your footer content here -->
        <br>
    </div>
</footer>
</body>
</html>