
<!-- -->
<!DOCTYPE html>
<html lang="en">
				<head>
				<meta charset="utf-8">
				<meta name="viewport" content="width=device-width, initial-scale=1">
				<meta name="description" content="">
				<meta name="author" content="">
				<link rel="icon" href="#">
				<title>Home-代码狗的BLOG</title>
				<style> 
					.tabs{
						tab-size: 6;
					}

				</style>



				</head>



<!-- Inside Body, there are a lot of division, one by one, displayed on the site-->
<body class="frontpage">




<?php
echo "The following is my development of my project2 <br><br>";
?> 

<a href=comment.php?>Comment Page</a>;

<!--Searching Box -->
<h1>Searching Page</h1>
<h2>Search:</h2>
<form action="index.php" method="post">
	<input type="text" name="name" placeholder="Searching"> <br>
	<input type="submit" value="Click Me!">
</form>

<br><br>


<!--Database connection and Formating two Queries -->
<?php
$db = new mysqli('localhost', 'cs143', '', 'cs143');
if ($db->connect_errno > 0) { 
    die('Unable to connect to database [' . $db->connect_error . ']'); 
}


// split the input string into substring by space, and store them in array keywords.
$keywords = explode(" ", $_POST["name"]);
$keywords = array_filter($keywords); //filter out empty entry of the arrary


// echo input value 
echo "\$_POST[name]: " . $_POST["name"] . "<br>" ; 


// display the keywords. 
echo "Your enter " . count($keywords) . " keywords, which are:  <br>";
for ($index = 0; $index < count($keywords); $index++) {
  echo $index + 1 . ": " . $keywords[$index] . "<br>";
}
echo "<br>";


if(count($keywords) == 0){
	$query1 = "SELECT * FROM Movie WHERE false";
	$query2 = "SELECT * FROM Movie WHERE false";
}
else{
	// Query1 formatation:
	// SELECT * FROM Movie  WHERE title LIKE %"keyword[0]"% AND %"keyword[1]"% AND %"keyword[2]"% ...
	// eg: SELECT * FROM Movie  WHERE title LIKE %"keyword[0]"% AND %"keyword[1]"% AND %"keyword[2]"% ...
	// eg: SELECT * FROM Movie WHERE title LIKE "%you%" AND title  LIKE "%when%";  ##this is good enough
	$query1 = "SELECT * FROM Movie ";
	$query1 = $query1 . " WHERE ";
	for ($index = 0; $index < count($keywords); $index++) {
		if($index == 0){
			$query1 = $query1 . " title LIKE " . "\"%" . $keywords[$index] . "%\" " ;	
		}
		else{
			$query1 = $query1 . " AND title LIKE " . "\"%" . $keywords[$index] . "%\" " ;
		}
	  	//echo "now QUERY IS :" . $query . "<br>";
	}


	// Query1 formatation:
	// eg: SELECT * FROM Actor WHERE ((first LIKE "%aa%" AND last LIKE "%bb%" ) OR (first LIKE "%bb%" AND last LIKE "%aa%" ))
	$query2 = "SELECT * FROM Actor ";
	$query2 = $query2 . " WHERE ";
	if (count($keywords) == 2){
		$query2 = $query2 . " ((first LIKE " . "\"%" . $keywords[0] . "%\" "  . 
		" AND last LIKE  " . "\"%" . $keywords[1] . "%\" ) " . 
		" OR (first LIKE " . "\"%" . $keywords[1] . "%\" "  . 
		" AND last LIKE  " . "\"%" . $keywords[0] . "%\" ))" ;
	}
	elseif (count($keywords) == 1) {
		$query2 = $query2 . " first LIKE " . "\"%" . $keywords[0] . "%\" "  . 
		" OR last LIKE  " . "\"%" . $keywords[0] . "%\" " ;
	}
	else{
		$query2 = "";
	}
}

// echo two queries 
echo "THE FIRST QUERY IS: " . $query1 . "<br><br>";
echo "THE SECOND QUERY IS: " . $query2 . "<br><br>";

?>



<!--Display Matching Actors/Actresses -->
<h2>Matching Actors/Actresses are:</h2>
<?php

$rs = $db->query($query2);
while ($row = $rs->fetch_assoc()) { 
    $first = $row['first']; 
    $last = $row['last'];
    $sex = $row['sex'];
    $dob = $row['dob'];
    $dod = $row['dod']; 
    $id = $row['id'];  
    print "$id, $first $last, $sex, $dob, $dod "; 
    echo "<a href=actor_info.php?selected_actor_id=" . $id . ">Check This Actor/Actress</a>";
    print "<br>";
}
print 'Total results: ' . $rs->num_rows;
$rs->free();


// reference:  passing a value through a
// https://stackoverflow.com/questions/5440197/how-to-pass-a-php-variable-using-the-url
?> 


<!--Display Matching Movies -->
<h2>Matching Movies are:</h2>
<?php
function myMethod() {
  echo "Hello world!";
}
//echo "<a href='projects.php'> Anchor Projects</a>";
$rs = $db->query($query1);
while ($row = $rs->fetch_assoc()) { 
    $id = $row['id']; 
    $title = $row['title']; 
    $year = $row['year']; 
    print "$id, $title, $year "; 
//   print "<a href='movie_info.php' onclick='myMethod();'> $title </a>";
    echo "<a href=movie_info.php?selected_movie_id=" . $id . ">Check This Movie</a>";
    print "<br>";

}
print 'Total results: ' . $rs->num_rows;
$rs->free();

?> 


<br><br><br><br><br><br><br><br><br><br>


</body>
</html>


