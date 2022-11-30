<!-- John Giaquinto 11/10/2022 Ileaqua Adams 11/30/2022-->
<?php require('../model/database.php');
include '../view/header.php'; ?>

<?php
if (!empty($_POST['id'])) { // We should always know the customer ID unless the user navigated to this page without first going through index.php > selectCustomer.php
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    $ID = $_POST['id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $pcode = $_POST['pcode'];
    $ccode = $_POST['countries'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        // Query to update the customer
        $query = "UPDATE customers SET firstName='$fname', lastName='$lname', address='$address', city='$city', state='$state', postalCode='$pcode', countryCode='$ccode', phone='$phone', email='$email', password='$password' WHERE CustomerID = '$ID';";
        $result = mysqli_query($con, $query);

        echo "<main><p>Customer updated</p>";
        echo "<a href=\"index.php\"><span class=\"addButton\">Return to customer search</span></a></main>";
    } catch (Exception $e) {
        $message = $e->getMessage();
        $code = $e->getCode();
        header("Location: error.php?code=$code&message=$message"); // If there is an error updating the customer, we display this error for the user on the errors page
    } finally {
        mysqli_close($con); // Whether or not there is an error, we close the connection when we are done accessing the database
    }
} else {
    // If the user got to this page without selecting a customer, redirect them to the error page
    header("Location: ../errors/error.php?message=Warning: Could not find CustomerID! Customer not updated!");
}


?>
<?php include '../view/footer.php'; ?>