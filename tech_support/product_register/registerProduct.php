<!-- <!-- Ben Yuter 11/09/2022, John Giaquinto 11/10/2022 -->
<?php require('../model/database.php');
include '../view/header.php'; ?>

<?php
//session_start(); // check login
//if ($_SESSION['login'] == "yes") {

//if (session_status() == PHP_SESSION_ACTIVE)
//{

if (!empty($_POST['email'])) { // We only get the customer information if the user entered the customer email
    $email = $_POST['email'];

    try {
        // Select the customer's customerID, first name, and last name using a prepared form to prevent SQL injections
        $query = mysqli_prepare($con, "SELECT customerID, firstName, lastName FROM customers WHERE email=?");
        mysqli_stmt_bind_param($query, "s", $email);
        mysqli_stmt_execute($query);
        $result = mysqli_stmt_get_result($query);


        if (mysqli_num_rows($result) > 0) {
            while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                // Create variables for the customerID, firstName, and lastName for the form to register products
                foreach ($line as $key => $value) {
                    if ($key == "customerID") {
                        $customerID = $value;
                    }
                    if ($key == "firstName") {
                        $firstName = $value;
                    } elseif ($key == "lastName") {
                        $lastName = $value;
                    }
                }
            }
        } else {
            header("Location: invalidEmail.php"); // If there are no results in the database for the entered email, the email must be invalid. Redirect to invalid email page
        }



        // Select all of the productCodes and names from the products table
        $query = "SELECT productCode, name FROM products;";
        $result = mysqli_query($con, $query);

        // Put all of the product codes and names into an array so the user can select them individually. Every product code has a corresponding product name
        $productCodeArray = [];
        $productNameArray = [];
        while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            // create a table row for our record
            foreach ($line as $key => $value) {
                if ($key == "productCode") {
                    $productCodeArray[] = $value;
                } elseif ($key == "name") {
                    $productNameArray[] = $value;
                }
            }
        }
    } catch (Exception $e) {
        $message = $e->getMessage();
        $code = $e->getCode();
        header("Location: error.php?code=$code&message=$message"); // If there is an error selecting the customer or products, display the error on the errors page
    } finally {
        mysqli_close($con); // Regardless of whether we have an error, we always close the connection
    }
} else {
    header("Location: index.php"); // If the user somehow gets to this page without having entered an email they are sent back to the index
}

// establish session
session_start();

// create session variable containing correct login status for use in other pages
$_SESSION['login'] = "yes";

// get table header names from SQL field names
//$finfo = mysqli_fetch_fields($result);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register Product</title>
</head>
<body>
<h2 style="text-align:center;">  <?php echo "Welcome " . $email . "" ?></h2>
<!--<h2 style="text-align:center;"">Welcome, " . $name . "</h2> -->
<main class="viewRegister">
    <h1>Register Product</h1>
    <table>
        <tr>
            <td>
                <p>Customer:</p>
            </td>
            <td>
                <p> <?php echo $firstName . " " . $lastName ?></p>
            </td>
        </tr>
    </table>
    <form method='POST' action='registerScript.php'>
        <!-- The customerID is hidden from the user, but submitted with the form -->
        <input type="hidden" name="id" value="<?php echo $customerID ?>" class="solid">
        <table>
            <tr>
                <td>
                    <label for="product">Product: </label>
                </td>
                <td>
                    <select name="product" id="product">
                        <!-- The user can select a product from a list of product names, each corresponding to a product code which is submitted with the form -->
                        <?php for ($i = 0; $i < sizeof($productNameArray); $i++) : ?>
                            <option value="<?php echo $productCodeArray[$i]; ?>">
                                <?php echo $productNameArray[$i]; ?>
                            </option>
                        <?php endfor; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                </td>
                <td>
                    <input type='submit' value='Register Product' name='register product'>
                </td>
            </tr>
        </table>
    </form>
</main>
</body>
</html>
<?php include '../view/footer.php';

//}else header("Location: index.php");


?>
/footer.php'; ?>