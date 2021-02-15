<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>DB-actor</title>
    
  <body>
  <h2>Actor/Actress INFO Page</h2>
  <br>

  <body>
    <!-- Database connection and Formating two Queries -->
    <?php
    $db = new mysqli('localhost', 'cs143', '', 'cs143');
    if ($db->connect_errno > 0) { 
        die('Unable to connect to database [' . $db->connect_error . ']'); 
    }
    else{
      echo "DB connected. <br>";
    }
    ?>

    <a href="index.php">Go back to homepage</a><hr>

    <!-- getting information from search and pass to id -->
    <?php
      $actor_id = (int)$_GET['actor_id'];
      echo "Actor/actress ID is ". $actor_id . "<br>"; 

      // query actor's information
      $query_actor =  "SELECT * FROM Actor WHERE id=" . $actor_id;

      $rs = $db->query($query_actor);
      while ($row = $rs->fetch_assoc()) 
      {  
        $first = $row['first']; 
        $last = $row['last'];
        $sex = $row['sex'];
        $dob = $row['dob'];
        $dod = $row['dod']; 
        if(is_null($dod))
        {
          $dod = "Not YET";
        }
      }
      print "Actor Name: $first $last <br> Sex: $sex <br> Date of Birth: $dob <br> Date of Death: $dod <br><hr>";
    ?>

<h16><b>Actor/Actress's Movies and Roles:</b></h16>
<br>
<?php
  //query_movie returns role and title the actor is in, DISTINCT
  $query_movie = "SELECT DISTINCT role, title, mid FROM Actor, Movie, MovieActor WHERE MovieActor.aid = " . $actor_id .
  " AND MovieActor.mid = Movie.id ";
  //print "query_movie is: $query_movie <br>";
  $rs = $db->query($query_movie);
  while ($row = $rs->fetch_assoc()) 
  {  
    $role = $row['role']; 
    $title = $row['title'];
    $mid = $row['mid'];

    print "Movie: $title <br> MovieID: $mid <br> Role: $role <br>";
    echo "<a href=movie.php?movie_id=" . $mid . ">   know more</a>";
    print "<br><br>";
  }



   
?>

</body>
</html>