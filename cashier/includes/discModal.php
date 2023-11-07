<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Apply Discount</title>
        <link rel="stylesheet" type="text/css" href="../style.css">
    </head>
    <body>
        <div id="discountModal" class="modal">
            <div class="modal-content" style="display: flex; justify-content: space-between; align-items: center;">
                <span class="close" style="margin-left: 90%;">&times;</span>
                <br>    
                <div class="sec1">
                    <form method="post" id="users" class="input-group" enctype="multipart/form-data" action="">
                        <label for="discType">Discount Type</label><br>
                        <select name="discType">
                            <option value="frequent">Frequent Customer</option>
                            <option value="pwd">PWD</option>
                            <option value="senior">Senior</option>
                        </select> <br>

                        <label for="discPercent">Discount Percentage</label> <br>
                        <input type="number" id="discPercent" name="discPercent" placeholder="20" value="20" min=1 max=90 required> <br>
                        <label for="customerID">Customer ID Number</label><br>
                        <input type="number" id="" name="customerID" placeholder="Just place 1 for a regular customer" required><br><br><br>

                        <div class="footer">
                            <button type="button" class="submit-btn" id="applyBtn" style="margin-left:15px; width: 300px;" >Apply Discount</button>
                        </div>
                    </form> 
                </div>
            </div>
        </div>

        <script type="text/javascript">
            document.addEventListener('DOMContentLoaded', function () {
                var applyDiscountBtn = document.getElementById("applyBtn");
                var discTypeInput = document.querySelector("select[name='discType']");
                var discPercentInput = document.querySelector("input[name='discPercent']");
                var customerIDInput = document.querySelector("input[name='customerID']");

                applyDiscountBtn.addEventListener('click', function () {
                    // Get the selected values
                    var discType = discTypeInput.value;
                    var discPercent = discPercentInput.value !== '' ? discPercentInput.value : 0; // Set to 0 if empty
                    var customerID = customerIDInput.value;

                    // Check if a discount type is selected, and if so, pass the values to index.php
                    if (discType) {
                        // Pass the values using JavaScript by setting them as query parameters in the URL
                        window.location.href = 'index.php?discType=' + discType + '&discPercent=' + discPercent + '&customerID=' + customerID;
                    }

                    // Close the discount modal
                    var modal = document.getElementById("discountModal");
                    modal.style.display = "none";
                });
            });
        </script>
    </body>
</html>