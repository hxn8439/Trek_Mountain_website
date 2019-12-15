<?php

/* 
 This script provides the capability of logging registered user's trip when hiking up a mountain.
 */

require_once 'pageTemplate.php';

  if (!$loggedin) die();
 
 
  //////////////////////////////////////////////////////////////////////////
//Coversion user data for standard time to military (zulu) Time//////////////////////
//////////////////////////////////////////////////////////////////////////

   $s = $z = '';

 if (isset($_POST['s'])) {
            $s = sanitizeString1($_POST['s']);
        }
        if (isset($_POST['z'])) {
            $z = sanitizeString1($_POST['z']);
        }

        if ($s > "0099" && $s < "1200")
  {
    $z = intval((1200) + ($s));
    $out = "$s time converted to military time is $z ";
  }
  
        elseif ($s == "1200" ||$s == "1201" ||$s == "1202" ||$s == "1203" ||$s == "1204" ||$s == "1205" ||$s == "1206" ||$s == "1207" ||$s == "1208" ||$s == "1209" ||$s == "1210" ||$s == "1211" ||$s == "1212"||$s == "1213" ||$s == "1214" ||$s == "1215" ||$s == "1216" ||$s == "1217" ||$s == "1218" ||$s == "1219" ||$s == "1220" ||$s == "1221" ||$s == "1222" ||$s == "1223" ||$s == "1224" ||$s == "1225" ||$s == "1226" ||$s == "1227" ||$s == "1228" ||$s == "1229" ||$s == "1230" ||$s == "1231" ||$s == "1232" || $s == "1233" ||$s == "1234" ||$s == "1235" ||$s == "1236" ||$s == "1237" ||$s == "1238" ||$s == "1239" ||$s == "1240" ||$s == "1241" ||$s == "1242" ||$s == "1243" ||$s == "1244" ||$s == "1245" ||$s == "1246" ||$s == "1247" ||$s == "1248" ||$s == "1249" ||$s == "1250" ||$s == "1251" ||$s == "1252" ||$s == "1253" ||$s == "1254" ||$s == "1255" ||$s == "1256" ||$s == "1257" ||$s == "1258" ||$s == "1259")
            {$z = intval($s);
    $out = "$s time converted to military time is $z ";    
        }
 elseif ($z != '') {
            $out = "Not accepted, convert only from standard time to military time.";
        } else {
            $out = "error input, enter correct standard time with hour and minutes format ";
        }

        echo <<<_END
<html>
  <head>
    <title>military time Converter</title>
  </head>
  <body>
    <pre>
      Enter your standard time and click on Convert.
        
      <b>$out</b>
      <form method="post" action="trekLog.php">
        Standard Time(in p.m.)       <input type="text" name="s" size="10">
        Military Time                      <input type="text" name="z" size="10">
                                                       <input type="submit" value="Convert">
      </form>
    </pre>
  </body>
</html>
_END;

  function sanitizeString1($alpha)
  {
    $alpha = stripslashes($alpha);
    $alpha = strip_tags($alpha);
    $alpha = htmlentities($alpha);
    return $alpha;
  }     
        
////////////////////////////////////////////////////////////////////
//Coversion user data for mountain temperature//////////////////////
////////////////////////////////////////////////////////////////////

 $f = $c = '';

 if (isset($_POST['f'])) {
            $f = inputconvert($_POST['f']);
        }
        if (isset($_POST['c'])) {
            $c = inputconvert($_POST['c']);
        }

        if ($f != '')
  {
    $c = intval((5 / 9) * ($f - 32));
    $out = "$f °f equals $c °c";
  }
 elseif ($c != '') {            
            $out = "Not accepted, convert only from Fahrenheit to Celsius";
        } else {
            $out = "";
        }

        echo <<<_END
