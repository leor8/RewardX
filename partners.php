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
        src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8="
        crossorigin="anonymous"></script>

        <script type="text/javascript" src="js/nav.js"></script>
        <script src="https://kit.fontawesome.com/c44e3d0e87.js"></script>

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
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
          </div>
        </nav>

      </header>

      <!-- The main content of index page -->
      <main>

        <h1>Our Partners</h1>
        <!-- Filter -->
        <section class="filter">
          <div class="filterHeader">
            <h2 class="filterHeading">RewardX</h2>
            <input type="text" name="nameSearch" class="filterSearch" placeholder="Search for a shop">
            <button class="searchBtn">Search</button>
          </div>

          <div class="filterCheckbox">
            <label>Within 5 KM</label>
            <input  type="checkbox" name="favorite1" value="Near">
          </div>

          <div class="filterCheckbox">
            <label>Opens Now</label>
            <input  type="checkbox" name="favorite1" value="Open">
          </div>

          <div class="filterCheckbox">
            <label>Cheap Shop</label>
            <input  type="checkbox" name="favorite1" value="Cheap">
          </div>

          <div class="filterCheckbox">
            <label>Restuarants</label>
            <input  type="checkbox" name="favorite1" value="Food">
          </div>

          <div class="filterCheckbox">
            <label>Grocery Stores</label>
            <input  type="checkbox" name="favorite1" value="Grocery">
          </div>

          <div class="filterCheckbox">
            <label>Activity</label>
            <input  type="checkbox" name="favorite1" value="Activity">
          </div>

          <div class="filterCheckbox">
            <label>On Promotion</label>
            <input  type="checkbox" name="favorite1" value="Promotion">
          </div>

          <!-- TO break checkboxes and sliders -->
          <p class="infoBreak"> -------------- More -------------- </p>

          <div class="slidecontainer">
            <label>Price Per Person</label>
            <input type="text" id="textInput" value="$20" class="priceDisplay">
            <input type="range" min="20" max="99" value="20" class="slider" id="priceSlider" onchange="updateTextInput(this.value);">
          </div>

          <div class="slidecontainer">
            <label>KMs from</label>
            <input type="text" id="distanceInput" value="5KM" class="distanceDisplay">
            <input type="range" min="5" max="200" value="20" class="slider" id="distanceSlider" onchange="updateDistance(this.value);">
          </div>

          <button class="startFilter">Filter</button>
        </section>

        <!-- List of all partnered stores -->
        <section class="partners">
          <div class="partnerFlex">

            <!-- The following php block is used to find the current week ofthe day and check if the shop is open when user first enters the page -->
            <?php

              // Getting today's date
              date_default_timezone_set('America/Vancouver');
              $day = date('D', time());
              $currTime = date('h:i a', time());

              // Subway

              // Saving each line in the file in to an array by file() function
              $subwayFile = file("txtDB/subway.txt");
              $subwayTime; // To hold the output text on whether the place is open or not

              if($subwayFile) {
                switch ($day) {
                  case 'Sun':
                    // Getting start and end time and formate them
                    $startingTime = explode('–', explode(" ", $subwayFile[5])[1])[0];
                    $endTime = explode('–', explode(" ", $subwayFile[5])[1])[1];

                    // Converting time to a formate that is decodeable by strtotime
                    $startingTime = substr($startingTime, 0, 5) . " " . substr($startingTime, 5);
                    $endTime = substr($endTime, 0, 5) . " " . substr($endTime, 5);

                    if(strtotime($currTime) > strtotime($startingTime) && strtotime($currTime) < strtotime($endTime)) {
                      $subwayTime = $startingTime. " to ". $endTime. "(OPEN)";
                    } else {
                      $subwayTime = $startingTime. " to ". $endTime. "(CLOSED)";
                    }
                    break;

                  case 'Mon':
                    // Getting start and end time and formate them
                    $startingTime = explode('–', explode(" ", $subwayFile[6])[1])[0];
                    $endTime = explode('–', explode(" ", $subwayFile[6])[1])[1];

                    // Converting time to a formate that is decodeable by strtotime
                    $startingTime = substr($startingTime, 0, 5) . " " . substr($startingTime, 5);
                    $endTime = substr($endTime, 0, 5) . " " . substr($endTime, 5);

                    if(strtotime($currTime) > strtotime($startingTime) && strtotime($currTime) < strtotime($endTime)) {
                      $subwayTime = $startingTime. " to ". $endTime. "(OPEN)";
                    } else {
                      $subwayTime = $startingTime. " to ". $endTime. "(CLOSED)";
                    }
                    break;

                  case 'Tue':
                    // Getting start and end time and formate them
                    $startingTime = explode('–', explode(" ", $subwayFile[7])[1])[0];
                    $endTime = explode('–', explode(" ", $subwayFile[7])[1])[1];

                    // Converting time to a formate that is decodeable by strtotime
                    $startingTime = substr($startingTime, 0, 5) . " " . substr($startingTime, 5);
                    $endTime = substr($endTime, 0, 5) . " " . substr($endTime, 5);

                    if(strtotime($currTime) > strtotime($startingTime) && strtotime($currTime) < strtotime($endTime)) {
                      $subwayTime = $startingTime. " to ". $endTime. "(OPEN)";
                    } else {
                      $subwayTime = $startingTime. " to ". $endTime. "(CLOSED)";
                    }
                    break;

                  case 'Wed':
                    // Getting start and end time and formate them
                    $startingTime = explode('–', explode(" ", $subwayFile[8])[1])[0];
                    $endTime = explode('–', explode(" ", $subwayFile[8])[1])[1];

                    // Converting time to a formate that is decodeable by strtotime
                    $startingTime = substr($startingTime, 0, 5) . " " . substr($startingTime, 5);
                    $endTime = substr($endTime, 0, 5) . " " . substr($endTime, 5);

                    if(strtotime($currTime) > strtotime($startingTime) && strtotime($currTime) < strtotime($endTime)) {
                      $subwayTime = $startingTime. " to ". $endTime. "(OPEN)";
                    } else {
                      $subwayTime = $startingTime. " to ". $endTime. "(CLOSED)";
                    }
                    break;

                  case 'Thu':
                    // Getting start and end time and formate them
                    $startingTime = explode('–', explode(" ", $subwayFile[9])[1])[0];
                    $endTime = explode('–', explode(" ", $subwayFile[9])[1])[1];

                    // Converting time to a formate that is decodeable by strtotime
                    $startingTime = substr($startingTime, 0, 5) . " " . substr($startingTime, 5);
                    $endTime = substr($endTime, 0, 5) . " " . substr($endTime, 5);

                    if(strtotime($currTime) > strtotime($startingTime) && strtotime($currTime) < strtotime($endTime)) {
                      $subwayTime = $startingTime. " to ". $endTime. "(OPEN)";
                    } else {
                      $subwayTime = $startingTime. " to ". $endTime. "(CLOSED)";
                    }
                    break;

                  case 'Fri':
                    // Getting start and end time and formate them
                    $startingTime = explode('–', explode(" ", $subwayFile[10])[1])[0];
                    $endTime = explode('–', explode(" ", $subwayFile[10])[1])[1];

                    // Converting time to a formate that is decodeable by strtotime
                    $startingTime = substr($startingTime, 0, 5) . " " . substr($startingTime, 5);
                    $endTime = substr($endTime, 0, 5) . " " . substr($endTime, 5);

                    if(strtotime($currTime) > strtotime($startingTime) && strtotime($currTime) < strtotime($endTime)) {
                      $subwayTime = $startingTime. " to ". $endTime. "(OPEN)";
                    } else {
                      $subwayTime = $startingTime. " to ". $endTime. "(CLOSED)";
                    }
                    break;

                  case 'Sat':
                    // Getting start and end time and formate them
                    $startingTime = explode('–', explode(" ", $subwayFile[11])[1])[0];
                    $endTime = explode('–', explode(" ", $subwayFile[11])[1])[1];

                    // Converting time to a formate that is decodeable by strtotime
                    $startingTime = substr($startingTime, 0, 5) . " " . substr($startingTime, 5);
                    $endTime = substr($endTime, 0, 5) . " " . substr($endTime, 5);

                    if(strtotime($currTime) > strtotime($startingTime) && strtotime($currTime) < strtotime($endTime)) {
                      $subwayTime = $startingTime. " to ". $endTime. "(OPEN)";
                    } else {
                      $subwayTime = $startingTime. " to ". $endTime. "(CLOSED)";
                    }
                    break;
                }

              }


              // Guildford
              $gfrcFile = file("txtDB/guildfordRecCenter.txt");
              $gfrcTime;
              if($gfrcFile) {
                switch ($day) {
                  case 'Sun':
                    // Getting start and end time and formate them
                    $startingTime = explode('–', explode(" ", $gfrcFile[5])[1])[0];
                    $endTime = explode('–', explode(" ", $gfrcFile[5])[1])[1];

                    // Converting time to a formate that is decodeable by strtotime
                    $startingTime = substr($startingTime, 0, 5) . " " . substr($startingTime, 5);
                    $endTime = substr($endTime, 0, 5) . " " . substr($endTime, 5);

                    if(strtotime($currTime) > strtotime($startingTime) && strtotime($currTime) < strtotime($endTime)) {
                      $gfrcTime = $startingTime. " to ". $endTime. "(OPEN)";
                    } else {
                      $gfrcTime = $startingTime. " to ". $endTime. "(CLOSED)";
                    }
                    break;

                  case 'Mon':
                    // Getting start and end time and formate them
                    $startingTime = explode('–', explode(" ", $gfrcFile[6])[1])[0];
                    $endTime = explode('–', explode(" ", $gfrcFile[6])[1])[1];

                    // Converting time to a formate that is decodeable by strtotime
                    $startingTime = substr($startingTime, 0, 5) . " " . substr($startingTime, 5);
                    $endTime = substr($endTime, 0, 5) . " " . substr($endTime, 5);

                    if(strtotime($currTime) > strtotime($startingTime) && strtotime($currTime) < strtotime($endTime)) {
                      $gfrcTime = $startingTime. " to ". $endTime. "(OPEN)";
                    } else {
                      $gfrcTime = $startingTime. " to ". $endTime. "(CLOSED)";
                    }
                    break;

                  case 'Tue':
                    // Getting start and end time and formate them
                    $startingTime = explode('–', explode(" ", $gfrcFile[7])[1])[0];
                    $endTime = explode('–', explode(" ", $gfrcFile[7])[1])[1];

                    // Converting time to a formate that is decodeable by strtotime
                    $startingTime = substr($startingTime, 0, 5) . " " . substr($startingTime, 5);
                    $endTime = substr($endTime, 0, 5) . " " . substr($endTime, 5);

                    if(strtotime($currTime) > strtotime($startingTime) && strtotime($currTime) < strtotime($endTime)) {
                      $gfrcTime = $startingTime. " to ". $endTime. "(OPEN)";
                    } else {
                      $gfrcTime = $startingTime. " to ". $endTime. "(CLOSED)";
                    }
                    break;

                  case 'Wed':
                    // Getting start and end time and formate them
                    $startingTime = explode('–', explode(" ", $gfrcFile[8])[1])[0];
                    $endTime = explode('–', explode(" ", $gfrcFile[8])[1])[1];

                    // Converting time to a formate that is decodeable by strtotime
                    $startingTime = substr($startingTime, 0, 5) . " " . substr($startingTime, 5);
                    $endTime = substr($endTime, 0, 5) . " " . substr($endTime, 5);

                    if(strtotime($currTime) > strtotime($startingTime) && strtotime($currTime) < strtotime($endTime)) {
                      $gfrcTime = $startingTime. " to ". $endTime. "(OPEN)";
                    } else {
                      $gfrcTime = $startingTime. " to ". $endTime. "(CLOSED)";
                    }
                    break;

                  case 'Thu':
                    // Getting start and end time and formate them
                    $startingTime = explode('–', explode(" ", $gfrcFile[9])[1])[0];
                    $endTime = explode('–', explode(" ", $gfrcFile[9])[1])[1];

                    // Converting time to a formate that is decodeable by strtotime
                    $startingTime = substr($startingTime, 0, 5) . " " . substr($startingTime, 5);
                    $endTime = substr($endTime, 0, 5) . " " . substr($endTime, 5);

                    if(strtotime($currTime) > strtotime($startingTime) && strtotime($currTime) < strtotime($endTime)) {
                      $gfrcTime = $startingTime. " to ". $endTime. "(OPEN)";
                    } else {
                      $gfrcTime = $startingTime. " to ". $endTime. "(CLOSED)";
                    }
                    break;

                  case 'Fri':
                    // Getting start and end time and formate them
                    $startingTime = explode('–', explode(" ", $gfrcFile[10])[1])[0];
                    $endTime = explode('–', explode(" ", $gfrcFile[10])[1])[1];

                    // Converting time to a formate that is decodeable by strtotime
                    $startingTime = substr($startingTime, 0, 5) . " " . substr($startingTime, 5);
                    $endTime = substr($endTime, 0, 5) . " " . substr($endTime, 5);

                    if(strtotime($currTime) > strtotime($startingTime) && strtotime($currTime) < strtotime($endTime)) {
                      $gfrcTime = $startingTime. " to ". $endTime. "(OPEN)";
                    } else {
                      $gfrcTime = $startingTime. " to ". $endTime. "(CLOSED)";
                    }
                    break;

                  case 'Sat':
                    // Getting start and end time and formate them
                    $startingTime = explode('–', explode(" ", $gfrcFile[11])[1])[0];
                    $endTime = explode('–', explode(" ", $gfrcFile[11])[1])[1];

                    // Converting time to a formate that is decodeable by strtotime
                    $startingTime = substr($startingTime, 0, 5) . " " . substr($startingTime, 5);
                    $endTime = substr($endTime, 0, 5) . " " . substr($endTime, 5);

                    if(strtotime($currTime) > strtotime($startingTime) && strtotime($currTime) < strtotime($endTime)) {
                      $gfrcTime = $startingTime. " to ". $endTime. "(OPEN)";
                    } else {
                      $gfrcTime = $startingTime. " to ". $endTime. "(CLOSED)";
                    }
                    break;
                }

              }


              // Mcdonalds
              $mcFile = file("txtDB/mcdonal.txt");
              $mcTime;
              if($mcFile) {
                switch ($day) {
                  case 'Sun':
                    // Getting start and end time and formate them
                    $startingTime = explode('–', explode(" ", $mcFile[5])[1])[0];
                    $endTime = explode('–', explode(" ", $mcFile[5])[1])[1];

                    // Converting time to a formate that is decodeable by strtotime
                    $startingTime = substr($startingTime, 0, 5) . " " . substr($startingTime, 5);
                    $endTime = substr($endTime, 0, 5) . " " . substr($endTime, 5);

                    if(strtotime($currTime) > strtotime($startingTime) && strtotime($currTime) < strtotime($endTime)) {
                      $mcTime = $startingTime. " to ". $endTime. "(OPEN)";
                    } else {
                      $mcTime = $startingTime. " to ". $endTime. "(CLOSED)";
                    }
                    break;

                  case 'Mon':
                    // Getting start and end time and formate them
                    $startingTime = explode('–', explode(" ", $mcFile[6])[1])[0];
                    $endTime = explode('–', explode(" ", $mcFile[6])[1])[1];

                    // Converting time to a formate that is decodeable by strtotime
                    $startingTime = substr($startingTime, 0, 5) . " " . substr($startingTime, 5);
                    $endTime = substr($endTime, 0, 5) . " " . substr($endTime, 5);

                    if(strtotime($currTime) > strtotime($startingTime) && strtotime($currTime) < strtotime($endTime)) {
                      $mcTime = $startingTime. " to ". $endTime. "(OPEN)";
                    } else {
                      $mcTime = $startingTime. " to ". $endTime. "(CLOSED)";
                    }
                    break;

                  case 'Tue':
                    // Getting start and end time and formate them
                    $startingTime = explode('–', explode(" ", $mcFile[7])[1])[0];
                    $endTime = explode('–', explode(" ", $mcFile[7])[1])[1];

                    // Converting time to a formate that is decodeable by strtotime
                    $startingTime = substr($startingTime, 0, 5) . " " . substr($startingTime, 5);
                    $endTime = substr($endTime, 0, 5) . " " . substr($endTime, 5);

                    if(strtotime($currTime) > strtotime($startingTime) && strtotime($currTime) < strtotime($endTime)) {
                      $mcTime = $startingTime. " to ". $endTime. "(OPEN)";
                    } else {
                      $mcTime = $startingTime. " to ". $endTime. "(CLOSED)";
                    }
                    break;

                  case 'Wed':
                    // Getting start and end time and formate them
                    $startingTime = explode('–', explode(" ", $mcFile[8])[1])[0];
                    $endTime = explode('–', explode(" ", $mcFile[8])[1])[1];

                    // Converting time to a formate that is decodeable by strtotime
                    $startingTime = substr($startingTime, 0, 5) . " " . substr($startingTime, 5);
                    $endTime = substr($endTime, 0, 5) . " " . substr($endTime, 5);

                    if(strtotime($currTime) > strtotime($startingTime) && strtotime($currTime) < strtotime($endTime)) {
                      $mcTime = $startingTime. " to ". $endTime. "(OPEN)";
                    } else {
                      $mcTime = $startingTime. " to ". $endTime. "(CLOSED)";
                    }
                    break;

                  case 'Thu':
                    // Getting start and end time and formate them
                    $startingTime = explode('–', explode(" ", $mcFile[9])[1])[0];
                    $endTime = explode('–', explode(" ", $mcFile[9])[1])[1];

                    // Converting time to a formate that is decodeable by strtotime
                    $startingTime = substr($startingTime, 0, 5) . " " . substr($startingTime, 5);
                    $endTime = substr($endTime, 0, 5) . " " . substr($endTime, 5);

                    if(strtotime($currTime) > strtotime($startingTime) && strtotime($currTime) < strtotime($endTime)) {
                      $mcTime = $startingTime. " to ". $endTime. "(OPEN)";
                    } else {
                      $mcTime = $startingTime. " to ". $endTime. "(CLOSED)";
                    }
                    break;

                  case 'Fri':
                    // Getting start and end time and formate them
                    $startingTime = explode('–', explode(" ", $mcFile[10])[1])[0];
                    $endTime = explode('–', explode(" ", $mcFile[10])[1])[1];

                    // Converting time to a formate that is decodeable by strtotime
                    $startingTime = substr($startingTime, 0, 5) . " " . substr($startingTime, 5);
                    $endTime = substr($endTime, 0, 5) . " " . substr($endTime, 5);

                    if(strtotime($currTime) > strtotime($startingTime) && strtotime($currTime) < strtotime($endTime)) {
                      $mcTime = $startingTime. " to ". $endTime. "(OPEN)";
                    } else {
                      $mcTime = $startingTime. " to ". $endTime. "(CLOSED)";
                    }
                    break;

                  case 'Sat':
                    // Getting start and end time and formate them
                    $startingTime = explode('–', explode(" ", $mcFile[11])[1])[0];
                    $endTime = explode('–', explode(" ", $mcFile[11])[1])[1];

                    // Converting time to a formate that is decodeable by strtotime
                    $startingTime = substr($startingTime, 0, 5) . " " . substr($startingTime, 5);
                    $endTime = substr($endTime, 0, 5) . " " . substr($endTime, 5);

                    if(strtotime($currTime) > strtotime($startingTime) && strtotime($currTime) < strtotime($endTime)) {
                      $mcTime = $startingTime. " to ". $endTime. "(OPEN)";
                    } else {
                      $mcTime = $startingTime. " to ". $endTime. "(CLOSED)";
                    }
                    break;
                }

              }


              // Costco
              $costFile = file("txtDB/costco.txt");
              $costTime;
              if($costFile) {
                switch ($day) {
                  case 'Sun':
                    // Getting start and end time and formate them
                    $startingTime = explode('–', explode(" ", $costFile[5])[1])[0];
                    $endTime = explode('–', explode(" ", $costFile[5])[1])[1];

                    // Converting time to a formate that is decodeable by strtotime
                    $startingTime = substr($startingTime, 0, 5) . " " . substr($startingTime, 5);
                    $endTime = substr($endTime, 0, 5) . " " . substr($endTime, 5);

                    if(strtotime($currTime) > strtotime($startingTime) && strtotime($currTime) < strtotime($endTime)) {
                      $costTime = $startingTime. " to ". $endTime. "(OPEN)";
                    } else {
                      $costTime = $startingTime. " to ". $endTime. "(CLOSED)";
                    }
                    break;

                  case 'Mon':
                    // Getting start and end time and formate them
                    $startingTime = explode('–', explode(" ", $costFile[6])[1])[0];
                    $endTime = explode('–', explode(" ", $costFile[6])[1])[1];

                    // Converting time to a formate that is decodeable by strtotime
                    $startingTime = substr($startingTime, 0, 5) . " " . substr($startingTime, 5);
                    $endTime = substr($endTime, 0, 5) . " " . substr($endTime, 5);

                    if(strtotime($currTime) > strtotime($startingTime) && strtotime($currTime) < strtotime($endTime)) {
                      $costTime = $startingTime. " to ". $endTime. "(OPEN)";
                    } else {
                      $costTime = $startingTime. " to ". $endTime. "(CLOSED)";
                    }
                    break;

                  case 'Tue':
                    // Getting start and end time and formate them
                    $startingTime = explode('–', explode(" ", $costFile[7])[1])[0];
                    $endTime = explode('–', explode(" ", $costFile[7])[1])[1];

                    // Converting time to a formate that is decodeable by strtotime
                    $startingTime = substr($startingTime, 0, 5) . " " . substr($startingTime, 5);
                    $endTime = substr($endTime, 0, 5) . " " . substr($endTime, 5);

                    if(strtotime($currTime) > strtotime($startingTime) && strtotime($currTime) < strtotime($endTime)) {
                      $costTime = $startingTime. " to ". $endTime. "(OPEN)";
                    } else {
                      $costTime = $startingTime. " to ". $endTime. "(CLOSED)";
                    }
                    break;

                  case 'Wed':
                    // Getting start and end time and formate them
                    $startingTime = explode('–', explode(" ", $costFile[8])[1])[0];
                    $endTime = explode('–', explode(" ", $costFile[8])[1])[1];

                    // Converting time to a formate that is decodeable by strtotime
                    $startingTime = substr($startingTime, 0, 5) . " " . substr($startingTime, 5);
                    $endTime = substr($endTime, 0, 5) . " " . substr($endTime, 5);

                    if(strtotime($currTime) > strtotime($startingTime) && strtotime($currTime) < strtotime($endTime)) {
                      $costTime = $startingTime. " to ". $endTime. "(OPEN)";
                    } else {
                      $costTime = $startingTime. " to ". $endTime. "(CLOSED)";
                    }
                    break;

                  case 'Thu':
                    // Getting start and end time and formate them
                    $startingTime = explode('–', explode(" ", $costFile[9])[1])[0];
                    $endTime = explode('–', explode(" ", $costFile[9])[1])[1];

                    // Converting time to a formate that is decodeable by strtotime
                    $startingTime = substr($startingTime, 0, 5) . " " . substr($startingTime, 5);
                    $endTime = substr($endTime, 0, 5) . " " . substr($endTime, 5);

                    if(strtotime($currTime) > strtotime($startingTime) && strtotime($currTime) < strtotime($endTime)) {
                      $costTime = $startingTime. " to ". $endTime. "(OPEN)";
                    } else {
                      $costTime = $startingTime. " to ". $endTime. "(CLOSED)";
                    }
                    break;

                  case 'Fri':
                    // Getting start and end time and formate them
                    $startingTime = explode('–', explode(" ", $costFile[10])[1])[0];
                    $endTime = explode('–', explode(" ", $costFile[10])[1])[1];

                    // Converting time to a formate that is decodeable by strtotime
                    $startingTime = substr($startingTime, 0, 5) . " " . substr($startingTime, 5);
                    $endTime = substr($endTime, 0, 5) . " " . substr($endTime, 5);

                    if(strtotime($currTime) > strtotime($startingTime) && strtotime($currTime) < strtotime($endTime)) {
                      $costTime = $startingTime. " to ". $endTime. "(OPEN)";
                    } else {
                      $costTime = $startingTime. " to ". $endTime. "(CLOSED)";
                    }
                    break;

                  case 'Sat':
                    // Getting start and end time and formate them
                    $startingTime = explode('–', explode(" ", $costFile[11])[1])[0];
                    $endTime = explode('–', explode(" ", $costFile[11])[1])[1];

                    // Converting time to a formate that is decodeable by strtotime
                    $startingTime = substr($startingTime, 0, 5) . " " . substr($startingTime, 5);
                    $endTime = substr($endTime, 0, 5) . " " . substr($endTime, 5);

                    if(strtotime($currTime) > strtotime($startingTime) && strtotime($currTime) < strtotime($endTime)) {
                      $costTime = $startingTime. " to ". $endTime. "(OPEN)";
                    } else {
                      $costTime = $startingTime. " to ". $endTime. "(CLOSED)";
                    }
                    break;
                }

              }
            ?>

            <div class="store">

              <i class="far fa-star favSelect"></i>
              <img class="store_img" src="src/Costco.png">
              <h2>Costco <br> ($1:5 points) </h2>

              <div class="storeSection">
                <i class="fas fa-clock storeIcon"></i>
                <p class="storeText"> <?php echo $costTime ?> </p>
              </div>

              <div class="storeSection">
                <i class="fas fa-shopping-basket storeIcon"></i>
                <p class="storeText">Grocery Store</p>
              </div>

              <div class="storeSection">
                <i class="fas fa-dollar-sign storeIcon"></i>
                <p class="storeText">$60/120</p>
              </div>

              <div class="storeSection">
                <i class="far fa-smile storeIcon"></i>
                <p class="storeText">82% Satisfactory Score</p>
              </div>

              <a class="storeMoreBtn" href="storeDetail.php?name=costco">More</a>

            </div>

            <!-- Food with bad satisfactory-->
            <div class="store">

              <i class="far fa-star favSelect"></i>
              <img class="store_img" src="src/McDonald's.png">
              <h2>McDonald's <br> ($1:2 points) </h2>

              <div class="storeSection">
                <i class="fas fa-clock storeIcon"></i>
                <p class="storeText"><?php echo $mcTime; ?></p>
              </div>

              <div class="storeSection">
                <i class="fas fa-utensils storeIcon"></i>
                <p class="storeText">Restuarant</p>
              </div>

              <div class="storeSection">
                <i class="fas fa-dollar-sign storeIcon"></i>
                <p class="storeText">$25 per person</p>
              </div>

              <div class="storeSection">

                <i class="far fa-frown-open storeIcon"></i>
                <p class="storeText">46% Satisfactory Score</p>
              </div>

              <a class="storeMoreBtn" href="storeDetail.php?name=mcdonal">More</a>

            </div>

            <!-- Activity with good satisfactory-->
            <div class="store">

              <i class="far fa-star favSelect"></i>
              <img class="store_img" src="src/Guildford Recreation Centre.png">
              <h2>Guildford Recreation Center <br> ($1:2.5 points) </h2>

              <div class="storeSection">
                <i class="fas fa-clock storeIcon"></i>
                <p class="storeText"> <?php echo $gfrcTime; ?> </p>
              </div>

              <div class="storeSection">
                <i class="fas fa-cloud-sun storeIcon"></i>
                <p class="storeText">Activity</p>
              </div>

              <div class="storeSection">
                <i class="fas fa-dollar-sign storeIcon"></i>
                <p class="storeText">$7.25 per person</p>
              </div>

              <div class="storeSection">
                <i class="far fa-smile storeIcon"></i>
                <p class="storeText">76% Satisfactory Score</p>
              </div>

              <a class="storeMoreBtn" href="storeDetail.php?name=guildfordRecCenter">More</a>

            </div>

            <!-- Restuarant with okay satisfactory-->
            <div class="store">

              <i class="far fa-star favSelect"></i>
              <img class="store_img" src="src/Subway.png">
              <h2>Subway <br> ($1:2 points) </h2>

              <div class="storeSection">
                <i class="fas fa-clock storeIcon"></i>
                <p class="storeText"> <?php echo $subwayTime; ?> </p>
              </div>

              <div class="storeSection">
                <i class="fas fa-utensils storeIcon"></i>
                <p class="storeText">Restuarant</p>
              </div>

              <div class="storeSection">
                <i class="fas fa-dollar-sign storeIcon"></i>
                <p class="storeText">$25 per person</p>
              </div>

              <div class="storeSection">
                <i class="far fa-meh storeIcon"></i>
                <p class="storeText">62% Satisfactory Score</p>
              </div>

              <a class="storeMoreBtn" href="storeDetail.php?name=subway">More</a>

            </div>


          </div>


        </section>


      </main>

      <!-- The following section is footer -->
      <footer>
        <p class="footerText">RewardsX@2019</p>
      </footer>


    </body>
</html>