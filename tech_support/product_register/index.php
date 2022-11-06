<?php require('../model/database.php'); include '../view/header.php'; ?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<h1>Customer Login</h1>
<p>You must login before you can register a product.</p>

<form action="registerProduct.php" method="post" >
    <label for="email">Email:</label>
    <input type="text" name="email" class="solid">
    <input type="submit" value="Login">
</form>
</body>
</html>
<?php include '../view/footer.php'; ?>
