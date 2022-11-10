<?php require('../model/database.php');
include '../view/header.php'; ?>
<?php
date_default_timezone_set('America/New_York');

if (!empty($_POST['product']) and !empty($_POST['id'])) {
    $product = $_POST['product'];
    $customerID = $_POST['id'];
    $date = date('Y/m/d', time());

    try {
        // Ignore prevents an error duplicate entries
        $query = "INSERT IGNORE INTO registrations VALUES ('$customerID', '$product', '$date');";
        $result = mysqli_query($con, $query);
    } catch (Exception $e) {
        $message = $e->getMessage();
        $code = $e->getCode();
        header("Location: error.php?code=$code&message=$message"); // If there is an error doing this, print out the error for the user
    } finally {
        mysqli_close($con); // Regardless of whether we have an error, we always close the connection
    }
} else {
    header("Location: index.php"); // If the user somehow gets to this page without having selected a product and customer
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
        <main>
            <h1>Register Product</h1>
            <!-- Duplicate entries are also "registered successfully", though we do not update the record for duplicates -->
            <p>Product <b>' . $product . '</b> was registered successfully</p>
        </main>
    </body>
    </html>
';

?>
<?php include '../view/footer.php'; ?>

