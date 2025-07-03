<?php
session_start();
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

    /* Ensure nav-bg also works on <nav> */
    .nav-bg {
      background-color: #41228e;
    }
  </style>
</head>

<body>
<div class="wrapper">
  <header class="navigation fixed-top nav-bg">
    <nav class="navbar navbar-expand-lg navbar-dark">
      
      <!-- LOGO -->
      <a class="navbar-brand" href="about.php">
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
          <li class="nav-item">
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

 <main class="content py-5">
  <div class="container text-center">
    <!-- Image Frame -->
    <div class="mb-4">
      <img src="creators.jpg" alt="Creators Photo" class="img-fluid rounded shadow" 
           style="max-height: 400px; width: auto; object-fit: cover;">
    </div>

    <!-- Title -->
    <h2 class="text-uppercase font-weight-bold mb-3">Creators</h2>

    <!-- Description -->
    <p class="lead" style="max-width: 700px; margin: 0 auto;">
      <!-- You can customize this text -->
      Welcome to Sweet Treats! This project is lovingly crafted by passionate developers and designers dedicated to making your candy shopping delightful and easy.
    </p>
  </div>
</main>

   

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
