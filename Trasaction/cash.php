<!-- Cash Payment Modal -->
<div class="modal fade" id="cashPaymentModal" tabindex="-1" role="dialog" aria-labelledby="cashPaymentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cashPaymentModalLabel">Cash Payment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="cashPaymentForm">
                    <div class="form-group">
                        <label for="cashReceived">Cash Received:</label>
                        <input type="text" class="form-control" id="cashReceived" placeholder="Enter cash received" required>
                    </div>
                    <div class="form-group">
                        <label for="totalAmount">Total Amount:</label>
                        <input type="text" class="form-control" id="totalAmount" placeholder="Enter total amount" required>
                    </div>
                    <div class="form-group">
                        <label for="changeAmount">Change:</label>
                        <input type="text" class="form-control" id="changeAmount" placeholder="Change" required readonly>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="submitCashPayment">Submit</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function() {
        // Automatically show the modal
        $('#cashPaymentModal').modal('show');

        // Function to calculate change for Cash Payment
        function calculateChange() {
            const totalAmount = parseFloat($('#totalAmount').val()) || 0;
            const cashReceived = parseFloat($('#cashReceived').val()) || 0;
            const change = cashReceived - totalAmount;
            $('#changeAmount').val(change >= 0 ? change.toFixed(2) : 0);
        }

        // Detect Enter key press to calculate change
        $('#totalAmount, #cashReceived').on('keypress', function(event) {
            if (event.which === 13) { // 13 is the Enter key
                event.preventDefault(); // Prevent form submission
                calculateChange(); // Calculate change
            }
        });

        // Reset fields when the modal is shown
        $('#cashPaymentModal').on('show.bs.modal', function () {
            $('#cashPaymentForm')[0].reset(); // Reset the form fields
            $('#changeAmount').val(''); // Clear the change field
        });

        $('#submitCashPayment').click(function() {
            // Handle form submission logic here
            const totalAmount = $('#totalAmount').val();
            const cashReceived = $('#cashReceived').val();
            const changeAmount = $('#changeAmount').val();

            // Example: Display the values in the console (you can replace this with your submission logic)
            console.log("Total Amount:", totalAmount);
            console.log("Cash Received:", cashReceived);
            console.log("Change:", changeAmount);

            // Close the modal after submission
            $('#cashPaymentModal').modal('hide');
        });
    });
</script>

<!-- Include Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<style>
    /* Ensure the modal is responsive */
    .modal-dialog {
        max-width: 500px; /* Limit modal width */
        margin: 1.75rem auto; /* Center the modal */
    }
    .form-group {
        margin-bottom: 1rem; /* Space between fields */
    }
</style>