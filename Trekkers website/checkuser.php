<?php

/* 
 This script is responsible of providing a checkuser function to determine if the a new user data is in the mysql database.
 */

require_once 'function.php';

  if (isset($_POST['user']))
  {
    $user   = sanitizeString($_POST['user']);
    $result = queryMysql("SELECT * FROM trekkers WHERE user='$user'");

    if ($result->num_rows)
      echo  "<span class='taken'>&nbsp;&#x2718; " .
            "This username is taken</span>";
    else
      echo "<span class='available'>&nbsp;&#x2714; " .
           "This username is available</span>";
  }
?>