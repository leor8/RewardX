<?php

session_start();

if (isset($_SESSION['currUser'])) {
  unset($_SESSION['currUser']);
  session_destroy();
  header('Location: index.php');
} else {
  header('Location: login.php?failed=2');
}

?>