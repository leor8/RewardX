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
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
          </div>
        </nav>

      </header>

      <!-- The main content of the page -->
      <h1>Redeem Reward: (Your points 260)</h1>
      <main>
        <div class="item">
          <img src="src/iphone.png" class="itemImg">
          <p class="itemHeading">Iphone 11</p>
          <p class="itemText">The newest Iphone for free</p>
          <button class="itemBtn">Redeem: 200000pt </button>
        </div>

        <div class="item">
          <img src="src/amazon.png" class="itemImg">
          <p class="itemHeading">Amazon Gift Card</p>
          <p class="itemText">A $25 amazon gift card</p>
          <button class="itemBtn">Redeem: 1000pt </button>
        </div>
        <div class="item">
          <img src="src/mug.png" class="itemImg">
          <p class="itemHeading">White Mug</p>
          <p class="itemText">A white mug that you can engrave anything on for free</p>
          <button class="itemBtn">Redeem: 500pt </button>
        </div>
        <div class="item">
          <img src="src/googleCardboard.png" class="itemImg">
          <p class="itemHeading">Google Cardboard</p>
          <p class="itemText">An easy to setup VR device</p>
          <button class="itemBtn">Redeem: 1200pt </button>
        </div>
        <div class="item">
          <img src="src/ac.png" class="itemImg">
          <p class="itemHeading">Portable AC</p>
          <p class="itemText">Easy to install portable air conditioner</p>
          <button class="itemBtn">Redeem: 30000pt </button>
        </div>
      </main>

      <!-- The following section is footer -->
      <footer>
        <p class="footerText">RewardsX@2019</p>
      </footer>


    </body>
</html>