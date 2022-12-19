<!-- Ben Yuter 11/23/2022, John Giaquinto 12/18/2022 -->
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
    <title>Get Customer</title>
</head>
<body>
<main class="registerProduct">
    <h1>Get Customer</h1>
    <p>You must enter the customer's email address to select the customer</p>

    <!-- the admin must enter a customer (which is sent over to createIncident.php) before they can register a product -->
    <form action="createIncident.php" method="post">
        <label for="email">Email:</label>
        <input type="text" name="email" class="solid">
        <input type="submit" value="Get Customer">
    </form>
    <br>
    <p style="text-align:left;">  <?php echo "You are logged in as " . $_SESSION['username'] . "" ?></p>
    <a href="../logout.php">
        <button type="button">Logout</button>
    </a>
</main>
</body>
</html>
<?php
} else // If an admin is not logged in, redirect to the admin login page
    header("Location: ../admin/index.php");
?>
<?php include '../view/footer.php'; ?>
