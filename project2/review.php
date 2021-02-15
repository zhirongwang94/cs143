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


<h1>Review Page :</h1>

<hr>

<?php
$mid = (int)$_GET['movie_id'];
$user_name = "Mr.Anonymous";
$comment = "";
$rating = 0;


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["user_name"])) {
     $user_name = "Mr.Anonymous";
  } else {
    $user_name = test_input($_POST["user_name"]);
  }

  if (empty($_POST["comment"])) {
    $comment = "This guy is lazy, he left no comment.";
  } else {
    $comment = test_input($_POST["comment"]);
  }


  if (!empty($_POST["mid"])) {
    $mid = test_input($_POST["mid"]);
  } 

  if (empty($_POST["rating"])) {
    $rating = -1; 
  } else {
    $rating = test_input($_POST["rating"]);
  }
 }

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>


<h2>Add new comment here:</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Movie ID(Don't Change): <input type="text" name="mid" value="<?php echo $mid;?>"><br><br>
  Your Name(optional): <input   type="text" name="user_name" placeholder="Mr.Anonymous" value="<?php echo $user_name;?>"><br><br>
  Comment(optional): <textarea name="comment" rows="5" cols="40"><?php echo $comment;?></textarea> <br><br>

  Rating(required):
  <input type="radio" name="rating" value=1>1
  <input type="radio" name="rating" value=2>2
  <input type="radio" name="rating" value=3>3
  <input type="radio" name="rating" value=4>4
  <input type="radio" name="rating" value=5>5
  <br><br>

  <input type="submit" name="submit" value="Rate it!">  
  <!-- echo "<a href=movie_info.php?selected_movie_id=" . $id . ">Check This Movie</a>"; -->
</form>


<?php
date_default_timezone_set("America/Los_Angeles");
$t = date("Y-m-d h:i:s", time());



?>


<?php
// Database connection
$db = new mysqli('localhost', 'cs143', '', 'cs143');
if ($db->connect_errno > 0) { 
    die('Unable to connect to database [' . $db->connect_error . ']'); 
}



// Formating query, Review(name, time, mid, rating, comment) 
$query = "INSERT INTO Review(name, time, mid, rating, comment) VALUES ('" .
         $user_name . "', '" . $t . "', " . $mid . ", " . $rating . ", '" . $comment ."') ";



// insert to the table Review
if($rating == -1 || $rating == 0){
    print "Wating to comment....Rating is required<br>" ;
}else{
    $rs = $db->query($query);
    if(!$rs){
        print "Failed to comment....<br>" ;
    }
    else{
        print "Succeed to comment, you can go back to the movie page or the main <br>" ;
        echo "<h2>Your Input:</h2>";
        date_default_timezone_set("America/Los_Angeles");
        $t = date("Y-m-d h:i:s", time());

        print "name: $user_name <br>";
        print "time: $t <br>";
        print "mid: $mid <br>";
        print "rating: $rating <br>";
        print "comment: $comment <br><br>";
    }
}
?>










<a href=index.php?>Main Page</a><br>
<?php echo "<a href=movie_info.php?selected_movie_id=" . $mid . ">Back to this Movie Page</a>";?>

</body>
</html>