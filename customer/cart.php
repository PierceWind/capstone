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
        outline: none;
        font-family: 'Poppins', sans-serif;
    }

    body{
        background-color: var(--softgreenColor);
        overflow-x: hidden;
        font-family: 'Poppins', sans-serif;
        width: 100;
        height: auto;
        display: flex;
    }
    .header {
        display: flex;
        justify-content: center;
        align-items: center;
        
    }

    .header img{
        width: 30%;
        height: 60%;
    }
    
</style>

<body>
    <!--
    <div class="header">
        <img src="tdf.png" alt="" class="logo">
        <h3>To Die For Foods</h3>
    </div>
    -->
    <h2>0 Items</h2>
    <br>

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
    
    


</body>