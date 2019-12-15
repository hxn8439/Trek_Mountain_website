<?php

/* 
This php script function as a login for users
 */


  require_once 'pageTemplate.php';
  echo "<div class='main'><h3>Please enter your details to log in</h3>";
  $error = $user = $pass = "";

  if (isset($_POST['user']))
  {
    $user = sanitizeString($_POST['user']);
    $pass = sanitizeString($_POST['pass']);
    
    if ($user == "" || $pass == "")
        $error = "Not all fields were entered<br>";
    else
    {
      $result = queryMySQL("SELECT user,pass FROM trekkers
        WHERE user='$user' AND pass='$pass'");

      if ($result->num_rows == 0)
      {
        $error = "<span class='error'>Username/Password
                  invalid</span><br><br>";
      }
      else
      {
        $_SESSION['user'] = $user;
        $_SESSION['pass'] = $pass;
        die("You are now logged in. Please <a href='Trekkers.php?view=$user'>" .
            "click here</a> to continue.<br><br>");
      }
    }
  }

  echo <<<_END
    <form method='post' action='login.php'>$error
    <span class='fieldname'>Username</span><input type='text'
      maxlength='32' name='user' value='$user'><br>
    <span class='fieldname'>Password</span><input type='password'
      maxlength='52' name='pass' value='$pass'>
_END;
?>

    <br>
    <span class='fieldname'>&nbsp;</span>
    <input type='submit' value='Login'>
    </form><br></div>
  </body>
</html>