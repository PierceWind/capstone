<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> TDF FOODS</title>
        <link rel="icon" type="image/x-icon" href="tdf.png">
        <!--for icons-->
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
        <!--for bootstrap-->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <!--for swiper slider-->
        <link rel="stylesheet" href="assets/css/swiper-bundle.min.css">
        <!--for fancy box-->
        <link rel="stylesheet" href="assets/css/jquery.fancybox.min.css">
        <link rel="stylesheet" href="stylesheet.css">
    </head>

    <body class="body-fixed">
        <!-- start of header-->

        <header class="site-header">
            <div class="container">
                <div class="row">
                    <div class="col-lg-2">
                        <div class="header-logo">
                            <a href="index.html">
                                <img src="tdf.png" alt="tdf logo" width="160" height="80"> <!--orginally width 160px and 36 height-->
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-10">
                        <div class="main-navigation">
                            <button class="menu-toggle"><span></span><span></span></button>
                            <nav class="header-menu">
                                <ul class="menu food-nav-menu">
                                    <li><a href="#home">Home</a></li>
                                    <li><a href="#about">About</a></li>
                                    <li><a href="#menu">Menu</a></li>
                                    <li><a href="#gallery">Gallery</a></li>
                                    <li><a href="#contact">Contact</a></li>
                                </ul>

                            </nav>
                            <div class="header-right">
                                <form action="#" class="header-search-form for-des">
                                    <input type="search" class="form-input" placeholder="Search Here..">
                                        <button type="submit">
                                            <i class="uil uil-search"></i>
                                        </button>
                                </form>
                                 <!--cart notif need to be edit to synch -->
                                <a href="javascript:void(0)" class="header-btn header-cart">
                                    <i class="uil uil-shopping-cart"></i>
                                    <span class="cart-number">3</span>
                                </a>
                                <!--user icon-->
                                <a href="javascript:void(0)" class="header-btn">
                                    <i class="uil uil-user"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!--END OF HEADER-->

        <div id="viewport">
            <div id="js-scroll-content">
                <section class="main-banner" id="home">
                    <div class="js-parallax-scene">
                        <div class="banner-shape-1 w-100" data-depth="0.30">
                            <img src="assets/images/berry.png" alt="">
                        </div>
                        <div class="banner-shape-2 w-100" data-depth="0.25">
                            <img src="assets/images/leaf.png" alt="">
                        </div>
                    </div>                        
                    <div class="sec-wp">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="banner-text">       
                                        <h1 class="h1-title">
                                            Welcome to TDF FOODS <br>
                                            <span>MANILA</span>
                                            restaurant
                                        </h1>
                                        <p>Farm - to - Table</p>
                                        <div class="banner-btn mt4">
                                            <a href="OrderingPage.php" class="sec-btn">Check our Menu</a>
                                        </div>
                                    </div>
                                </div>
                                <!--<div class="col-lg-6">
                                <div class="banner-img-wp">
                                        <div class="banner-img" style="background-image: url(assets/images/main-b.jpg);"></div>
                                    </div>
                                    <div class="banner-img-text mt-4 m-auto">
                                    
                                        <h5 class="h5-title">Sushi</h5>
                                        <P>hatdog makaknsdohsaiodas</P>
                                    </div>
                                </div>-->
                            </div>
                        </div>
                    </div>    
                </section>
                
                <!--  COULD PLACE TOP PRODUCTS/DISH BEFORE ABOUT US instead of brands-->
                <section class="about-sec section" id="about">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="sec-title text-center mb-5">
                                    <p class="sec-sub-title mb-3">About Us</p>
                                    <h2 class="h2-title">discover our <span>restaurant story</span></h2>
                                    <div class="sec-title-shape mb-4">
                                        <img src="assets/images/title-shape.svg" alt="">
                                    </div>
                                    <p>
                                        A family business that offers a variety of classic foods from different region. 
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8 m-auto">
                                <div class="about-img">
                                    <!--insert store img -->
                                    <div class="about-us-img" style="background-image:url(tdf.png)"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section style="background-image: url(assets/images/menu-bg.png);"
                    class="our-menu section bg-light repeat-img" id="menu">
                        <div class="sec-wp">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="sec-title text-center mb-5">
                                            <p class="sec-sub-title mb-3">our menu</p>
                                            <h2 class="h2-title">wake up early, <span>eat fresh & healthy</span></h2>
                                            <div class="sec-title-shape mb-4">
                                                <img src="assets/images/title-shape.svg" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="menu-tab-wp">
                                    <div class="row">
                                        <div class="col-lg-12 m-auto">
                                            <div class="menu-tab text-center">
                                                <ul class="filters">
                                                    <div class="filter-active"></div>
                                                    <li class="filter" data-filter=".all, .breakfast, .lunch, .dinner">
                                                        <img src="assets/images/menu-1.png" alt="">
                                                        All
                                                    </li>
                                                    <li class="filter" data-filter=".breakfast">
                                                        <img src="assets/images/menu-2.png" alt="">
                                                        Breakfast
                                                    </li>
                                                    <li class="filter" data-filter=".lunch">
                                                        <img src="assets/images/menu-3.png" alt="">
                                                        Lunch
                                                    </li>
                                                    <li class="filter" data-filter=".dinner">
                                                        <img src="assets/images/menu-4.png" alt="">
                                                        Dinner
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="menu-list-row">
                                        
                                </div>
                                </div>
                            </div>
                        </div> 
                </section>
            </div>
        </div>

        <!--jquery-->
        <script src="assets/js/jquery-3.5.1.min.js"></script>
        <!--bootstrap-->
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/popper.min.js"></script>
        <!--fontawesome-->
        <script src="assets/js/font-awesome.min.js"></script>
        <!--swiper slider-->
        <script src="assets/js/swiper-bundle.min.js"></script>
        <!--mixitup--filter -->
        <script src="assets/js/jquery.mixitup.min.js"></script>
        <!--fancybox-->
        <script src="assets/js/jquery.fancybox.min.js"></script>
        <!--parallax-->
        <script src="assets/js/parallax.min.js"></script>
        <!--gasp-->
        <script src="assets/js/gsap.min.js"></script>
        <!--scroll trigger-->
        <script src="assets/js/ScrollTrigger.min.js"></script>
        <!--scroll to plugin-->
        <script src="assets/js/ScrollToPlugin.min.js"></script>
        <!--Rellax-->
        <script src="assets/js/rellax.min.js"></script>
        <script src="assets/js/rellax-custom.js"></script>
        <!--smooth scroll-->
        <script src="assets/js/smooth-scroll.js"></script>
        <!--customer js-->
        <script src="main.js"></script>
    </body>
</html>
