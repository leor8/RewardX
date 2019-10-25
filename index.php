<!DOCTYPE html>
<html lang="en">
    <head>
        <title>RewardX - Home</title>

        <!-- Making sure the site is web friendly -->
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" type="text/css" href="css/normalize.css">
        <link rel="stylesheet" type="text/css" href="css/index.css">
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

      <!-- The main content of index page -->
      <main>

          <div class="highLevel">
            <!-- Section displaying high level information about rewardX-->
          <section class="info">
            <h1>RewardX</h1>
            <p class="cardInfo">A Free to sign up reward card system that let you pick up points going to your favorite places in down. <br/><br/> You can trade points for products like gift cards, household items and even mobile phones!</p>

            <!-- Buttons to visit other pages -->
            <div class="cardInfoBtns">
              <a href="partners.php" class="cardInfoNav partner_link">Our Partners</a>
              <a href="reward.php" class="cardInfoNav">All Rewards</a>
              <a href="register.php" class="cardInfoNav">Sign up</a>
            </div>


          </section>

          <section class="image_card">
            <!-- Image icons created by fontawesome -->
            <img src="src/rewardXCard.png" class="recardCardImg">
          </section>

        </div>

        <!-- The following sections outlines the advantages of the card -->
        <div>
          <h2 class="detailTitle">Our Advantages</h2>

          <!-- Sections to create flex box to hold three itmes -->
          <section class="cardDetail">

            <!-- Each section contains an icon, a heading and a text explaining the heading -->
            <section class="details">
              <i class="far fa-clock detailIcon"></i>
              <h3>
                Hassle Free
              </h3>

              <p class="detailText">Make a purchase and gain rewards instantly. </p>


            </section>

            <!-- Each section contains an icon, a heading and a text explaining the heading -->
            <section class="details">
              <i class="fas fa-mobile-alt detailIcon"></i>
              <h3>
                Mobile Friendly
              </h3>
              <p class="detailText">Scan your QR code and earn points from your phone.</p>
            </section>

            <!-- Each section contains an icon, a heading and a text explaining the heading -->
            <section class="details">
              <i class="fas fa-dollar-sign detailIcon"></i>
              <h3>
                Saves Money
              </h3>
              <p class="detailText">Redeem your points for discounts and cashback.</p>
            </section>

          </section>

          <!-- A button to enrol in the reward card -->
          <a href="register.php" class="detailJoin">Join Now</a>
        </div>


        <!-- The following section is footer -->
        <footer>
          <p class="footerText">RewardsX@2019</p>
        </footer>

      </main>


    </body>
</html>