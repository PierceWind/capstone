<!DOCTYPE html>
<html>
<head>
    <style>
        /* Add your styles here */
    </style>
</head>
<body>
    <section>
        <h2><strong>Order Details</strong></h2>
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <p style="font-size: 17px; font-weight: bold; margin-bottom: 0px;" id="inProgressOrderId">Order Number: <strong><?php echo $inProgressOrderId; ?></strong></p>
                <p style="font-size: 17px; font-weight: bold; margin-top: 0px; margin-bottom: 0px;">Queue Number: <strong><?php echo $inProgressQueueNum; ?></strong></p>
                <p style="font-size: 17px; font-weight: bold; margin-top: 0px;">Date: <strong><?php echo date('F j, Y | g:i a'); ?></strong></p>
            </div>
        </div>
    </section>

    <section class="tb" style="padding-bottom: 20px;border-bottom-style: solid;border-bottom-color: var(--bs-black);">
        <div class="table-responsive" style="background: #fceca7; border-radius: 10px;">
            <table id="order-list" class="table" style="border-collapse: collapse; width: 100%;">
                <thead>
                    <tr style="height: 50px;">
                        <th style="border-bottom-color: var(--bs-black);">DESCRIPTION</th>
                        <th style="border-bottom-color: var(--bs-table-striped-color);">QTY</th>
                        <th style="border-bottom-color: var(--bs-table-striped-color);">UNIT PRICE</th>
                        <th style="border-bottom-color: var(--bs-table-striped-color);">SUBTOTAL</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $query ="SELECT DISTINCT product.*, order_items.* 
                    FROM product
                    INNER JOIN order_items ON product.prodId = order_items.ProductID
                    INNER JOIN orders ON order_items.OrderID = orders.orderID
                    WHERE orders.orderID = '$inProgressOrderId'";

                    $query_run = mysqli_query($conn, $query);

                    if (mysqli_num_rows($query_run) > 0) {
                        foreach($query_run as $row) {
                            $subTotal = $row['Quantity'] * $row['prodPrice'];
                            $formattedSubAmt = number_format($subTotal, 2);

                            ?>
                            <tr style="height: 40px;">
                                <td><?php echo $row['prodName']; ?></td>
                                <td><?php echo $row['Quantity']; ?></td>
                                <td><?php echo $row['prodPrice']; ?></td>
                                <td><?php echo $formattedSubAmt; ?></td>
                            </tr>
                        <?php
                        }
                    }
                    else {  
                        ?> 
                        <tr> <td style="color:red; "> <?php echo '<strong>NO RECORD FOUND</strong>'; ?></td> </tr>
                    <?php 
                    }
                    ?>
                </tbody>
            </table>
        </div> <br> <br>
        <div class="row">
            <div class="col-md-6" style= "padding-left: 10%;">
                <p style="line-height: 80%;"><strong> Customer : <?php echo $indentation . $indentation . $indentation . $indentation . $discType . $indentation . $customerID;?></strong></p>
                <p style="line-height: 80%;"><strong> Net Amount : <?php echo isset($formattedTotalSubTotal) ?  $indentation . $indentation . $indentation . $p . $formattedTotalSubTotal : '0.00'; ?></strong></p>
                <p style="line-height: 80%;"><strong> Sales Discount : <?php echo isset($formattedDiscPercent) ? $indentation . $indentation . $formattedDiscPercent . ' %' : '0 %'; ?></strong></p>
                <p style="line-height: 80%;"><strong> Discount Amount: <?php echo isset($formattedDiscAmt) ? $indentation . $p . $formattedDiscAmt : '0.00'; ?></strong></p>
            </div>
            <div class="col-md-6">
                <p style="line-height: 80%;"><strong> VATable Sales : <?php echo isset($formattedVatSales) ? $indentation . $indentation . $indentation . '   ' . $p . $formattedVatSales : '0.00'; ?></strong> </p>
                <p style="line-height: 80%;"><strong> VAT 12% Amount :  <?php echo isset($formattedVatAmt) ? $indentation . $indentation . $p . $formattedVatAmt : '0.00'; ?></strong> </p>
                <p style="line-height: 80%;"><strong> Total Discount :  <?php echo isset($formattedTotalDisc) ? $indentation . $indentation . $indentation . $p . $formattedTotalDisc : '0.00'; ?></strong> </p>
                <p style="font-weight: bold;font-size: 24px;font-style: italic;"><strong>TOTAL BILL :  <?php echo isset($formattedTotalBill) ? $p . $formattedTotalBill : '0.00'; ?></strong> </p>
            </div>
        </div>
    </section>
</body>
</html>
