
<?= template_header('Home') ?>
<?php
// Assuming you have a database connection in $pdo

$stmt = $pdo->prepare('SELECT DISTINCT product.prodId, product.prodName, product.prodPrice, product.prodDescription, product.prodCategory, prodimage.productImg, inventory.stock 
FROM product 
LEFT JOIN prodimage ON product.prodId = prodimage.productId
LEFT JOIN inventory ON product.prodId = inventory.prodCode');
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

$extension = "../admin/menu/";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../files/assets/bootstrap/js/bootstrap/3.6.4.min.js"></script>
    <title>Your Page Title</title>

    <style>         
        /* Your CSS Styles Go Here */
        .search {
            width: 100%;
            height: 40px;
            display: flex;
            justify-content: space-between; /* Adjusted to space between items */
            background-color: var(--whiteColor);
            border-radius: 20px;
            margin: 20px 20px; /* Adjusted the margin */
        }

        .searchInput {
            margin-left: 250px; 
            width: 500px; 
            flex: 1; /* Take remaining space */
            height: 100%;
            padding: 10px;
            border: none;
            border-radius: 15px;
            outline: none;
            box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);

            /* Add emphasis styles to the text inside the input */
            color: #700202; /* Change text color */
        }

        .searchbtn {
            background-color: #700202;
            color: #fff;
            border: none;
            border-radius: 20px;
            padding: 8px;
            width: 100px;
            cursor: pointer;
            font-weight: bold;
            margin-left: -100px; 
        }

        .searchbtn:hover {
            background-color: yellow;
            color: black;
        }
        .product {
        position: relative;
        display: inline-block;
        width: 200px;
        margin: 28px;
        transition: transform 1s ease;
            
        }
        .products {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr 1fr  1fr 1fr 1fr));
        gap: 20px;
        }

        .product img {
        width: 100%; 
        height: 200px; 
        object-fit: cover;
            
        }
        .product img:hover, .product.unavailable img:hover {
        transform: scale(1.05);
        transition: transform 1s;
        }

        .product-link {
        text-decoration: none;
        color: inherit;
        }

        .product.unavailable {
        pointer-events: none;
        }

        .unavailable-message {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: white;
        padding: 5px;
        color: red;
        font-weight: bold;
        font-size: 16px;
        }
        .submenu {
        position: sticky;
        top: 0;
        background-color: #fff;
        z-index: 1000;
    }

    .submenu ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
        background-color: #f1f1f1; /* Background color for the submenu */
        display: flex; /* Use flexbox to create a horizontal layout */
        justify-content: space-evenly; /* Distribute items evenly */
    }

    .submenu li {
        flex: 1; /* Distribute available space equally among items */
        text-align: center;
    }

    .submenu a {
        display: block;
        color: #700202;
        padding: 14px 0; /* Adjust vertical padding */
        text-decoration: none;
    }

    .submenu a:hover {
        background-color: #ddd;
    }

    .category-section {
        margin-top: 20px;
    }
    .submenu {
        position: relative;
    }   
    .submenu .unavailable img {
        width: 100%; /* Adjust the width to your preference */
        height: auto; /* Maintain aspect ratio */
        object-fit: contain; /* Use contain to fit the entire image within the container */
        max-width: 100%; /* Ensure the image doesn't exceed its natural size */
        border-radius: 20px;
    }

    .submenu .unavailable img {
        border-radius: 20px;
        border-color: red;
        border: red;
        /*filter: blur(5px);*/
    }

    .unavailable-message {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: red; /* You can customize the background color */
        color: white; /* You can customize the text color */
        padding: 10px; /* You can customize the padding */
        z-index: 2 ; /* Ensure the message is above the image */
    }

    .product-image-container {
        position: relative;
        z-index: 1; /* Ensure the image is below the message */
    }

    </style>
</head>
<body>

    <div class="featured">
        <br>
        <h2>To Die For Foods</h2>
        <p>Your Cravings Satisfied Here at TDF Foods</p>
        <br>
    </div>

    <div class="submenu">
    <ul>
        <li><a href="#" onclick="loadItems('heritage')">Heritage</a></li>
        <li><a href="#" onclick="loadItems('specialties')">Specialties</a></li>
        <li><a href="#" onclick="loadItems('pasta')">Pasta</a></li>
        <li><a href="#" onclick="loadItems('salad')">Salad</a></li>
        <li><a href="#" onclick="loadItems('sweets')">Sweets</a></li>
        <li><a href="#" onclick="loadItems('drinks')">Drinks</a></li>
    </ul>
</div>

<script>
function loadItems(category) {
    // Use AJAX to fetch items for the selected category
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Update the categoryItems div with the fetched items
            document.getElementById('categoryItems').innerHTML = xhr.responseText;
        }
    };
    xhr.open('GET', 'filtercategories.php?category=' + category, true);
    xhr.send();
}
</script>

    <div class="recentlyadded content-wrapper">
        <h2 style="font-size: 30px; color: #700202;">To Die For Menu</h2>
        <!--search bar--> 
        <div class="search">
            <form id="searchForm">
                <input type="text" class="searchInput" placeholder="Search Menu" name="query" id="query" required>
                <input type="submit" class="searchbtn" value="Search">
            </form>
        </div>
        <div id="searchResults" class="recentlyadded content-wrapper">
        <!-- The search results will be dynamically inserted here -->
        <br>
        </div>
        
        <div id="categoryItems" class="category-items">
            <!-- Display items for the selected category here -->
        </div>
        
        <?php foreach ($products as $product): ?>
            <div class="product <?= ($product['stock'] == 0) ? 'unavailable' : '' ?>">
                <?php if ($product['stock'] == 0): ?>
                    <div class="unavailable-message">UNAVAILABLE</div>
                <?php endif; ?>  
                <a href="<?= ($product['stock'] > 0) ? 'index.php?page=product&id=' . $product['prodId'] : '#' ?>" class="product-link">
                    <div class="product-image-container">
                        <img src="<?= $extension . $product['productImg'] ?>" alt="<?= $product['prodName'] ?>">
                        <span class="name" style="color: #700202;"><strong><?= $product['prodName'] ?></strong></span><br>
                        <span class="price">&#8369;<?= $product['prodPrice'] ?></span><br>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
        
    </div>
    
    <!-- Your JavaScript for AJAX -->
    <script>
        $(document).ready(function () {
            $('#searchForm').submit(function (e) {
                e.preventDefault(); // Prevent the default form submission

                // Get the search query
                var query = $('#query').val();

                // Perform AJAX request
                $.ajax({
                    type: 'GET',
                    url: 'search.php', // Adjust the URL based on your file structure
                    data: { query: query },
                    success: function (data) {
                        // Update the search results container with the received data
                        $('#searchResults').html(data);
                    },
                    error: function () {
                        console.log('Error occurred during AJAX request.');
                    }
                });
            });
        });
    </script>
     
    <!-- Your JavaScript for smooth scrolling goes here -->

</body>
</html>


<?= template_footer() ?>
