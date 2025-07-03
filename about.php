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
    <section class="page-title-alt bg-primary position-relative">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <h1 class="text-white font-tertiary">About Us</h1>
          </div>
        </div>
      </div>
      <!-- background shapes -->
      <img src="images/illustrations/leaf-bg-top.png" alt="illustrations" class="bg-shape-1 w-100">
      <img src="images/illustrations/dots-group-sm.png" alt="illustrations" class="bg-shape-2">
      <img src="images/illustrations/leaf-yellow.png" alt="illustrations" class="bg-shape-3">
      <img src="images/illustrations/leaf-orange.png" alt="illustrations" class="bg-shape-4">
      <img src="images/illustrations/dots-group-cyan.png" alt="illustrations" class="bg-shape-5">
      <img src="images/illustrations/leaf-cyan-lg.png" alt="illustrations" class="bg-shape-6">
    </section>
    <!-- /page title -->

    <!-- about -->
    <section class="section pt-5">
      <div class="container">
        <div class="row">
          <div class="col-md-8">
            <p>Welcome to your new happy place! Founded in January 2025, we are your go-to place for all things sweet. 
              From classic candies and creamy chocolates to fun and flavorful treats, we bring joy to every bite.</p>
            <p>We believe that every sweet treat should make you smile. 
              That’s why we focus on offering only the highest quality treats that you’ll love sharing, gifting, or enjoying for yourself.</p>
            <p>Whether you’re looking for a nostalgic favorite or something new to try, our wide selection has something for every sweet tooth. 
              Life is simply better with a sweet tooth, and we’re here to prove it.</p>
          </div>
          <div class="col-md-4 text-center drag-lg-top">
            <div class="shadow-down mb-4">
              <img src="pics/logo3.png" alt="author" class="img-fluid w-100 rounded-lg border-thick border-white">
            </div>
            <h4>Sweet Treats</h4>
            <a href="creators.php" class="btn btn-primary">The Creators</a>
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
