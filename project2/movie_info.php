

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

<!-- 
Movie Information is:

Title :To Wong Foo, Thanks for Everything, Julie Newmar(1995)
Producer :Amblin Entertainment
MPAA Rating :PG-13
Director :
Genre :Comedy
 -->

<!-- Inside Body, there are a lot of division, one by one, displayed on the site-->
<body class="frontpage">

<h1>Movies Information Page :</h1>
<?php

$selected_movie_id = (int)$_GET['selected_movie_id'];


echo "Selected movie ID is : ". $selected_movie_id . "<br>"; //retrieve data

?> 



<!--Database connection and Formating two Queries -->
<?php
$db = new mysqli('localhost', 'cs143', '', 'cs143');
if ($db->connect_errno > 0) { 
    die('Unable to connect to database [' . $db->connect_error . ']'); 
}


?>




<!--Display Matching Movies -->
<h2>Movie Information is:</h2>
<?php

$query1 = "SELECT * FROM Movie WHERE id=" . $selected_movie_id;
echo "THE FIRST QUERY IS: " . $query1 . "<br>";
$rs = $db->query($query1);
while ($row = $rs->fetch_assoc()) { 
    $title = $row['title']; 
    $mpaa = $row['rating'];
    $producer = $row['company'];
}


$query2 = "SELECT * FROM MovieDirector WHERE mid=" . $selected_movie_id;
echo "THE 2nd QUERY IS: " . $query2 . "<br>";
$rs = $db->query($query2);
while ($row = $rs->fetch_assoc()) { 
    $dir = $row['did'];
}

$query3 = "SELECT * FROM Director WHERE id=" . $dir;
echo "THE 3rd QUERY IS: " . $query3 . "<br>";
$rs = $db->query($query3);
while ($row = $rs->fetch_assoc()) { 
    $d_fname = $row['first'];
    $d_lname = $row['last'];
    $d_dob = $row['dob'];
}

$query4 = "SELECT * FROM MovieGenre WHERE mid=" . $selected_movie_id;
echo "THE 4th QUERY IS: " . $query4 . "<br>";
$rs = $db->query($query4);
while ($row = $rs->fetch_assoc()) { 
    $genre = $row['genre'];
}


print "Title : $title <br>" ;
print "Producer : $producer <br>" ;
print "MPAA Rating : $mpaa <br>" ;
print "Director id is: $dir <br>" ;
print "Director: $d_fname $d_lname ($d_dob)<br>" ;
print "Genre : $genre <br>" ;


$query5 = "SELECT * FROM Actor, MovieActor WHERE aid=id AND mid=" . $selected_movie_id;
echo "THE 5th QUERY IS: " . $query5 . "<br>";
$rs = $db->query($query5);
while ($row = $rs->fetch_assoc()) { 
	$selected_actor_id = $row["id"];
	$actor_fname = $row['first'];
	$actor_lname = $row['last'];
	$role = $row['role'];
    print "Actor Name: $actor_fname $actor_lname, Role :\"$role\" " ;
    echo "<a href=actor_info.php?selected_actor_id=" . $id . ">Check This Actor/Actress</a>";
    print "his id: $selected_actor_id <br>";
    echo "<br>";
}
$rs->free();

?> 






<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</body>
</html>


