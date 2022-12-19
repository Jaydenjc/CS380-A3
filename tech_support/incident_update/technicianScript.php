<!-- John Giaquinto 12/18/2022 -->
<?php require('../model/database.php');
include '../view/header.php'; ?>
<?php

// check login
session_start();
error_reporting(0);

// if an email is already being used for a current session, use that email to login
// otherwise, require a password
$email = null;
$password = null;
if (!isset($_SESSION['email'])) {
    if (!empty($_POST['emailTech']) and !empty($_POST['passwordTech'])) {
        $email = htmlspecialchars($_POST['emailTech']);
        $password = htmlspecialchars($_POST['passwordTech']);
    }
    else{ //Email and password must be entered
        header("Location: invalidCredentials.php");
    }
} else {
    $email = $_SESSION['email'];
}

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try {
    // Select the technician using a prepared form to prevent SQL injections
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
            // Set the techID as one of our session variables
            foreach ($line as $key => $value) {
                if ($key == "techID") {
                    $_SESSION['techID'] = htmlspecialchars($value);
                }
            }
        }
        // create session variables containing correct login status and email for use in other pages
        $_SESSION['login'] = "technician"; // This user can access technician pages
        $_SESSION['email'] = $email;

        mysqli_close($con);
        header("Location: technicianMenu.php"); // redirect to the technician menu
    }
    // If there are no results in the database for the entered email and password,
    // the credentials must be invalid. Redirect to invalid credentials page
    else {
        header("Location: invalidCredentials.php");
    }
} catch (Exception $e) {
    $message = $e->getMessage();
    $code = $e->getCode();
    // If there is an error selecting the technician, display the error on the errors page
    header("Location: ../errors/error.php?code=$code&message=$message");
} finally{
    mysqli_close($con);
}
?>
<?php include '../view/footer.php'; ?>