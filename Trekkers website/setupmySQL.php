

/* 
 This php webpage is responsible for setting up mySQL database and neccessary tables. 
 */

<!DOCTYPE html>
<html>
  <head>
    <title>Setting up database</title>
  </head>
  <body>

    <h3>Setting up...</h3>

<?php 
  require_once 'function.php';

  createTable('trekkers',
              'user VARCHAR(128),
              pass VARCHAR(128),
              INDEX(user(10))');

  createTable('messages', 
              'id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
              auth VARCHAR(128),
              recip VARCHAR(128),
              pm CHAR(1),
              time INT UNSIGNED,
              message VARCHAR(8000),
              INDEX(auth(10)),
              INDEX(recip(10))');

  createTable('affiliates',
              'user VARCHAR(128),
              affiliate VARCHAR(128),
              INDEX(user(10)),
              INDEX(friend(10))');

  createTable('profiles',
              'user VARCHAR(10),
              text VARCHAR(8000),
              INDEX(user(10))');
  
  createTable('treklog',
              'user VARCHAR(10),
               Location_Name Varchar(128),
               Temperature_Celsius Varchar(128),
               Time_Zulu_Format Varchar(128),
               GPS_Location Varchar(128),
               Description Varchar(50000),
              INDEX(user(10))');
?>

    <br>...done.
  </body>
</html>
