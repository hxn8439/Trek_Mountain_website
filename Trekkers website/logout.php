<?php

/* 
 The php script is responsible for logging out procedure.
 */

 require_once 'pageTemplate.php';

  if (isset($_SESSION['user']))
  {
    destroySession();
    echo "<div class='main'>You have been logged out. " .
         "<a href='index.php'>click</a> to refresh the screen.";
  }
  else echo "<div class='main'><br>" .
            "You cannot log out, you need to be logged into the site.";
?>

    <br><br></div>
  </body>
</html>