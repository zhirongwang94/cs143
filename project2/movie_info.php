

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

<h1>Movies Information Page :</h1>
<?php

$selected_movie_id = (int)$_GET['selected_movie_id'];
echo "Selected movie is : ". $selected_movie_id . "<br>"; //retrieve data

echo "<br><br><br><br><br><br><br><br><br><br>";

?> 





<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

<!--This division is for the study of text division -->
<div class="pagehead">

		<h1>代码狗的BLOG</h1>
		<pre>爱国、爱党、爱世界、爱生活</pre>	
		<pre>"种下去的是代码，收获的是bug"             
				---码农农场</pre>
</div>

<!--This division is for the study of linking (link to) other sites -->
<div class="menu-outer">
    <nav> <!-- Navigation tag -->
	    <ul>  <!--Unordered list tag,  -->
           <li><a href="home.html">Home</a></li> <!-- a tag, a tag to conatain a hyperlink  -->
           <li><a href="projects.html">Projects</a></li>
           <li><a href="notes.html">Notes</a></li>
           <li><a href="lifes.html">生活</a></li>
           <li><a href="about.html">About</a></li>
        </ul>
   </nav>
</div>

<div>
	<h2>生活</h2>
</div>

<!--Division of preface-->
<div>
	<p style="color:grey;font-size:10px;">
		还没想到有什么可以分享的，想到再post吧。
	</p>

</div>


</body>
</html>


