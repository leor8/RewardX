<!DOCTYPE html>
<html lang="en">
    <head>
        <title>RewardX - Home</title>

        <!-- Making sure the site is web friendly -->
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" type="text/css" href="css/normalize.css">
        <link rel="stylesheet" type="text/css" href="css/store.css">

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
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
          </div>
        </nav>

      </header>


      <main>

      <!-- Getting URL Query and text file containing the information -->
      <?php
         // Getting default db varialbe
        require 'DBinfo.php';

        // Opening a db connection
        $con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

        $name; $type; $des; $rating; $address; $time; $url; $price; $srcLink;

        $gettingQuery = "SELECT * FROM Store WHERE StoreId = ". $_GET["id"];

        // get results
        $storeResult = mysqli_query($con, $gettingQuery);

        // If query failed, end the program
        if (!$storeResult) {
          die("Database query failed.");
        }

        while ($row = mysqli_fetch_assoc($storeResult)) {
          $name = $row["StoreName"];
          $type = $row["StoreType"];
          $des = $row["StoreDes"];
          $rating = $row["StoreRatings"];
          $address = $row["StoreAddress"];
          $time = $row["StoreHours"];
          $url = $row["StoreLink"];
          $price = $row["StorePriceAverage"];
          $srcLink = $row["StoreImage"];
        }

        // Free the results
        mysqli_free_result($storeResult);

      ?>

      <!-- Name of the store (Added dynamically) -->
      <h1><?php echo $name ?>
      <?php
        if($type == "Food") {
          echo "<i class=\"fas fa-utensils storeIcon\"></i>";
        } else if ($type == "Shop") {
          echo "<i class=\"fas fa-shopping-basket storeIcon\" aria-hidden=\"true\"></i>";
        } else {
          echo "<i class=\"fas fa-cloud-sun storeIcon\" aria-hidden=\"true\"></i>";
        }

      ?>

      <span class="score">
          <?php echo $rating?> Satisfaction Score
        <i class="far fa-star favSelect"></i> </span></h1>

      <p class="storeDes"> <?php echo $des?> </p>

      <section class="storeSec">
        <!-- Images on the side -->
         <div class="imgs">
          <?php

            echo "
              <img src=\"". $srcLink. "/1.png\" class=\"storeImg\">
              <img src=\"". $srcLink. "/2.png\" class=\"storeImg\">
              <img src=\"". $srcLink. "/3.png\" class=\"storeImg\">
            "
          ?>
        </div>

        <!-- Store information -->
          <div class="storeInfo">

            <!-- Each section contains a different piece of information -->
            <div class="eachSection">
              <i class="fas fa-map-marker-alt mapIcon"></i>
              <p class="storeInfoText"> <?php echo $address ?></p>
            </div>

            <div class="eachSection">
              <i class="fas fa-clock mapIcon" style="margin-left: 1.6rem;"></i>
              <p class="storeInfoText">
                <?php
                  date_default_timezone_set('America/Vancouver');
                  $day = date('D', time());

                  $timeArr = explode(" ", $time);

                  for($index = 0; $index < count($timeArr); $index++) {
                    $timeArr[$index] = str_replace("_", "-" , $timeArr[$index]);
                    if($index == 0) {
                      $timeArr[$index] = "Sunday ". $timeArr[$index];
                    } else if ($index == 1) {
                      $timeArr[$index] = "Monday ". $timeArr[$index];
                    } else if ($index == 2) {
                      $timeArr[$index] = "Tuesday ". $timeArr[$index];
                    } else if ($index == 3) {
                      $timeArr[$index] = "Wednesday ". $timeArr[$index];
                    } else if ($index == 4) {
                      $timeArr[$index] = "Thursday ". $timeArr[$index];
                    } else if ($index == 5) {
                      $timeArr[$index] = "Friday ". $timeArr[$index];
                    } else if ($index == 6) {
                      $timeArr[$index] = "Saturday ". $timeArr[$index];
                    }


                  }

                  switch ($day) {
                    case 'Sun':
                      # code...
                      if($_GET["open"] == 1) {
                        echo "
                          <p class=\"storeInfoText\">
                          <span style=\"color: green\">". $timeArr[0]. "(Open)<br/></span>".
                          $timeArr[1]."<br>".
                          $timeArr[2]."<br>".
                          $timeArr[3]."<br>".
                          $timeArr[4]."<br>".
                          $timeArr[5]."<br>".
                          $timeArr[6].
                          "</p>"
                        ;
                      } else {
                        echo "
                          <p class=\"storeInfoText\">
                          <span style=\"color: red\">". $timeArr[0]. "(Closed)<br/></span>".
                          $timeArr[1]."<br>".
                          $timeArr[2]."<br>".
                          $timeArr[3]."<br>".
                          $timeArr[4]."<br>".
                          $timeArr[5]."<br>".
                          $timeArr[6].
                          "</p>"
                        ;
                      }

                      break;

                      case 'Mon':
                        # code...
                        if($_GET["open"] == 1) {
                          echo "
                            <p class=\"storeInfoText\">".
                            $timeArr[0]."<br>".
                            "<span style=\"color: green\">". $timeArr[1]. "(Open)<br/></span>".
                            $timeArr[2]."<br>".
                            $timeArr[3]."<br>".
                            $timeArr[4]."<br>".
                            $timeArr[5]."<br>".
                            $timeArr[6].
                            "</p>"
                          ;
                        } else {
                          echo "
                            <p class=\"storeInfoText\">".
                            $timeArr[0]."<br>".
                            "<span style=\"color: red\">". $timeArr[1]. "(Closed)<br/></span>".
                            $timeArr[2]."<br>".
                            $timeArr[3]."<br>".
                            $timeArr[4]."<br>".
                            $timeArr[5]."<br>".
                            $timeArr[6].
                            "</p>"
                          ;
                        }

                        break;

                      case 'Tue':
                        # code...
                        if($_GET["open"] == 1) {
                          echo "
                            <p class=\"storeInfoText\">".
                            $timeArr[0]."<br>".
                            $timeArr[1]."<br>".
                            "<span style=\"color: green\">". $timeArr[2]. "(Open)<br/></span>".
                            $timeArr[3]."<br>".
                            $timeArr[4]."<br>".
                            $timeArr[5]."<br>".
                            $timeArr[6].
                            "</p>"
                          ;
                        } else {
                          echo "
                            <p class=\"storeInfoText\">".
                            $timeArr[0]."<br>".
                            $timeArr[1]."<br>".
                            "<span style=\"color: red\">". $timeArr[2]. "(Closed)<br/></span>".
                            $timeArr[3]."<br>".
                            $timeArr[4]."<br>".
                            $timeArr[5]."<br>".
                            $timeArr[6].
                            "</p>"
                          ;
                        }

                        break;

                      case 'Wed':
                        # code...
                        if($_GET["open"] == 1) {
                          echo "
                            <p class=\"storeInfoText\">".
                            $timeArr[0]."<br>".
                            $timeArr[1]."<br>".
                            $timeArr[2]."<br>".
                            "<span style=\"color: green\">". $timeArr[3]. "(Open)<br/></span>".
                            $timeArr[4]."<br>".
                            $timeArr[5]."<br>".
                            $timeArr[6].
                            "</p>"
                          ;
                        } else {
                           echo "
                            <p class=\"storeInfoText\">".
                            $timeArr[0]."<br>".
                            $timeArr[1]."<br>".
                            $timeArr[2]."<br>".
                            "<span style=\"color: red\">". $timeArr[3]. "(Closed)<br/></span>".
                            $timeArr[4]."<br>".
                            $timeArr[5]."<br>".
                            $timeArr[6].
                            "</p>"
                          ;
                        }

                        break;

                      case 'Thu':
                        # code...
                        if($_GET["open"] == 1) {
                          echo "
                            <p class=\"storeInfoText\">".
                            $timeArr[0]."<br>".
                            $timeArr[1]."<br>".
                            $timeArr[2]."<br>".
                            $timeArr[3]."<br>".
                            "<span style=\"color: green\">". $timeArr[4]. "(Open)<br/></span>".
                            $timeArr[5]."<br>".
                            $timeArr[6].
                            "</p>"
                          ;
                        } else {
                           echo "
                            <p class=\"storeInfoText\">".
                            $timeArr[0]."<br>".
                            $timeArr[1]."<br>".
                            $timeArr[2]."<br>".
                            $timeArr[3]."<br>".
                            "<span style=\"color: red\">". $timeArr[4]. "(Closed)<br/></span>".
                            $timeArr[5]."<br>".
                            $timeArr[6].
                            "</p>"
                          ;
                        }

                        break;

                      case 'Fri':
                        # code...
                        if($_GET["open"] == 1) {
                          echo "
                            <p class=\"storeInfoText\">".
                            $timeArr[0]."<br>".
                            $timeArr[1]."<br>".
                            $timeArr[2]."<br>".
                            $timeArr[3]."<br>".
                            $timeArr[4]."<br>".
                            "<span style=\"color: green\">". $timeArr[5]. "(Open)<br/></span>".
                            $timeArr[6].
                            "</p>"
                          ;
                        } else {
                           echo "
                            <p class=\"storeInfoText\">".
                            $timeArr[0]."<br>".
                            $timeArr[1]."<br>".
                            $timeArr[2]."<br>".
                            $timeArr[3]."<br>".
                            $timeArr[4]."<br>".
                            "<span style=\"color: red\">". $timeArr[5]. "(Closed)<br/></span>".
                            $timeArr[6].
                            "</p>"
                          ;
                        }

                        break;

                      case 'Sat':
                        # code...
                        if($_GET["open"] == 1) {
                          echo "
                            <p class=\"storeInfoText\">".
                            $timeArr[0]."<br>".
                            $timeArr[1]."<br>".
                            $timeArr[2]."<br>".
                            $timeArr[3]."<br>".
                            $timeArr[4]."<br>".
                            $timeArr[5]."<br>".
                            "<span style=\"color: green\">". $timeArr[6]. "(Open)</span>".
                            "</p>"
                          ;
                        } else {
                           echo "
                            <p class=\"storeInfoText\">".
                            $timeArr[0]."<br>".
                            $timeArr[1]."<br>".
                            $timeArr[2]."<br>".
                            $timeArr[3]."<br>".
                            $timeArr[4]."<br>".
                            $timeArr[5]."<br>".
                            "<span style=\"color: red\">". $timeArr[6]. "(Open)</span>".
                            "</p>"
                          ;
                        }

                  }


                ?>


              </p>
          </div>

          <div class="eachSection">
            <i class="fas fa-link mapIcon"></i>

            <?php
              echo "<a class=\"storeInfoText\" href=\"". $url ."\" style=\"text-decoration: underline; color: blue;\">". $url ."</a>";
            ?>
          </div>

          <div class="eachSection">
            <i class="fas fa-dollar-sign mapIcon" style="margin-left: 2.6rem; margin-right: 0.7rem;"></i>
            <p class="storeInfoText"> <?php echo $price; ?> / Person</p>
          </div>

          <!-- The followings are for comments -->
           <div class="eachSection">
              <form>
                <h2>Leave a review</h2>
                <div>
                  <label>Out of 10, how would you rate the place?</label>
                  <input type="number" name="rating" step="0.1" class="commentInput">
                </div>

                <textarea></textarea>

                <button class="submitBtn" type="submit">Submit Review </button>

              </form>
            </div>

            <div class="eachSection" style="margin-top: 2rem;">
              <h2>Reviews</h2>

              <!-- TODO: The comment should be loaded from a comment sql table (Needs to be created) -->
              <!-- The following comments are retrieved from google reviews AS A PLACEHOLDER to show the visuals-->

              <?php
                $commentQuery = "SELECT * FROM Comments WHERE BelongStore = ". $_GET["id"];

                $commentResults = mysqli_query($con, $commentQuery);

                // If query failed, end the program
                if (!$commentResults) {
                  die("Database query failed.");
                }

                if(mysqli_num_rows($commentResults) == 0) {
                  echo "<p>Be the first one to comment!</p>";
                }
                while ($row = mysqli_fetch_assoc($commentResults)) {
                  echo "
                  <div class=\"eachComment\">
                    <img src=\"https://api.adorable.io/avatars/285/". $row["UserName"].".png\" class=\"commentIcon\">
                    <div class=\"commentName\">
                      <h3>". $row["UserName"]. "</h3>
                      <p class=\"commentPoints\">". $row["UserRating"]." Score</p>
                    </div>

                    <p class=\"reviewDetail\">". $row["UserComment"]."</p>

                  </div>
                  ";
                }
              ?>

              <!-- <div class="eachComment">
                <img src="https://api.adorable.io/avatars/285/Jan.png" class="commentIcon">
                <div class="commentName">
                  <h3>Baljeet Kaur</h3>
                  <p class="commentPoints">89 Score</p>
                </div>

                <p class="reviewDetail">We had an office function the other day and we brought in two platters of assorted sandwiches from Subway and everybody enjoyed it. This is a great place to do a late catering job at the office. We received excellent service.</p>

              </div>

              <div class="eachComment">
                <img src="https://api.adorable.io/avatars/285/Lucy.png" class="commentIcon">
                <div class="commentName">
                  <h3>Lucky Nic</h3>
                  <p class="commentPoints">5 Score</p>
                </div>

                <p class="reviewDetail">Staff member named upkar and her 2 coworkers were absolutely atrocious to deal with. 1 of them was making their personal home lunch on the counter which was some disgusting looking stew... I'm fine with employees making their lunch but not outside food where my food is being prepared. The took no care with making my sandwich either they may as well have thrown it at me when they were done. I hope management sees this and has a chat with these girls because I was a few moments away from declining my sandwich and walking out after watching it be prepared. Also this is the dirtiest subway ever. Finally to end my rant... how come with 3 girls working behind the counter it still took almost 10 minutes to take my order.. this place is a joke.</p>

              </div>



            </div>

          </div> -->
      </section>

      <a class="returnBtn" href="partners.php">
        <i class="fas fa-arrow-left"></i>
      </a>

      </main>

      <!-- The following section is footer -->
      <footer>
        <p class="footerText">RewardsX@2019</p>
      </footer>

    </body>
</html>

<?php

// Close Connection
mysqli_close($con);
?>












