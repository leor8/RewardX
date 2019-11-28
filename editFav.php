<?php
  session_start();


  // Getting default db varialbe
  require 'DBinfo.php';

  // Opening a db connection
  $con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

  // Getting user favorites

  $userFavQuery = "SELECT * FROM Users WHERE UserId = ". $_SESSION["currUser"];
  $favResults = mysqli_query($con, $userFavQuery);

  if(!$favResults) {
    die("Database query failed.");
  }

  $fav;

  while($row = mysqli_fetch_assoc($favResults)) {
    if(is_null($row["UserFavoriteStoreId"])) {
      $fav = "";
    } else {
      $fav = $row["UserFavoriteStoreId"];
    }

  }

  mysqli_free_result($favResults);
  if($fav !== ""){
    $fav = explode(",", $fav);
  } else {
    $fav = [];
  }


  if($_POST["liked"] == 1) { // If the store is already liked
    unset($fav[array_search($_POST["favId"], $fav)]);
    $Newfav = join(",", $fav);

    $updateFav = "UPDATE Users SET UserFavoriteStoreId = \"". $Newfav."\" WHERE UserId = ". $_SESSION["currUser"];

    $result = mysqli_query($con, $updateFav);

    if($result) {
      echo "1";
    } else {
      echo "0";
    }


  } else { // If the store is not liked
    array_push($fav, $_POST["favId"]);

    $Newfav = join(",", $fav);

    $updateFav = "UPDATE Users SET UserFavoriteStoreId = \"". $Newfav."\" WHERE UserId = ". $_SESSION["currUser"];

    $result = mysqli_query($con, $updateFav);

    if($result) {
      echo "1";
    } else {
      echo "0";
    }
  }

?>