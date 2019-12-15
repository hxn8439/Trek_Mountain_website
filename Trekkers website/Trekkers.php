<?php

/* 
This php script is responsible of finding other users. 
 */

require_once 'pageTemplate.php';

  if (!$loggedin) die();

  echo "<div class='main'>";

  if (isset($_GET['view']))
  {
    $view = sanitizeString($_GET['view']);
    
    if ($view == $user) $name = "Your";
    else                $name = "$view's";
    
    echo "<h3>$name Profile</h3>";
    showProfile($view);
    echo "<a class='button' href='messagebox.php?view=$view'>" .
         "View $name messages</a><br><br>";
    die("</div></body></html>");
  }

  if (isset($_GET['add']))
  {
    $add = sanitizeString($_GET['add']);

    $result = queryMysql("SELECT * FROM affiliates WHERE user='$add' AND affiliate='$user'");
    if (!$result->num_rows)
      queryMysql("INSERT INTO affiliates VALUES ('$add', '$user')");
  }
  elseif (isset($_GET['remove']))
  {
    $remove = sanitizeString($_GET['remove']);
    queryMysql("DELETE FROM affiliates WHERE user='$remove' AND affiliate='$user'");
  }

  $result = queryMysql("SELECT user FROM trekkers ORDER BY user");
  $num    = $result->num_rows;

  echo "<h3>Other Trekkers</h3><ul>";

  for ($j = 0 ; $j < $num ; ++$j)
  {
    $row = $result->fetch_array(MYSQLI_ASSOC);
    if ($row['user'] == $user) continue;
    
    echo "<li><a href='Trekkers.php?view=" .
      $row['user'] . "'>" . $row['user'] . "</a>";
    $follow = "follow";

    $result1 = queryMysql("SELECT * FROM affiliates WHERE
      user='" . $row['user'] . "' AND affiliate='$user'");
    $t1      = $result1->num_rows;
    $result1 = queryMysql("SELECT * FROM affiliates WHERE
      user='$user' AND affiliate='" . $row['user'] . "'");
    $t2      = $result1->num_rows;

    if (($t1 + $t2) > 1) echo " &harr; is a mutual friend";
    elseif ($t1)         echo " &larr; you are following";
    elseif ($t2)       { echo " &rarr; is following you";
      $follow = "recip"; }
    
    if (!$t1) echo " [<a href='Trekkers.php?add="   .$row['user'] . "'>$follow</a>]";
    else      echo " [<a href='Trekkers.php?remove=".$row['user'] . "'>drop</a>]";
  }
?>

    </ul></div>
  </body>
  <audio controls>
    <center><video width="400" height="220" controls>
        <source src="videoplayback.mp4" type="video/mp4"></video></center>
</audio>
</html>