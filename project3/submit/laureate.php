<!DOCTYPE HTML>
<html>  
<body>

<form action="laureate.php" method="get">
Name: <input type="text" name="id"><br>
<input type="submit">
</form>


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

<?php
// get the id parameter from the request
$id = intval($_GET['id']);

print "hello entered ID is: $id <br><br>" ;

$query1 = "SELECT * FROM Person WHERE id=" . "$id";
$rs = $db->query($query1);

// print "$query1 <br>";
while ($row = $rs->fetch_assoc()) { 
    $id = $row['id'];
    $givenName = $row['givenName'];
    $familyName = $row['familyName'];
    $gender = $row['gender'];
    $birth_date = $row['birth_date'];
    $birth_city_id = $row['birth_city_id'];
	print "id: $id  <br>";
    print "givenName: en $givenName <br>";
    print "familyName: en $familyName <br>";
    print "gender:   $gender <br>";
    print "birth: { <br>";
    print ".....data: $birth_date <br>";
    print ".....place: {<br>";

    if ( !is_null($birth_city_id) ){
	    $query11 = "SELECT * FROM City WHERE id=" . "$birth_city_id";
	    $rs11 = $db->query($query11);
	    $row11 = $rs11->fetch_assoc();
	    $city = $row11['name'];
	    $country = $row11['country'];
	    // print "........city id: $birth_city_id  <br>";
	    print "........city: en $city  <br>";
	    print "........country: en $country} } <br> ";
    }

}


$count_query = "SELECT COUNT(*) AS count FROM NobelPrize WHERE id=" . "$id";
// print "$count_query <br>";
$rs = $db->query($count_query);
$row = $rs->fetch_assoc();
$count = $row['count'];
print "count is: $count <br>";

print "<br><br>";
print "nobelPrizes:[<br>";

for($number=1; $number <= $count; $number++){
		$query2 = "SELECT * FROM NobelPrize WHERE id=" . "$id AND num=" . "$number";
		 // print "query2: $query2 <br> ";
		$rs = $db->query($query2);


		print "<br><br>{<br>";
		 print "$query1\2 <br>";
		while ($row = $rs->fetch_assoc()) { 
		    $awardYear = $row['awardYear'];
		    $category = $row['category'];
		    $sortOrder = $row['sortOrder'];
		    $portion = $row['portion'];
		    $dateAwared = $row['dateAwared'];
		    $prizeStatus = $row['prizeStatus'];
		    $prizeAmount = $row['prizeAmount'];
		    $affiliations_name = $rpw['affiliations_name'];
		    $affiliations_city_id = $rpw['affiliations_city_id'];
		//     $motivation = $row['motivation']
			print "awardYear: $awardYear  <br>";
		    print "category:  en $category <br>";
		    print "sortOrder:  $sortOrder <br>";
		    print "portion:   $portion <br>";
		    print "dateAwared:  $dateAwared<br>";
		    print "prizeStatus: $prizeStatus <br>";
		    print "prizeAmount: $prizeAmount <br>";    
		    print "affiliations: <br> ";
		    print " name: en $affiliations_name <br>";
		    if ( !is_null($affiliations_city_id) ){
			    $query21 = "SELECT * FROM City WHERE id=" . "$affiliations_city_id";
			    // print "query21: $query21 <br>";
			    $rs21 = $db->query($query21);
			    $row21 = $rs21->fetch_assoc();
			    $city = $row21['name'];
			    $country = $row21['country'];
			    // print "........city id: $birth_city_id  <br>";
			    print "........city: en  $city  <br>";
			    print "........country: en $country} } <br> ";
			//     print "motivation: $motivation<br>";
		    }
		}
		print "}<br><br><br>";
}


print "]";

// // set the Content-Type header to JSON, so that the client knows that we are returning a JSON data
// header('Content-Type: application/json');


//    Send the following fake JSON as the result
//    {  "id": $id,
//       "givenName": { "en": "A. Michael" },
//       "familyName": { "en": "Spencer" },
//       "affiliations": [ "UCLA", "White House" ]
//    }

// $output = (object) [
//     "id" => strval($id),
//     "givenName" => (object) [
//         "en" => "A. Michael"
//     ],
//     "familyName" => (object) [
//         "en" => "Spencer"
//     ],
//     "affliations" => array(
//         "UCLA",
//         "White House"
//     )
// ];


// echo json_encode($output);

?>
</body>
</html>



