<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_data']) || !is_array($_SESSION['user_data'])) {
    header("Location: login.php");
    exit;
}

$user = $_SESSION['user_data'];
$user_id = $user['id'] ?? 0;

// Extract shipping details
$fullname = $user['full_name'] ?? '';
$phone = $user['phone'] ?? '';
$email = $user['email'] ?? '';

// Fetch cart items
$stmt = $conn->prepare("SELECT * FROM cart_items WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$items = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

$grand_total = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Checkout</title>
  <link rel="stylesheet" href="plugins/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header class="navigation fixed-top nav-bg">
  <nav class="navbar navbar-expand-lg navbar-dark">
    <a class="navbar-brand" href="homepage.php">
      <img src="pics/logo2.png" alt="Logo" style="height: 60px;">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse text-center" id="navigation">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item"><a class="nav-link" href="homepage.php">Account</a></li>
        <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
        <li class="nav-item active"><a class="nav-link" href="products.php">Products</a></li>
        <li class="nav-item"><a class="nav-link" href="cart.php">Cart</a></li>
        <li class="nav-item"><a class="nav-link" href="logout.php">Log-out</a></li>
      </ul>
    </div>
  </nav>
</header>

<div class="container mt-5 pt-4">
  <h2 class="mb-4">Checkout</h2>

  <form id="checkoutForm" method="post" onsubmit="return handleSubmit()">
    <!-- Shipping Info -->
    <div class="card mb-4">
      <div class="card-header bg-primary text-white">Shipping Information</div>
      <div class="card-body">
        <p><strong>Name:</strong> <?= htmlspecialchars($fullname) ?></p>
        <p><strong>Phone:</strong> <?= htmlspecialchars($phone) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($email) ?></p>
        <div class="form-group">
          <label for="shipping_address"><strong>Address:</strong></label>
          <textarea class="form-control" id="shipping_address" name="shipping_address" rows="3" required></textarea>
        </div>
      </div>
    </div>

    <!-- Payment Method -->
    <div class="card mb-4">
      <div class="card-header bg-warning text-dark">Payment Method</div>
      <div class="card-body">
        <div class="form-group">
          <label for="payment_method"><strong>Select Payment Method:</strong></label>
          <select class="form-control" id="payment_method" name="payment_method" required>
            <option value="">-- Choose --</option>
            <option value="Cash on Delivery">Cash on Delivery</option>
            <option value="Credit Card">Credit Card</option>
          </select>
        </div>
      </div>
    </div>

    <!-- Cart Summary -->
    <div class="card">
      <div class="card-header bg-success text-white">Order Summary</div>
      <div class="card-body">
        <?php if (!empty($items)): ?>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Product</th>
              <th>Price (₱)</th>
              <th>Quantity</th>
              <th>Total (₱)</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($items as $item): 
              $total = $item['price'] * $item['quantity'];
              $grand_total += $total;
            ?>
            <tr>
              <td><?= htmlspecialchars($item['product_name']) ?></td>
              <td><?= number_format($item['price'], 2) ?></td>
              <td><?= $item['quantity'] ?></td>
              <td><?= number_format($total, 2) ?></td>
            </tr>
            <?php endforeach; ?>

            <?php
              $vat = $grand_total * 0.12;
              $total_with_vat = $grand_total + $vat;
            ?>

            <tr>
              <th colspan="3" class="text-right">Subtotal:</th>
              <td>₱<?= number_format($grand_total, 2) ?></td>
            </tr>
            <tr>
              <th colspan="3" class="text-right">VAT (12%):</th>
              <td>₱<?= number_format($vat, 2) ?></td>
            </tr>
            <tr>
              <th colspan="3" class="text-right">Total with VAT:</th>
              <th>₱<?= number_format($total_with_vat, 2) ?></th>
            </tr>
          </tbody>
        </table>
        <?php else: ?>
          <p>Your cart is empty.</p>
        <?php endif; ?>
      </div>
    </div>

    <!-- Confirm Button -->
    <div class="text-center mt-4">
      <button type="submit" class="btn btn-primary btn-lg">Place Order</button>
    </div>
  </form>
</div>

<!-- Footer -->
<footer class="bg-dark footer-section mt-5">
  <div class="container">
    <div class="row">
      <div class="col-md-4"><h5 class="text-light">Email</h5><p class="text-white">sweet.treats@gmail.com</p></div>
      <div class="col-md-4"><h5 class="text-light">Phone</h5><p class="text-white">0977-135-2302</p></div>
      <div class="col-md-4"><h5 class="text-light">Address</h5><p class="text-white">10 Santa Teresita, Caloocan City</p></div>
    </div>
  </div>
</footer>

<script>
function handleSubmit() {
  const payment = document.getElementById('payment_method').value;
  const address = document.getElementById('shipping_address').value.trim();

  if (!payment) {
    alert('Please select a payment method.');
    return false;
  }

  if (!address) {
    alert('Please enter your shipping address.');
    return false;
  }

  document.getElementById('checkoutForm').action = 'thankyou.php';
  return true;
}
</script>

</body>
</html>
