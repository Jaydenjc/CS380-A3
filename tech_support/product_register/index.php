<!-- Jayden Cooper 11/30/2022, Ben Yuter 11/09/2022, John Giaquinto 11/10/2022 -->
<?php require('../model/database.php');
include '../view/header.php'; ?>

<?php

// check login
session_start();
if (! isset($_SESSION['login'])) {

    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Product Register</title>
</head>
<body>
<main class="registerProduct">
    <h1>Customer Login</h1>
    <p>You must login before you can register a product.</p>

    <!-- the user must enter their email (which is sent over to registerProduct.php) before they can register a product -->
    <form action="registerProduct.php" method="post">
        <label for="email">Email:</label>
        <input type="text" name="email" class="solid">
        <input type="submit" value="Login">
    </form>
</main>
</body>
</html>
    <?php
}
else
    header("Location: registerProduct.php");
?>
<?php include '../view/footer.php'; ?>
