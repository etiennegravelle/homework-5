<?php

require_once 'includes/filter-wrapper.php';

$errors = array();


$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

if(empty($id)){
	header('Location: index.php');
	exit;
}

$movie_name = filter_input(INPUT_POST, 'movie_name', FILTER_SANITIZE_STRING);
$year = filter_input(INPUT_POST, 'year', FILTER_SANITIZE_STRING);



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if (empty($movie_name)){
		$errors['movie_name'] = true;
	}
	
	if (empty($year)){
		$errors['year'] = true;
	}
	
	if (empty($errors)) {
		require_once 'includes/db.php';
		
		$sql = $db->prepare('
			INSERT INTO movies (movie_name, year)
			VALUES (:movie_name, :year)
			WHERE id = :id
			');
			
			$sql->bindValue(':movie_name', $movie_name, PDO::PARAM_STR);
			$sql->bindValue(':year', $year, PDO::PARAM_STR);
			$sql->bindValue(':id', $id, PDO::PARAM_INT);
			$sql->execute();
			
			header('Location: index.php');
			exit;
	}
} else {
	require_once 'includes/db.php';
	
	$sql = $db->prepare('
	SELECT id, movie_name, year
	FROM movies
	WHERE id = :id
	');
	
	$sql->bindValue(':id', $id, PDO::PARAM_INT);
	$sql->execute();
	$results = $sql->fetch();
	
	$movie_name = $results['movie_name'];
	$year = $results['year'];
}
	
	

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Edit Dinosaur</title>
</head>
<body>
	
	<form method="post" action="edit.php?id=<?php echo $id; ?>">
    	<div>
        	<label for="movie_name">Movie Name <?php if (isset($errors['movie_name'])) : ?><strong>Is required</strong><?php endif; ?></label>
            <input id="movie_name" name="movie_name" value="<?php echo $movie_name; ?>" required>
		</div>
		<div>
			<label for="year">year<?php if (isset($errors['year'])) :?><strong>Is required</strong><?php endif; ?></label>
			<input id="year" name="year" value="<?php echo $year; ?>" required>
		</div>
			<button type="submit">Save</button>
	</form>
    
</body>
</html>