<!-- Ben Yuter 11/23/2022, John Giaquinto 11/23/2022 -->
<?php require('../model/database.php');
include '../view/header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Get Customer</title>
</head>
<body>
<main class="registerProduct">
    <h1>Get Customer</h1>
    <p>You must enter the customer's email address to select the customer</p>

    <!-- the user must enter their email (which is sent over to createIncident.php) before they can register a product -->
    <form action="createIncident.php" method="post">
        <label for="email">Email:</label>
        <input type="text" name="email" class="solid">
        <input type="submit" value="Get Customer">
    </form>
</main>
</body>
</html>
<?php include '../view/footer.php'; ?>
