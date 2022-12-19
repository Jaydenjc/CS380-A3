<!-- John Giaquinto 12/18/2022 -->
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
    $message = $e->getMessage();
    header("Location: ../errors/error.php?message=$message");
    exit();
}
?>