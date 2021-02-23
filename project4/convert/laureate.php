<!DOCTYPE HTML>
<html>  
<body>

<form action="laureate.php" method="get">
Name: <input type="text" name="id"><br>
<input type="submit">
</form>



<?php
	$id = $_GET['id'];
	print("id is $id <br><br><br>");
    $mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");

	$options = ["projection" => ['_id' => 0]];
    $filter = [ 'gender' => 'female', 'id' => $id ]; 
    $query = new MongoDB\Driver\Query($filter, $options);  

    // $query = new MongoDB\Driver\Query([]); 


    $rows = $mng->executeQuery("nobel.laureates", $query);
    foreach ($rows as $row) {
    	// $knownName = json_encode($row->gender);
        // echo "id: $row->id  : knownName $knownName \n";
        $to_print = json_encode($row);
        print_r($to_print);
        print "<br><br>";
    }

    print "hello world from laureate.php <br>";
    print "Bye";
    
?>

</body>
</html>