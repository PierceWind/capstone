<?php
        include_once 'server.php';
        
        $sql = 'SELECT DISTINCT product.prodId, product.prodName, product.prodPrice, product.prodDescription, product.prodCategory, prodimage.productImg 
        FROM product 
        LEFT JOIN prodimage ON product.prodId = prodimage.productId
        LEFT JOIN inventory ON inventory.prodCode = product.prodId
        LEFT JOIN sales ON sales.code = product.prodId LIMIT 8';
        $all_product = $conn->query($sql);

        $heritage = 'SELECT DISTINCT product.prodId, product.prodName, product.prodPrice, product.prodDescription, product.prodCategory, prodimage.productImg 
        FROM product 
        LEFT JOIN prodimage ON product.prodId = prodimage.productId
        WHERE product.prodCategory = "Heritage"' ;
        $her = $conn->query($heritage);


        $specialties = 'SELECT DISTINCT product.prodId, product.prodName, product.prodPrice, product.prodDescription, product.prodCategory, prodimage.productImg 
        FROM product 
        LEFT JOIN prodimage ON product.prodId = prodimage.productId
        WHERE product.prodCategory = "Specialties"' ;
        $spe = $conn->query($specialties);

        $pasta = 'SELECT DISTINCT product.prodId, product.prodName, product.prodPrice, product.prodDescription, product.prodCategory, prodimage.productImg 
        FROM product 
        LEFT JOIN prodimage ON product.prodId = prodimage.productId
        WHERE product.prodCategory = "Pasta"' ;
        $pas = $conn->query($pasta);

        $sweets = 'SELECT DISTINCT product.prodId, product.prodName, product.prodPrice, product.prodDescription, product.prodCategory, prodimage.productImg 
        FROM product 
        LEFT JOIN prodimage ON product.prodId = prodimage.productId
        WHERE product.prodCategory = "Sweets"' ;
        $swe = $conn->query($sweets);

        $beverages = 'SELECT DISTINCT product.prodId, product.prodName, product.prodPrice, product.prodDescription, product.prodCategory, prodimage.productImg 
        FROM product 
        LEFT JOIN prodimage ON product.prodId = prodimage.productId
        WHERE product.prodCategory = "Beverages"' ;
        $bev = $conn->query($beverages);

        $sql_cart = 'SELECT order_items.ProductID, order_items.orderID, order_items.OrderItemID, order_items.Quantity, order_items.subtotal, product.prodName, product.prodPrice, product.prodDescription, product.prodCategory
        FROM order_items
        LEFT JOIN product ON order_items.ProductID = product.prodId';
        
        $order_items = $conn->query($sql_cart);
        
        
    
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
                    <a href="cart.php"><img  class="cart"  src="../files/icons/shopping-cart.png" alt=""> </a>
                    <span id="quantity"><?php echo mysqli_num_rows($order_items);?></span>
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
                            <a button class="category" href="#TopSelling">Top-Selling</a>
                        </div>
                        <div class="filter-card">
                            <a button class="category" href="#Heritage">Heritage</p>
                        </div>
                        <div class="filter-card">
                            <a button class="category" href="#Specialties">Specialties</p>
                        </div>
                        <div class="filter-card">
                            <a button class="category" href="#Pasta">Pasta</p>
                        </div>
                        <div class="filter-card">
                            <a button class="category" href="#Sweets">Sweets</p>
                        </div>
                        <div class="filter-card">
                            <a button class="category" href="#Beverages">Beverages</p>
                        </div>
                    </div>

                    <hr class="divider">
                    <div class="list-header">
                        <!--list of food section-->
                        <div class="main-detail"> 
                            <div> 
                                <!--NEW ADDED CODE FOR DISPLAYING THE MENU ITEM-->
                                <h2 id="TopSelling" class="main-title">Top- Selling Products</h2>
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
                                        <img class="addtoc" title="Add to cart" src="../files/icons/add2.png" data-id="<?php echo $row["prodId"]; ?>"> <!--col. name from product TB-->
                                    </div>
                                </div>
                                <?php
                                    }
                                ?>
                            </div> <br><br><hr><br>
                            <div>                                 
                                <h2 id="Heritage" class="main-title">Heritage</h2>
                                <div class="detail-wrapper">
                                <?php
                                    while($row1 = $her->fetch_assoc()) {
                                        $id = $row1['prodId'];
                                        $image = $row1['productImg'];
                                        $name = $row1['prodName'];
                                        $price = $row1['prodPrice'];
                                        $description = $row1['prodDescription'];
                                        $category = $row1['prodCategory'];
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
                                        <img class="addtoc" title="Add to cart" src="../files/icons/add2.png" data-id="<?php echo $row["prodId"]; ?>"> <!--col. name from product TB-->
                                    </div>
                                </div>
                                <?php
                                    }
                                ?>
                            </div> <br><br><hr><br>
                            <div>                                 
                                <h2 id="Specialties" class="main-title">Specialties</h2>
                                <div class="detail-wrapper">
                                <?php
                                    while($row2 = $spe->fetch_assoc()) {
                                        $id = $row2['prodId'];
                                        $image = $row2['productImg'];
                                        $name = $row2['prodName'];
                                        $price = $row2['prodPrice'];
                                        $description = $row2['prodDescription'];
                                        $category = $row2['prodCategory'];
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
                                        <img class="addtoc" title="Add to cart" src="../files/icons/add2.png" data-id="<?php echo $row["prodId"]; ?>"> <!--col. name from product TB-->
                                    </div>
                                </div>
                                <?php
                                    }
                                ?>
                            </div> <br><br><hr><br>
                            <div>                                 
                                <h2 id="Heritage" class="main-title">Pasta</h2>
                                <div class="detail-wrapper">
                                <?php
                                    while($row3 = $pas->fetch_assoc()) {
                                        $id = $row3['prodId'];
                                        $image = $row3['productImg'];
                                        $name = $row3['prodName'];
                                        $price = $row3['prodPrice'];
                                        $description = $row3['prodDescription'];
                                        $category = $row3['prodCategory'];
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
                                        <img class="addtoc" title="Add to cart" src="../files/icons/add2.png" data-id="<?php echo $row["prodId"]; ?>"> <!--col. name from product TB-->
                                    </div>
                                </div>
                                <?php
                                    }
                                ?>
                            </div> <br><br><hr><br>
                            <div>                                 
                                <h2 id="Sweets" class="main-title">Sweets</h2>
                                <div class="detail-wrapper">
                                <?php
                                    while($row4 = $swe->fetch_assoc()) {
                                        $id = $row4['prodId'];
                                        $image = $row4['productImg'];
                                        $name = $row4['prodName'];
                                        $price = $row4['prodPrice'];
                                        $description = $row4['prodDescription'];
                                        $category = $row4['prodCategory'];
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
                                        <img class="addtoc" title="Add to cart" src="../files/icons/add2.png" data-id="<?php echo $row["prodId"]; ?>"> <!--col. name from product TB-->
                                    </div>
                                </div>
                                <?php
                                    }
                                ?>
                            </div> <br><br><hr><br>
                            <div>                                 
                                <h2 id="Beverages" class="main-title">Beverages</h2>
                                <div class="detail-wrapper">
                                <?php
                                    while($row5 = $her->fetch_assoc()) {
                                        $id = $row5['prodId'];
                                        $image = $row5['productImg'];
                                        $name = $row5['prodName'];
                                        $price = $row5['prodPrice'];
                                        $description = $row5['prodDescription'];
                                        $category = $row5['prodCategory'];
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
                                        <img class="addtoc" title="Add to cart" src="../files/icons/add2.png" data-id="<?php echo $row["prodId"]; ?>"> <!--col. name from product TB-->
                                    </div>
                                </div>
                                <?php
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>               
            </div>
            
        </div>  <!--end of div main--> 
        <script>
        var prodId= document.getElementsByClassName("addtoc");

        for (var i = 0; i < prodId.length; i++) {
            prodId[i].addEventListener("click", function(event) {
                var target = event.target;
                var id = target.getAttribute("data-id");
                var xml = new XMLHttpRequest();

                xml.onreadystatechange = function() {
                    if (xml.readyState == 4 && xml.status == 200) {
                        var data = JSON.parse(xml.responseText);
                        target.innerHTML = data.in_cart;
                        document.getElementById("quantity").innerHTML = data.num_cart + 1; 
                    }
                };
                xml.open("GET", "server.php?id=" + id, true);
                xml.send(); 
                
            })  
        }
        <?php
        if (isset($_GET["id"])) {
            // Sanitize and validate the input
            $prodId = filter_var($_GET["id"], FILTER_VALIDATE_INT);
        
            if ($prodId !== false) {
                $in_cart = "added into cart"; // Initialize in_cart variable
        
                // Use a prepared statement to safely query the database
                $sql_cart = "SELECT ProductID, orderID, OrderItemID, Quantity, subtotal FROM order_items WHERE ProductID = ?";
                $stmt = $conn->prepare($sql_cart);
                $stmt->bind_param("i", $prodId);
                $stmt->execute();
                $result = $stmt->get_result();
        
                $totalCart = "SELECT ProductID, orderID, OrderItemID, Quantity, subtotal FROM order_items";
                $totalCart_Result = $conn->query($totalCart);
                $cartNum = mysqli_num_rows($totalCart_Result);
        
                if ($result->num_rows > 0) {
                    $in_cart = "already in cart";
                } else {
                    // Use a prepared statement to safely insert data
                    $insert = "INSERT INTO order_items (ProductID) VALUES (?)";
                    $stmt = $conn->prepare($insert);
                    $stmt->bind_param("i", $prodId);
                    
                    if ($stmt->execute()) {
                        $in_cart = "added into cart";
                    } else {
                        $in_cart = "not added";
                    }
                }
        
                // Close the prepared statements and the database connection
                $stmt->close();
                $conn->close();
        
                // Return the response as JSON
                echo json_encode(["num_cart" => $cartNum, "in_cart" => $in_cart]);
            } else {
                // Invalid input, handle the error
                echo json_encode(["error" => "Invalid input"]);
            }
        }
        ?>
    </script>
        
    </body> 
        <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
        <script src="app.js"></script>
        
        
    </html>