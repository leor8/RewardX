<?php
  session_start();


  // Getting default db varialbe
  require 'DBinfo.php';

  // Opening a db connection
  $con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

  // Getting user favorites

  // Getting default db varialbe
  require 'DBinfo.php';

  // Opening a db connection
  $con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

  // Getting user favorites

  $pointsCount = "SELECT * FROM Users WHERE UserId = ". $_SESSION["currUser"];
  $pointsCountResults = mysqli_query($con, $pointsCount);

  if(!$pointsCountResults) {
    die("Database query failed.");
  }

  $UserpointsLeft;

  while($row = mysqli_fetch_assoc($pointsCountResults)) {
    $UserpointsLeft = $row["StorePoints"];
  }

  mysqli_free_result($pointsCountResults);

  // Getting product cost
  // Loading all the rewards dynamically.
  $rewardsQuery = "SELECT * FROM Rewards WHERE RewardId = ". $_GET["productId"];

  $rewardCost = mysqli_query($con, $rewardsQuery);

  if(!$rewardCost) {
    die("Database query failed.");
  }

  $cost;
  $quantity;

  while($row = mysqli_fetch_assoc($rewardCost)) {
    $cost = $row["RewardPoints"];
    $quantity = $row["RewardQuantityLeft"];
  }

  mysqli_free_result($rewardCost);

  if($UserpointsLeft > $cost) {
    // Update user's points
    $newPoints = $UserpointsLeft - $cost;
    $updateUserPoints = "UPDATE Users SET StorePoints = ". $newPoints." WHERE UserId = ". $_SESSION["currUser"];
    $updatepointsresult = mysqli_query($con, $updateUserPoints);

    // -1 reward product quantity
    $newQuantity = $quantity - 1;
    $updateQuantity = "UPDATE Rewards SET RewardQuantityLeft = ". $newQuantity." WHERE RewardId = ". $_GET["productId"];
    mysqli_query($con, $updateQuantity);
  } else {
    echo "<script type='text/javascript'>alert('You do not have enough points to redeem this item.');</script>";
    header('Location: reward.php?failed=1');
  }




      // header('Location: storeDetail.php?id='. $_GET["favId"].'&open='. $_GET["open"]);
      // mysqli_close($con);
      // header('Location: partners.php');

?>







<?php
if (!isset($_SESSION['currUser'])) { // if user is logged in
  echo "<script type='text/javascript'>alert('You are not logged in, redirecting to Dashboard.');</script>";
  header('Location: login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>RewardX - Home</title>

        <!-- Making sure the site is web friendly -->
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" type="text/css" href="css/normalize.css">
        <link rel="stylesheet" type="text/css" href="css/nav.css">
        <link rel="stylesheet" type="text/css" href="css/footer.css">
        <link rel="stylesheet" type="text/css" href="css/main.css">

        <!-- Page specific css -->
        <link rel="stylesheet" type="text/css" href="css/index.css">
        <link rel="stylesheet" type="text/css" href="css/login.css">

        <!-- External links -->
        <link href="https://fonts.googleapis.com/css?family=Manjari:400,700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Merriweather:900&display=swap" rel="stylesheet">

        <script
        src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8="
        crossorigin="anonymous"></script>

        <script type="text/javascript" src="js/nav.js"></script>
        <script src="https://kit.fontawesome.com/c44e3d0e87.js"></script>
    </head>
    <body>
      <!-- Headers  -->
      <header>
        <!-- Logo created from https://www.freelogoservices.com/step1 -->
        <img src="src/logo.jpg" class="logo">

        <!-- Navigation -->
        <nav>
          <ul>
            <!-- A list of nevigations  -->
            <li class="nav_button"><a href="index.php">Home</a></li>
            <li class="nav_button"><a href="partners.php">Partners</a></li>
            <li class="nav_button"><a href="reward.php">Rewards</a></li>
            <!-- Account tab will have a dropdown with all account related actions -->
            <li class="nav_button dropdown">Account <i class="fas fa-sort-down"></i></li>
          </ul>

          <!-- Account dropdown -->
          <div class="dropdown-content">
            <a href="dashboard.php">Dashboard</a>
            <?php
              if (isset($_SESSION['currUser'])) {
                echo "<a href=\"logout.php\">Logout</a>";
              } else {
                echo "
                <a href=\"login.php\">Login</a>
                <a href=\"register.php\">Register</a>
                ";
              }
            ?>
          </div>
        </nav>

      </header>

      <!-- The main content of index page -->
      <main>
        <div class="highLevel">
          <section class="info">
            <h2>You will receive an email notification once your order is processed.</h2>
          </section>


            <section class="image_card">
              <!-- Image icons created by fontawesome -->
              <img src="src/rewardXCard.png" class="recardCardImg">
            </section>


        </div>


      </main>

      <footer>
        <p class="footerText">RewardsX@2019</p>
      </footer>

    </body>
</html>











