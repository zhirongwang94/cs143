
<?php
// get the id parameter from the request
$id = intval($_GET['id']);

// set the Content-Type header to JSON, so that the client knows that we are returning a JSON data
header('Content-Type: application/json');

/*
   Send the following fake JSON as the result
   {  "id": $id,
      "givenName": { "en": "A. Michael" },
      "familyName": { "en": "Spencer" },
      "affiliations": [ "UCLA", "White House" ]
   }
*/
$output = (object) [
    "id" => strval($id),
    "givenName" => (object) [
        "en" => "A. Michael"
    ],
    "familyName" => (object) [
        "en" => "Spencer"
    ],
    "affliations" => array(
        "UCLA",
        "White House"
    )
];
echo json_encode($output);

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

    print "hello world from laureate.php";
    
?>

