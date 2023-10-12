<?php
    require_once 'server.php';
    
    $sql_cart= "SELECT *  FROM order_items";
    $all_cart = $conn->query($sql_cart);
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
<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap');
    /* font-family: 'Playfair Display', serif;
    font-family: 'Poppins', sans-serif; */
    :root{
        --primaryColor: #0e6253;
        --secondaryColor: #700202;
        --whiteColor: #fff;
        --blackColor:#222;
        --softgreenColor: #d9f2ee;
        --darkgreenColor: #a7a7a7;
        --greyColor: #f5f5f5;
    }
    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        text-decoration:none;
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
        height: 150px;
        border: 1px solid lightgray;
        margin: 20px;
        display: flex;
    }

    main .detail-card .detail-img{
        width: 20%;
    }
    main .detail-card .detail-img img{
        width: 100%;
        height: 100%;
        object-fit:cover;
    }
    main .detail-card .detail-desc{
        line-height: 3em;
        margin-left: 30px;
        position: relative;
        width:75%;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    main .detail-card .detail-desc p{
        font-size: 1.5rem;
    }

    main .detail-card .detail-desc button{
        position: absolute;
        bottom: 10px;
        right: 10px;
        border: none;
        background-color: var(--primaryColor);
        color: var(--whiteColor);
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
    }
    
</style>

<body>
    <br>
    <div class="banner-text-item">
        <div class="banner-heading">
            <div class="image">
                <img src="../files/icons/tdf.png" alt="TDF LOGO">
            </div>
            <div class = "content"> 
                <br> <br>
                <h2>Your Ultimate Cravings Satisfied Exclusively </h2>
                <h1> @TDF FOODS</h1>
                <p> 1159 Zobel Roxas corner Espiritu St. </p>
                <p> Barangay 757, Manila, 1009 Metro Manila </p> 
            </div> 
        </div>
        
    </div>    
    <main>
    <h1>0 Items</h1>
    <hr class="divider">
    <?php
        while($row_cart = mysqli_fetch_assoc($all_cart)){
            $sql = "SELECT * FROM product WHERE prodId=" .$row_cart["[prodId"];
            $all_product = $conn->query($sql);
            while($row = mysqli_fetch_assoc($all_product)) {
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
                <button class="remove"> Remove from Cart</button>
            </a>
        </div>
        
    </div>
    <?php
            }
        }
    ?>
    </main>
    
    <script>
        var remove = document.getElementsByClassName("remove");
        for (var i = 0; i < remove.length; i++) {
            remove[i].addEventListener("click",function(event){
                var target = event.target;
                var orderId = target.getAttribute("data-id");
                var xml = new XMLHttpRequest();
                xml.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        target.innerHTML = this.responseText;
                        target.style.opacity= .3;
                    }
            }
                xml.open("GET","server.php?id=" + id, true);
                xml.send(); 
            })           
        }
    </script>

</body>
</html>