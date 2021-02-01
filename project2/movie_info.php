

<!-- -->
<!DOCTYPE html>
<html lang="en">
				<head>
				<meta charset="utf-8">
				<meta name="viewport" content="width=device-width, initial-scale=1">
				<meta name="description" content="">
				<meta name="author" content="">
				<link rel="icon" href="#">
				<title>Lifes-代码狗的BLOG</title>
				</head>

<body class="frontpage">



<h1>Movies Information Page :</h1>
<h2>Movie Information is:</h2>

<!--Database connection and Formating two Queries -->
<?php
$db = new mysqli('localhost', 'cs143', '', 'cs143');
if ($db->connect_errno > 0) { 
    die('Unable to connect to database [' . $db->connect_error . ']'); 
}
?>




<!--Display Matching Movies Infomation -->
<?php

$selected_movie_id = (int)$_GET['selected_movie_id'];
echo "Selected movie ID is : ". $selected_movie_id . "<br>"; //retrieve data


$query1 = "SELECT * FROM Movie WHERE id=" . $selected_movie_id;
// echo "THE FIRST QUERY IS: " . $query1 . "<br>";
$rs = $db->query($query1);
while ($row = $rs->fetch_assoc()) { 
    $title = $row['title']; 
    $mpaa = $row['rating'];
    $producer = $row['company'];
}


$query2 = "SELECT DISTINCT * FROM Director, MovieDirector WHERE Director.id=MovieDirector.did AND MovieDirector.mid=" . $selected_movie_id;
// echo "THE 2nd QUERY IS: " . $query2 . "<br>";
$rs = $db->query($query2);

while ($row = $rs->fetch_assoc()) { 
    $d_fname = $row['first'];
    $d_lname = $row['last'];
    $d_dob = $row['dob'];
    $d_fullname = $d_fname . " " . $d_lname; 
}


$query4 = "SELECT DISTINCT * FROM MovieGenre WHERE mid=" . $selected_movie_id;
// echo "THE 4th QUERY IS: " . $query4 . "<br>";
// $rs = $db->query($query4);
// while ($row = $rs->fetch_assoc()) { 
//     $genre = $row['genre'];
// }

print "Title : $title <br>" ;
print "Producer : $producer <br>" ;
print "MPAA Rating : $mpaa <br>" ;
// print "Director id is: $dir <br>" ;
print "Director: $d_fullname $d_dob<br>" ;
print "Genre :";
$rs = $db->query($query4);
while ($row = $rs->fetch_assoc()) { 
    $genre = $row['genre'];
    print "$genre ";
} 

?>





<br> <br> <br> 
<h2>Actors in this Movie:</h2>
<?php
$query5 = "SELECT DISTINCT * FROM Actor, MovieActor WHERE aid=id AND mid=" . $selected_movie_id;
// echo "THE 5th QUERY IS: " . $query5 . "<br>";
$rs = $db->query($query5);
while ($row = $rs->fetch_assoc()) {
	$selected_actor_id = $row["id"];
	$actor_fname = $row['first'];
	$actor_lname = $row['last'];
	$role = $row['role'];
    print "Actor Name: $actor_fname $actor_lname, Role :\"$role\" " ;
    echo "<a href=actor_info.php?selected_actor_id=" . $selected_actor_id . ">Check This Actor</a>";
    // print "actor id: $selected_actor_id <br>";
    echo "<br>";
}
$rs->free();

?> 

<br> <br><br> 


<br> 
<h2>User Review:</h2>
<?php
  $query_score = "SELECT AVG(rating), COUNT(rating) from Review WHERE mid=" . $selected_movie_id;
  $rs = $db->query($query_score); 
  while ($row = $rs->fetch_assoc()){
  	$avg_score = $row['AVG(rating)'];
  	$cout_score = $row['COUNT(rating)'];
  	print "Average score for this Movie is $avg_score based on $cout_score people's reviews <br>";
  }
  $rs->free();
  echo "<a href=comment.php?rating_movie_id=" . $selected_movie_id . ">Leave Your Review as Well</a>";

?>



<br> <br> <br> 
<h2>Comment details shown below:</h2>
<?php
	$query_comment = "SELECT * from Review WHERE mid=" . $selected_movie_id;
	$rs = $db->query($query_comment);
	while ($row = $rs->fetch_assoc()){
		$comment_name = $row['name'];
		$comment_rate = $row['rating'];
		$comment_time = $row['time'];
		$comment = $row['comment'];
		print "$comment_name rates this movie with score $comment_rate left a review at $comment_time <br>";
		print "$comment <br>";
	}

	$rs->free();

?>





<br>
<a href=index.php?>Back to Main Searching Page</a><br>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</body>
</html>


