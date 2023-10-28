<script>
    var customerID = "<?php echo $customerID?>";
    var discType = "<?php echo $discType?>";
    var discountPercent = "<?php echo $discountPercent?>";
    var totalSubtotal = "<?php echo $totalSubtotal?>";
    var totalBill = "<?php echo $totalBill?>";
</script> 


<div id="paymentModal" class="modal">
    <div class="modal-content" style="display: flex; justify-content: space-between; align-items: center;">
        <span class="close" style="margin-left: 90%;">&times;</span>
        <br>    
        <div class="sec1" id="paymentContent" style="text-align: center;">
            <h2>Order ID: <?php echo $inProgressOrderId; ?></h2> <!-- Display the Order ID here -->
            <form method="post" id="paymentForm" class="input-group" enctype="multipart/form-data" action="">
                <label for="cash"><strong>Receive Cash Payment</strong></label><br>
                <input type="number" id="cashInput" name="cash" placeholder="" required><br><br><br>

                <div class="footer">
                    <button type="button" class="submit-btn" id="confirmBtn" onclick="calculateChange()">Confirm Payment</button>
                </div>
            </form> 
            <div id="paymentResults" style="display: none;">
                <p id="changeDisplay" style="text-align: center;"></p>
                <button class="submit-btn" style="margin-left:0px; width: 300px;" onclick="refreshPage()">Next Customer</button>
            </div>
        </div>
    </div>
</div>

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

        // Hide the payment form and display the payment results
        var paymentForm = document.getElementById('paymentForm');
        var paymentResults = document.getElementById('paymentResults');
        paymentForm.style.display = "none";
        paymentResults.style.display = "block";
    }
    
    function refreshPage() {
        var xhr = new XMLHttpRequest();
        var orderID = "<?php echo $inProgressOrderId; ?>"; 
        var change = document.getElementById('changeDisplay').innerText;
        change = change.replace('Change: ', ''); 

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

        var encodedProducts = encodeURIComponent(JSON.stringify(products));

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
