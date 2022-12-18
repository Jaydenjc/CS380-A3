<!-- John Giaquinto 12/18/2022 -->
<?php require('../model/database.php');
include '../view/header.php'; ?>
<?php

// check login
session_start();
error_reporting(0);

// if an email is already being used for a current session, use that email
$email = null;
$password = null;
if (!isset($_SESSION['email'])) {
    if (!empty($_POST['emailTech']) and !empty($_POST['passwordTech'])) {
        $email = $_POST['emailTech'];
        $password = $_POST['passwordTech'];
    }
    else{
        header("Location: invalidCredentials.php");
    }
} else {
    $email = $_SESSION['email'];
}

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try {
    // Select the customer's customerID, first name, and last name using a prepared form to prevent SQL injections
    if (!isset($_SESSION['email'])) {
        $query = mysqli_prepare($con, "SELECT * FROM technicians WHERE email=? AND password=?");
        mysqli_stmt_bind_param($query, "ss", $email, $password);
    } else {
        $query = mysqli_prepare($con, "SELECT * FROM technicians WHERE email=?");
        mysqli_stmt_bind_param($query, "s", $email);
    }
    mysqli_stmt_execute($query);
    $result = mysqli_stmt_get_result($query);

    if (mysqli_num_rows($result) > 0) {
        while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            // Create variables for the customerID, firstName, and lastName for the form to register products
            foreach ($line as $key => $value) {
                if ($key == "techID") {
                    $_SESSION['techID'] = $value;
                }
            }
        }
        // create session variable containing correct login status for use in other pages
        $_SESSION['login'] = "technician";
        $_SESSION['email'] = $email;

        mysqli_close($con);
        header("Location: technicianMenu.php");
    }
    // If there are no results in the database for the entered email,
    // the email must be invalid. Redirect to invalid email page
    else {
        header("Location: invalidCredentials.php");
    }
} catch (Exception $e) {
    $message = $e->getMessage();
    $code = $e->getCode();
    // If there is an error selecting the customer or products, display the error on the errors page
    header("Location: ../errors/error.php?code=$code&message=$message");
} finally{
    mysqli_close($con);
}
?>
<?php include '../view/footer.php'; ?>