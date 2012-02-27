<?php

// Gets an environment variable we created in the .htaccess file
// This is the best way to keep usernames and passwords out of public GitHub repos
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');
$dsn = getenv('DB_DSN');

$db = new PDO($dsn, $user, $pass);


$db->exec('SET NAMES utf8');



echo $user;