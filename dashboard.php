<?php
session_start();

if(!isset($_SESSION["currUser"])) {
  header('Location: login.php?failed=2');
} else { // Get user info
  // Getting default db varialbe
  require 'DBinfo.php';

  // Opening a db connection
  $con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

  // Building query
  $gettingUser = "SELECT * FROM Users WHERE UserId = ". $_SESSION["currUser"];

  // get results
  $userResults = mysqli_query($con, $gettingUser);

  $userName; $userPoints; $userFavorite;

  // If query failed, end the program
  if (!$userResults) {
    die("Database query failed.");
  }

  while ($row = mysqli_fetch_assoc($userResults)) {
    $userName = $row["UserName"];
    $userPoints = $row["StorePoints"];
    if(is_null($row["UserFavoriteStoreId"])){
      $userFavorite = "";
    } else {
      $userFavorite = $row["UserFavoriteStoreId"];
    }

  }

  mysqli_free_result($userResults);

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
        <link rel="stylesheet" type="text/css" href="css/dash.css">

        <!-- External links -->
        <link href="https://fonts.googleapis.com/css?family=Manjari:400,700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Merriweather:900&display=swap" rel="stylesheet">

        <script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>

        <script type="text/javascript" src="js/removeFavFromDashAJAX.js"></script>
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

          <!-- The following section contains user's icon, name and points -->
          <section class="userDash">
            <?php echo "<img src=\"https://api.adorable.io/avatars/285/". $userName.".png\" class=\"userIcon\">"; ?>

            <h2><?php echo $userName; ?></h2>

            <div class="dashSec">
              <p class="dashHeadings">Your points:</p>
              <p class="userPoints"><?php echo $userPoints;?></p>
            </div>

            <!-- QR Code Section -->
            <div class="dashSec">
              <p class="dashHeadings">Your QR code:</p>
              <img src="src/qr.jpg" alt="A placeholder qr code" class="user_qr">
            </div>

            <a class="logout" href="logout.php">Logout</a>
          </section>


        <section class="sectionDash">

          <!-- The following section is for contents user can edit including their favorites -->

          <?php
            if($userFavorite == "") {
              echo "<p>You do not have favorite stores, go browswer all the stores and select few of your favorite stores!</p>";
            } else {
              $userFavArr = explode(',', $userFavorite);

              // Building query
              if(count($userFavArr) > 0) {
                $favStoreQuery = "SELECT * FROM Store WHERE ";
                foreach ($userFavArr as $storeId){
                  $favStoreQuery .= "StoreId = ". $storeId." OR ";
                }
                $favStoreQuery = substr($favStoreQuery, 0, -4);

                $favStoreResult = mysqli_query($con, $favStoreQuery);

                if (!$favStoreResult) {
                  die("Database query failed.");
                }

                date_default_timezone_set('America/Vancouver');
                $day = date('D', time());
                $currTime = date('h:i a', time());

                while ($row = mysqli_fetch_assoc($favStoreResult)) {
                  $sectionInfo;

                  if($row["StoreType"] == "Shop") {
                    $sectionInfo = "<section class=\"userEdit grocery\">";
                  } else if ($row["StoreType"] == "Food") {
                    $sectionInfo = "<section class=\"userEdit food\">";
                  } else {
                    $sectionInfo = "<section class=\"userEdit activity\">";
                  }

                  // Check if store is open and pass in url parameter dynamically
                  $hoursByDay = explode(" ", $row["StoreHours"]);

                  $startingTime;
                  $endTime;
                  $openNow = false;

                  switch($day) {
                    case 'Sun':
                      $startingTime = explode('_', $hoursByDay[0])[0];
                      $endTime = explode('_', $hoursByDay[0])[1];
                      // Converting time to a formate that is decodeable by strtotime
                      $startingTime = substr($startingTime, 0, 5) . " " . substr($startingTime, 5);
                      $endTime = substr($endTime, 0, 5) . " " . substr($endTime, 5);
                      if(strtotime($currTime) > strtotime($startingTime) && strtotime($currTime) < strtotime($endTime)) {
                        $openNow = true;
                      }
                      break;

                    case 'Mon':
                      $startingTime = explode('_', $hoursByDay[1])[0];
                      $endTime = explode('_', $hoursByDay[1])[1];

                      // Converting time to a formate that is decodeable by strtotime
                      $startingTime = substr($startingTime, 0, 5) . " " . substr($startingTime, 5);
                      $endTime = substr($endTime, 0, 5) . " " . substr($endTime, 5);

                      if(strtotime($currTime) > strtotime($startingTime) && strtotime($currTime) < strtotime($endTime)) {
                        $openNow = true;
                      }
                      break;

                    case 'Tue':
                      $startingTime = explode('_', $hoursByDay[2])[0];
                      $endTime = explode('_', $hoursByDay[2])[1];

                      // Converting time to a formate that is decodeable by strtotime
                      $startingTime = substr($startingTime, 0, 5) . " " . substr($startingTime, 5);
                      $endTime = substr($endTime, 0, 5) . " " . substr($endTime, 5);

                      if(strtotime($currTime) > strtotime($startingTime) && strtotime($currTime) < strtotime($endTime)) {
                        $openNow = true;
                      }
                      break;

                    case 'Wed':
                      $startingTime = explode('_', $hoursByDay[3])[0];
                      $endTime = explode('_', $hoursByDay[3])[1];

                      // Converting time to a formate that is decodeable by strtotime
                      $startingTime = substr($startingTime, 0, 5) . " " . substr($startingTime, 5);
                      $endTime = substr($endTime, 0, 5) . " " . substr($endTime, 5);

                      if(strtotime($currTime) > strtotime($startingTime) && strtotime($currTime) < strtotime($endTime)) {
                        $openNow = true;
                      }
                      break;

                    case 'Thu':
                      $startingTime = explode('_', $hoursByDay[4])[0];
                      $endTime = explode('_', $hoursByDay[4])[1];

                      // Converting time to a formate that is decodeable by strtotime
                      $startingTime = substr($startingTime, 0, 5) . " " . substr($startingTime, 5);
                      $endTime = substr($endTime, 0, 5) . " " . substr($endTime, 5);

                      if(strtotime($currTime) > strtotime($startingTime) && strtotime($currTime) < strtotime($endTime)) {
                        $openNow = true;
                      }
                      break;

                    case 'Fri':
                      $startingTime = explode('_', $hoursByDay[5])[0];
                      $endTime = explode('_', $hoursByDay[5])[1];

                      // Converting time to a formate that is decodeable by strtotime
                      $startingTime = substr($startingTime, 0, 5) . " " . substr($startingTime, 5);
                      $endTime = substr($endTime, 0, 5) . " " . substr($endTime, 5);

                      if(strtotime($currTime) > strtotime($startingTime) && strtotime($currTime) < strtotime($endTime)) {
                        $openNow = true;
                      }
                      break;

                    case 'Sat':
                      $startingTime = explode('_', $hoursByDay[6])[0];
                      $endTime = explode('_', $hoursByDay[6])[1];

                      // Converting time to a formate that is decodeable by strtotime
                      $startingTime = substr($startingTime, 0, 5) . " " . substr($startingTime, 5);
                      $endTime = substr($endTime, 0, 5) . " " . substr($endTime, 5);

                      if(strtotime($currTime) > strtotime($startingTime) && strtotime($currTime) < strtotime($endTime)) {
                        $openNow = true;
                      }
                      break;


                  }

                  $storeURL;
                  if($openNow) {
                    $storeURL = "<a class=\"favBtn\" href=\"storeDetail.php?id=". $row["StoreId"]. "&open=1\">Visit Shop</a>";
                  } else {
                    $storeURL = "<a class=\"favBtn\" href=\"storeDetail.php?id=". $row["StoreId"]. "&open=0\">Visit Shop</a>";
                  }

                  // $removeStoreURL = "<a class=\"favBtn\" href=\"dashboard.php?removeId=". $row["StoreId"]. "\">Remove</a>";
                  $removeStoreURL = "<button class=\"removeFavBtn\" id=\"".$row["StoreId"]."\">Remove</button>";
                  echo $sectionInfo.
                  "
                    <i class=\"fas fa-star iconStar\"></i>
                    <h2>". $row["StoreName"]."</h2>
                    ".$storeURL. $removeStoreURL."
                  </section>
                  ";
                }
              } else {
                echo "<p>You do not have favorite stores, go browswer all the stores and select few of your favorite stores!</p>";
              }

            }
          ?>

        </section>

      </main>

      <footer>
        <p class="footerText">RewardsX@2019</p>
      </footer>

    </body>
</html>