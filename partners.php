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
        <link rel="stylesheet" type="text/css" href="css/partner.css">
        <link rel="stylesheet" type="text/css" href="css/nav.css">
        <link rel="stylesheet" type="text/css" href="css/footer.css">
        <link rel="stylesheet" type="text/css" href="css/main.css">

        <link href="https://fonts.googleapis.com/css?family=Manjari:400,700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Merriweather:900&display=swap" rel="stylesheet">

        <script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>

        <script type="text/javascript" src="js/nav.js"></script>
        <script src="https://kit.fontawesome.com/c44e3d0e87.js"></script>
        <script type="text/javascript" src=js/handleSearch.js></script>

        <script type="text/javascript">
          function updateTextInput(val) {
            document.getElementById('textInput').value = "$" + val;
          }

          function updateDistance(val) {
            document.getElementById('distanceInput').value = val + "km";
          }
      </script>
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

        <h1 style="margin-bottom: 5rem;">Our Partners</h1>
        <!-- Filter -->
        <section class="filter">

          <form class="filterHeader">
            <h2 class="filterHeading">RewardX</h2>
            <input type="text" name="nameSearch" class="filterSearch" placeholder="Search for a shop">

            <button class="searchBtn">Search</button>
          </form>

          <form class="filterRadios">

<!--
            <div class="filterCheckbox">
              <label>Within 5 KM</label>
              <input  type="checkbox" name="near" value="Near">
            </div> -->

            <div class="filterCheckbox">
              <label>Opens Now</label>
              <input type="checkbox" name="open" value="Open">
            </div>

            <div class="filterCheckbox">
              <label>Cheap Shop</label>
              <input type="checkbox" name="cheap" value="Cheap">
            </div>

            <div class="filterCheckbox">
              <label>Restuarants</label>
              <input type="checkbox" name="food" value="Food">
            </div>

            <div class="filterCheckbox">
              <label>Grocery Stores</label>
              <input type="checkbox" name="shop" value="Shop">
            </div>

            <div class="filterCheckbox">
              <label>Activity</label>
              <input type="checkbox" name="activity" value="Activity">
            </div>

            <!-- TO break checkboxes and sliders -->
            <p class="infoBreak"> -------------- More -------------- </p>

            <div class="slidecontainer">
              <label>Price Per Person</label>
              <input type="text" id="textInput" value="$0" class="priceDisplay">
              <input name="priceSlider" type="range" min="0" max="99" value="0" class="slider" id="priceSlider" onchange="updateTextInput(this.value);">
            </div>

