<?php
// Include server.php and establish the database connection
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

// Function to generate product cards
function generateProductCards($products) {
    $extension = "../admin/menu/";

    while ($row = $products->fetch_assoc()) {
        $id = $row['prodId'];
        $image = $row['productImg'];
        $name = $row['prodName'];
        $price = $row['prodPrice'];
        $description = $row['prodDescription'];
        $category = $row['prodCategory'];
        ?>
        <div class="detail-card">
            <img class="detail-img" src="<?php echo $extension, $image; ?>">
            <div class="detail-desc">
                <h4 class="d-name"><?php echo $name; ?> </h4>
                <p class="d-desc"><?php echo $description; ?></p>
                <div class="detail-price">
                    <p class="price">Php <?php echo $price; ?></p>
                </div>
                <img class="addtoc add-to-cart" src="../files/icons/add2.png" data-id="<?php echo $row["prodId"]; ?>" data-name="<?php echo $row["prodName"]; ?>" data-price="<?php echo $row["prodPrice"]; ?>">
            </div>
        </div>
    <?php
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../files/assets/bootstrap/js/jquery-3.5.1.slim.min.js"></script>
    <script src="../files/assets/bootstrap/js/bootstrap/4.5.2.min.js"></script>
    <script src="../files/assets/bootstrap/js/popper.min.js"></script>
    <script src="app.js"></script>    
    <link rel="stylesheet" href="OrderPage.css">
    
    <title>ORDERING PAGE</title>
    <link rel="icon" type="image/x-icon" href="tdf.png">

</head>
<body>
    <!-- Your HTML body content here -->
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
                <img class="cart" src="../files/icons/shopping-cart.png" alt=""  data-toggle="modal" data-target="#cart" >
                <span class="show-cart total-count" ></span>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="cart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Cart</h5>
                        </div>
                        <div class="modal-body">
                            <table class="show-cart table"></table>
                            <div>Total price: ₱<span class="total-cart"></span></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Order now</button>
                        </div>
                    </div>
                </div>
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
            
    <div class="main-menu">
        <!-- Other HTML elements and structure -->
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

        <!-- Top-Selling Products -->
        <div class="main-detail">
            <h2 id="TopSelling" class="main-title">Top-Selling Products</h2>
            <div class="detail-wrapper">
                <?php generateProductCards($all_product); ?>
            </div>
        </div>

        <!-- Heritage -->
        <div class="main-detail">
            <h2 id="Heritage" class="main-title">Heritage</h2>
            <div class="detail-wrapper">
                <?php generateProductCards($her); ?>
            </div>
        </div>

        <!-- Specialties -->
        <div class="main-detail">
            <h2 id="Specialties" class="main-title">Specialties</h2>
            <div class="detail-wrapper">
                <?php generateProductCards($spe); ?>
            </div>
        </div>

        <!-- Pasta -->
        <div class="main-detail">
            <h2 id="Pasta" class="main-title">Pasta</h2>
            <div class="detail-wrapper">
                <?php generateProductCards($pas); ?>
            </div>
        </div>

        <!-- Sweets -->
        <div class="main-detail">
            <h2 id="Sweets" class="main-title">Sweets</h2>
            <div class="detail-wrapper">
                <?php generateProductCards($swe); ?>
            </div>
        </div>

        <!-- Beverages -->
        <div class="main-detail">
            <h2 id="Beverages" class="main-title">Beverages</h2>
            <div class="detail-wrapper">
                <?php generateProductCards($bev); ?>
            </div>
        </div>
    </div>

<script>
    // Shopping Cart JavaScript code
    var shoppingCart = (function() {
        // Private methods and properties
        var cart = [];

        function Item(name, price, count) {
            this.name = name;
            this.price = price;
            this.count = count;
        }

        function saveCart() {
            sessionStorage.setItem('shoppingCart', JSON.stringify(cart));
        }

        function loadCart() {
            cart = JSON.parse(sessionStorage.getItem('shoppingCart')) || [];
        }

        if (sessionStorage.getItem("shoppingCart") != null) {
            loadCart();
        }

        // Public methods and properties
        var obj = {};

        obj.addItemToCart = function(name, price, count) {
            for (var item in cart) {
                if (cart[item].name === name) {
                    cart[item].count++;
                    saveCart();
                    return;
                }
            }
            var item = new Item(name, price, count);
            cart.push(item);
            saveCart();
        };

        obj.setCountForItem = function(name, count) {
            for (var i in cart) {
                if (cart[i].name === name) {
                    cart[i].count = count;
                    break;
                }
            }
        };

        obj.removeItemFromCart = function(name) {
            for (var item in cart) {
                if (cart[item].name === name) {
                    cart[item].count--;
                    if (cart[item].count === 0) {
                        cart.splice(item, 1);
                    }
                    break;
                }
            }
            saveCart();
        };

        obj.removeItemFromCartAll = function(name) {
            for (var item in cart) {
                if (cart[item].name === name) {
                    cart.splice(item, 1);
                    break;
                }
            }
            saveCart();
        };

        obj.clearCart = function() {
            cart = [];
            saveCart();
        };

        obj.totalCount = function() {
            var totalCount = 0;
            for (var item in cart) {
                totalCount += cart[item].count;
            }
            return totalCount;
        };

        obj.totalCart = function() {
            var totalCart = 0;
            for (var item in cart) {
                totalCart += cart[item].price * cart[item].count;
            }
            return Number(totalCart.toFixed(2));
        };

        obj.listCart = function() {
            var cartCopy = [];
            for (var i in cart) {
                var item = cart[i];
                var itemCopy = {};
                for (var p in item) {
                    itemCopy[p] = item[p];
                }
                itemCopy.total = Number(item.price * item.count).toFixed(2);
                cartCopy.push(itemCopy);
            }
            return cartCopy;
        };

        return obj;
    })();

    // Event handling
    $('.add-to-cart').click(function(event) {
        event.preventDefault();
        var name = $(this).data('name');
        var price = Number($(this).data('price'));
        shoppingCart.addItemToCart(name, price, 1);
        displayCart();
    });

    $('.clear-cart').click(function() {
        shoppingCart.clearCart();
        displayCart();
    });

    // Rest of your event handlers here

    function displayCart() {
            var cartArray = shoppingCart.listCart();
            var output = "";
            for (var i in cartArray) {
                output += "<tr>"
                    + "<td>" + cartArray[i].name + "</td>"
                    + "<td>(" + cartArray[i].price + ")</td>"
                    + "<td><div class='input-group'><button class='minus-item input-group-addon btn btn-primary' data-name='" + cartArray[i].name + "'>-</button>"
                    + "<input type='number' class='item-count form-control' data-name='" + cartArray[i].name + "' value='" + cartArray[i].count + "'>"
                    + "<button class='plus-item btn btn-primary input-group-addon' data-name='" + cartArray[i].name + "'>+</button></div></td>"
                    + "<td><button class='delete-item btn btn-danger' data-name='" + cartArray[i].name + "'>X</button></td>"
                    + " = "
                    + "<td>" + cartArray[i].total + "</td>"
                    + "</tr>";
            }
            $('.show-cart').html(output);
            $('.total-cart').html(shoppingCart.totalCart());
            $('.total-count').html(shoppingCart.totalCount());
        }


    // Rest of your JavaScript code

</script>


</body> 
</html>
