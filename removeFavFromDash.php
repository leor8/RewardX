<?php
  session_start();
  // Getting default db varialbe
  require 'DBinfo.php';

  // Opening a db connection
  $con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

  // Building query
  $gettingUser = "SELECT * FROM Users WHERE UserId = ". $_SESSION["currUser"];

  // get results
  $userResults = mysqli_query($con, $gettingUser);

  $userName; $userPoints; $userFavorite;

  // If query failed, end the program
  if (!$userResults) {
    die("Database query failed.");
  }

  while ($row = mysqli_fetch_assoc($userResults)) {
    $userName = $row["UserName"];
    $userPoints = $row["StorePoints"];
    if(is_null($row["UserFavoriteStoreId"])){
      $userFavorite = "";
    } else {
      $userFavorite = $row["UserFavoriteStoreId"];
    }

  }

  mysqli_free_result($userResults);


  // If remove button is clicked, remove before displaying and also call a query to remove from database
  if(isset($_POST["removeId"])){
    $userFavArr = explode(',', $userFavorite);
    if(array_search($_POST["removeId"], $userFavArr) !== false) {
      unset($userFavArr[array_search($_POST["removeId"], $userFavArr)]); // array search looks for the index of the removed Id and use unset to remove the item from the array completely.

      // Build the new fab stores
      $newFavId;
      $updateFav;
      if(count($userFavArr) == 0) {
        $newFavId = "NULL";
        $updateFav = "UPDATE Users SET UserFavoriteStoreId = ". $newFavId." WHERE UserId = ". $_SESSION["currUser"];
      } else {
        $newFavId = join(",", $userFavArr);
        $updateFav = "UPDATE Users SET UserFavoriteStoreId = \"". $newFavId."\" WHERE UserId = ". $_SESSION["currUser"];
      }

      $result = mysqli_query($con, $updateFav);

      if(!$result) {
        echo "0";
      } else {
        echo "1";
      }
    }
  }
?>









