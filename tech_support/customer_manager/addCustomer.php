<!-- Jayden Cooper 11/09/2022, Ben Yuter 12/07/2022, John Giaquinto 12/19/2022 Ileaqua Adams 11/30/2022-->
<?php require('../model/database.php');
include '../view/header.php'; ?>
<?php
// check login
session_start();
if (isset($_SESSION['login']) and $_SESSION['login'] == "admin") {
?>
<main class="selectCustomer">
    <h1>Add/Update Customer</h1>
    <!-- Here the user can enter the new customer information to update. The form submits to the updateCustomer.php page -->
    <form action="updateCustomer.php" method="post">
        <table>
            <tr>
                <!-- Character length for fname, lname, address city state and email should have minimum lengths of 1 character and maximum lengths of 50 characters -->
                <td>
                    <label for="fnameAdd">First Name:</label>
                </td>
                <td>
                    <input type="text" minlength="1" maxlength="50" name="fnameAdd" id="fnameAdd" value="" class="solid" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="lnameAdd">Last Name:</label>
                </td>
                <td>
                    <input type="text" minlength="1" maxlength="50" name="lnameAdd" id="lnameAdd" value="" class="solid" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="addressAdd">Address:</label>
                </td>
                <!-- We want the address line and email line to be a bit longer. The form boxes in the extraLength class are longer due to CSS -->
                <td class="extraLength">
                    <input type="text" minlength="1" maxlength="50" name="addressAdd" id="addressAdd" value="" class="solid"
                           required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="cityAdd">City:</label>
                </td>
                <td>
                    <input type="text" minlength="1" maxlength="50" name="cityAdd" id="cityAdd" value="" class="solid" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="stateAdd">State:</label>
                </td>
                <td>
                    <input type="text" minlength="1" maxlength="50" name="stateAdd" id="stateAdd" value="" class="solid" required>
                </td>
            </tr>
            <tr>
                <!-- Postal code should be between 1 and 20 characters -->
                <td>
                    <label for="pcodeAdd">Postal Code:</label>
                </td>
                <td>
                    <input type="text" minlength="1" maxlength="20" name="pcodeAdd" id="pcodeAdd" value="" required>
                </td>
            </tr>
            <tr>
                <td class="vt"><label for="countriesAdd">Country:</label></td>
                <td>
                    <select name="countriesAdd" id="countriesAdd">
                        <?php
                        // Access database for <option> country values
                        include("countryDropdown.php");
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="phoneAdd">Phone:</label>
                </td>
                <td>
                    <input type="text" name="phoneAdd" id="phoneAdd" value="" class="solid" pattern="\([0-9]{3}\) [0-9]{3}-[0-9]{4}"><span class="requiredTag"></span>
                </td>
            </tr>
            <tr>
                <!-- Email address must be valid-->
                <td>
                    <label for="emailAdd">Email:</label>
                </td>
                <td class="extraLength">
                    <input type="email" minlength="1" maxlength="50" name="emailAdd" id="emailAdd" value="" pattern="[a-z0-9._%+-]+@[a-z0-9]+\.[a-z]{2,4}$" class="solid" required>
                </td>
            </tr>
            <tr>
                <!-- Password should be between 6 and 20 characters -->
                <td>
                    <label for="passwordAdd">Password:</label>
                </td>
                <td>
                    <input type="text" minlength="6" maxlength="20" name="passwordAdd" id="passwordAdd" value="" class="solid" required>
                </td>
            </tr>
            <tr>
                <td>
                    <!-- The table cell here moves the "Update Customer" button from the left of the page to the center-->
                </td>
                <td>
                    <input type="submit" value="Add Customer">
                </td>
            </tr>
        </table>
    </form>
    <!-- The user can go back to the index page to make a new search if they click this button-->
    <a href="index.php"><span class="addButton">Search Customers</span></a>
    <p style="text-align:left;">  <?php echo "You are logged in as " . $_SESSION['username'] . "" ?></p>
    <a href="../logout.php">
        <button type="button">Logout</button>
    </a>
</main>
<?php
} else // If an admin is not logged in, redirect to the admin login page
    header("Location: ../admin/index.php");
?>
<?php include '../view/footer.php'; ?>