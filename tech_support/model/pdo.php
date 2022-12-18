<?php

$host = 'webdev.bentley.edu';
$db = 'jgiaquinto';
$user = 'jgiaquinto';
$password = '3740';

//connection string
$dsn = "mysql:host=$host;dbname=$db;charset=UTF8";

//connect to DB
try {
    //create PDO object
    $pdo = new PDO($dsn, $user, $password);

} catch (PDOException $e) {
    echo $e->getMessage();
    include('../errors/database_error.php');
    exit();
}
?>