<?php
require_once 'includes/db.php';
var_dump($db);

//'->exec()' allows us to perform SQL and NOT expect results
//'->query()' allows us to perform SQL and expect results

$results = $db->query('
	SELECT id, movie_name, year 
	FROM movies
	ORDER BY movie_name ASC
');
?>




<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<title>Movies</title>
</head>
<body>
	<a href="add.php">Add a Movie!</a>
	<ul>
	
	
	<?php 
	/*
	foreach ($results as $dino) {
		echo '<li>' . $dino['dino_name'] . '</li>';
		}
	*/
	?>
	
	<?php
	foreach ($results as $movie) : ?>
		<li><a href="single.php?id=<?php echo $movie['id']; ?>"><?php echo $movie['movie_name']; ?></a>
		&bull;
        <a href="edit.php?id=<?php echo $movie['id']; ?>">Edit</a>
        <a href="delete.php?id=<?php echo $movie['id']; ?>">Delete</a>
		</li>
	<?php endforeach; ?>
	/*
	</ul>
	
	
</body>
</html>
