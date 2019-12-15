<?php

/* 
 This php script is responsible of creating a message box environment.
 */

require_once 'pageTemplate.php';

  if (!$loggedin) die();

  if (isset($_GET['view'])) $view = sanitizeString($_GET['view']);
  else                      $view = $user;

  if (isset($_POST['text']))
  {
    $text = sanitizeString($_POST['text']);

    if ($text != "")
    {
      $pm   = substr(sanitizeString($_POST['pm']),0,1);
      $time = time();
      queryMysql("INSERT INTO messages VALUES(NULL, '$user',
        '$view', '$pm', $time, '$text')");
    }
  }

  if ($view != "")
  {
    if ($view == $user) $name1 = $name2 = "Your";
    else
    {
      $name1 = "<a href='Trekkers.php?view=$view'>$view</a>'s";
      $name2 = "$view's";
    }

    echo "<div class='main'><h3>$name1 Messages</h3>";
    
    
    echo <<<_END
      <form method='post' action='messagebox.php?view=$view'>
       Leave a message here:<br>
      <textarea name='text' cols='55' rows='6'></textarea><br>
      Public<input type='radio' name='pm' value='0' checked='checked'>
      Private<input type='radio' name='pm' value='1'>
      <input type='submit' value='Post Message'></form><br>
_END;

    if (isset($_GET['erase']))
    {
      $erase = sanitizeString($_GET['erase']);
      queryMysql("DELETE FROM messages WHERE id=$erase AND recip='$user'");
    }
    
    $query  = "SELECT * FROM messages WHERE recip='$view' ORDER BY time DESC";
    $result = queryMysql($query);
    $num    = $result->num_rows;
    
    for ($j = 0 ; $j < $num ; ++$j)
    {
      $row = $result->fetch_array(MYSQLI_ASSOC);

      if ($row['pm'] == 0 || $row['auth'] == $user || $row['recip'] == $user)
      {
        echo date('M jS \'y g:ia:', $row['time']);
        echo " <a href='messagebox.php?view=" . $row['auth'] . "'>" . $row['auth']. "</a> ";

        if ($row['pm'] == 0)
          echo "respond: &quot;" . $row['message'] . "&quot; ";
        else
          echo "wind: <span class='wind'>&quot;" .
            $row['message']. "&quot;</span> ";

        if ($row['recip'] == $user)
          echo "[<a href='messagebox.php?view=$view" .
               "&erase=" . $row['id'] . "'>erase</a>]";

        echo "<br>";
      }
    }
  }

  if (!$num) echo "<br><span class='info'>No messages yet</span><br><br>";

  echo "<br><a class='button' href='messagebox.php?view=$view'>Refresh messages</a>";
?>

    </div><br>
  </body>
  <audio controls>
      <center> <source src="mountain.mp3" type="audio/mp3"></center>
</audio>
</html>
