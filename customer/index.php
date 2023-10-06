<!DOCTYPE html>
<html lang ="en">
<head>
     <meta charset="utf-8" name="homepage" content=width=device-width, initial-scale=1 >
        <link rel="stylesheet" type="text/css" href="style.css" media="screen"/> 
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
        <hr>
        <div class = "sec1" id = "popularCuisines"> 
        <div class="sections">
            <a button class="popularCuisines" href="#popularCuisines"> Popular Cuisines </a>
            <a button class="heritage" href="#heritage"> Heritage </a>
            <a button class="specialties" href="#specialties"> Specialties </a>
            <a button class="pastries" href="#pastries"> Pastries </a>
            <a button class="sweets" href="#sweets"> Sweets </a>
            <a button class="beverages" href="#beverages"> Beverages </a>
        </div>
        
            <img src = "https://i.ibb.co/WgyLctd/abalos-about-me.jpg"> <br> <br>
            <h3> Discover </h3> 
            <h1> About Me </h1> <hr>
            <p> Hi! I am Jerusa Mae Peñarubia Abalos. A BSIS2-02 student of Dr. Filemon C. Aguilar Information Technology Training Institute. I practically seek for environments that provide me with an opportunities to enhance my professional skills, creativity, character, and competencies. This is my third time to create a website and the first time I have used HTML and CSS. </p>
        <div class="row">
            <div class="col">
                <p> <b> Name: </b> Jerusa Mae P. Abalos </p>
                <p> <b> Phone </b> +63 948 821 5837 </p>
                <p> <b> Experience: </b> thrice </p>    
                <p> <b> Messenger </b> @jerusa.penarubia </p>
            </div>
            <div class="col">
                <p> <b> Age: </b> 19 years old </p>
                <p> <b> Address: </b> Las Piñas City</p>
                <p> <b> Status: </b> Single </p>    
                <p> <b> Language: </b> Filipino, English, Spanish</p> 
            </div>
        </div>
    </div>
    <hr>
    
    </section>
    <br><br>
</body>
<footer>
    <div class = "footer">
        <h2> Final Project </h2>
        <p> Abalos | Bagobe | Bataller | Gaborno</p>
        <p> ©2021 ITE105
        <br>
    </div>

</footer>
</html>