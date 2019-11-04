<?php
session_start();

if(isset($_POST["username"])) {
  echo "register";
} else {
  echo "login";
}

if (!isset($_SESSION['currUser'])) { //if user is not logged in
  // Getting default db varialbe
  require 'DBinfo.php';

  // Opening a db connection
  $con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

  if(isset($_POST["username"])) { // Register
    // Check if email already exists
    $gettingDuplicateEmail = "SELECT * FROM Users WHERE UserEmail = \"". $_POST["email"]. "\"";
    // get results
    $DuplicateEmail = mysqli_query($con, $gettingDuplicateEmail);

    // If query failed, end the program
    if (!$DuplicateEmail) {
      die("Database query failed.");
    }

    if(mysqli_num_rows($DuplicateEmail) > 0) {
      mysqli_free_result($DuplicateEmail);
      header('Location: register.php?failed=1');
    } else {
      $registerQuery = "INSERT INTO Users (UserName, UserEmail, UserPassword, isAdmin) VALUES (
      \"". $_POST["username"] ."\",
      \"". $_POST["email"]."\",
      \"". $_POST["password"]."\",
      0
      )";

      // insert user
      $insertUser = mysqli_query($con, $registerQuery);

      if($insertUser){
        // Getting new added user's id
        $gettingNewUserInfo = "SELECT * FROM Users WHERE UserEmail = \"". $_POST["email"]. "\"";
        // get results
        $newUser = mysqli_query($con, $gettingNewUserInfo);

        // If query failed, end the program
        if (!$newUser) {
          die("Database query failed.");
        }

        while($row = mysqli_fetch_assoc($newUser)) {
          mysqli_free_result($newUser);
          header('Location: dashboard.php?id='. $row["UserId"]);
        }
      } else {
        header('Location: register.php?failed=2');
      }

    }




  } else { // login
    // Check if email already exists
    $gettingDuplicateEmail = "SELECT * FROM Users WHERE UserEmail = \"". $_POST["email"]. "\" AND UserPassword = \"". $_POST["password"]."\"";
    // get results
    $DuplicateEmail = mysqli_query($con, $gettingDuplicateEmail);

    // If query failed, end the program
    if (!$DuplicateEmail) {
      die("Database query failed.");
    }

    if(mysqli_num_rows($DuplicateEmail) == 0) { // If account not found
      header('Location: login.php?failed=1');

    } else {
      while ($row = mysqli_fetch_assoc($DuplicateEmail)) {
        header('Location: dashboard.php?id='. $row["UserId"]);
      }
    }
  }
}

?>




    <!-- <p>This is not part of the content</p> -->
  </body>
</html>