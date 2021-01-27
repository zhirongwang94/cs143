

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
<?php

$selected_actor_id = (int)$_GET['selected_actor_id'];
echo "Selected Actor is : ". $selected_actor_id . "<br>"; //retrieve data



// $query3 =  "SELECT * FROM Actor WHERE (last LIKE '%Aaron%' AND first LIKE '%hank%' )";

// $db = new mysqli('localhost', 'cs143', '', 'cs143');
// if ($db->connect_errno > 0) { 
//     die('Unable to connect to database [' . $db->connect_error . ']'); 
// }


// $rs = $db->query($query3);
// while ($row = $rs->fetch_assoc()) { 
//     $id = $row['id']; 
//     $first = $row['first']; 
//     $last = $row['last'];
//     $sex = $row['sex'];
//     $dob = $row['dob'];
//     $dod = $row['dod']; 
//     print "$id, ";
//     print "$last $first, ";
//     print ", $sex, $dob, $dod <br>"; 
// }
// $rs->free();

?> 




<br><br><br><br><br><br><br><br><br><br>
</body>
</html>