<!--             <div class="slidecontainer">
              <label>KMs from</label>
              <input type="text" id="distanceInput" value="5KM" class="distanceDisplay">
              <input name="rangeSlider"type="range" min="5" max="100" value="5" class="slider" id="distanceSlider" onchange="updateDistance(this.value);">
            </div> -->

            <button class="startFilter">Filter</button>
            <a class="startFilterReset" href="partners.php">Reset</a>

          </form>
        </section>

        <!-- List of all partnered stores retrieved from database-->
        <section class="partners">
          <div class="partnerFlex">

            <!-- The following php block is used to find the current week ofthe day and check if the shop is open when user first enters the page -->
            <?php
              require 'DBinfo.php';

              // Opening a db connection
              $con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

              // Getting user favorites
              if(isset($_SESSION["currUser"])) {
                $userFavQuery = "SELECT * FROM Users WHERE UserId = ". $_SESSION["currUser"];
                $favResults = mysqli_query($con, $userFavQuery);

                if(!$favResults) {
                  die("Database query failed.");
                }

                $fav;
                while($row = mysqli_fetch_assoc($favResults)) {
                  $fav = $row["UserFavoriteStoreId"];
                }

                mysqli_free_result($favResults);
                $fav = explode(",", $fav);
              }

              $storesQuery = "SELECT * FROM Store ";

              // get results
              $storeResult = mysqli_query($con, $storesQuery);

              // If query failed, end the program
              if (!$storeResult) {
                die("Database query failed.");
              }


              // Getting today's date
              date_default_timezone_set('America/Vancouver');
              $day = date('D', time());
              $currTime = date('h:i a', time());

              $displayed = false; // this variable is used to check if there is any not opned right now being displayed

              // Calculating if the store is currently open

              // constructing the store cards
              $resultMoreThanOne = false;

              while ($row = mysqli_fetch_assoc($storeResult)) {
                $currOpenStatus;

                $hoursByDay = explode(" ", $row["StoreHours"]);

                $startingTime;
                $endTime;
                $openNow = false;


                switch($day) {
                  case 'Sun':
                    $startingTime = explode('_', $hoursByDay[0])[0];
                    $endTime = explode('_', $hoursByDay[0])[1];
                    if($startingTime == "Closed") {
                      $currOpenStatus = "Closed";
                    } else {
                      // Converting time to a formate that is decodeable by strtotime
                      $startingTime = substr($startingTime, 0, 5) . " " . substr($startingTime, 5);
                      $endTime = substr($endTime, 0, 5) . " " . substr($endTime, 5);



                      if(strtotime($currTime) > strtotime($startingTime) && strtotime($currTime) < strtotime($endTime)) {
                        $currOpenStatus = $startingTime. " to ". $endTime. "(OPEN)";
                        $openNow = true;
                      } else {
                        $currOpenStatus = $startingTime. " to ". $endTime. "(CLOSED)";
                      }
                    }

                    break;

                  case 'Mon':
                    $startingTime = explode('_', $hoursByDay[1])[0];
                    $endTime = explode('_', $hoursByDay[1])[1];

                    if($startingTime == "Closed") {
                      $currOpenStatus = "Closed";
                    } else {
                      // Converting time to a formate that is decodeable by strtotime
                      $startingTime = substr($startingTime, 0, 5) . " " . substr($startingTime, 5);
                      $endTime = substr($endTime, 0, 5) . " " . substr($endTime, 5);

                      if(strtotime($currTime) > strtotime($startingTime) && strtotime($currTime) < strtotime($endTime)) {
                        $currOpenStatus = $startingTime. " to ". $endTime. "(OPEN)";
                        $openNow = true;
                      } else {
                        $currOpenStatus = $startingTime. " to ". $endTime. "(CLOSED)";
                      }
                    }
                    break;

                  case 'Tue':
                    $startingTime = explode('_', $hoursByDay[2])[0];
                    $endTime = explode('_', $hoursByDay[2])[1];

                    if($startingTime == "Closed") {
                      $currOpenStatus = "Closed";
                    } else {
                      // Converting time to a formate that is decodeable by strtotime
                      $startingTime = substr($startingTime, 0, 5) . " " . substr($startingTime, 5);
                      $endTime = substr($endTime, 0, 5) . " " . substr($endTime, 5);

                      if(strtotime($currTime) > strtotime($startingTime) && strtotime($currTime) < strtotime($endTime)) {
                        $currOpenStatus = $startingTime. " to ". $endTime. "(OPEN)";
                        $openNow = true;
                      } else {
                        $currOpenStatus = $startingTime. " to ". $endTime. "(CLOSED)";
                      }
                    }
                    break;

                  case 'Wed':
                    $startingTime = explode('_', $hoursByDay[3])[0];
                    $endTime = explode('_', $hoursByDay[3])[1];

                    if($startingTime == "Closed") {
                      $currOpenStatus = "Closed";
                    } else {
                      // Converting time to a formate that is decodeable by strtotime
                      $startingTime = substr($startingTime, 0, 5) . " " . substr($startingTime, 5);
                      $endTime = substr($endTime, 0, 5) . " " . substr($endTime, 5);

                      if(strtotime($currTime) > strtotime($startingTime) && strtotime($currTime) < strtotime($endTime)) {
                        $currOpenStatus = $startingTime. " to ". $endTime. "(OPEN)";
                        $openNow = true;
                      } else {
                        $currOpenStatus = $startingTime. " to ". $endTime. "(CLOSED)";
                      }
                    }
                    break;

                  case 'Thu':
                    $startingTime = explode('_', $hoursByDay[4])[0];
                    $endTime = explode('_', $hoursByDay[4])[1];

                    if($startingTime == "Closed") {
                      $currOpenStatus = "Closed";
                    } else {
                      // Converting time to a formate that is decodeable by strtotime
                      $startingTime = substr($startingTime, 0, 5) . " " . substr($startingTime, 5);
                      $endTime = substr($endTime, 0, 5) . " " . substr($endTime, 5);

                      if(strtotime($currTime) > strtotime($startingTime) && strtotime($currTime) < strtotime($endTime)) {
                        $currOpenStatus = $startingTime. " to ". $endTime. "(OPEN)";
                        $openNow = true;
                      } else {
                        $currOpenStatus = $startingTime. " to ". $endTime. "(CLOSED)";
                      }
                    }
                    break;

                  case 'Fri':
                    $startingTime = explode('_', $hoursByDay[5])[0];
                    $endTime = explode('_', $hoursByDay[5])[1];

                    if($startingTime == "Closed") {
                        $currOpenStatus = "Closed";
                      } else {

                        // Converting time to a formate that is decodeable by strtotime
                        $startingTime = substr($startingTime, 0, 5) . " " . substr($startingTime, 5);
                        $endTime = substr($endTime, 0, 5) . " " . substr($endTime, 5);

                        if(strtotime($currTime) > strtotime($startingTime) && strtotime($currTime) < strtotime($endTime)) {
                          $currOpenStatus = $startingTime. " to ". $endTime. "(OPEN)";
                          $openNow = true;
                        } else {
                          $currOpenStatus = $startingTime. " to ". $endTime. "(CLOSED)";
                        }
                      }
                      break;

                  case 'Sat':
                    $startingTime = explode('_', $hoursByDay[6])[0];
                    $endTime = explode('_', $hoursByDay[6])[1];

                    if($startingTime == "Closed") {
                      $currOpenStatus = "Closed";
                    } else {
                      // Converting time to a formate that is decodeable by strtotime
                      $startingTime = substr($startingTime, 0, 5) . " " . substr($startingTime, 5);
                      $endTime = substr($endTime, 0, 5) . " " . substr($endTime, 5);

                      if(strtotime($currTime) > strtotime($startingTime) && strtotime($currTime) < strtotime($endTime)) {
                        $currOpenStatus = $startingTime. " to ". $endTime. "(OPEN)";
                        $openNow = true;
                      } else {
                        $currOpenStatus = $startingTime. " to ". $endTime. "(CLOSED)";
                      }
                    }
                    break;


                  }

                  $detailPageTag;
                  if($openNow) {
                    $detailPageTag= "<a class=\"storeMoreBtn\" href=\"storeDetail.php?id=". $row["StoreId"]. "&open=1\">More</a>";
                  } else {
                    $detailPageTag= "<a class=\"storeMoreBtn\" href=\"storeDetail.php?id=". $row["StoreId"]. "&open=0\">More</a>";
                  }

                  // Check if the price average exits
                  $priceAverage;
                  if($row["StorePriceAverage"] == -1) {
                    $priceAverage = "Based on individuals";
                  } else {
                    $priceAverage = "$". $row["StorePriceAverage"]. "/Person";
                  }


                  $likedStore;
                  if(isset($_SESSION["currUser"])) {
                    if(in_array($row["StoreId"], $fav)) {
                      $likedStore = "<i class=\"fas fa-star favSelect selectable\" style=\"color: yellow\"></i>";
                    } else {
                      $likedStore = "<i class=\"far fa-star favSelect selectable\"></i>";
                    }
                  } else {
                    $likedStore = "<i class=\"far fa-star favSelect\" onClick=\"alert('You need to login to do this action.')\"></i>";
                  }

                  $iconBasedOnType;

                  switch($row["StoreType"]) {
                    case "Shop":
                      $iconBasedOnType = "<i class=\"fas fa-shopping-basket storeIcon\"></i>";
                      break;
                    case "Activity":
                      $iconBasedOnType = "<i class=\"fas fa-cloud-sun storeIcon\"></i>";
                      break;
                    case "Food":
                      $iconBasedOnType = "<i class=\"fas fa-utensils storeIcon\"></i>";
                      break;
                  }

                  $ratingIcon;
                  if($row["StoreRatings"] < 5.5) {
                    $ratingIcon = "<i class=\"far fa-frown-open storeIcon\"></i>";
                  } else if ($row["StoreRatings"] > 8) {
                    $ratingIcon = "<i class=\"far fa-smile storeIcon\"></i>";
                  } else {
                    $ratingIcon = "<i class=\"far fa-meh storeIcon\"></i>";
                  }



                  echo "
                    <div class=\"store\" id=\"". $row["StoreId"]."\">
                      ". $likedStore."
                      <img class=\"store_img\" src=\"". $row["StoreImage"]. "/1.png\">
                      <h2>". $row["StoreName"]. "<br> ($1:". $row["StorePointsPerDollar"]. " points) </h2>

                      <div class=\"storeSection\">
                         <i class=\"fas fa-clock storeIcon\"></i>
                         <p class=\"storeText\" style=\"font-size: 0.9rem;\"> ". $currOpenStatus. " </p>
                       </div>

                       <div class=\"storeSection\">
                         ". $iconBasedOnType. "
                         <p class=\"storeText\">". $row["StoreType"]. "</p>
                       </div>

                       <div class=\"storeSection\">
                         <i class=\"fas fa-dollar-sign storeIcon\"></i>
                         <p class=\"storeText\">". $priceAverage. "</p>
                       </div>

                       <div class=\"storeSection\">
                          ". $ratingIcon. "
                         <p class=\"storeText\">". $row["StoreRatings"]. " Satisfactory Score</p>
                       </div>

                       ".  $detailPageTag. "

                    </div>
                  ";
                }

                  // Free the results
                  mysqli_free_result($storeResult);

                  // Close db connection
                  mysqli_close($con);



            ?>

          </div>


        </section>


      </main>

      <!-- The following section is footer -->
      <footer>
        <p class="footerText">RewardsX@2019</p>
      </footer>


    </body>
</html>