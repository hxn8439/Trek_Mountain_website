<?php

/* 
 This php script provide uniformity for each page, thus it have access to a set of features
 */

  session_start();

  echo "<!DOCTYPE html>\n<html><head>";

  require_once 'function.php';

  $userstr = ' (Guest)';

  if (isset($_SESSION['user']))
  {
    $user     = $_SESSION['user'];
    $loggedin = TRUE;
    $userstr  = " ($user)";
  }
  else $loggedin = FALSE;

  echo "<title>$appname$userstr</title><link rel='stylesheet' " .
       "href='stylesheet.css' type='text/css'>"                 .
       "</head><body><center><canvas id='logo' width='624' "    .
       "height='96'>$appname</canvas></center>"                 .
       "<div class='appname'>$appname$userstr</div>"            .
          
//Javascript insert
          
       "<script src='externaljavascript.js'></script>";
       

  if ($loggedin)
  {
    echo "<br ><ul class='menu'>" .
         "<li><a href='Trekkers.php?view=$user'>Home</a></li>"  .
         "<li><a href='Trekkers.php'>Trekkers</a></li>"         .
         "<li><a href='Affiliates.php'>Affiliates</a></li>"     .
         "<li><a href='messagebox.php'>Messages</a></li>"       .
         "<li><a href='profile.php'>Edit Profile</a></li>"      .
         "<li><a href='trekLog.php'>TrekLog</a></li>"           .  
         "<li><a href='logout.php'>Log out</a></li></ul><br>";
  }
  else
  {
    echo ("<br><ul class='menu'>" .
          "<li><a href='index.php'>Home</a></li>"                .
          "<li><a href='signup.php'>Sign up</a></li>"            .
          "<li><a href='login.php'>Log in</a></li></ul><br>"     .
          "<br><br>");
  }
?>