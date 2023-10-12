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
        <div id="discountModal" class="modal" >
            <div class="modal-content" style="display: flex; justify-content: space-between; align-items: center;">
                <span class="close" style="margin-left:90%;">&times;</span>
                <br>    
                <div class="sec1">
                    <form method="post" id="users" class="input-group" enctype="multipart/form-data"  action = ""> 
                        <label for="discType">Discount Type</label><br>
                        <select name="discType">
                            <option value="regular">Frequent Customer</option>
                            <option value="pwd">PWD</option>
                            <option value="senior">Senior</option>
                        </select> <br>
                    
                        <label for="discPercent">Discount Percentage</label> <br>
                        <input type="number" id="discPercent" name="discPercent" placeholder="20" value="" min=1 max=90 required> <br>
                        <label for="customerID">Customer ID Number</label><br> 
                        <input type="number" id="" name="customerID" placeholder="Just place 1 for regular customer" required><br><br><br>
                        
                        <div class="footer">
                            <button type="button" class="submit-btn" id="applyDiscountBtn">Apply Discount</button>
                        </div>
                    </form> 
                </div>
            </div>
        </div>
    </body>
</html>
