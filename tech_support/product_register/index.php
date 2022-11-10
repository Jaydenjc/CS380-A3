<?php require('../model/database.php');
include '../view/header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Product Register</title>
</head>
<body>
<main class="registerProduct">
    <h1>Customer Login</h1>
    <p>You must login before you can register a product.</p>

    <form action="registerProduct.php" method="post">
        <label for="email">Email:</label>
        <input type="text" name="email" class="solid">
        <input type="submit" value="Login">
    </form>
</main>
</body>
</html>
<?php include '../view/footer.php'; ?>
