<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>DB-review</title>
    
  <body>
  <h2>Review Page</h2>
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
      $movie_id = (int)$_GET['movie_id'];
      echo "Movie ID is ". $movie_id . "<br>"; 

      // query MOVIE's information
      $query_movie =  "SELECT * FROM Movie WHERE id=" . $movie_id;
      //print "query_movie is $query_movie <br><br>";
      $rs = $db->query($query_movie);
      while ($row = $rs->fetch_assoc()) 
      {  
        $mid = $row['id']; 
        $mtitle = $row['title'];
        $myear = $row['year'];
        $mrating = $row['rating'];
        $mcompany = $row['company']; 
      }
      print "Title: $mtitle <br> Year: $myear <br> Rating: $mrating <br> Company: $mcompany <br><hr>";
    ?>

<h16><b>Actors/Actresses in the movie and their roles:</b></h16>
<br>
<?php
  //query_movie_actor returns actor names and its role in the movie, DISTINCT
  $query_movie_actor = "SELECT DISTINCT aid, role, first, last FROM Actor, Movie, MovieActor WHERE MovieActor.mid = " . $mid .
  " AND MovieActor.aid = Actor.id ";
  print "query_movie_actor is: $query_movie_actor <br>";
  $rs = $db->query($query_movie_actor);
  while ($row = $rs->fetch_assoc()) 
  {  
    $role = $row['role']; 
    $first = $row['first'];
    $last = $row['last'];
    $aid = $row['aid'];

    print "Name: $first $last <br> Role: $role <br>";
    echo "<a href=actor.php?actor_id=" . $aid ." >know more </a>";
    print "<br><br>";
  } 
  print "<hr>";  
?>

<?php
    $movie_id = (int)$_GET['movie_id'];
    echo "<a href=review.php?movie_id=" . $movie_id ." >Write a review about this movie:) </a>";
?>

</body>
</html>