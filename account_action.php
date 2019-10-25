<!DOCTYPE html>
<html>
  <head>
    <title>PHP Test</title>
  </head>
  <body>

    <?php
      // As im not sure how to determine the pages that send the request, I will be identifiying it based on if an email is provided

      $found = false;
      if(array_key_exists("email", $_REQUEST)) { // Register
        $name = $_REQUEST['username'];
        $email = $_REQUEST['email'];
        $password = $_REQUEST['password'];

        $file = fopen("user", 'a');
        fwrite($file, "\nname: ". $name);
        fwrite($file, ", email: ". $email);
        fwrite($file, ", password: ". $password);
        fclose($file);

        // display the results
        $_SESSION['user'] = $name;
        header('Location: dashboard.php?id='.$name);
      } else { // Login
        $name = $_REQUEST['username'];
        // Reading files to look for the account
        // The following section will be changed after switching to use DB
        $file = fopen("user", 'r');

        while(! feof($file))  { // While it is not the last line of the file
          $result = fgets($file); // Get the line at current iteration
          $resultSplit = explode(",", $result); // Split up by name email and password in current line

          if (isset(explode(":", $resultSplit[0])[1]) && isset(explode(":", $resultSplit[2])[1])) { // Check if array set
            if(substr(explode(":", $resultSplit[0])[1], 1) == $_REQUEST['username'] && substr(explode(":", $resultSplit[2])[1], 1) == $_REQUEST['password'] ) {
                $found = true;
                break;
              }
          }

        }
        fclose($file);

        if(!$found) {
          echo "<script type=\"text/javascript\">
          alert(\"Wrong Username or Password\");
          location=\"login.php\";
           </script>";
        } else if($found) {
          // display the results
          $_SESSION['user'] = $name;
          header('Location: dashboard.php?id='.$name);
        }

      }


    ?>

    <!-- <p>This is not part of the content</p> -->
  </body>
</html>