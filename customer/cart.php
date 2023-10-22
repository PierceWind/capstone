<?php
    // Include the database connection file (server.php)
    require_once 'server.php';
    
    // Retrieve shopping cart items from the database
    $sql_cart = 'SELECT order_items.ProductID, order_items.orderID, order_items.OrderItemID, order_items.Quantity, order_items.Subtotal, product.prodName, product.prodPrice, product.prodDescription, product.prodCategory
    FROM order_items
    LEFT JOIN product ON order_items.ProductID = product.prodId';
    
    $order_items = $conn->query($sql_cart);
    // Function to calculate the cart total
    function getCartTotal() {
        // Implement the logic to calculate the cart total here
        return 0; // Replace with actual logic
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">   
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>CART PAGE</title>
        <link rel="icon" type="image/x-icon" href="tdf.png">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <style>
            /* Add your CSS styles here */
            @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap');
            
            :root{
                --primaryColor: #0e6253;
                --secondaryColor: #700202;
                --whiteColor: #fff;
                --blackColor: #222;
                --softgreenColor: #d9f2ee;
                --darkgreenColor: #a7a7a7;
                --greyColor: #f5f5f5;
            }
            
            *{
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                text-decoration: none;
                font-family: 'Poppins', sans-serif;
            }
            
            html{
                font-size: 62.5%;
            }
            
            .banner-text-item {
                text-align: center;
                justify-content: center;
            }
            
            img{
                justify-content: center;
                align-items: center;
                margin-top: 10px;
                width: 160px;
                height: 100px;
            }

            main{
                max-width: 1500px;
                width: 80%;
                margin: 30px auto;
                display: flex;
                flex-wrap: wrap;
            }

            main .detail-card{
                min-height: 280px;
                height: 102%;
                background-color: var(--whiteColor);
                border-radius: 8px; /* Changed to px for symmetry */
                margin: 1% 0; /* Adjusted top and bottom margin */
                box-shadow: rgba(176, 176, 176, 0.2) 0px 2px 8px 0px;
                cursor: pointer;
                border: 1px solid lightgray;
                display: grid;
                padding-right: 5px;
                margin-right: 5px;
            }

            main .detail-card .detail-img{
                width: 20%;
            }
            
            main .detail-card .detail-img img{
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            main .detail-card .detail-desc{
                line-height: 3em;
                margin-left: 30px;
                position: relative;
                width: 75%;
                height: 100%;
                display: flex;
                flex-direction: column;
                justify-content: center;
            }

            main .detail-card .detail-desc p{
                font-size: 1.5rem;
            }

            main .detail-card .detail-desc button{
                position: relative;
                bottom: 10px;
                align-items: center;
                border: none;
                background-color: var(--primaryColor);
                color: var(--whiteColor);
                padding: 10px;
                margin: 5px;
                border-radius: 5px;
                cursor: pointer;
                top: 10px;
            }
        </style>
    </head>
    <body>
        <!-- Header and Banner Section -->
        <header>
            <!-- Your banner content here -->
            <div class="banner-text-item">
            <div class="banner-heading">
                <div class="image">
                    <img src="../files/icons/tdf.png" alt="TDF LOGO">
                </div>
                <div class="content"> 
                    <br> <br>
                    <h2>Your Ultimate Cravings Satisfied Exclusively </h2>
                    <h1> @TDF FOODS</h1>
                    <p> 1159 Zobel Roxas corner Espiritu St. </p>
                    <p> Barangay 757, Manila, 1009 Metro Manila </p> 
                </div> 
            </div>
        </header>
        <!-- Cart Item Count Section -->
        <section class="cart-count">
            <h1><?php echo mysqli_num_rows($order_items); ?> Items in Cart</h1>
            <hr class="divider">
        </section>

        <!-- Cart Items Section -->
        <section class="cart-items">
            <!-- Display shopping cart items -->
            <?php
                if ($order_items->num_rows > 0) {
                    // Start the table structure before the loop
                    echo "<table border='1'><tr><th>ID</th><th>Name</th><th>Price</th><th>Description</th><th>Quantity</th><th>Subtotal</th></tr>";

                    // Output each row from the cart
                    while ($row_cart = mysqli_fetch_assoc($order_items)) {
                        $id = $row_cart['ProductID'];    
                        
                        // Retrieve shopping cart items from the database
                        $sql = "SELECT * FROM product WHERE prodId=".$id; // Construct the SQL query
                        $product_result = $conn->query($sql); // Execute the SQL query
                        
                        while ($row = mysqli_fetch_assoc($product_result)) {
                            $id = $row['prodId'];
                            $name = $row['prodName'];
                            $price = $row['prodPrice'];
                            $description = $row['prodDescription'];
                            $quantity = $row_cart['Quantity']; // Get quantity from the $row_cart, not $row
                            $subtotal = $row_cart['Subtotal']; // Get subtotal from the $row_cart, not $row

                            echo "<tr><td>".$id."</td><td>".$name."</td><td>".$price."</td><td>".$description."</td><td>".$quantity."</td><td>".$subtotal."</td></tr>";
                        }
                    }

                    // Close the table structure after the loop
                    echo "</table>";
                } else {
                    echo "Your cart is empty.";
                }
                ?>

                    
        </section>

        <button class="remove">Remove from cart</button>
        <!-- Total and Checkout Section -->
        <section class="cart-summary">
            <div class="total">Total: ₱ <?php echo getCartTotal(); ?></div>
            <button class="checkout-btn">Checkout</button>
        </section>

    <!-- JavaScript -->
    <script>
        var remove = document.getElementByClassName("remove");
            for(var i = 0;i<remove.lengths;i++){
                remove[i].addEventListener("click",function(event){
                    var target= event.target;
                    var cart_id =target.getAttribute("data-id");
                    var xml = new XMLHttpRequest = function(){
                        if(this.readyState == 4 && this.status == 200){
                            taget.innerHTML = this.responseText;
                            target.style.opacity = .3;
                        }
                    }
                    xml.open("GET","server.php?id=" +cart_id, true);
                    xml.send();
                })
            }

            <?php
                if(isset($_GET["OrderID"])){
                    $sql = "DELETE FROM order_items WHERE ProductID=".$ProductID;
                
                    if($conn->query($sql) === TRUE){
                        echo "removed from cart";

                    }
                
                }
            ?>
    </script>
    <script src="app.js"></script>
    </body>
</html>