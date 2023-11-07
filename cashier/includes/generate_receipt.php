<?php

//var_dump($_GET);


$customerID = $_GET['customerID']; 
$orderNum = $_GET['orderID'];
$date = date("Y-m-d H:i:s");
$queueNum = $_GET['queueNum'];
$discType = $_GET['discType'];
$discountPercent = $_GET['discountPercent'];
$discAmt = $_GET['discAmt'];
$vatSales = $_GET['vatSales'];
$vatAmt = $_GET['vatAmt'];
$totalDiscAmt = $_GET['totalDiscAmt'];
$totalSubtotal = $_GET['totalSubtotal'];
$totalBill = $_GET['totalBill'];
$change = $_GET['change'];
$cashInput = $_GET['cashInput'];
$encodedProducts = $_GET['products'];


$items = json_decode(urldecode($encodedProducts), true);

// Calculate total
$numItems = 0;
$total = 0;
foreach ($items as $item) {
    $total += $item['quantity'] * $item['unitPrice'];
    $numItems += $item['quantity'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width">
    <title>Receipt</title>
    <style>
        body {
            position: relative;
            margin: 5px;
            padding-bottom: 100px; /* Height of the footer */
        }
        .footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            background-color: #f1f1f1;
            text-align: center;
        }
        .print-btn {
            background-color: #700202;
            border-radius: 20px; 
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }
        @media print {
            @page {
                size: 80mm auto; /* 80mm width and auto height */
            }
            body {
                width: 80mm;
                margin: 0; /* Reset default margin */
            }
            .footer {
                display: none; /* Hide the footer in print view */
            }
        }
    </style>
</head>
<body>
    <h2>To Die for Foods - Manila</h2>
    <p>1159 Zobel Roxas corner Espiritu St.</p>
    <p>Barangay 757, Manila, 1009</p>
    <p> Metro  Manila, NCR, Philippines</p>
    <p>Contact No: 0920 230 9787</p>
    <hr>
    <h2>REFERENCE</h2>
    <p>Date: <?php echo $date; ?></p>
    <h3>Order Number: <?php echo $orderNum; ?></h3>
    <h3>Queue Number: <?php echo $queueNum; ?></h3>
    <p>Number of Items <?php echo $numItems ; ?></p>
    <hr>
    <h2>CUSTOMER</h2>
    <p>Customer: <?php echo $customerID; ?></p>
    <p>Type: <?php echo $discType; ?></p>
    <table border='1'>
        <tr>
            <th>Item</th>
            <th>Quantity</th>
            <th>Unit Price</th>
            <th>Subtotal</th>
        </tr>
        <?php
        foreach ($items as $item) {
            $itemName = $item['description'];
            $quantity = $item['quantity'];
            $unitPrice = $item['unitPrice'];
            $subtotal = $item['subtotal'];
            echo "
                <tr>
                    <td>$itemName</td>
                    <td>$quantity</td>
                    <td>$unitPrice</td>
                    <td>$subtotal</td>
                </tr>";
        }
        ?>
        <tr>
            <td colspan='3'><b>Total</b></td>
            <td><?php echo $total; ?></td>
        </tr>
    </table>
    
    <hr>
    <p>Sales Discount: <?php echo $discountPercent; ?></p>
    <p>Discount Amount: <?php echo $discAmt; ?></p>
    <p>VATabe Sales: <?php echo $vatSales; ?></p>
    <p>VAT 12% Amount: <?php echo $vatAmt; ?></p>
    <hr>
    <p>Total Amount: <?php echo $total; ?></p>
    <p>Amount Tendered (CASH): <?php echo $cashInput; ?></p>
    <p>Change: <?php echo $change; ?></p>
    <hr>
    <h2>THANK YOU FOR YOUR ORDER</h2>
    <p>Your Cravings Satisfied Here at TDF Foods</p>
    <p>BON APPETITE</p>
    <br>
    <div class="footer">
        <button class="print-btn" onclick="window.print()">Print Receipt</button>
    </div>

</body>
</html>
