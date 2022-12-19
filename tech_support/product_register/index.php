<!-- Jayden Cooper 11/30/2022, Ben Yuter 11/09/2022, John Giaquinto 11/10/2022 -->
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
    <title>Product Register</title>
</head>
<body>
<main class="registerProduct">
    <!--  Create Login Section  -->
    <section class="login">
        <h1>Customer Login</h1>
        <p>You must login before you can register a product.</p>
        <!-- the user must enter their email (which is sent over to registerProduct.php) before they can register a product -->
        <form action="registerProduct.php" method="post">
            <table>
                <tr>
                    <td>
                        <label for="emailCustomer">Email:</label>
                    </td>
                    <td>
                        <input type="text" minlength="1" maxlength="20" name="emailCustomer" id="emailCustomer"
                               value="" class="solid" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="passwordCustomer">Password:</label>
                    </td>
                    <td>
                        <input type="text" minlength="1" maxlength="20" name="passwordCustomer"
                               id="passwordCustomer"
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
    </section>
</main>
</body>
</html>

<?php
} else // if a customer is already logged in, redirect to registerProduct.php
    header("Location: registerProduct.php");
?>
<?php include '../view/footer.php'; ?>
