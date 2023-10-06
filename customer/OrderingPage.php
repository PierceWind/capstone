<?php
    require_once 'server.php';

    $sql = "SELECT * FROM `product`;";
    $all_product = $conn->query($sql);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="OrderPage.css">
    
    <title>ORDERING PAGE</title>
    <link rel="icon" type="image/x-icon" href="tdf.png">
</head>
<body >
    <!--sidebar-->
    <div class="sidebar">
        <!--logo-->
        <img src="tdf.png" alt="tdf_logo">
        <h1 class="logo">To Die For</h1>

        <!--list of menu-->
        <div class="sidebar-menu">
            <a href="#">Heritage</a>
            <a href="#">Pasta</a>
            <a href="#">Salad</a>
            <a href="#">Sweets</a>
            <a href="#">Drinks</a>
            <a href="#">Specialties</a>
        </div>

        <!--GO BACK BUTTON-->
        <div class="sidebar-GBbutton">
            <a href="#"><ion-icon name="arrow-back-circle-outline"></ion-icon>Go Back</a>
        </div>
    </div>

    <!-- Main-->
    <div class="main">
        <!--Main navigation-->
        <div class="main-navbar">
            <!-- menu appear on mobile ver.-->
            <div class="menu-toggle">
            <ion-icon name="grid-outline"></ion-icon>
            </div>

            <!--search bar-->
            <div class="search">
                <input type="text" placeholder="What are you looking for?">
                <button class="search-btn">Search</button>
            </div>

            <!-- icon on the upper right side of navbar-->
            <div class="icon">
                <a href="#" class="cart"><ion-icon name="cart-outline"></ion-icon></a>
                <a href="#" class="filter"><ion-icon name="filter-outline"></ion-icon></ion-ion></a>

            </div>
        </div>

        <!-- menu recommendation-->
        <div class="main-highlight">

            <div class="main-header">
                <h2 class="main-title">Best Seller</h2>
                <div class="main-arrow">
                    <ion-icon class="back" name="chevron-back-circle-outline"></ion-icon>
                    <ion-icon class="next" name="chevron-forward-circle-outline"></ion-icon>
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
            </div>

            <hr class="divider">
            <!--MAIN MENU/ORDER-->
            <div class="main-menu">
                <!--PHP CODE HERE-->
                <!--list of food section-->
                <div class="main-detail">
                    <h2 class="main-title">Choose Order</h2>
                    <div class="detail-wrapper">
                        <div class="detail-card">
                            <img src="assets/images/dish/dish1.jpg" alt="" class="detail-img">
                            <div class="detail-desc">
                                <div class="detail-name">
                                    <h4>Dish 1</h4>
                                    <p class="price">150 php</p>
                                </div>
                                
                            </div>
                        </div>  
                         <div class="detail-card">
                            <img src="assets/images/dish/dish1.jpg" alt="" class="detail-img">
                            <div class="detail-desc">
                                <div class="detail-name">
                                    <h4>Dish 1</h4>
                                    <p class="price">150 php</p>
                                </div>
                                
                            </div>
                        </div>  
                        <div class="detail-card">
                            <img src="assets/images/dish/dish1.jpg" alt="" class="detail-img">
                            <div class="detail-desc">
                                <div class="detail-name">
                                    <h4>Dish 1</h4>
                                    <p class="price">150 php</p>
                                </div>
                                
                            </div>
                        </div>  
                        <div class="detail-card">
                            <img src="assets/images/dish/dish1.jpg" alt="" class="detail-img">
                            <div class="detail-desc">
                                <div class="detail-name">
                                    <h4>Dish 1</h4>
                                    <p class="price">150 php</p>
                                </div>
                                
                            </div>
                        </div>  
                        <div class="detail-card">
                            <img src="assets/images/dish/dish1.jpg" alt="" class="detail-img">
                            <div class="detail-desc">
                                <div class="detail-name">
                                    <h4>Dish 1</h4>
                                    <p class="price">150 php</p>
                                </div>
                                
                            </div>
                        </div>  
                        <div class="detail-card">
                            <img src="assets/images/dish/dish1.jpg" alt="" class="detail-img">
                            <div class="detail-desc">
                                <div class="detail-name">
                                    <h4>Dish 1</h4>
                                    <p class="price">150 php</p>
                                </div>
                                
                            </div>
                        </div>  

                    </div>
                </div>
            </div> 
            <div class="quantity-cart">
                <h2 class="quantity-title">QUANTITY </h2>
                <div class="quantity-wrapper">
                    <div class= "myform">
                        
                        <ion-icon class="minus" name="remove-circle"></ion-icon>
                        <input type='text' class="value" value='0'>
                        <ion-icon class="add" name="add-circle"></ion-icon>
                        
                    </div>
                
                </div>
                <div class="submit">
                    <button class="submit-btn"> ADD TO CART</button>
                </div>
            </div>     
                
                
        </div>
    </div>    
   
   

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>

<script src="app.js"></script>
 
</body>
</html>

