<?php
session_start();

// Define localhost, databaseuser, database user and database name
define('dbhost', 'localhost');
define('dbuser', 'root');
define('dbpass', '');
define('dbname', 'test');

// Connecting to above mentioned database
try {
    $conn = new PDO("mysql:host=".dbhost."; dbname=".dbname, dbuser, dbpass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
//if any error occured
catch(PDOException $e) {
    echo $e->getMessage();
}
	session_destroy();

	header('Location: index.php');
?>
