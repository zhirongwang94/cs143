

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



<!-- Inside Body, there are a lot of division, one by one, displayed on the site-->
<body class="frontpage">

<h1>Actor Information Page :</h1>
<h2>Actor Information is :</h2>

<?php

$selected_actor_id = (int)$_GET['selected_actor_id'];
echo "Selected Actor ID is : ". $selected_actor_id . "<br>"; //retrieve data


// connect to database
$db = new mysqli('localhost', 'cs143', '', 'cs143');
if ($db->connect_errno > 0) { 
    die('Unable to connect to database [' . $db->connect_error . ']'); 
}

// query actor's information
$query =  "SELECT * FROM Actor WHERE id=" . $selected_actor_id;
// echo "THE first QUERY IS: " . $query. "<br>";

$rs = $db->query($query);
while ($row = $rs->fetch_assoc()) { 
    // $id = $row['id']; 
    $first = $row['first']; 
    $last = $row['last'];
    $sex = $row['sex'];
    $dob = $row['dob'];
    $dod = $row['dod']; 
    if(is_null($dod)){
    	$dod = "Still Alive";
    }
    // print "Actor ID: $id, <br>";
    print "Actor Name: $first $last <br>";
    print "Sex: $sex <br>";
    print "Date of Birth: $dob <br>";
    print "Date of Death: $dod <br>";
}
?>


<br><br><br>
<h2>Actor's Movies and Role:</h2>
<?php
$query2 =  "SELECT DISTINCT * FROM Movie, Actor, MovieActor" . 
		  " WHERE MovieActor.aid=" . $selected_actor_id .
		  " AND MovieActor.mid=Movie.id " .
		  " AND Actor.id=" . $selected_actor_id;


// echo "THE last QUERY IS: " . $query2. "<br>";

$rs = $db->query($query2);
while ($row = $rs->fetch_assoc()) { 
    $selected_movie_id = $row['mid']; 
    $title = $row['title']; 
    $role = $row['role'];

    // print "Movie ID: $selected_movie_id,   ";
    print "Role: $role,    ";
    print "Movie Title: $title,   ";
    echo "<a href=movie_info.php?selected_movie_id=" . $selected_movie_id . ">Check This Movie</a>";
    print "<br>";
}

$rs->free();

?> 




<br><br><br><br><br><br><br><br><br><br>
</body>
</html>


