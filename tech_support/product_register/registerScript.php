<!-- Jayden Cooper 11/30/2022, Ben Yuter 11/09/2022, John Giaquinto 11/10/2022 -->
<?php require('../model/database.php');
include '../view/header.php'; ?>
<?php

// check login
session_start();
if (isset($_SESSION['login']) and $_SESSION['login'] == "customer") {

// Set the default timezone to New York for when we grab today's date
date_default_timezone_set('America/New_York');
if (!empty($_POST['product']) and !empty($_POST['id'])) { // We can only register a product of we know the product id and the customer id
    $product = $_POST['product'];
    $customerID = $_POST['id'];
    $date = date('Y/m/d', time()); // Today's date in year/month/day format

    try {
        // The IGNORE keyword won't throw an error for duplicate entries
        $query = "INSERT IGNORE INTO registrations VALUES ('$customerID', '$product', '$date');";
        $result = mysqli_query($con, $query);
    } catch (Exception $e) {
        $message = $e->getMessage();
        $code = $e->getCode();
        header("Location: error.php?code=$code&message=$message"); // If there is an error registering a product to a customer, print out the error for the user on the errors page
    } finally {
        mysqli_close($con); // Close the connection to the database
    }
} else {
    // If the user somehow gets to this page without having selected a product and customer, they are sent back to the index to login again
    // The user is meant to go from index.php to registerProduct.php to registerScript.php
    header("Location: index.php");
}

echo '
    <!DOCTYPE html>
    <html lang="en">
    <head>
    <title>
        Register Product
    </title>
    </head>
    <body>
    <!--<h2 style="text-align:center;">  <?php echo Welcome, " . $email . " ?></h2> -->

        <main>
            <h1>Register Product</h1>
            <!-- Duplicate entries are also "registered successfully", though we do not update the record for duplicates -->
            <p>Product <b>' . $product . '</b> was registered successfully</p>
        </main>
    </body>
    </html>
';

}
// If a customer is not logged in, go back to the customer login page
else
    header("Location: index.php");
?>

<?php include '../view/footer.php';
?>

