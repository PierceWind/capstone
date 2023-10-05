<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Ordering System</title>
    <link rel="stylesheet" href="../files/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Noto+Sans+Hebrew&amp;display=swap">
    <link rel="stylesheet" href="../filesassets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="../filesassets/css/Articles-Badges-images.css">
    <link rel="stylesheet" href="../filesassets/css/Navbar-Centered-Links-icons.css">
    <link rel="stylesheet" href="../filesassets/css/Off-Canvas-Sidebar-Drawer-Navbar.css">
    <link rel="stylesheet" href="../filesassets/css/project-card.css">
</head>  

<body>
    <nav class="navbar navbar-light navbar-expand-md py-3">
        <div class="container"><a class="navbar-brand d-flex align-items-center" href="#"><img src="assets/img/tdfLogo.png" style="width: 120px;"></a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-3"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-3">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item d-flex" style="margin-right: 30px;"><i class="fa fa-dashboard fs-3 d-xl-flex align-items-xl-center"></i><a class="nav-link active" href="#"><strong>Dashboard</strong></a></li>
                    <li class="nav-item d-flex" style="margin-right: 30px;"><i class="fa fa-list fs-3 d-xl-flex align-items-xl-center"></i><a class="nav-link active" href="#"><strong>Order List</strong></a></li>
                    <li class="nav-item d-flex" style="margin-right: 30px;"><i class="fa fa-history fs-3 d-xl-flex align-items-xl-center"></i><a class="nav-link active" href="#"><strong>History</strong></a></li>
                    <li class="nav-item d-flex align-items-xl-center" style="margin-right: 30px;"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -64 640 640" width="1em" height="1em" fill="currentColor" class="fs-3 d-xl-flex align-items-xl-center">
                            <!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                            <path d="M96 96C96 60.65 124.7 32 160 32H576C611.3 32 640 60.65 640 96V320C640 355.3 611.3 384 576 384H160C124.7 384 96 355.3 96 320V96zM160 320H224C224 284.7 195.3 256 160 256V320zM160 96V160C195.3 160 224 131.3 224 96H160zM576 256C540.7 256 512 284.7 512 320H576V256zM512 96C512 131.3 540.7 160 576 160V96H512zM368 128C323.8 128 288 163.8 288 208C288 252.2 323.8 288 368 288C412.2 288 448 252.2 448 208C448 163.8 412.2 128 368 128zM48 360C48 399.8 80.24 432 120 432H520C533.3 432 544 442.7 544 456C544 469.3 533.3 480 520 480H120C53.73 480 0 426.3 0 360V120C0 106.7 10.75 96 24 96C37.25 96 48 106.7 48 120V360z"></path>
                        </svg><a class="nav-link active" href="#"><strong>Bills</strong></a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 col-xl-3 d-md-flex flex-column justify-content-xl-center" style="background: #edd1d0;">
                <section class="d-xl-flex flex-column justify-content-xl-center align-items-xl-center">
                    <h2 class="d-xl-flex flex-column justify-content-xl-center align-items-xl-center" style="margin-top: 20px;">Waiting List</h2><button class="btn btn-primary" type="button" style="padding-right: 20px;padding-left: 20px;border-color: var(--bs-black);background: var(--bs-yellow);color: var(--bs-black);margin-bottom: 15px;"><strong>#0001</strong></button><button class="btn btn-primary" type="button" style="padding-right: 20px;padding-left: 20px;border-color: var(--bs-black);background: var(--bs-white);color: var(--bs-black);margin-bottom: 15px;"><strong>#0002</strong></button><button class="btn btn-primary" type="button" style="padding-right: 20px;padding-left: 20px;border-color: var(--bs-black);background: var(--bs-btn-active-color);color: var(--bs-black);margin-bottom: 15px;"><strong>#0003</strong></button><button class="btn btn-primary" type="button" style="padding-right: 20px;padding-left: 20px;border-color: var(--bs-black);background: var(--bs-btn-disabled-color);color: var(--bs-black);margin-bottom: 15px;"><strong>#0004</strong></button><button class="btn btn-primary" type="button" style="padding-right: 20px;padding-left: 20px;border-color: var(--bs-black);background: var(--bs-btn-disabled-color);color: var(--bs-black);margin-bottom: 15px;"><strong>#0005</strong></button>
                </section>
            </div>
            <div class="col-md-8" style="/*margin-top: 100px;*/">
                <section>
                    <h2>Order Details</h2>
                    <p style="font-size: 17px;font-weight: bold;margin-bottom: 0px;">Order Number: #0001</p>
                    <p style="font-size: 17px;font-weight: bold;margin-top: 0px;">Date: May, 6, 2023</p>
                </section>
                <section style="padding-bottom: 20px;border-bottom-style: solid;border-bottom-color: var(--bs-black);">
                    <div class="table-responsive" style="background: #edd1d0;border-radius: 10px;">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="border-bottom-color: var(--bs-black);">QTY</th>
                                    <th style="border-bottom-color: var(--bs-table-striped-color);">PRODUCT</th>
                                    <th style="border-bottom-color: var(--bs-table-striped-color);">PRICE</th>
                                    <th style="border-bottom-color: var(--bs-table-striped-color);">TAX</th>
                                    <th style="border-bottom-color: var(--bs-table-striped-color);">TOTAL</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>2</td>
                                    <td>Kare-Kare</td>
                                    <td>150</td>
                                    <td>0</td>
                                    <td>300</td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Dinuguan</td>
                                    <td>120</td>
                                    <td>0</td>
                                    <td>120</td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Bopis</td>
                                    <td>130</td>
                                    <td>0</td>
                                    <td>130</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <p style="font-weight: bold;font-size: 24px;font-style: italic;"><strong>TOTAL: 550.0</strong></p>
                </section>
                <section style="padding-top: 15px;">
                    <h3 style="font-style: italic;"><strong>Payment Method</strong></h3>
                    <div class="row">
                        <div class="col d-xxl-flex justify-content-xxl-center align-items-xxl-center"><button class="btn btn-primary d-xxl-flex flex-column align-items-xxl-center" type="button" style="background: #edd1d0;border-style: none;border-bottom-style: none;padding-top: 12px;padding-bottom: 12px;padding-right: 24px;padding-left: 24px;"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="1em" height="1em" fill="currentColor" class="fs-1 text-dark">
                                    <!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                                    <path d="M512 80C512 98.01 497.7 114.6 473.6 128C444.5 144.1 401.2 155.5 351.3 158.9C347.7 157.2 343.9 155.5 340.1 153.9C300.6 137.4 248.2 128 192 128C183.7 128 175.6 128.2 167.5 128.6L166.4 128C142.3 114.6 128 98.01 128 80C128 35.82 213.1 0 320 0C426 0 512 35.82 512 80V80zM160.7 161.1C170.9 160.4 181.3 160 192 160C254.2 160 309.4 172.3 344.5 191.4C369.3 204.9 384 221.7 384 240C384 243.1 383.3 247.9 381.9 251.7C377.3 264.9 364.1 277 346.9 287.3C346.9 287.3 346.9 287.3 346.9 287.3C346.8 287.3 346.6 287.4 346.5 287.5L346.5 287.5C346.2 287.7 345.9 287.8 345.6 288C310.6 307.4 254.8 320 192 320C132.4 320 79.06 308.7 43.84 290.9C41.97 289.9 40.15 288.1 38.39 288C14.28 274.6 0 258 0 240C0 205.2 53.43 175.5 128 164.6C138.5 163 149.4 161.8 160.7 161.1L160.7 161.1zM391.9 186.6C420.2 182.2 446.1 175.2 468.1 166.1C484.4 159.3 499.5 150.9 512 140.6V176C512 195.3 495.5 213.1 468.2 226.9C453.5 234.3 435.8 240.5 415.8 245.3C415.9 243.6 416 241.8 416 240C416 218.1 405.4 200.1 391.9 186.6V186.6zM384 336C384 354 369.7 370.6 345.6 384C343.8 384.1 342 385.9 340.2 386.9C304.9 404.7 251.6 416 192 416C129.2 416 73.42 403.4 38.39 384C14.28 370.6 .0003 354 .0003 336V300.6C12.45 310.9 27.62 319.3 43.93 326.1C83.44 342.6 135.8 352 192 352C248.2 352 300.6 342.6 340.1 326.1C347.9 322.9 355.4 319.2 362.5 315.2C368.6 311.8 374.3 308 379.7 304C381.2 302.9 382.6 301.7 384 300.6L384 336zM416 278.1C434.1 273.1 452.5 268.6 468.1 262.1C484.4 255.3 499.5 246.9 512 236.6V272C512 282.5 507 293 497.1 302.9C480.8 319.2 452.1 332.6 415.8 341.3C415.9 339.6 416 337.8 416 336V278.1zM192 448C248.2 448 300.6 438.6 340.1 422.1C356.4 415.3 371.5 406.9 384 396.6V432C384 476.2 298 512 192 512C85.96 512 .0003 476.2 .0003 432V396.6C12.45 406.9 27.62 415.3 43.93 422.1C83.44 438.6 135.8 448 192 448z"></path>
                                </svg><span style="border-bottom-color: var(--bs-black);color: var(--bs-black);"><strong>Cash</strong></span></button></div>
                        <div class="col d-xxl-flex justify-content-xxl-center align-items-xxl-center"><button class="btn btn-primary d-xxl-flex flex-column align-items-xxl-center" type="button" style="background: #edd1d0;border-style: none;border-bottom-style: none;padding-top: 12px;padding-bottom: 12px;padding-right: 24px;padding-left: 24px;"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="1em" height="1em" fill="currentColor" class="fs-1 text-dark">
                                    <!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                                    <path d="M448 32C465.7 32 480 46.33 480 64C480 81.67 465.7 96 448 96H80C71.16 96 64 103.2 64 112C64 120.8 71.16 128 80 128H448C483.3 128 512 156.7 512 192V416C512 451.3 483.3 480 448 480H64C28.65 480 0 451.3 0 416V96C0 60.65 28.65 32 64 32H448zM416 336C433.7 336 448 321.7 448 304C448 286.3 433.7 272 416 272C398.3 272 384 286.3 384 304C384 321.7 398.3 336 416 336z"></path>
                                </svg><span style="border-bottom-color: var(--bs-black);color: var(--bs-black);"><strong>E-Wallet</strong></span></button></div>
                    </div>
                </section>
                <section>
                <div class="buttones1">
                <button class="confirm">CONFIRM</button>
                <button class="cancel">CANCEL</button>
            </div>
            </section>
            </div>
        </div>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/Off-Canvas-Sidebar-Drawer-Navbar-swipe.js"></script>
    <script src="assets/js/Off-Canvas-Sidebar-Drawer-Navbar-off-canvas-sidebar.js"></script>
</body>

</html>