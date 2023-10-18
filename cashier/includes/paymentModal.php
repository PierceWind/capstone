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
        <div id="paymentModal" class="modal">
            <div class="modal-content" style="display: flex; justify-content: space-between; align-items: center;">
                <span class="close" style="margin-left: 90%;">&times;</span>
                <br>    
                <div class="sec1">
                    <form method="post" id="users" class="input-group" enctype="multipart/form-data" action="">
                        <label for="cash" style="float:center;"><strong>Cash Payment</strong></label><br>
                        <input type="number" id="" name="cash" placeholder="" required><br><br><br>

                        <div class="footer">
                            <button type="button" class="submit-btn" id="confirmBtn">Confirm Payment</button>
                        </div>
                    </form> 
                </div>
            </div>
        </div>
    </body>
</html>
