<!-- John Giaquinto 12/17/2022 -->
<!-- The user should only ever be sent to this page if they entered an invalid email -->
<!-- This page is almost identical to the index page, with the exception that it indicates an invalid email has been entered -->
<?php require('../model/database.php');
include '../view/header.php'; ?>
<?php
// check login
session_start();
if (!isset($_SESSION['login']) or $_SESSION['login'] != "customer") {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Invalid Email</title>
</head>
<body>
<main class="registerProduct">
    <h1>Customer Login</h1>
    <p>The email or password you entered is invalid. Please enter a valid email / password combination.</p>

    <form action="registerProduct.php" method="post">
        <table>
            <tr>
                <td>
                    <label for="emailCustomer">Email:</label>
                </td>
                <td>
                    <input type="text" minlength="1" maxlength="20" name="emailCustomer" id="emailCustomer" value=""
                           class="solid" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="passwordCustomer">Password:</label>
                </td>
                <td>
                    <input type="text" minlength="1" maxlength="20" name="passwordCustomer" id="passwordCustomer"
                           value="" class="solid" required>
                </td>
            </tr>
            <tr>
                <td>
                </td>
                <td><input type="submit" value="Login"></td>
            </tr>
        </table>
    </form>
</main>
</body>
</html>
<?php
} else
    header("Location: registerProduct.php");
?>
<?php include '../view/footer.php'; ?>