<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_data'])) {
    header("Location: login.php");
    exit;
}

$user = $_SESSION['user_data'];
$user_id = $user['id'];

// Get form inputs
$payment_method = $_POST['payment_method'] ?? '';
$shipping_address = $_POST['shipping_address'] ?? '';

// 1. Calculate total from cart
$total_amount = 0;
$cart_query = $conn->prepare("SELECT * FROM cart_items WHERE user_id = ?");
$cart_query->bind_param("i", $user_id);
$cart_query->execute();
$cart_result = $cart_query->get_result();

$cart_items = [];
while ($row = $cart_result->fetch_assoc()) {
    $cart_items[] = $row;
    $total_amount += $row['price'] * $row['quantity'];
}


// 4. Clear the cart
$clear = $conn->prepare("DELETE FROM cart_items WHERE user_id = ?");
$clear->bind_param("i", $user_id);
$clear->execute();
?>


<!DOCTYPE html>
<html lang="zxx">

<head>
  <meta charset="utf-8">
  <title>Welcome Page</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="stylesheet" href="plugins/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="plugins/slick/slick.css">
  <link rel="stylesheet" href="plugins/themify-icons/themify-icons.css">
  <link href="css/style.css" rel="stylesheet">
  <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
  <link rel="icon" href="images/favicon.ico" type="image/x-icon">

  <style>
    html, body {
      height: 100%;
    }

    .wrapper {
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    .content {
      flex: 1;
    }

    .page-title {
      padding: 100px 0 50px; /* reduced from 250px/150px */
    }

      .profile-card:hover {
    box-shadow: 0 0 20px rgba(0,0,0,0.1);
    transform: translateY(-3px);
    transition: all 0.3s ease;
  }

  </style>
</head>

<body>
 <header class="navigation fixed-top nav-bg">
    <nav class="navbar navbar-expand-lg navbar-dark">
      
      <!-- LOGO -->
      <a class="navbar-brand" href="homepage.php">
        <img src="pics/logo2.png" alt="Logo" style="height: 60px;">
      </a>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
        aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse text-center" id="navigation">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="homepage.php">Account</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about.php">About</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="products.php">Products</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="cart.php">Cart</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Log-out</a>
          </li>
        </ul>
      </div>
    </nav>
  </header>


    <!-- page title -->
    <section class="page-title bg-primary position-relative content">
      <div class="container">
        <div class="row">
          <div class="col-12 text-center">
            <h1 class="text-white font-tertiary">Thank You for Ordering!</h1>
           </div>
      </div>
    </div>
  </section>



    <!-- footer -->
<footer class="bg-dark footer-section">
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
    <!-- /footer -->
  </div>

  <script src="plugins/jQuery/jquery.min.js"></script>
  <script src="js/script.js"></script>
</body>

</html>
