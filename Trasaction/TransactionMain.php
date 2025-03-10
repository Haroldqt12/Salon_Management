<?php
include "../database/connectiondb.php";

// Fetch services from the database
$service_query = "SELECT service_id, service_name, price FROM services";
$service_result = $conn->query($service_query);

$stylist_query = "SELECT employee_id, first_name, last_name FROM employees WHERE role = 'HairStylist'";
$stylist_result = $conn->query($stylist_query);

if (!$service_result || !$stylist_result) {
    die("Query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Transaction</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
        rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
        rel="stylesheet">
  <link rel="stylesheet" 
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <style>
    .info-box { padding: 15px; border-radius: 5px; margin-top: 10px; background-color: #ffffff; }
    .search-bar { width: 100%; border: 1px solid #ced4da; border-radius: 5px; padding: 8px; font-size: 1rem; }
    .result-box { margin-top: 10px; border: 1px solid #ced4da; border-radius: 5px; padding: 10px; background-color: #f8f9fa; }
    .total-box { margin-top: 20px; font-weight: bold; }
  </style>
</head>

<body>
  <div class="col py-3">
    <div class="container">
      <div class="row">
        <div class="card py-3">
          <h3 class="lead">Transaction</h3>
          <div class="border border-dark"></div>

          <div class="col py-3">
            <!-- Transaction Date -->
            <div class="row mt-2">
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="Tdate">Transaction Date</label>
                  <input type="date" class="form-control" id="Tdate" name="Tdate" required>
                </div>
              </div>
            </div>

            <!-- Customer Search -->
            <div class="row justify-content-between mt-3">
              <div class="col-sm-4">
                <div class="input-group">
                  <input type="text" class="form-control" id="customer_id" name="customerId" placeholder="Customer ID" required>
                  <button class="btn btn-sm btn-primary">Search</button>
                </div>
              </div>
              <div class="col-sm-4 mt-3">
                <p>Customer Name:</p>
              </div>
            </div>

            <!-- Stylist Selection -->
            <div class="row justify-content-between mt-3">
              <div class="col-sm-4">
                <select class="form-control" id="stylist_id" name="stylist_id" required>
                  <option value="">Select a Stylist</option>
                  <?php while ($row = $stylist_result->fetch_assoc()): ?>
                    <option value="<?= $row['employee_id'] ?>">
                      <?= htmlspecialchars($row['first_name'] . " " . $row['last_name']) ?>
                    </option>
                  <?php endwhile; ?>
                </select>
              </div>
              <div class="col-sm-4 mt-3">
                <p>Stylist Name: <span id="stylist_name_display"></span></p>
              </div>
            </div>

            <!-- Service Selection -->
            <div class="border border-secondary mt-5"></div>
            <div class="row mt-5">
              <div class="col-sm-4">
                <label for="service_id">Service</label>
                <select class="form-control" id="service_id">
                  <option value="">Select a service</option>
                  <?php while ($row = $service_result->fetch_assoc()): ?>
                    <option value="<?= $row['price'] ?>">
                      <?= htmlspecialchars($row['service_name']) ?> - ₱<?= htmlspecialchars($row['price']) ?>
                    </option>
                  <?php endwhile; ?>
                </select>
              </div>
              <div class="col-sm-1 mt-4">
                <button class="btn btn-primary" onclick="submitService()">Submit</button>
              </div>
            </div>

            <!-- Selected Services and Total Amount -->
            <div class="row mt-3 justify-content-between">
              <div class="col-sm-3">
                <p>Avail Services:</p>
                <div id="available_services"></div>
              </div>
              <div class="col-sm-3">
                <p>Total Amount:</p>
                <div id="total_amount">₱0</div>
              </div>
            </div>

            <!-- Payment Method -->
            <div class="row mt-4">
              <div class="col-sm-4">
                <p>Payment:</p>
                <select class="form-control" id="payment_method" onchange="handlePaymentMethodChange()">
                  <option value="">Select Payment Method</option>
                  <option value="cash">Cash</option>
                  <option value="gcash">GCash</option>
                </select>
              </div>
            </div>
            <div class="row justify-content-end">
                    <div class="col-sm-1">
                        <button class="btn btn-sm btn-success w-100">Submit</button>
                    </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    let total = 0;

    function submitService() {
      const select = document.getElementById('service_id');
      const selectedValue = select.value;
      const availableServices = document.getElementById('available_services');

      if (selectedValue) {
        const serviceText = select.options[select.selectedIndex].text;
        const servicePrice = parseFloat(selectedValue);

        const newService = document.createElement('div');
        newService.className = 'result-box mt-2';
        newService.innerHTML = serviceText;
        availableServices.appendChild(newService);

        total += servicePrice;
        document.getElementById('total_amount').innerHTML = `₱${total}`;

        select.value = '';
      }
    }

    function handlePaymentMethodChange() {
      const paymentMethod = document.getElementById('payment_method').value;
      if (paymentMethod !== "") {
        alert(`Selected Payment Method: ${paymentMethod.toUpperCase()}\nTotal Amount: ₱${total}`);
      }
    }

    // Update stylist name when selected
    document.getElementById("stylist_id").addEventListener("change", function () {
      const stylistSelect = document.getElementById("stylist_id");
      const selectedText = stylistSelect.options[stylistSelect.selectedIndex].text;
      document.getElementById("stylist_name_display").innerText = selectedText;
    });
  </script>

</body>
</html>

<?php
$conn->close();
?>
