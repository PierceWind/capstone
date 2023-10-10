<?php
    require_once '../admin/server.php';
    
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="OrderPage.css">
    
    <title>ORDERING PAGE</title>
    <link rel="icon" type="image/x-icon" href="tdf.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/lib/font-awesome/5.15.3/css/all.min.css">
</head>

<body >
    <!-- Main-->
    <div class="main">
        <!--Main navigation-->
        <div class="main-navbar">
            <a href="dashboard.html" >
                <img  class="go-back-button" src="../files/icons/backIcon.png" alt=""> 
            </a>
            <!--search bar--> 
            <div class="search">
                <input type="text" placeholder="What are you looking for?">
                <button class="search-btn">Search</button>
            </div>
            <!-- icon on the upper right side of navbar-->
            <div class="shopping">
                <a href="#" ><img  class="cart"  src="../files/icons/shopping-cart.png" alt=""> </a>
                <span class="quantity">0</span>
            </div>
        </div>
        <!-- menu recommendation-->
        <div class="main-highlight">
            <div class="main-header">
                <h2 class="main-title">Best Seller</h2>
                <div class="main-arrow">
                <img  class=" back"  src="../files/icons/previous.png" alt="">
                <img  class=" next"  src="../files/icons/next.png" alt="">
                </div>
            </div>
            <div class="highlight-wrapper">
                <div class="highlight-card">
                    <!-- TO BE RECODE INTO PHP LANG.-->
                    <img class="highlight-img" src="assets/images/menu-1.png" alt="">                     
                    <div class="highlight-desc">
                        <h4>MENU 1</h4>
                        <p>1000.00</p>
                    </div>  
                </div>
                <div class="highlight-card">
                    <!-- TO BE RECODE INTO PHP LANG.-->
                    <img class="highlight-img" src="assets/images/menu-2.png" alt="">                     
                    <div class="highlight-desc">
                        <h4>MENU 1</h4>
                        <p>1000.00</p>
                    </div>  
                </div>
                <div class="highlight-card">
                    <!-- TO BE RECODE INTO PHP LANG.-->
                    <img class="highlight-img" src="assets/images/menu-3.png" alt="">                     
                    <div class="highlight-desc">
                        <h4>MENU 1</h4>
                        <p>1000.00</p>
                    </div>  
                </div>
                <div class="highlight-card">
                    <!-- TO BE RECODE INTO PHP LANG.-->
                    <img class="highlight-img" src="assets/images/menu-4.png" alt="">                     
                    <div class="highlight-desc">
                        <h4>MENU 1</h4>
                        <p>1000.00</p>
                    </div>  
                </div>
                <div class="highlight-card">

                    <!-- TO BE RECODE INTO PHP LANG.-->
                    <img class="highlight-img" src="assets/images/menu-3.png" alt="">                     
                    <div class="highlight-desc">
                        <h4>MENU 1</h4>
                        <p>1000.00</p>
                    </div>  
                </div>
                <div class="highlight-card">
                    <!-- TO BE RECODE INTO PHP LANG.-->
                    <img class="highlight-img" src="assets/images/menu-4.png" alt="">                     
                    <div class="highlight-desc">
                        <h4>MENU 1</h4>
                        <p>1000.00</p>
                    </div>  
                </div>
            </div>
           
            <!--MAIN MENU/ORDER-->
            <div class="main-menu">
                <div class="filter-header">
                    <h2 class="filter-title">Food category</h2>
                    <div class="filter-arrow"> 
                        <img  class="back-menu"  src="../files/icons/previous.png" alt="">
                        <img  class="next-menu"  src="../files/icons/next.png" alt="">
                    </div>
                </div>
                <div class="filter-wrapper">
                    <div class="filter-card">
                        <p class="category">All Menu</p>
                    </div>
                    <div class="filter-card">
                        <p class="category">Heritage</p>
                    </div>
                    <div class="filter-card">
                        <p class="category">Pasta</p>
                    </div>
                    <div class="filter-card">
                        <p class="category">Sweets</p>
                    </div>
                    <div class="filter-card">
                        <p class="category">Sweets</p>
                    </div>
                    <div class="filter-card">
                        <p class="category">Sweets</p>
                    </div>
                    <div class="filter-card">
                        <p class="category">Sweets</p>
                    </div>
                </div>

                <hr class="divider">
                <div class="list-header">
                <!--list of food section-->
                <div class="main-detail">
                    <!--NEW ADDED CODE FOR DISPLAYING THE MENU ITEM-->
                    <h2 class="main-title">Choose Order</h2>
                    <div class="detail-wrapper">
                    <?php
                        while($row = $all_product->fetch_assoc()) {
                            $id = $row['prodId'];
                            $image = $row['productImg'];
                            $name = $row['prodName'];
                            $price = $row['prodPrice'];
                            $description = $row['prodDescription'];
                            $category = $row['prodCategory'];
                            $extension = "../admin/menu/";
                    ?>
                        <div class="detail-card">
                            <img class="detail-img" src="<?php echo $extension, $image; ?>" >
                            <div class="detail-desc">
                                <h4 class="d-name"><?php echo $name; ?> </h4> 
                                <p class="d-desc"><?php echo $description;?></p>
                                <div class="detail-price">
                                    <p class="price">Php <?php echo $price;?></p>
                                </div>
                                <a href="order.php?id=<?php echo $id;?>">
                                    <img class="addtoc"src="../files/icons/shopping-cart.png" title="Add to cart">
                                </a>
                            </div>
                        </div>
                        <?php
                             }
                        ?>
                    </div>
                </div>
            </div>               
        </div>
        
    </div>  <!--end of div main--> 
    
</body>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="app.js"></script>
    
</html>