<html>
  <head>
    <title>Temperature (Celsius) Converter</title>
  </head>
  <body>
    <pre>
      Enter only Fahrenheit and click on Convert.
        
      <b>$out</b>
      <form method="post" action="trekLog.php">
        Fahrenheit <input type="text" name="f" size="10">
              Celsius <input type="text" name="c" size="10">
                             <input type="submit" value="Convert">
      </form>
    </pre>
  </body>
</html>
_END;

  function inputconvert($a)
  {
    $a = stripslashes($a);
    $a = strip_tags($a);
    $a = htmlentities($a);
    return $a;
  }

////////////////////////////////////////////////////////////////
// mysql access for inputs and outputs user's data ///////////////       
///////////////////////////////////////////////////////////////////
 
  if (isset($_POST['delete']) && isset($_POST['Location_Name']))
  {
    $Location_Name   = get_post($conn, 'Location_Name');
    $query  = "DELETE FROM treklog WHERE Location_Name='$Location_Name'";
    $result = $conn->query($query);
    if (!$result) {
                echo "DELETE failed: $query<br>" .
                $conn->error . "<br><br>";
            }
        }
  
  if  (isset($_POST['Location_Name'])  &&
      isset($_POST['TEMPERATURE_CELSIUS'])  &&
      isset($_POST['TIME_ZULU_FORMAT'])    &&
      isset($_POST['GPS_LOCATION'])  &&
      isset($_POST['DESCRIPTION']))

 
      {
    $Location_Name = get_post($conn, 'Location_Name');
    $TEMPERATURE_CELSIUS  = get_post($conn, 'TEMPERATURE_CELSIUS');
    $TIME_ZULU_FORMAT = get_post($conn, 'TIME_ZULU_FORMAT');
    $GPS_LOCATION = get_post($conn, 'GPS_LOCATION');
    $DESCRIPTION = get_post($conn, 'DESCRIPTION');
   
    $query = "INSERT INTO treklog VALUES" .
      "('$Location_Name', '$TEMPERATURE_CELSIUS', '$TIME_ZULU_FORMAT ', '$GPS_LOCATION ', '$DESCRIPTION' 
         )";
   
    $result = $conn->query($query);

    if (!$result) {
                echo "INSERT failed: $query<br>" .
                $conn->error . "<br><br>";
            }
        }
 
    
   echo <<<_END
  
                   Mountain Visit Information
        
   <form action="trekLog.php" method="post"><pre>
        Location_Name <input type="text" name="Location_Name">
  
  TEMPERATURE_CELSIUS <input type="text" name="TEMPERATURE_CELSIUS">
  
     TIME_ZULU_FORMAT <input type="text" name="TIME_ZULU_FORMAT">
  
         GPS_LOCATION <input type="text" name="GPS_LOCATION">
  
          DESCRIPTION <textarea name ="DESCRIPTION" cols="30" rows="10" wrap="soft"> Tell me your experience on the mountain!!
		      </textarea><br>
                      <input type="submit" value="ADD RECORD">
  </pre></form>
_END;
    
    // $query = "SELECT * FROM treklog";
    // $result = $conn->query($query);
    // if (!$result) {
    //        die("Database access failed: " . $conn->error);
    //    }

 

     $rows = $result->num_rows;

for ($j = 0 ; $j < $rows ; ++$j)

{
    $result->data_seek($j);
    $row = $result->fetch_array(MYSQLI_NUM);
     

  echo <<<_END
  <pre>
    
         Location_Name $row[0]
   TEMPERATURE_CELSIUS $row[1]
      TIME_ZULU_FORMAT $row[2]
          GPS_LOCATION $row[3]
           DESCRIPTION $row[4]
       </pre>
            
  <form action="trekLog.php" method="post">
  <input type="hidden" name="delete" value="yes">
  <input type="hidden" name="Location_Name" value="$row[0]">
  <input type="submit" value="DELETE RECORD"></form>       
_END;
  }

  $result->close();
  $conn->close();
  
  function get_post($conn, $var)
  {
    return $conn->real_escape_string($_POST[$var]);
  }
        
  ?>
    </body>
</html>
