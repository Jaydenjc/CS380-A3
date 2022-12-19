<!-- John Giaquinto 12/18/2022 -->
<!-- The admin should only ever be sent to this page if they entered an invalid customer email -->
<!-- This page is almost identical to the index page, with the exception that it indicates an invalid email has been entered -->
<?php require('../model/database.php');
include '../view/header.php'; ?>
<?php
// check login
session_start();
if (isset($_SESSION['login']) and $_SESSION['login'] == "admin") {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Invalid Email</title>
</head>
<body>
<main class="createIncident">
    <h1>Get Customer</h1>
    <p>The email you entered is invalid. Please enter a valid email.</p>

    <form action="createIncident.php" method="post">
        <label for="email">Email:</label>
        <input type="text" name="email" class="solid">
        <input type="submit" value="Get Customer">
    </form>
</main>
</body>
</html>
<?php
} else // If an admin is not logged in, redirect to the admin login page
    header("Location: ../admin/index.php");
?>
<?php include '../view/footer.php'; ?>