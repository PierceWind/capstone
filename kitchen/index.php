<?php
session_start();

if (!isset($_SESSION['acc_name'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location:../login/log.php');
}

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['acc_name']);
    header('location:../login/log.php');
}

include('server.php');

date_default_timezone_set('Asia/Manila');

// Check if an order is currently being processed (you need to retrieve this information from your system)
$currentlyProcessingOrder = true; // Change this based on your system logic
$currentlyProcessingOrderQueueNumber = "0001"; // Replace with the actual queue number of the processing order

// Get the next queue number
$nextQueueNumber = getNextQueueNumber($conn, $currentlyProcessingOrderQueueNumber);

function getNextQueueNumber($conn, $currentQueueNumber) {
    $query = "SELECT MIN(queueNumber) AS NextQueueNumber FROM orders WHERE queueNumber > '$currentQueueNumber'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['NextQueueNumber'];
    } else {
        return null; // No next queue found
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Ordering System</title>
    <link rel="stylesheet" href="../files/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Noto+Sans+Hebrew&amp;display=swap">
    <link rel="stylesheet" href="../files/assets/css/Articles-Badges-images.css">
    <link rel="stylesheet" href="../files/assets/css/Navbar-Centered-Links-icons.css">
    <link rel="stylesheet" href="../files/assets/css/Off-Canvas-Sidebar-Drawer-Navbar.css">
    <link rel="stylesheet" href="../files/assets/css/project-card.css">
</head>

<body>
    <a href="index.php?logout='1'" class="logout">
        <img src="../files/icons/logout.png" alt="" class="fas" style="width:30px; float: right; margin: 20px;">
    </a>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-xl-4 d-md-flex flex-column justify-content-xl-center">
                <section class="d-xl-flex flex-column justify-content-xl-center align-items-xl-center"><img src="../files/icons/tdfLogo.png" style="width: 300px;">
                    <h1 style="color: #7c2128;">KITCHEN STATION</h1>
                </section>
                <section class="d-xl-flex flex-column justify-content-xl-center align-items-xl-center">
                    <h2 class="d-xl-flex flex-column justify-content-xl-center align-items-xl-center" style="margin-bottom: 50px;">Waiting List</h2>
                    <?php
                    // Fetch the first 100 queue numbers from your database
                    $query = "SELECT orderID, queueNumber, orderDateTime FROM orders ORDER BY orderDateTime ASC LIMIT 5";
                    $query_run = mysqli_query($conn, $query);

                    if (mysqli_num_rows($query_run) > 0) {
                        $changeStat = "UPDATE `orders` SET `orderStatus` = 'In Progress' ORDER BY orderDateTime ASC LIMIT 1";
                        $firstRecordQueryResult = mysqli_query($conn, $changeStat);

                        while ($row = mysqli_fetch_assoc($query_run)) {
                            $queueNumber = sprintf("%04d", $row['queueNumber']); // Format as 4 digits
                            $orderID = $row['orderID'];
                            $isProcessing = ($currentlyProcessingOrder && $queueNumber == $currentlyProcessingOrderQueueNumber);
                    ?>
                        <button class="btn btn-primary queue-button" data-queue-number="<?php echo $queueNumber; ?>" data-order-id="<?php echo $orderID; ?>"  style="padding-right: 20px; padding-left: 20px; border-color: var(--bs-black); background: var(--bs-yellow); color: var(--bs-black); margin-bottom: 15px;" onclick="loadOrderDetails('<?php echo $queueNumber; ?>')">
                            <strong>#<?php echo $queueNumber; ?></strong>
                        </button>
                    <?php
                        }
                    }
                    ?>
                </section>
            </div>
            <div class="col-md-8" style="margin-top: 100px;">
                <div class="row" style="margin-bottom: 15px;">
                    <div class="col">
                        <div class="card">
                            <div class="card-body d-xl-flex flex-column justify-content-xl-center">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Qty</th>
                                                <th>Product</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>2</td>
                                                <td>Kare - Kare</td>
                                            </tr>
                                            <tr>
                                                <td>1</td>
                                                <td>Dinuguan</td>
                                            </tr>
                                            <tr>
                                                <td>1</td>
                                                <td>Bopis</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div><button class="btn btn-primary" type="button" style="background: #7c2128;border-style: none;"><strong>SERVED TO #0001</strong></button>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-body d-xl-flex flex-column justify-content-xl-center">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Qty</th>
                                                <th>Product</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>2</td>
                                                <td>Kare - Kare</td>
                                            </tr>
                                            <tr>
                                                <td>1</td>
                                                <td>Dinuguan</td>
                                            </tr>
                                            <tr>
                                                <td>1</td>
                                                <td>Bopis</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div><button class="btn btn-primary" type="button" style="background: #7c2128;border-style: none;"><strong>SERVED TO #0002</strong></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-body d-xl-flex flex-column justify-content-xl-center" style="border-style: none;">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Qty</th>
                                                <th>Product</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>2</td>
                                                <td>Kare - Kare</td>
                                            </tr>
                                            <tr>
                                                <td>1</td>
                                                <td>Dinuguan</td>
                                            </tr>
                                            <tr>
                                                <td>1</td>
                                                <td>Bopis</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div><button class="btn btn-primary" type="button" style="background: #7c2128;border-style: none;"><strong>SERVED TO #0003</strong></button>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-body d-xl-flex flex-column justify-content-xl-center">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Qty</th>
                                                <th>Product</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>2</td>
                                                <td>Kare - Kare</td>
                                            </tr>
                                            <tr>
                                                <td>1</td>
                                                <td>Dinuguan</td>
                                            </tr>
                                            <tr>
                                                <td>1</td>
                                                <td>Bopis</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div><button class="btn btn-primary" type="button" style="background: #7c2128;border-style: none;"><strong>SERVED TO #0004</strong></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/Off-Canvas-Sidebar-Drawer-Navbar-swipe.js"></script>
    <script src="assets/js/Off-Canvas-Sidebar-Drawer-Navbar-off-canvas-sidebar.js"></script>
</body>

</html>