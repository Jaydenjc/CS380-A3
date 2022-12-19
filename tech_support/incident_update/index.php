<!-- Ben Yuter 12/07/2022, John Giaquinto 12/18/2022 -->
<?php include '../view/header.php'; ?>
<?php
// check login
session_start();
if (!isset($_SESSION['login']) or $_SESSION['login'] != "technician") {
?>
<main>
    <!--  Create Login Section  -->
    <section class="login">
        <h1>Technician Login</h1>
        You must login before you can update an incident.<br>
        <form method='POST' action='technicianScript.php'>
            <table>
                <tr>
                    <td>
                        <label for="emailTech">Email:</label>
                    </td>
                    <td>
                        <input type="text" minlength="1" maxlength="20" name="emailTech" id="emailTech" value="" class="solid" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="passwordTech">Password:</label>
                    </td>
                    <td>
                        <input type="text" minlength="1" maxlength="20" name="passwordTech" id="passwordTech" value="" class="solid" required>
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
    header("Location: technicianScript.php"); //If a technician is already logged in, skip this login page
?>
<?php include '../view/footer.php'; ?>