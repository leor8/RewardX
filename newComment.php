<?php
  session_start();

  // print_r($_POST);

  $ratings;
  $comment = $_POST["comment"];
  $userName;
  $userId = $_SESSION["currUser"];
  $storeId = $_GET["storeId"];

  if($_POST["rating"] > 10) {
    $ratings = 10;
  } else if($_POST["rating"] < 0) {
    $ratings = 0;
  } else {
    $ratings = $_POST["rating"];
  }

  // Getting default db varialbe
  require 'DBinfo.php';

  // Opening a db connection
  $con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

  $getUserDetail = "SELECT UserName FROM Users WHERE UserId = ". $_SESSION["currUser"];
  $userResult = mysqli_query($con, $getUserDetail);

  if(!$userResult) {
    die("db query failed");
  } else {
    $userName = mysqli_fetch_assoc($userResult)["UserName"];
  }

  mysqli_free_result($userResult);

  $newCommentQuery = "INSERT INTO Comments (UserName, UserRating, UserComment, BelongStore, UserId) VALUES (
    \"". $userName."\",
    ". $ratings.",
    \"". $comment."\",
    ". $storeId.",
    ". $userId."
  )";

  // echo $newCommentQuery;
  $insertCommentResult = mysqli_query($con, $newCommentQuery);
  if(!$insertCommentResult) {
    die("db query failed");
  }

  // If the comment is posted

  // Updating store ratings

  // Getting the count of the store numbers
  $CommentCountQuery = "SELECT COUNT(*) FROM Comments WHERE BelongStore = ". $storeId;

  $CommentCount = mysqli_query($con, $CommentCountQuery);

  if(!$CommentCount) {
    die("db query failed.");
  }

  $count = mysqli_fetch_assoc($CommentCount)["COUNT(*)"];

  $count = intval($count);

  mysqli_free_result($CommentCount);

  // Get all the comments and its rating total
  $CommentRatingQuery = "SELECT * FROM Comments WHERE BelongStore = ". $storeId;
  $CommentRating = mysqli_query($con, $CommentRatingQuery);

  if(!$CommentRating) {
    die("db query failed.");
  }

  $totalRatingsToBeDivided = 0;

  while($row = mysqli_fetch_assoc($CommentRating)) {
    $totalRatingsToBeDivided += $row["UserRating"];
  }

  // echo $totalRatingsToBeDivided;
  // echo $ratings;
  $updatedRatings = round($totalRatingsToBeDivided/$count, 1);

  // // Update the store rating in store db
  $updateStoreRatingQuery = "UPDATE Store SET StoreRatings = ". $updatedRatings." WHERE StoreId = ". $storeId;
  $updateStoreRating = mysqli_query($con, $updateStoreRatingQuery);

  mysqli_close($con);
  header('Location: storeDetail.php?id='. $_GET["storeId"].'&open='. $_GET["open"]);




?>













