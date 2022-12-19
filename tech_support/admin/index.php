<!-- Ben Yuter 12/07/2022, John Giaquinto 12/18/2022 -->
<?php include '../view/header.php'; ?>
<?php
// check login
session_start();
if (!isset($_SESSION['login']) or $_SESSION['login'] != "admin") {
?>
<main>
    <!--  Create Login Section  -->
    <section class="login">
        <h1>Admin Login</h1>
        <form method='POST' action='adminMenu.php'>
            <table>
                <tr>
                    <td>
                        <label for="usernameAdmin">Username:</label>
                    </td>
                    <td>
                        <input type="text" minlength="1" maxlength="20" name="usernameAdmin" id="usernameAdmin"
                               class="solid" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="passwordAdmin">Password:</label>
                    </td>
                    <td>
                        <input type="text" minlength="1" maxlength="20" name="passwordAdmin" id="passwordAdmin"
                               class="solid" required>
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
<?php
} else
    header("Location: adminMenu.php"); //if an admin is already logged in, go straight to the admin menu page
?>
<?php include '../view/footer.php'; ?>