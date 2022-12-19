<!-- Jayden Cooper 11/30/2022, Ben Yuter 11/30/2022, John Giaquinto 11/30/2022 Ileaqua Adams 11/30/2022-->
<?php require('../model/database.php');
include '../view/header.php'; ?>
<?php
// check login
session_start();
if (isset($_SESSION['login']) and $_SESSION['login'] == "admin") {
?>
<?php
if (!empty($_POST['customerID'])) { // If the user pressed the "select" button, this should be true (i.e., we should know the customerID)
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $ID = $_POST['customerID'];

    try {
        $query = "SELECT * FROM customers WHERE customerID='$ID';"; // Select the one customer with a matching ID (customerID is a primary key)
        $result = mysqli_query($con, $query);
        while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            // Find the customer's information to be echoed into the customer's table / form later on
            // htmlspecialchars($value) prevents html injections by converting < , >, &, ', " into special format
            foreach ($line as $key => $value) {
                if ($key == "customerID") {
                    $ID = htmlspecialchars($value);
                } elseif ($key == "firstName") {
                    $fname = htmlspecialchars($value);
                } elseif ($key == "lastName") {
                    $lname = htmlspecialchars($value);
                } elseif ($key == "address") {
                    $address = htmlspecialchars($value);
                } elseif ($key == "city") {
                    $city = htmlspecialchars($value);
                } elseif ($key == "state") {
                    $state = htmlspecialchars($value);
                } elseif ($key == "postalCode") {
                    $pcode = htmlspecialchars($value);
                } elseif ($key == "countryCode") {
                    $ccode = htmlspecialchars($value);
                } elseif ($key == "phone") {
                    $phone = htmlspecialchars($value);
                } elseif ($key == "email") {
                    $email = htmlspecialchars($value);
                } elseif ($key == "password") {
                    $userpassword = htmlspecialchars($value);
                }
            }
        }
    } catch (Exception $e) {
        $message = $e->getMessage();
        $code = $e->getCode();
        header("Location: error.php?code=$code&message=$message"); // If there is an error selecting the customer, we display the error for the user in the errors page
    } // We won't close the connection here in a finally block because we use it again later
} else {
    // If the user somehow got to this page without properly selecting a customer, redirect to the error page
    header("Location: ../errors/error.php?message=Warning: Customer not properly selected!");
}
?>
<main class="selectCustomer">
    <h1>View / Update Customer</h1>
    <!-- Here the user can enter the new / changed customer information to update. The form submits to the updateCustomer.php page -->
    <form action="updateCustomer.php" method="post">
        <!-- The user cannot change the customerID, but can change anything else -->
        <input type="hidden" name="id" value="<?php echo $ID ?>" class="solid">
        <table>
            <tr>
                <!-- Character length for fname, lname, address city state and email should have minimum lengths of 1 character and maximum lengths of 50 characters -->
                <td>
                    <label for="fname">First Name:</label>
                </td>
                <td>
                    <input type="text" minlength="1" maxlength="50" name="fname" id="fname" value="<?php echo $fname ?>" class="solid" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="lname">Last Name:</label>
                </td>
                <td>
                    <input type="text" minlength="1" maxlength="50" name="lname" id="lname" value="<?php echo $lname ?>" class="solid" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="address">Address:</label>
                </td>
                <!-- We want the address line and email line to be a bit longer. The form boxes in the extraLength class are longer due to CSS -->
                <td class="extraLength">
                    <input type="text" minlength="1" maxlength="50" name="address" id="address" value="<?php echo $address ?>" class="solid" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="city">City:</label>
                </td>
                <td>
                    <input type="text" minlength="1" maxlength="50" name="city" id="city" value="<?php echo $city ?>" class="solid" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="state">State:</label>
                </td>
                <td>
                    <input type="text" minlength="1" maxlength="50" name="state" id="state" value="<?php echo $state ?>" class="solid" required>
                </td>
            </tr>
            <tr>
                <!-- Postal code should be between 1 and 20 characters -->
                <td>
                    <label for="pcode">Postal Code:</label>
                </td>
                <td>
                    <input type="text" minlength="1" maxlength="20" name="pcode" id="pcode" value="<?php echo $pcode ?>" required>
                </td>
            </tr>
            <tr>
                <td class="vt"><label for="countries">Country:</label></td>
                <td>
                    <select name="countries" id="countries">
                        <?php
                        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

                        try { // Find the customer's current country
                            $query = "SELECT countryName FROM countries WHERE countryCode='$ccode';";
                            $result = mysqli_query($con, $query);
                            while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                // create a table row for our record
                                foreach ($line as $key => $value) {
                                    if ($key == "countryName") {
                                        $cname = $value;
                                    }
                                }
                            }
                        } catch (Exception $e) {
                            $message = $e->getMessage();
                            $code = $e->getCode();
                            header("Location: error.php?code=$code&message=$message"); // If there is an error selecting the country, we display this error for the user on the error page
                        } finally {
                            mysqli_close($con); // Now we are done using the database. We can close the connection.
                        }
                        ?>
                        <!-- Select the customer's current country by default -->
                        <option value="<?php echo $ccode ?>" selected><?php echo $cname ?></option>
                        <?php
                        // Access database for <option> country values
                        include("countryDropdown.php");
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="phone">Phone:</label>
                </td>
                <td>
                    <input type="text" name="phone" id="phone" value="<?php echo $phone ?>" class="solid" pattern="\([0-9]{3}\) [0-9]{3}-[0-9]{4}" title="Use (999) 999-9999 format"><span class="requiredTag"></span>
                </td>
            </tr>
            <tr>
                <!-- Email address must be valid-->
                <td>
                    <label for="email">Email:</label>
                </td>
                <td class="extraLength">
                    <input type="email" minlength="1" maxlength="50" name="email" id="email" value="<?php echo $email ?>" pattern="[a-z0-9._%+-]+@[a-z0-9]+\.[a-z]{2,4}$" title="Use name@example.com format" class="solid" required>
                </td>
            </tr>
            <tr>
                <!-- Password should be between 6 and 20 characters -->
                <td>
                    <label for="password">Password:</label>
                </td>
                <td>
                    <input type="text" minlength="6" maxlength="20" name="password" id="password" value="<?php echo $userpassword ?>" class="solid" required>
                </td>
            </tr>
            <tr>
                <td>
                    <!-- The table cell here moves the "Update Customer" button from the left of the page to the center-->
                </td>
                <td>
                    <input type="submit" value="Update Customer">
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
} else // if an admin is not logged in, redirect to the admin login page
    header("Location: ../admin/index.php");
?>
<?php include '../view/footer.php'; ?>