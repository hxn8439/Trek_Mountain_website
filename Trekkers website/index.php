<?php

/* 
 This php script serve as a welcome homepage. 
 */

 require_once 'pageTemplate.php';

  echo "<br><span class='main'>Welcome to $appname,";

  if ($loggedin) echo " $user, you are logged in.";
  else           echo ' please sign up and/or log in to join in.';
                      
?>

    </span><br><br>
  </body>
<center> <img src="panorama.jpeg" alt="panaorama" width="800" height="125"><br>
  <script type="text/javascript" src="externaljavascript2.js"></script> </center>
  <audio controls>
    <source src="mountain.mp3" type="audio/mp3">
</audio>
</html>
