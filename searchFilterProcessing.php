<?php
  // Getting default db varialbe
  session_start();

  require 'DBinfo.php';
  $result_array = array();

  // Opening a db connection
  $con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
  // mysqli_set_charset($con, "utf8");

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




  // Building query based on filter or if no filters are applied



  $checkOpen = false;
  $storesQuery = "SELECT * FROM Store ";


  if(isset($_POST["nameSearch"])) {
    // if nameSearch exists that means a search query is entered
    $storesQuery .= "WHERE StoreName LIKE '%". $_POST["nameSearch"]."%'";
    // get results
    $storeResult = mysqli_query($con, $storesQuery);


  } else if(count($_POST) >= 1) { // if any filter item is applied
    $storesQuery .= "WHERE ";
    // if name Search does not exist but there is something passed by post variable, certain filter is checked.
    if(isset($_POST["cheap"])) {
      $storesQuery .= "StorePriceAverage <= 15 AND StorePriceAverage > 0 AND ";
    }

    if($_POST["priceSlider"] >= 5) {
      $storesQuery .= "StorePriceAverage <= ". $_POST["priceSlider"] ." AND StorePriceAverage > 0 AND ";
    }

    if(isset($_POST["food"])) {
      $storesQuery .= "StoreType = \"Food\" OR  ";
    }

    if(isset($_POST["shop"])) {
      $storesQuery .= "StoreType = \"Shop\" OR  ";
    }

    if(isset($_POST["activity"])) {
      $storesQuery .= "StoreType = \"Activity\" OR  ";
    }

    // Removing the last AND from query
    $storesQuery = substr($storesQuery, 0, -5);
  }


  if(isset($_POST["open"])) { // Open will not be interacting with the database instead with the code only
      $checkOpen = true;
  }


  // Else just select all the stores

  // echo $storesQuery;

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

      // Check if the price average exits
      $priceAverage;
      if($row["StorePriceAverage"] == -1) {
        $priceAverage = "Based on individuals";
      } else {
        $priceAverage = "$". $row["StorePriceAverage"]. "/Person";
      }


      // Outputing the card after setting the time

      if($checkOpen) { // If open is checked
        if(!$openNow) {
          continue;
        }
      }

      if(!$displayed) { // only run once for faster perfromance
        $displayed = true;
      }

      $detailPageTag;
      if($openNow) {
        $detailPageTag= "<a class=\"storeMoreBtn\" href=\"storeDetail.php?id=". $row["StoreId"]. "&open=1\">More</a>";
      } else {
        $detailPageTag= "<a class=\"storeMoreBtn\" href=\"storeDetail.php?id=". $row["StoreId"]. "&open=0\">More</a>";
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



      array_push($result_array, "
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
      ");

  }

  if (mysqli_num_rows($storeResult) == 0 || !$displayed) {
    array_push($result_array, "<p style=\"margin: auto; margin-top: 2rem; margin-bottom: 2rem;\">Your search did not return any results, please try again</p>");
  }

  echo json_encode($result_array);

  // If there is no results found

  // Free the results
  mysqli_free_result($storeResult);

  // Close db connection
  mysqli_close($con);

?>