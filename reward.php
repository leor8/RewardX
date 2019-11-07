<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>RewardX - Home</title>

        <!-- Making sure the site is web friendly -->
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" type="text/css" href="css/normalize.css">
        <link rel="stylesheet" type="text/css" href="css/reward.css">
        <link rel="stylesheet" type="text/css" href="css/nav.css">
        <link rel="stylesheet" type="text/css" href="css/footer.css">
        <link rel="stylesheet" type="text/css" href="css/main.css">

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

      <!-- The main content of the page -->
      <h1>Redeem Reward
      <?php
      // Getting user point counts
      // Getting default db varialbe
      require 'DBinfo.php';

      // Opening a db connection
      $con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

      if(isset($_SESSION["currUser"])) {
        // Getting user favorites

        $pointsCount = "SELECT * FROM Users WHERE UserId = ". $_SESSION["currUser"];
        $pointsCountResults = mysqli_query($con, $pointsCount);

        if(!$pointsCountResults) {
          die("Database query failed.");
        }

        $points;

        while($row = mysqli_fetch_assoc($pointsCountResults)) {
          $points = $row["StorePoints"];
        }

        mysqli_free_result($pointsCountResults);

        echo "(Your points: ". $points. ")";
      }



      ?>

      </h1>
      <main>

        <?php
          // Loading all the rewards dynamically.
          $rewardsQuery = "SELECT * FROM Rewards WHERE RewardQuantityLeft > 0";

          $allRewardsAvailble = mysqli_query($con, $rewardsQuery);

          if(!$allRewardsAvailble) {
            die("Database query failed.");
          }

          while($row = mysqli_fetch_assoc($allRewardsAvailble)) {
            echo "
              <div class=\"item\">
                <img src=\"". $row["RewardImage"]."\" class=\"itemImg\">
                <p class=\"itemHeading\">". $row["RewardName"]."</p>
                <p class=\"itemText\">". $row["RewardDescription"]. " <br/><strong>(". $row["RewardQuantityLeft"]." Left)</strong></p>
                <a class=\"itemBtn\" href=\"redeemReward.php?productId=". $row["RewardId"]."\">Redeem: ". $row["RewardPoints"]."pt </a>
              </div>
            ";
          }

          mysqli_free_result($allRewardsAvailble);

          mysqli_close($con);

        ?>
      </main>

      <!-- The following section is footer -->
      <footer>
        <p class="footerText">RewardsX@2019</p>
      </footer>


    </body>
</html>




<?php

if(isset($_GET["failed"])) {
  if($_GET["failed"] == 1) {
    echo "<script type='text/javascript'>alert('You do not have enough points to redeem the item.');</script>";
  } else {
    echo "<script type='text/javascript'>alert('You are not logged in.');</script>";
  }

}

?>