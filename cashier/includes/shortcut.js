document.addEventListener('keydown', function(event) {
    if (event.key === 'Enter') {
        // Check if the target element is an input field, if not, trigger the click event on the CONFIRM button
        if (document.activeElement.tagName.toLowerCase() !== 'input') {
            document.getElementById('paymentBtn').click();
        }
    }
});



/* PAYMENT MODAL BUTTON
document.addEventListener('DOMContentLoaded', function () {
    var cashInput = document.getElementById('cashInput');
    var confirmBtn = document.getElementById('confirmBtn');
    var printReceiptButton = document.getElementById('printReceipt');
    var paymentModal = document.getElementById('paymentModal');

    cashInput.addEventListener('keyup', function (event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            confirmBtn.click(); // Trigger the Confirm Payment button
        }
    });

    paymentModal.addEventListener('keyup', function (event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            if (confirmBtn.style.display !== 'none') {
                confirmBtn.click(); // Trigger the Confirm Payment button
            } else if (printReceiptButton.style.display !== 'none') {
                printReceiptButton.click(); // Trigger the View Receipt button
            }
        }
    });
});
*/