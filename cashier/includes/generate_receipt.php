<!-- Include the jsPDF library -->
<script src="../../files/assets/js/jspdf.umd.min.js"></script>

<script>
    function generateReceiptPDF(orderID, queueNumber, customerID, discType, formattedDiscPercent, formattedDiscAmt, formattedVatSales, formattedVatAmt, inProgressOrderId, totalAmount, cashInput, change, orderItems) {
        var doc = new jsPDF();
        doc.text("To Die For Foods - Manila", 10, 10);
        doc.text("1159 Zobel Roxas corner Espiritu St.", 10, 20);
        doc.text("Barangay 757, Manila, 1009 Metro Manila,", 10, 30);
        doc.text("NCR, Philippines", 10, 40);
        doc.text("CONTACT NO: 0920 230 9787", 10, 50);
        doc.text("--------------------------------------------", 10, 60);
        doc.text("Date: " + new Date().toLocaleDateString(), 10, 70);
        doc.text("Order Number: " + orderID, 10, 80);
        doc.text("Queue Number: " + queueNumber, 10, 90);
        doc.text("CUSTOMER INFORMATION", 10, 100);
        doc.text("Customer: " + customerID, 10, 110);
        doc.text("Type: " + discType, 10, 120);
        doc.text("-----------------------------------------------", 10, 130);

        var startY = 140;
        for (var i = 0; i < orderItems.length; i++) {
            var item = orderItems[i];
            doc.text(item.itemName, 10, startY + 10 * i);
            doc.text(item.quantity, 50, startY + 10 * i);
            doc.text(item.unitPrice, 90, startY + 10 * i);
            doc.text(item.subtotal, 130, startY + 10 * i);
        }

        doc.text("-----------------------------------------------------------------", 10, startY + 10 * orderItems.length);
        doc.text("Total Amount: " + totalAmount, 10, startY + 10 * orderItems.length + 10);
        doc.text("Amt Tendered (CASH): " + cashInput, 10, startY + 10 * orderItems.length + 20);
        doc.text("Change: " + change, 10, startY + 10 * orderItems.length + 30);
        doc.text("-----------------------------------------------", 10, startY + 10 * orderItems.length + 40);
        doc.text("Sales Discount: " + formattedDiscPercent, 10, startY + 10 * orderItems.length + 50);
        doc.text("Discount Amt: " + formattedDiscAmt, 10, startY + 10 * orderItems.length + 60);
        doc.text("VATable Sales: " + formattedVatSales, 10, startY + 10 * orderItems.length + 70);
        doc.text("VAT 12% Amt: " + formattedVatAmt, 10, startY + 10 * orderItems.length + 80);
        doc.text("-----------------------------------------------", 10, startY + 10 * orderItems.length + 90);
        doc.text("Order Received in Good Condition & on Time", 10, startY + 10 * orderItems.length + 100);
        doc.text("Your Cravings Satisfied here at TDF FOODS :)", 10, startY + 10 * orderItems.length + 110);
        doc.text("THANK YOU FOR YOUR ORDER!", 10, startY + 10 * orderItems.length + 120);
        doc.text("BON APPETITE!", 10, startY + 10 * orderItems.length + 130);

        doc.save("receipt_" + orderID + ".pdf");
    }
</script>
