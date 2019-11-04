<?php
session_start();

if (isset($_SESSION['currUser'])) { // if user is logged in
  echo "<script type='text/javascript'>alert('You are Logged in, redirecting to Dashboard.');</script>";
  header('Location: dashboard.php?id='.$_SESSION['currUser']);
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
        <link rel="stylesheet" type="text/css" href="css/login.css">
        <link rel="stylesheet" type="text/css" href="css/index.css">

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

        <div class="highLevel">
            <!-- Section displaying high level information about rewardX-->
          <section class="info">
            <h1>RewardX</h1>

            <h2>Register</h2>
            <form action="account_action.php" method="post" >
              <div class="formItem">
                <label for="email">Your Email: </label>
                <!-- Regular expression retrieved from http://regexlib.com/REDetails.aspx?regexp_id=16 -->
                <input type="text" placeholder="Enter Email" name="email" pattern="^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$" oninvalid="setCustomValidity('Please enter a valid email address')" required>

                <label for="username">Username: </label>
                <input type="text" placeholder="Enter Username" name="username" required>

                <label for="password">Password: </label>
                <input type="password" placeholder="Enter Password" name="password" required>

                <button type="submit" class="loginBtn">Register</button>
              </div>
            </form>

            <p class="registerPortal">Already have an account? <a class="normalA" href="login.php">Log in</a></p>
          </section>

          <section class="image_card">
            <!-- Image icons created by fontawesome -->
            <img src="src/rewardXCard.png" class="recardCardImg">
          </section>

        </div>

      </main>

      <footer>
        <p class="footerText">RewardsX@2019</p>
      </footer>

    </body>
</html>

<?php
if(isset($_GET["failed"]) == 1) {
  echo "<script type='text/javascript'>alert('Your emailed entered already exits, please login or enter a different email.');</script>";
}
if(isset($_GET["failed"]) == 2) {
  echo "<script type='text/javascript'>alert('There is an error creating your account, please try again later.');</script>";
}
?>









