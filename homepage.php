<?php
session_start();

// If user is not logged in, redirect to login page
if (!isset($_SESSION['user_data']) || !is_array($_SESSION['user_data'])) {
    header("Location: login.php");
    exit;
}

$user = $_SESSION['user_data'];

// Safely extract user data
$fullname = $user['full_name'] ?? '';
$gender = $user['gender'] ?? '';
$dob = $user['dob'] ?? '';
$phone = $user['phone'] ?? '';
$email = $user['email'] ?? '';
$street = $user['street'] ?? '';
$city = $user['city'] ?? '';
$province = $user['province'] ?? '';
$zip = $user['zip'] ?? '';
$country = $user['country'] ?? '';
$username = $user['username'] ?? '';
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
            <h1 class="text-white font-tertiary">Welcome, <?php echo $username?>!</h1>
          </div>
        </div>

          <!-- background shapes -->
  <img src="images/illustrations/leaf-pink-round.png" alt="illustrations" class="bg-shape-2">
  <img src="images/illustrations/dots-cyan.png" alt="illustrations" class="bg-shape-3">
  <img src="images/illustrations/dots-group-cyan.png" alt="illustrations" class="bg-shape-6">
</section>

<section class="page-title bg-light position-relative content py-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8 col-lg-6">
        <div class="bg-white rounded-4 shadow p-5 border text-dark">
          <h3 class="mb-4 fw-bold text-center">Personal Information</h3>
          <hr class="mb-4">

          <div class="p-3 mb-3 border rounded bg-light">
            <span class="fw-semibold">Name:</span> <span class="text-dark fs-3"><?php echo $fullname; ?></span>
          </div>
          <div class="p-3 mb-3 border rounded bg-light">
            <span class="fw-semibold">Gender:</span> <span class="text-dark fs-3"><?php echo $gender; ?></span>
          </div>
          <div class="p-3 mb-3 border rounded bg-light">
            <span class="fw-semibold">Date of Birth:</span> <span class="text-dark fs-3"><?php echo $dob; ?></span>
          </div>
          <div class="p-3 mb-3 border rounded bg-light">
            <span class="fw-semibold">Phone:</span> <span class="text-dark fs-3"><?php echo $phone; ?></span>
          </div>
          <div class="p-3 mb-3 border rounded bg-light">
            <span class="fw-semibold">Email:</span> <span class="text-dark fs-3"><?php echo $email; ?></span>
          </div>
          <div class="p-3 mb-3 border rounded bg-light">
            <span class="fw-semibold">Street:</span> <span class="text-dark fs-3"><?php echo $street; ?></span>
          </div>
          <div class="p-3 mb-3 border rounded bg-light">
            <span class="fw-semibold">City:</span> <span class="text-dark fs-3"><?php echo $city; ?></span>
          </div>
          <div class="p-3 mb-3 border rounded bg-light">
            <span class="fw-semibold">Province:</span> <span class="text-dark fs-3"><?php echo $province; ?></span>
          </div>
          <div class="p-3 mb-3 border rounded bg-light">
            <span class="fw-semibold">ZIP:</span> <span class="text-dark fs-3"><?php echo $zip; ?></span>
          </div>
          <div class="p-3 border rounded bg-light">
            <span class="fw-semibold">Country:</span> <span class="text-dark fs-3"><?php echo $country; ?></span>
          </div>
          <div class="p-3 mt-3 border rounded bg-light">
            <span class="fw-semibold">Username:</span> <span class="text-dark fs-3"><?php echo $username; ?></span>
          </div>

        </div>
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
