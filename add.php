<?php

require_once 'includes/filter-wrapper.php';

$errors = array();


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
			');
			
			$sql->bindValue(':movie_name', $movie_name, PDO::PARAM_STR);
			$sql->bindValue(':year', $year, PDO::PARAM_STR);
			$sql->execute();
			
			header('Location: index.php');
			exit;
	}
}

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add a movie!</title>
</head>
<body>
	
	<form method="post" action="add.php">
    	<div>
        	<label for="movie_name">Movie Name <?php if (isset($errors['movie_name'])) : ?><strong>Is required</strong><?php endif; ?></label>
            <input id="movie_name" name="movie_name" value="<?php echo $movie_name; ?>" required>
		</div>
		<div>
			<label for="year">Year<?php if (isset($errors['year'])) :?><strong>Is required</strong><?php endif; ?></label>
			<input id="year" name="year" value="<?php echo $year; ?>" required>
		</div>
			<button type="submit">Add</button>
	</form>
    
</body>
</html>