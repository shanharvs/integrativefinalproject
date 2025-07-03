<?php
session_start();

require 'db.php'; // your DB connection

$user_id = $_SESSION['user_data']['id']; // adjust based on your session structure

if (isset($_POST['add_to_cart'])) {
  $name = $_POST['product_name'];
  $price = $_POST['product_price'];
  $quantity = max(1, (int)$_POST['product_quantity']);

  // Check if item already in cart
  $stmt = $conn->prepare("SELECT * FROM cart_items WHERE user_id = ? AND product_name = ?");
  $stmt->bind_param("is", $user_id, $name);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    // Item exists, update quantity
    $row = $result->fetch_assoc();
    $new_qty = $row['quantity'] + $quantity;

    $update = $conn->prepare("UPDATE cart_items SET quantity = ? WHERE user_id = ? AND product_name = ?");
    $update->bind_param("iis", $new_qty, $user_id, $name);
    $update->execute();
  } else {
    // Insert new item
    $insert = $conn->prepare("INSERT INTO cart_items (user_id, product_name, price, quantity) VALUES (?, ?, ?, ?)");
    $insert->bind_param("isdi", $user_id, $name, $price, $quantity);
    $insert->execute();
  }
  $success = true;
 
}
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
      padding-top: 100px;
      padding-bottom: 80px;
    }
    .content {
      flex: 1;
    }
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

<?php
$products = [
  ["Gummies", 25, "pic1.png", "1gummies.html", "A chewy, fruity treat that’s fun to eat and perfect for sharing.", "2025-06-30"],
  ["Chocolate Bar", 40, "pic2.png", "2chocolatebar.html", "Smooth and rich chocolate that melts in your mouth with every bite.", "2025-06-29"],
  ["Lollipop", 10, "pic3.png", "3lollipop.html", "Colorful and sweet hard candy on a stick that lasts and lasts.", "2025-06-28"],
  ["Marshmallow", 20, "pic4.png", "4marshmallow.html", "Soft, fluffy treats that are perfect for snacking or toasting.", "2025-06-27"],
  ["Gummy Teeth", 30, "pic5.png", "5gummyteeth.html", "Playful, chewy candy shaped like little teeth with a fruity punch.", "2025-06-26"],
  ["Gummy Corn", 30, "pic6.png", "6gummycorn.html", "Sweet and chewy candy shaped like corn kernels, fun and tasty.", "2025-06-25"],
  ["Gummy Worms", 25, "pic7.png", "7gummyworms.html", "Wiggly, colorful worms bursting with tangy-sweet flavor.", "2025-06-24"],
  ["Gummy Flowers", 30, "pic8.png", "8gummyflowers.html", "Pretty floral-shaped gummies with a garden of fruity flavors.", "2025-06-23"],
  ["Gummy Hearts", 30, "pic9.png", "9gummyhearts.html", "Heart-shaped treats filled with love and sweet, fruity taste.", "2025-06-22"],
  ["Choco", 35, "pic10.png", "10choco.html", "A bite-sized chocolate delight that satisfies your sweet tooth.", "2025-06-21"],
  ["Gummy Cola", 25, "pic11.png", "11gummycola.html", "Fizzy, cola-flavored gummies that taste just like your favorite drink.", "2025-06-20"],
  ["Chocolate-Covered Almonds", 50, "pic12.png", "12chocoal.html", "Crunchy almonds coated in rich, velvety chocolate.", "2025-06-19"],
  ["Rock Candy", 15, "pic13.png", "13rockcandy.html", "Crystal-like sugar sticks that shimmer and crunch with sweetness.", "2025-06-18"],
  ["Candy Rings", 10, "pic14.png", "14candyrings.html", "Wearable candy that’s sweet, fruity, and fun to eat.", "2025-06-17"],
  ["Jelly Beans", 25, "pic15.png", "15jellybeans.html", "Tiny bean-shaped candies with a surprise of flavors in every bite.", "2025-06-16"],
  ["Chocolate-Covered Pretzels", 45, "pic16.png", "16chocopret.html", "A perfect mix of salty crunch and smooth chocolate coating.", "2025-06-15"],
  ["Sour Belts", 30, "pic17.png", "17sourbelts.html", "Tangy, colorful candy strips packed with a punch of sour flavor.", "2025-06-14"],
  ["Toffee Bites", 35, "pic18.png", "18toffeebites.html", "Buttery, crunchy toffee candy that’s hard to resist.", "2025-06-13"],
  ["Candy Buttons", 15, "pic19.png", "19candybuttons.html", "Cute little sugar dots on paper strips, full of colorful charm.", "2025-06-12"],
  ["Bubblegum Balls", 5, "pic20.png", "20bubblegum.html", "Round, chewy gum balls bursting with classic bubble-blowing fun.", "2025-06-11"]
];


$currentSort = isset($_GET['sort']) ? $_GET['sort'] : '';
$label = 'Select';
if ($currentSort == 'newest') $label = 'Newest';
elseif ($currentSort == 'oldest') $label = 'Oldest';
elseif ($currentSort == 'recommendation') $label = 'Recommendation';

// sort products if needed
if ($currentSort == 'newest') {
  $products = array_reverse($products);
} elseif ($currentSort == 'recommendation') {
  usort($products, function($a, $b) {
    return $b[1] - $a[1];
  });
}
?>

<div class="container mt-5 pt-4">
  <div class="row justify-content-end mb-3">
    <div class="col-auto">
      <div class="d-flex align-items-center">
        <span class="mr-2 font-weight-bold">Sort by:</span>
        <div class="dropdown">
          <button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="sortDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?= htmlspecialchars($label) ?>
          </button>
          <div class="dropdown-menu" aria-labelledby="sortDropdown">
            <a class="dropdown-item" href="?sort=newest">Newest</a>
            <a class="dropdown-item" href="?sort=oldest">Oldest</a>
            <a class="dropdown-item" href="?sort=recommendation">Recommendation</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<section class="section">
  <div class="container">
    <div class="row">
<?php
foreach ($products as $product) {
  list($name, $price, $image, $link, $desc, $date) = $product;
  echo <<<HTML
    <div class="col-lg-4 col-sm-6 mb-4">
      <article class="card shadow">
        <img class="rounded card-img-top" src="pics/{$image}" alt="{$name}">
        <div class="card-body">
          <h4 class="card-title"><a class="text-dark" href="{$link}">{$name}</a></h4>
          <p class="cars-text">₱{$price}.00<br>{$desc}<br><small class="text-muted">Added: {$date}</small></p>
          <form method="post" action="products.php" class="d-flex flex-column align-items-center">
            <input type="hidden" name="product_name" value="{$name}">
            <input type="hidden" name="product_price" value="{$price}">
            <div class="mb-2">
              <input type="number" name="product_quantity" min="1" value="1" class="form-control form-control-sm" style="width: 70px;" required>
            </div>
            <button type="submit" name="add_to_cart" class="btn btn-xs btn-primary">Add to cart</button>
          </form>
        </div>
      </article>
    </div>
HTML;
}
?>
    </div>
  </div>
</section>

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

<script src="plugins/jQuery/jquery.min.js"></script>
<script src="plugins/bootstrap/bootstrap.min.js"></script>
<script src="js/script.js"></script>
<?php if (!empty($success)): ?>
  <script>
    window.alert("Item added to cart!");
  </script>
<?php endif; ?>
</body>
</html>
