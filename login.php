<?php
session_start();
include 'db.php'; // make sure db.php is in the same directory

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'] ?? '';
  $password = $_POST['password'] ?? '';

  // Use prepared statement to prevent SQL injection
  $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();
  $user = $result->fetch_assoc();

  if ($user && password_verify($password, $user['password'])) {
    // Login success
    $_SESSION['user_data'] = $user;
    $_SESSION['username'] = $user['username'];
    header("Location: homepage.php");
    exit;
  } else {
    // Login failed
    $error = "<div class='alert alert-danger mt-3'>Invalid username or password.</div>";
  }

  $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
  <meta charset="utf-8">
  <title>Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="plugins/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="plugins/slick/slick.css">
  <link rel="stylesheet" href="plugins/themify-icons/themify-icons.css">
  <link href="css/style.css" rel="stylesheet">
  <link rel="icon" href="images/favicon.ico" type="image/x-icon">
</head>

<body>

<header class="navigation fixed-top nav-bg">
  <nav class="navbar navbar-expand-lg navbar-dark">

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
          <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="register.php">Register</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="login.php">Log-in</a>
        </li>
      </ul>
    </div>
  </nav>
</header>


<!-- Login Form -->
<section class="section section-on-footer" data-background="images/backgrounds/bg-dots.png">
  <div class="container">
    <div class="row">
      <div class="col-12 text-center">
        <h2 class="section-title">Log in for more updates!</h2>
      </div>
      <div class="col-lg-8 mx-auto">
        <div class="bg-white rounded text-center p-5 shadow-down">
          <h4 class="mb-4">Kindly fill up your details</h4>

          <form action="login.php" method="post" class="row">
            <!-- Error message (if any) -->
            <div class="col-md-12">
              <?php if (!empty($error)) echo $error; ?>
            </div>

            <!-- Username Field -->
            <div class="col-md-12">
              <input type="text" id="username" name="username" placeholder="Username" class="form-control px-0 mb-4" required>
            </div>

            <!-- Password Field -->
            <div class="col-md-12">
              <input type="password" id="password" name="password" placeholder="Password" class="form-control px-0 mb-4" required>
            </div>

            <!-- Submit Button -->
            <div class="col-lg-6 col-10 mx-auto">
              <input type="submit" name="login" value="Log-in" class="btn btn-primary w-100">
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</section>

<!-- Footer -->
<footer class="bg-dark footer-section">
  <div class="section">
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
  </div>
</footer>

<script src="plugins/jQuery/jquery.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>
