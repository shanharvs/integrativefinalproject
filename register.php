<?php
session_start();
include 'db.php'; // connect to DB

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $full_name = $_POST['full_name'] ?? '';
  $gender = $_POST['gender'] ?? '';
  $dob = $_POST['dob'] ?? '';
  $phone = $_POST['phone'] ?? '';
  $email = $_POST['email'] ?? '';
  $street = $_POST['street'] ?? '';
  $city = $_POST['city'] ?? '';
  $province = $_POST['province'] ?? '';
  $zip = $_POST['zip'] ?? '';
  $country = $_POST['country'] ?? '';
  $username = $_POST['username'] ?? '';
  $password = $_POST['password'] ?? '';
  $confirm_password = $_POST['confirm_password'] ?? '';

  // your validations (unchanged)...
  if (!preg_match("/^[a-zA-Z\s]{2,50}$/", $full_name)) {
    $errors['full_name'] = "Full name must be 2-50 characters and contain only letters and spaces.";
  }
  if (empty($gender)) $errors['gender'] = "Please select your gender.";
  if (empty($dob) || (new DateTime())->diff(new DateTime($dob))->y < 18) {
    $errors['dob'] = "You must be at least 18 years old.";
  }
  if (!preg_match("/^09\d{9}$/", $phone)) {
    $errors['phone'] = "Phone number must be 11 digits and start with 09.";
  }
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = "Invalid email format.";
  }
  if (!preg_match("/^[\w\s.,#-]{5,100}$/", $street)) {
    $errors['street'] = "Street must be 5-100 characters and contain only allowed characters.";
  }
  if (!preg_match("/^[a-zA-Z\s]{2,50}$/", $city)) {
    $errors['city'] = "City must be 2-50 characters and contain only letters and spaces.";
  }
  if (!preg_match("/^[a-zA-Z\s]{2,50}$/", $province)) {
    $errors['province'] = "Province must be 2-50 characters and contain only letters and spaces.";
  }
  if (!preg_match("/^\d{4}$/", $zip)) {
    $errors['zip'] = "Zip code must be exactly 4 digits.";
  }
  if (!preg_match("/^[a-zA-Z\s]+$/", $country)) {
    $errors['country'] = "Country must contain only letters and spaces.";
  }
  if (!preg_match("/^\w{5,20}$/", $username)) {
    $errors['username'] = "Username must be 5-20 characters and contain only letters, numbers, and underscores.";
  }
  if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/", $password)) {
    $errors['password'] = "Password must be at least 8 characters with uppercase, lowercase, number, and special character.";
  }
  if ($password !== $confirm_password) {
    $errors['confirm_password'] = "Passwords do not match.";
  }

  // Insert into database if no errors
  if (empty($errors)) {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users 
      (full_name, gender, dob, phone, email, street, city, province, zip, country, username, password)
      VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssssss",
      $full_name, $gender, $dob, $phone, $email,
      $street, $city, $province, $zip, $country,
      $username, $hashed_password);

    if ($stmt->execute()) {
      $_SESSION['user_data'] = [
        'full_name' => $full_name,
        'gender' => $gender,
        'dob' => $dob,
        'phone' => $phone,
        'email' => $email,
        'street' => $street,
        'city' => $city,
        'province' => $province,
        'zip' => $zip,
        'country' => $country,
        'username' => $username,
      ];
      $_SESSION['username'] = $username;
      header("Location: login.php?registered=1");
      exit;
    } else {
      $errors['general'] = "Error: " . $stmt->error;
    }

    $stmt->close();
  }
}
?>

<!DOCTYPE html>
<html lang="zxx">
<head>
  <meta charset="utf-8">
  <title>Registration Form</title>
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

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse text-center" id="navigation">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active"><a class="nav-link" href="index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
        <li class="nav-item"><a class="nav-link" href="login.php">Log-in</a></li>
      </ul>
    </div>
  </nav>
</header>

