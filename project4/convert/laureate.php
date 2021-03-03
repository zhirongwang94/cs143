
<!DOCTYPE html>
<html lang="en">


<!--   <form action="laureate.php" method="get">
Name: <input type="text" name="id"><br>
<input type="submit">
</form>

 -->


<h2>Laureate Search Page</h2>
<br>

<hr>
<label for="search_input">Search form here:</label>
<!-- WE use either GET or POST method -->

<form  method ="POST" >  
    <input type="text" placeholder="enter the id of the laureate" name="input"><br>
    <input type="submit" value="Click to Search" >
</form>



<?php

    $id = $_POST['input'];
   
    $mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");
    $filter = ['id'=>strval($id)];
    $options = ["projection" => ['_id' => 0]];
    $query = new MongoDB\Driver\Query($filter, $options);
    $rows = $mng->executeQuery("nobel.laureates", $query);

    $output = $rows->toArray();
    echo json_encode($output);

?>



</body>
</html>