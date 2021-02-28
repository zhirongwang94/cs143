
<?php
// get the id parameter from the request
$id = intval($_GET['id']);


?>

<!---------------------------- Developing  ---------------------->
<!---------------------------- Developing  ---------------------->
<?php

    $mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");

    $query = new MongoDB\Driver\Query([]); 
    $rows = $mng->executeQuery("testdb.cars", $query);
    foreach ($rows as $row) {
        echo "$row->name : $row->price\n";
    }

    print "hello world from laureate.phppp";
    
?>

