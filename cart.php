<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_data'])) {
  header("Location: login.php");
  exit;
}

$user_id = $_SESSION['user_data']['id'];
$total = 0;

// Handle item removal
if (isset($_POST['remove_item'])) {
  $stmt = $conn->prepare("DELETE FROM cart_items WHERE user_id = ? AND product_name = ?");
  $stmt->bind_param("is", $user_id, $_POST['remove_item']);
  $stmt->execute();
}

// Fetch cart items
$stmt = $conn->prepare("SELECT * FROM cart_items WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$items = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My Cart</title>
  <link rel="stylesheet" href="plugins/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
  <style>
    html, body { height: 100%; }
    .wrapper {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      padding-top: 80px;
    }
    .container.mt-5.pt-5 { flex: 1; }
  </style>
</head>

<body>
<header class="navigation fixed-top nav-bg">
  <nav class="navbar navbar-expand-lg navbar-dark">
    <a class="navbar-brand" href="about.php">
      <img src="pics/logo2.png" alt="Logo" style="height: 60px;">
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
      aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse text-center" id="navigation">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item"><a class="nav-link" href="homepage.php">Account</a></li>
        <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
        <li class="nav-item"><a class="nav-link" href="products.php">Products</a></li>
        <li class="nav-item active"><a class="nav-link" href="cart.php">Cart</a></li>
        <li class="nav-item"><a class="nav-link" href="logout.php">Log-out</a></li>
      </ul>
    </div>
  </nav>
</header>

<div class="container mt-5 pt-5">
  <h2 class="mb-4">Your Shopping Cart</h2>

  <?php if (!empty($items)): ?>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Product</th>
          <th>Price (₱)</th>
          <th>Quantity</th>
          <th>Total (₱)</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($items as $item): 
          $subtotal = $item['price'] * $item['quantity'];
          $total += $subtotal;
        ?>
        <tr>
          <td><?= htmlspecialchars($item['product_name']) ?></td>
          <td><?= number_format($item['price'], 2) ?></td>
          <td><?= $item['quantity'] ?></td>
          <td><?= number_format($subtotal, 2) ?></td>
          <td>
            <form method="post">
              <button name="remove_item" value="<?= htmlspecialchars($item['product_name']) ?>" class="btn btn-sm btn-danger">Remove</button>
            </form>
          </td>
        </tr>
        <?php endforeach; ?>
        <tr>
          <th colspan="3" class="text-right">Grand Total:</th>
          <th colspan="2">₱<?= number_format($total, 2) ?></th>
        </tr>
      </tbody>
    </table>
    <a href="checkout.php" class="btn btn-secondary">Proceed to Checkout</a>
  <?php else: ?>
    <p>Your cart is empty. <a href="products.php">Start shopping</a>.</p>
  <?php endif; ?>
</div>

<footer class="bg-dark footer-section mt-5">
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <h5 class="text-light">Email</h5>
        <p class="text-white paragraph-lg font-secondary">sweet.treats@gmail.com</p>
      </div>
      <div class="col-md-4">
        <h5 class="text-light">Phone</h5>
        <p class="text-white paragraph-lg font-secondary">0977-135-2302</p>
      </div>
      <div class="col-md-4">
        <h5 class="text-light">Address</h5>
        <p class="text-white paragraph-lg font-secondary">10 Santa Teresita, Caloocan City</p>
      </div>
    </div>
  </div>
</footer>

<script src="plugins/jQuery/jquery.min.js"></script>
<script src="plugins/bootstrap/bootstrap.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>