<section class="section section-on-footer" data-background="images/backgrounds/bg-dots.png">
  <div class="container">
    <div class="row">
      <div class="col-12 text-center">
        <h2 class="section-title">Registration Form</h2>
      </div>

      <div class="col-lg-8 mx-auto">
        <div class="bg-white rounded text-center p-5 shadow-down">
          <form action="" method="post" class="row">

            <div class="col-md-12">
              <h4 class="mb-4">Personal Information</h4>

              <?php if (!empty($errors['full_name'])): ?>
                <div class="text-danger text-left mb-1"><?php echo $errors['full_name']; ?></div>
              <?php endif; ?>
              <input type="text" name="full_name" placeholder="Full Name" class="form-control px-0 mb-4" value="<?php echo htmlspecialchars($full_name ?? '') ?>">

              <?php if (!empty($errors['gender'])): ?>
                <div class="text-danger text-left mb-1"><?php echo $errors['gender']; ?></div>
              <?php endif; ?>
              <select name="gender" class="form-control px-0 mb-4">
                <option value="">Select Gender</option>
                <option value="male" <?php if (($gender ?? '') === 'male') echo 'selected'; ?>>Male</option>
                <option value="female" <?php if (($gender ?? '') === 'female') echo 'selected'; ?>>Female</option>
                <option value="other" <?php if (($gender ?? '') === 'other') echo 'selected'; ?>>Other</option>
              </select>

              <?php if (!empty($errors['dob'])): ?>
                <div class="text-danger text-left mb-1"><?php echo $errors['dob']; ?></div>
              <?php endif; ?>
              <input type="date" name="dob" class="form-control px-0 mb-4" value="<?php echo htmlspecialchars($dob ?? '') ?>">

              <?php if (!empty($errors['phone'])): ?>
                <div class="text-danger text-left mb-1"><?php echo $errors['phone']; ?></div>
              <?php endif; ?>
              <input type="tel" name="phone" placeholder="Phone Number" class="form-control px-0 mb-4" value="<?php echo htmlspecialchars($phone ?? '') ?>">

              <?php if (!empty($errors['email'])): ?>
                <div class="text-danger text-left mb-1"><?php echo $errors['email']; ?></div>
              <?php endif; ?>
              <input type="email" name="email" placeholder="Email" class="form-control px-0 mb-4" value="<?php echo htmlspecialchars($email ?? '') ?>">
            </div>

            <div class="col-md-12 mt-4">
              <h4 class="mb-4">Address Details</h4>

              <?php if (!empty($errors['street'])): ?>
                <div class="text-danger text-left mb-1"><?php echo $errors['street']; ?></div>
              <?php endif; ?>
              <input type="text" name="street" placeholder="Street" class="form-control px-0 mb-4" value="<?php echo htmlspecialchars($street ?? '') ?>">

              <?php if (!empty($errors['city'])): ?>
                <div class="text-danger text-left mb-1"><?php echo $errors['city']; ?></div>
              <?php endif; ?>
              <input type="text" name="city" placeholder="City" class="form-control px-0 mb-4" value="<?php echo htmlspecialchars($city ?? '') ?>">

              <?php if (!empty($errors['province'])): ?>
                <div class="text-danger text-left mb-1"><?php echo $errors['province']; ?></div>
              <?php endif; ?>
              <input type="text" name="province" placeholder="Province/State" class="form-control px-0 mb-4" value="<?php echo htmlspecialchars($province ?? '') ?>">

              <?php if (!empty($errors['zip'])): ?>
                <div class="text-danger text-left mb-1"><?php echo $errors['zip']; ?></div>
              <?php endif; ?>
              <input type="text" name="zip" placeholder="Zip Code" class="form-control px-0 mb-4" value="<?php echo htmlspecialchars($zip ?? '') ?>">

              <?php if (!empty($errors['country'])): ?>
                <div class="text-danger text-left mb-1"><?php echo $errors['country']; ?></div>
              <?php endif; ?>
              <input type="text" name="country" placeholder="Country" class="form-control px-0 mb-4" value="<?php echo htmlspecialchars($country ?? '') ?>">
            </div>

            <div class="col-md-12 mt-4">
              <h4 class="mb-4">Account Details</h4>

              <?php if (!empty($errors['username'])): ?>
                <div class="text-danger text-left mb-1"><?php echo $errors['username']; ?></div>
              <?php endif; ?>
              <input type="text" name="username" placeholder="Username" class="form-control px-0 mb-4" value="<?php echo htmlspecialchars($username ?? '') ?>">

              <?php if (!empty($errors['password'])): ?>
                <div class="text-danger text-left mb-1"><?php echo $errors['password']; ?></div>
              <?php endif; ?>
              <input type="password" name="password" placeholder="Password" class="form-control px-0 mb-4">

              <?php if (!empty($errors['confirm_password'])): ?>
                <div class="text-danger text-left mb-1"><?php echo $errors['confirm_password']; ?></div>
              <?php endif; ?>
              <input type="password" name="confirm_password" placeholder="Confirm Password" class="form-control px-0 mb-4">
            </div>

            <div class="col-lg-6 col-10 mx-auto">
              <input type="reset" value="Reset" class="btn btn-light w-100">
            </div>
            <div class="col-lg-6 col-10 mx-auto">
              <input type="submit" name="register" value="Register" class="btn btn-primary w-100">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

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
