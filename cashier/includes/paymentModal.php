

<?php  include('server.php');

if (isset($_POST['confirmPaymentBtn'])) {
    $cashPaid = isset($_POST['cashPaid']) ? (float)$_POST['cashPaid'] : 0.0;
    $orderID = isset($_POST['orderID']) ? $_POST['orderID'] : 0;
    $customerID = isset($_POST['customerID']) ? $_POST['customerID'] : 0;
    $discType = isset($_POST['discType']) ? $_POST['discType'] : '';
    $discPercent = isset($_POST['discPercent']) ? (float)$_POST['discPercent'] : 0.0;
    $totalSubtotal = isset($_POST['totalSubtotal']) ? (float)$_POST['totalSubtotal'] : 0.0;
    $totalBill = isset($_POST['totalBill']) ? (float)$_POST['totalBill'] : 0.0;
    $products = isset($_POST['products']) ? json_decode($_POST['products'], true) : [];

    // Here you can perform the necessary operations with the received values, such as saving them to the database or processing the payment.

    // Redirect to the generate_receipt.php page
    header("Location: includes/generate_receipt.php?orderID=$orderID&customerID=$customerID&discType=$discType&discountPercent=$discPercent&totalSubtotal=$totalSubtotal&totalBill=$totalBill&products=" . urlencode(json_encode($products)));
    exit();
}

?>





<div id="paymentModal" class="modal">
    <div class="modal-content" style="display: flex; justify-content: space-between; align-items: center;">
        <span class="close" style="margin-left: 90%;">&times;</span>
        <br>    
        <div class="sec1" id="paymentContent" style="text-align: center;">
            <h2 id="inProgressOrderId" >Order ID: <?php echo $inProgressOrderId; ?></h2>
            <form method="post" id="paymentForm" class="input-group" enctype="multipart/form-data" action="">
                <label for="cash"><strong>Receive Cash Payment</strong></label><br>
                <input type="hidden" id="inProgressOrderId" name="inProgressOrderId" placeholder="" required>
                <input type="number" id="cashInput" name="cash" placeholder="" required><br><br><br>

                <div class="footer">
                    <button type="button" class="submit-btn" id="confirmBtn" style="margin-left:15px; width: 300px;" onclick="calculateChange()">Confirm Payment</button>
                </div>
            </form> 
            <div id="paymentResults" style="display: none;">
                <p id="changeDisplay" style="text-align: center;"></p>
            </div>
            <div id="printReceipt" style="display: none;">
                <button class="submit-btn" style="margin-left:0px; width: 300px;" onclick="printReceipt()">Print Receipt</button>
            </div>
            <div id="nextCustomer" style="display: none;">
                <button class="submit-btn" style="margin-left:0px; width: 300px;" onclick="refreshPage()">Next Customer</button>
            </div>
        </div>
    </div>
</div>




<script> 
   function printReceipt(orderID, queueNum, customerID, discType, discountPercent, discAmt, vatSales, vatAmt, totalDiscAmt, totalSubtotal, totalBill, encodedProducts) {
    var xhr = new XMLHttpRequest();
    var orderID = <?php echo isset($inProgressOrderId) ? $inProgressOrderId : 0; ?>;
    var customerID = <?php echo isset($customerID) ? $customerID : 0; ?>;
    var queueNum = <?php echo isset($inProgressQueueNum) ? $inProgressQueueNum : 0; ?>;
    var discType = "<?php echo isset($discType) ? $discType : 'regular'; ?>";
    var discountPercent = <?php echo isset($discountPercent) ? $discountPercent : 0.00; ?>;
    var discAmt = <?php echo isset($discAmt) ? $discAmt : 0.00; ?>;
    var vatSales = <?php echo isset($vatSales) ? $vatSales : 0.00; ?>;
    var vatAmt = <?php echo isset($vatAmt) ? $vatAmt : 0.00; ?>;
    var totalSubtotal = <?php echo isset($totalSubtotal) ? $totalSubtotal : 0.00; ?>;
    var cashInput = document.getElementById('cashInput').value;
    var totalBill = <?php echo isset($formattedTotalBill) ? $totalBill : 0.00; ?>;
    var change = cashInput - totalBill;
    var changeDisplay = document.getElementById('changeDisplay').innerText;
    changeDisplay = changeDisplay.replace('Change: ', '');

    var rows = document.getElementById('order-list').getElementsByTagName('tr');
    var products = [];

    for (var i = 0; i < rows.length; i++) {
        var cells = rows[i].getElementsByTagName('td');
        if (cells.length > 0) {
            var product = {
                description: cells[0].innerText,
                quantity: cells[1].innerText,
                unitPrice: cells[2].innerText,
                subtotal: cells[3].innerText
            };
            products.push(product);
        }
    }

    encodedProducts = encodeURIComponent(JSON.stringify(products));


    var url = "includes/generate_receipt.php?customerID=" + customerID + "&orderID=" + orderID + "&queueNum=" + queueNum + "&discType=" + discType + "&discountPercent=" + discountPercent + "&discAmt=" + discAmt + "&vatSales=" + vatSales + "&vatAmt=" + vatAmt + "&totalDiscAmt=" + totalDiscAmt + "&totalSubtotal=" + totalSubtotal + "&totalBill=" + totalBill + "&products=" + encodedProducts + "&cashInput=" + cashInput + "&change=" + change;
    xhr.open("GET", url, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var receiptWindow = window.open("", "_blank", "width=600, height=600, top=200, left=200");
                receiptWindow.document.write(xhr.responseText);
                receiptWindow.document.close();
            } else {
                alert("Failed to update order status");
            }
            refreshPage(); // Call the refreshPage function to update the order status
        }
    };
    xhr.send();
}

</script>

<script>
    function calculateChange() {
        var cashInput = document.getElementById('cashInput').value;
        var totalBill = <?php echo isset($formattedTotalBill) ? $totalBill : 0; ?>;
        var change = cashInput - totalBill;
        if (cashInput < totalBill) {
            alert("Insufficient payment. Please provide the complete amount.");
            return;
        }

        var formattedChange = change.toFixed(2); // Format to 2 decimal places
        var changeDisplay = document.getElementById('changeDisplay');
        changeDisplay.innerHTML = "<strong>Change: " + formattedChange + "</strong>";

        // Hide the payment form and display the payment results and print button
        var paymentForm = document.getElementById('paymentForm');
        var paymentResults = document.getElementById('paymentResults');
        var printReceiptButton = document.getElementById('printReceipt');
        paymentForm.style.display = "none";
        paymentResults.style.display = "block";
        printReceiptButton.style.display = "block";
    }

</script> 


<script>


    
    function refreshPage() {
        // Your code to update order status goes here
        var xhr = new XMLHttpRequest();
        var url = "index.php?orderID=" + orderID + "&change=" + change + "&customerID=" + customerID + "&discType=" + discType + "&discountPercent=" + discountPercent + "&totalSubtotal=" + totalSubtotal + "&totalBill=" + totalBill + "&products=" + encodedProducts;
        xhr.open("GET", url, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    alert("Order status updated to Paid");
                } else {
                    alert("Failed to update order status");
                }
                location.reload();
            }
        };
        xhr.send();
    }
</script>
