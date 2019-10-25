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

      <!-- Getting URL Query and text file containing the information -->
      <?php
        $file = fopen("txtDB/".$_GET['name'].".txt", "r");
        $counter = 0;

        $name; $type; $des; $rating; $address; $time; $url; $price;

        if($file) {

          while (! feof($file)) {
            // echo $file;
            switch ($counter) {
              case 0:
                $name = fgets($file);
                break;
              case 1:
                $type = fgets($file);
                break;
              case 2:
                $des = fgets($file);
                break;
              case 3:
                $rating = fgets($file);
                break;
              case 4:
                $address = fgets($file);
                break;
              case 5:
                $time = fgets($file). "<br>";
                break;
              case 6:
                $time .= fgets($file). "<br>";
                break;
              case 7:
                $time .= fgets($file). "<br>";
                break;
              case 8:
                $time .= fgets($file). "<br>";
                break;
              case 9:
                $time .= fgets($file). "<br>";
                break;
              case 10:
                $time .= fgets($file). "<br>";
                break;
              case 11:
                $time .= fgets($file);
                break;
              case 12:
                $url = fgets($file);
                break;
              case 13:
                $price = fgets($file);
                break;
              default:

                break;
            }
            $counter++;
          }

        }
        fclose($file);

        // echo $name;
        // echo $type;
        // echo $des;
        // echo $rating;
        // echo $address;
        // echo $time;
        // echo $url;
        // echo $price;

        // Building the page compenents.s
      ?>

      <!-- The main content of index page -->
      <main>
        <!-- Name of the store (Added dynamically) -->
        <h1><?php echo $name ?>
        <?php
          if($type == "Food\n") {
            echo "<i class=\"fas fa-utensils storeIcon\"></i>";
          } else if ($type == "Shop\n") {
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
                <img src=\"src/". $name .".png\" class=\"storeImg\">
                <img src=\"src/". $name ."2.png\" class=\"storeImg\">
                <img src=\"src/". $name ."3.png\" class=\"storeImg\">
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
            <?php
              date_default_timezone_set('America/Vancouver');
              $day = date('D', time());
              $currTime = date('h:i a', time());

              $timeArr = explode("<br>", $time);

              switch ($day) {
                case 'Sun':
                  // Getting sunday's opening time
                  $startingTime = explode('–', explode(" ", $timeArr[0])[1])[0];
                  $endTime = explode('–', explode(" ", $timeArr[0])[1])[1];

                  // Converting time to a formate that is decodeable by strtotime
                  $startingTime = substr($startingTime, 0, 5) . " " . substr($startingTime, 5);
                  $endTime = substr($endTime, 0, 5) . " " . substr($endTime, 5);

                  // Compare to see if the store is open
                  if(strtotime($currTime) > strtotime($startingTime) && strtotime($currTime) < strtotime($endTime)) {
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
                  // Getting sunday's opening time
                  $startingTime = explode('–', explode(" ", $timeArr[0])[1])[0];
                  $endTime = explode('–', explode(" ", $timeArr[0])[1])[1];

                  // Converting time to a formate that is decodeable by strtotime
                  $startingTime = substr($startingTime, 0, 5) . " " . substr($startingTime, 5);
                  $endTime = substr($endTime, 0, 5) . " " . substr($endTime, 5);

                  // Compare to see if the store is open
                  if(strtotime($currTime) > strtotime($startingTime) && strtotime($currTime) < strtotime($endTime)) {
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
                  // Getting sunday's opening time
                  $startingTime = explode('–', explode(" ", $timeArr[0])[1])[0];
                  $endTime = explode('–', explode(" ", $timeArr[0])[1])[1];

                  // Converting time to a formate that is decodeable by strtotime
                  $startingTime = substr($startingTime, 0, 5) . " " . substr($startingTime, 5);
                  $endTime = substr($endTime, 0, 5) . " " . substr($endTime, 5);

                  // Compare to see if the store is open
                  if(strtotime($currTime) > strtotime($startingTime) && strtotime($currTime) < strtotime($endTime)) {
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
                  // Getting sunday's opening time
                  $startingTime = explode('–', explode(" ", $timeArr[0])[1])[0];
                  $endTime = explode('–', explode(" ", $timeArr[0])[1])[1];

                  // Converting time to a formate that is decodeable by strtotime
                  $startingTime = substr($startingTime, 0, 5) . " " . substr($startingTime, 5);
                  $endTime = substr($endTime, 0, 5) . " " . substr($endTime, 5);

                  // Compare to see if the store is open
                  if(strtotime($currTime) > strtotime($startingTime) && strtotime($currTime) < strtotime($endTime)) {
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
                  // Getting sunday's opening time
                  $startingTime = explode('–', explode(" ", $timeArr[0])[1])[0];
                  $endTime = explode('–', explode(" ", $timeArr[0])[1])[1];

                  // Converting time to a formate that is decodeable by strtotime
                  $startingTime = substr($startingTime, 0, 5) . " " . substr($startingTime, 5);
                  $endTime = substr($endTime, 0, 5) . " " . substr($endTime, 5);

                  // Compare to see if the store is open
                  if(strtotime($currTime) > strtotime($startingTime) && strtotime($currTime) < strtotime($endTime)) {
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
                  // Getting sunday's opening time
                  $startingTime = explode('–', explode(" ", $timeArr[0])[1])[0];
                  $endTime = explode('–', explode(" ", $timeArr[0])[1])[1];

                  // Converting time to a formate that is decodeable by strtotime
                  $startingTime = substr($startingTime, 0, 5) . " " . substr($startingTime, 5);
                  $endTime = substr($endTime, 0, 5) . " " . substr($endTime, 5);

                  // Compare to see if the store is open
                  if(strtotime($currTime) > strtotime($startingTime) && strtotime($currTime) < strtotime($endTime)) {
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
                  // Getting sunday's opening time
                  $startingTime = explode('–', explode(" ", $timeArr[0])[1])[0];
                  $endTime = explode('–', explode(" ", $timeArr[0])[1])[1];

                  // Converting time to a formate that is decodeable by strtotime
                  $startingTime = substr($startingTime, 0, 5) . " " . substr($startingTime, 5);
                  $endTime = substr($endTime, 0, 5) . " " . substr($endTime, 5);

                  // Compare to see if the store is open
                  if(strtotime($currTime) > strtotime($startingTime) && strtotime($currTime) < strtotime($endTime)) {
                    echo "
                      <p class=\"storeInfoText\">".
                      $timeArr[0]."<br>".
                      $timeArr[1]."<br>".
                      $timeArr[2]."<br>".
                      $timeArr[3]."<br>".
                      $timeArr[4]."<br>".
                      $timeArr[5]."<br>".
                      "<span style=\"color: green\">". $timeArr[6]. "(Open)<br/></span>".
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
                      "<span style=\"color: red\">". $timeArr[6]. "(Closed)<br/></span>".
                      "</p>"
                    ;
                  }
                  break;


                default:
                  # code...
                  break;
              }

            ?>
          </div>

          <div class="eachSection">
            <i class="fas fa-link mapIcon"></i>

            <?php
              echo "<a class=\"storeInfoText\" href=\"". $url ."\" style=\"text-decoration: underline; color: blue;\">". $url ."</a>";
            ?>
          </div>

          <div class="eachSection">
            <i class="fas fa-dollar-sign mapIcon" style="margin-left: 2.6rem; margin-right: 0.7rem;"></i>
            <p class="storeInfoText"> <?php echo $price; ?> </p>
          </div>

          <div class="eachSection">
              <form>
                <h2>Leave a review</h2>
                <div>
                  <label>Out of 10, how would you rate the place?</label>
                  <input type="number" name="rating" step="0.1" class="commentInput">
                </div>

                <textarea></textarea>

              </form>
            </div>

            <div class="eachSection" style="margin-top: 2rem;">
              <h2>Reviews</h2>
              <!-- The following comments are retrieved from google reviews AS A PLACEHOLDER to show the visuals-->
              <div class="eachComment">
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

          </div>
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














