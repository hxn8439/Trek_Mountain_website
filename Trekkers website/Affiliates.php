<?php

/* 
 This php script is responsible for creating affiliates environment webpage.
 */

require_once 'pageTemplate.php';

  if (!$loggedin) die();

  if (isset($_GET['view'])) $view = sanitizeString($_GET['view']);
  else                      $view = $user;

  if ($view == $user)
  {
    $name1 = $name2 = "Your";
    $name3 =          "You are";
  }
  else
  {
    $name1 = "<a href='Trekkers.php?view=$view'>$view</a>'s";
    $name2 = "$view's";
    $name3 = "$view is";
  }

  echo "<div class='main'>";

  

  $followers = array();
  $following = array();

  $result = queryMysql("SELECT * FROM affiliates WHERE user='$view'");
  $num    = $result->num_rows;

  for ($j = 0 ; $j < $num ; ++$j)
  {
    $row           = $result->fetch_array(MYSQLI_ASSOC);
    $followers[$j] = $row['affiliate'];
  }

  $result = queryMysql("SELECT * FROM affiliates WHERE affiliate='$view'");
  $num    = $result->num_rows;

  for ($j = 0 ; $j < $num ; ++$j)
  {
      $row           = $result->fetch_array(MYSQLI_ASSOC);
      $following[$j] = $row['user'];
  }

  $mutual    = array_intersect($followers, $following);
  $followers = array_diff($followers, $mutual);
  $following = array_diff($following, $mutual);
  $friends   = FALSE;

  if (sizeof($mutual))
  {
    echo "<span class='subhead'>$name2 mutual friends</span><ul>";
    foreach($mutual as $affiliate)
      echo "<li><a href='Trekkers.php?view=$affiliate'>$affiliate</a>";
    echo "</ul>";
    $affiliates = TRUE;
  }

  if (sizeof($followers))
  {
    echo "<span class='subhead'>$name2 followers</span><ul>";
    foreach($followers as $affiliate)
      echo "<li><a href='Trekkers.php?view=$affiliate'>$affiliate</a>";
    echo "</ul>";
    $affiliates = TRUE;
  }

  if (sizeof($following))
  {
    echo "<span class='subhead'>$name3 following</span><ul>";
    foreach($following as $affiliate)
      echo "<li><a href='Trekkers.php?view=$affiliate'>$affiliate</a>";
    echo "</ul>";
    $affiliates = TRUE;
  }

  if (!$affiliates) echo "<br>You don't have any affiliates yet.<br><br>";

  echo "<a class='button' href='messagebox.php?view=$view'>" .
       "View $name2 messages</a>";
?>

    </div><br>
  </body>
  <audio controls>
      <center><source src="mountain.mp3" type="audio/mp3"></center>
</audio>
</html>
