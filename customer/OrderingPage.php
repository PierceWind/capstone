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
                <img  class="go-back-button" src="../files/icons/arrow.png" alt=""> 
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

            <!--not sure if ilalagay or papalitan pa
            < h5 class="text-info">Quantity: <input type="number" min="1" max="25" name="quantity" 
            class="form-control" value="1" > </h5>-->
            </div>
            <div class="list">
                <!--added to cart orders -->
            </div>
            
            <!--CARD FOR PRODUCT ADDED TO CART-->
            <div class="card">
                <h1>List of Orders</h1>
                <ul class="listCard">
                </ul>
                <div class="checkOut">
                    <div class="total">0</div>
                    <div class="closeShopping">Close</div>
                </div>
            </div>
        </div>

        <!-- menu recommendation-->
        <div class="main-highlight">

            <div class="main-header">
                <h2 class="main-title">Best Seller</h2>
                <div class="main-arrow">
                <i class='fas fa-chevron-left'></i>
                <i class='fas fa-chevron-right'> </i>
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
                        <ion-icon class="back-menu" name="chevron-back-circle-outline"></ion-icon>
                        <ion-icon class="next-menu" name="chevron-forward-circle-outline"></ion-icon>
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
                <!--PHP CODE HERE-->
                <!--list of food section-->
                <div class="main-detail">
                    <!--NEW ADDED CODE FOR DISPLAYING THE MENU ITEM-->
                    <?php 
                        $result = $food->itemsList();
                        $count=0;
                        while ($item = $result->fetch_assoc()) { 
                            if ($count == 0) {
                                echo "<div class='main-detail'>";
                        }
                    }
                    ?>
                    <h2 class="main-title">Choose Order</h2>
                    <div class="detail-wrapper">
                        <div class="detail-card">
                            <form method="post" action="cart.php?action=add&id=<?php echo $item["id"]; ?>">
                                    <img class="detail-img" src="images/<?php echo $item["images"]; ?>">
                                    <div class="detail-desc">
                                        <div class="detail-name">
                                        <h4><?php echo $item["name"]; ?></h4>
                                        <p><?php echo $item["description"]; ?></p>
                                        <p class="price"><span></span><?php echo $item["price"]; ?>/-</p>
                                        </div>
                                    </div>
                                    <input type="submit" name="add" style="margin-top:5px;" class="btn btn-success" value="Add to Cart">
                            </form>
			            </div>
                        <div class="detail-card">
                            <img class="detail-img" src="assets/images/dish/dish1.jpg" alt="" class="detail-img">
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
        </div>
    </div>   
    
</body>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="app.js"></script>
</html>
