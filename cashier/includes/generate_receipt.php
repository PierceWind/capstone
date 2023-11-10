<?php

//var_dump($_GET);

date_default_timezone_set('Asia/Manila');

$customerID = $_GET['customerID'] ?? 0;
$orderNum = $_GET['orderID'] ?? 0;
$date = date("Y-m-d H:i:s");
$queueNum = $_GET['queueNum'] ?? 0;
$discType = $_GET['discType'] ?? '';
$discountPercent = (float)($_GET['discountPercent'] ?? 0.0);
$discAmt = (float)($_GET['discAmt'] ?? 0.0);
$vatSales = (float)($_GET['vatSales'] ?? 0.0);
$vatAmt = (float)($_GET['vatAmt'] ?? 0.0);
$totalDiscAmt = (float)($_GET['totalDisc'] ?? 0.0);
$totalSubtotal = (float)($_GET['totalSubtotal'] ?? 0.0);
$totalBill = (float)($_GET['totalBill'] ?? 0.0);
$change = (float)($_GET['change'] ?? 0.0);
$cashInput = (float)($_GET['cashInput'] ?? 0.0);
$encodedProducts = $_GET['products'] ?? '[]';

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
            line-height: 0.2em; 
        }
        
        p {
            line-height: 0.2em;
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
        .header, .end {
            flex-direction: column;
            align-items: center;
            text-align: center;
            line-height: 0.2em; 
        }

        .header img {
            width: 20%;
            float: left; /* Adjust the margin as needed */
            margin-top: -5px; 
        }
        table {
            border-collapse: collapse;
            width: 54mm; /* Set the width to 56mm */
        }

        th, td {
            border: 0.5px solid black; /* Adjust the border as needed */
            padding: 2mm;
            text-align: left;
            white-space: normal; /* Allow text to wrap */
            line-height: 1.2; 
        }

        th {
            text-align: center;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        @media print {
            @page {
                size: 57mm auto; 
            }
            body {
                width: 57mm;
                margin: 0.3em;
            }
            .footer {
                display: none; /* Hide the footer in print view */
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="../files/icons/tdfLogo.png" >
        <h2>To Die for Foods</h2>
        <p style="font-size: 11px;">1159 Zobel Roxas corner Espiritu St. </p>
        <p style="font-size: 11px;">Brgy. 757 Metro Manila, 1009, NCR</p>
        <p>0920 230 9787 || @tdffoods</p>
        <p><?php echo date('F j, Y | g:i a'); ?></p>
    </div>
    <hr>
    <div class="sec1">
        <h4>Order Number: <?php echo $orderNum; ?></h4>
        <h4>Queue Number: <?php echo $queueNum; ?></h4>
        <p>Number of Items:  <?php echo $numItems ; ?></p>
        <hr>
    </div>
    <div class="sec1">
        <p>Customer: <?php echo "******" . substr($customerID, -4); ?> </p>
        <p>Type: <?php echo $discType; ?></p>
        <hr> 
    </div>
    <h3>ORDER DETAILS</h3>
    <table border='1'>
        <tr>
            <th>Item</th>
            <th>Qty</th>
            <th>UP</th>
            <th>ST</th>
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
            <td><?php echo number_format($total, 2, '.', ','); ?></td>
        </tr>
    </table>
    
    <hr>
    <p>Sales Discount: <?php echo number_format($discountPercent, 2, '.', ',');  ?></p>
    <p>Discount Amount: <?php echo number_format($discAmt, 2, '.', ','); ?></p>
    <p>VATabe Sales: <?php echo number_format($vatSales, 2, '.', ','); ?></p>
    <p>VAT 12% Amount: <?php echo number_format($vatAmt, 2, '.', ','); ?></p>
    <p>TOTAL DIS AMT: <?php echo number_format($totalDiscAmt, 2, '.', ',') ?>  
    <hr>
    <p>Gross Amount: <?php echo number_format($totalSubtotal, 2, '.', ','); ?></p>
    <p><strong> NET AMOUNT: <?php echo  number_format($totalBill, 2, '.', ','); ?> </strong> </p>
    <p>Cash Tendered: <?php echo number_format($cashInput, 2, '.', ','); ?></p>
    <p>Change: <?php echo number_format($change, 2, '.', ','); ?></p>

    <hr>
    <div class="end">
        <h3 style="font-size: 12px;">THANK YOU FOR YOUR ORDER</h3>
        <strong> <h4 style="font-size: 12px;">Your Cravings Satisfied Here 
    </h4> <h4> @ TDF Foods</h4>
        <h3>BON APPETITE</h3> </strong>
    </div>
    <br>
    <div class="footer">
        <button class="print-btn" onclick="window.print()"><strong>PRINT RECEIPT</strong></button>
    </div>

</body>
</html>
