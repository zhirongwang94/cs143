<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>DB-search</title>


  <body>
  <h2>Search Page</h2>
  <br>

  <!-- Database connection and Formating two Queries -->
  <?php
  $db = new mysqli('localhost', 'cs143', '', 'cs143');
  if ($db->connect_errno > 0) { 
      die('Unable to connect to database [' . $db->connect_error . ']'); 
  }
  else{
    echo "Oh yeah DB found! Go ahead:) <br>";
  }
  ?>

  <a href="index.php">Go back to homepage</a>
         <hr>


          <label for="search_input">Search form here:</label>
          <!-- WE use either GET or POST method -->
          <form  method ="GET" id="usrform">  
              <input type="text" placeholder="type someting." name="input"><br>
              <input type="submit" value="Click Me!" >
          </form>


    </div>

<!-- <a href=actor_infooo.php> empty link </a>
<br> -->

<?php 

//explode used to split the string then store
  $input = $_GET["input"];
  print "you typed: $input <br><hr>";
//array_filter make an array
  $inputwords = array_filter(explode(" ", $input));
  $cunt = count($inputwords);
  // formating and print query 
  //$query_for_actor = "SELECT * FROM Actor WHERE first like '$input' or last like '$input'"; 

  //if more than 2 keywords are inputed, not actor for sure
  //print "cunt= $cunt <br><hr>";
  if ($cunt > 2) 
  {
    $query_for_actor = "SELECT * FROM Actor WHERE false ";
  } 
  elseif ($cunt == 1)
  {
    $query_for_actor = "SELECT * FROM Actor WHERE (first='$inputwords[0]') OR (last='$inputwords[0]') ";
  }
  elseif ($cunt == 2)
  {
    $query_for_actor = "SELECT * FROM Actor WHERE (first='$inputwords[0]' AND last='$inputwords[1]') OR (first='$inputwords[1]' AND last='$inputwords[0]')  ";
  }

  //print "$query_for_actor <br>";
  // query database 
  $rs = $db->query($query_for_actor);

  print "The following actors and actresses with their IDs are found:<br>";
  print "(listed as lastname firstname, ID#)<br><hr>";
  // loop throw the result $rs and print the data 
  while ($row = $rs->fetch_assoc()) { 
      $first = $row['first']; 
      $last = $row['last'];
      $id =   $row['id'];

      print "$first $last <br> $id <br>";
      //echo "<a href=actor.php?actor_id=" . $id . ">        know more</a>";
      echo "<a href=actor.php?actor_id=" . $id ." >know more </a>";

      // selected_actor_id 
      print "<br><br>";//change line
  }
  print "<hr>"; //an actual line

  // $query_for_movie = "SELECT * FROM Movie WHERE title='$input'";
  $query_for_movie = "SELECT * FROM Movie WHERE ";
  for ($index = 0; $index < count($inputwords); $index++) {
    if($index != 0){
      $query_for_movie = $query_for_movie . " AND ";
    }
    $query_for_movie = $query_for_movie . " title LIKE '%$inputwords[$index]%' ";
  }

  // $query_for_movie = "SELECT * FROM Movie WHERE title like '%$input%'";
  // print "query_for_movie: $query_for_movie <br>";
  $rs = $db->query($query_for_movie);

  print "The following movies are found:<br><hr>";
  // loop throw the result $rs and print the data 
  while ($row = $rs->fetch_assoc()) { 
      $title = $row['title'];  
      $mid = $row['id'];
      print "$title <br>";
      echo "<a href=movie.php?movie_id=" . $mid ." >know more </a>";
      print "<br>";
  }
  print "<hr>";



?>

</body>
</html>