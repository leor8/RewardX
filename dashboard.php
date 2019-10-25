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

          <!-- The following section contains user's icon, name and points -->
          <section class="userDash">
            <img src="https://api.adorable.io/avatars/285/Leo.png" class="userIcon">
            <h2>User name</h2>

            <div class="dashSec">
              <p class="dashHeadings">Your points:</p>
              <p class="userPoints">200</p>
            </div>

            <!-- QR Code Section -->
            <div class="dashSec">
              <p class="dashHeadings">Your QR code:</p>
              <img src="src/qr.jpg" alt="A placeholder qr code" class="user_qr">
            </div>

            <button class="logout">Logout</button>
          </section>


        <section class="sectionDash">

          <!-- The following section is for contents user can edit including their favorites -->
          <section class="userEdit food">
            <i class="fas fa-star iconStar"></i>
            <h2>Subway</h2>
            <p class="favText">Last Visit: 2019/09/21</p>
            <p class="favText">Points Earned: 70</p>
            <button class="favBtn">Visit Shop</button>
            <button class="favBtn">Remove</button>
          </section>

          <section class="userEdit grocery">
            <i class="fas fa-star iconStar"></i>
            <h2>Costco</h2>
            <p class="favText">Last Visit: 2019/09/11</p>
            <p class="favText">Points Earned: 90</p>
            <button class="favBtn">Visit Shop</button>
            <button class="favBtn">Remove</button>
          </section>

          <section class="userEdit activity">
            <i class="fas fa-star iconStar"></i>
            <h2>PNE</h2>
            <p class="favText">Last Visit: 2019/08/21</p>
            <p class="favText">Points Earned: 20</p>
            <button class="favBtn">Visit Shop</button>
            <button class="favBtn">Remove</button>
          </section>

          <section class="userEdit food">
            <i class="fas fa-star iconStar"></i>
            <h2>KFC</h2>
            <p class="favText">Last Visit: 2019/09/22</p>
            <p class="favText">Points Earned: 10</p>
            <button class="favBtn">Visit Shop</button>
            <button class="favBtn">Remove</button>
          </section>

          <section class="userEdit food">
            <i class="fas fa-star iconStar"></i>
            <h2>Burger King</h2>
            <p class="favText">Last Visit: 2019/09/18</p>
            <p class="favText">Points Earned: 10</p>
            <button class="favBtn">Visit Shop</button>
            <button class="favBtn">Remove</button>
          </section>

        </section>

      </main>

      <footer>
        <p class="footerText">RewardsX@2019</p>
      </footer>

    </body>
</html>