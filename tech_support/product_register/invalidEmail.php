<!-- John Giaquinto 11/10/2022 -->
<!-- The user should only ever be sent to this page if they entered an invalid email -->
<!-- This page is almost identical to the index page, with the exception that it indicates an invalid email has been entered -->
<?php require('../model/database.php');
include '../view/header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Invalid Email</title>
</head>
<body>
<main class="registerProduct">
    <h1>Customer Login</h1>
    <p>The email you entered is invalid. Please enter a valid email.</p>

    <form action="registerProduct.php" method="post">
        <label for="email">Email:</label>
        <input type="text" name="email" class="solid">
        <input type="submit" value="Login">
    </form>
</main>
</body>
</html>
<?php include '../view/footer.php'; ?>