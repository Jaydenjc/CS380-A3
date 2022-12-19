<!-- Jayden Cooper 11/30/2022, Ben Yuter 11/09/2022, John Giaquinto 12/17/2022 -->
<?php require('../model/database.php');
include '../view/header.php'; ?>

<?php
// check login
session_start();
error_reporting(0);

// if an email is already being used for a current session, use that email to grab the customer information
// otherwise, require a password
$email = null;
$password = null;
if (!isset($_SESSION['email'])) {
    if (!empty($_POST['emailCustomer']) and !empty($_POST['passwordCustomer'])) {
        $email = htmlspecialchars($_POST['emailCustomer']);
        $password = htmlspecialchars($_POST['passwordCustomer']);
    }
    else{
        header("Location: invalidEmail.php"); // Both the username and password need to be filled out
    }
} else {
    $email = $_SESSION['email'];
}

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try {
    // Select the customer's customerID, first name, and last name using a prepared form to prevent SQL injections
    if (!isset($_SESSION['email'])) {
        $query = mysqli_prepare($con, "SELECT customerID, firstName, lastName FROM customers WHERE email=? AND password=?");
        mysqli_stmt_bind_param($query, "ss", $email, $password);
    } else {
        $query = mysqli_prepare($con, "SELECT customerID, firstName, lastName FROM customers WHERE email=?");
        mysqli_stmt_bind_param($query, "s", $email);
    }
    mysqli_stmt_execute($query);
    $result = mysqli_stmt_get_result($query);

    if (mysqli_num_rows($result) > 0) {
        while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            // Create variables for the customerID, firstName, and lastName for the form to register products
            foreach ($line as $key => $value) {
                if ($key == "customerID") {
                    $customerID = $value;
                } elseif ($key == "firstName") {
                    $firstName = $value;
                } elseif ($key == "lastName") {
                    $lastName = $value;
                }
            }
        }
        // create session variable containing correct login status for use in other pages
        $_SESSION['login'] = "customer"; //This user can access customer pages
        $_SESSION['email'] = $email;
    }
    // If there are no results in the database for the entered email and password,
    // the credentials must be invalid. Redirect to invalid email page
    else {
        header("Location: invalidEmail.php");
    }

    // Select all of the productCodes and names from the products table
    $query = "SELECT productCode, name FROM products;";
    $result = mysqli_query($con, $query);

    // Put all of the product codes and names into an array so the user can select them individually.
    // Every product code has a corresponding product name
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
    // If there is an error selecting the customer or products, display the error on the errors page
    header("Location: ../errors/error.php?code=$code&message=$message");
} // Regardless of whether we have an error, we always close the connection
finally {
    mysqli_close($con);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register Product</title>
</head>
<body>
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
    <p style="text-align:left;">  <?php echo "You are logged in as " . $email . "" ?></p>
    <a href="../logout.php">
        <button type="button">Logout</button>
    </a>
</main>
</body>
</html>

<?php include '../view/footer.php';
?>
