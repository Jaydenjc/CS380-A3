<!-- John Giaquinto 11/30/2022 Ileaqua Adams 11/30/2022-->
<?php require('../model/database.php');
include '../view/header.php'; ?>

<?php
if (!empty($_POST['id'])) { // We should always know the customer ID unless the user navigated to this page without first going through index.php > selectCustomer.php
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    $ID = htmlspecialchars($_POST['id']);
    $fname = htmlspecialchars($_POST['fname']);
    $lname = htmlspecialchars($_POST['lname']);
    $address = htmlspecialchars($_POST['address']);
    $city = htmlspecialchars($_POST['city']);
    $state = htmlspecialchars($_POST['state']);
    $pcode = htmlspecialchars($_POST['pcode']);
    $ccode = htmlspecialchars($_POST['countries']);
    $phone = htmlspecialchars($_POST['phone']);
    $email = htmlspecialchars($_POST['email']);
    $userpassword = htmlspecialchars($_POST['password']);

    try {
        // Query to update the customer
        $query = "UPDATE customers SET firstName='$fname', lastName='$lname', address='$address', city='$city', state='$state', postalCode='$pcode', countryCode='$ccode', phone='$phone', email='$email', password='$userpassword' WHERE CustomerID = '$ID';";
        $result = mysqli_query($con, $query);

        echo "<main><p>Customer updated</p>";
        echo "<a href=\"index.php\"><span class=\"addButton\">Return to customer search</span></a></main>";
    } catch (Exception $e) {
        $message = $e->getMessage();
        $code = $e->getCode();
        header("Location: ../errors/error.php?code=$code&message=$message"); // If there is an error updating the customer, we display this error for the user on the errors page
    } finally {
        mysqli_close($con); // Whether or not there is an error, we close the connection when we are done accessing the database
    }
} elseif (!empty($_POST['fnameAdd']) and !empty($_POST['lnameAdd']) and !empty($_POST['addressAdd']) and !empty($_POST['cityAdd']) and !empty($_POST['stateAdd']) and !empty($_POST['pcodeAdd']) and !empty($_POST['countriesAdd']) and !empty($_POST['phoneAdd']) and !empty($_POST['emailAdd']) and !empty($_POST['passwordAdd'])) {
    $fname = htmlspecialchars($_POST['fnameAdd']);
    $lname = htmlspecialchars($_POST['lnameAdd']);
    $address = htmlspecialchars($_POST['addressAdd']);
    $city = htmlspecialchars($_POST['cityAdd']);
    $state = htmlspecialchars($_POST['stateAdd']);
    $pcode = htmlspecialchars($_POST['pcodeAdd']);
    $ccode = htmlspecialchars($_POST['countriesAdd']);
    $phone = htmlspecialchars($_POST['phoneAdd']);
    $email = htmlspecialchars($_POST['emailAdd']);
    $userpassword = htmlspecialchars($_POST['passwordAdd']);

    try {
        // Query to update the customer
        $query = "INSERT IGNORE INTO customers (firstName, lastName, address, city, state, postalCode, countryCode, phone, email, password) VALUES ('$fname', '$lname', '$address', '$city', '$state', '$pcode', '$ccode', '$phone', '$email', '$userpassword');";
        $result = mysqli_query($con, $query);

        echo "<main><p>Customer updated</p>";
        echo "<a href=\"index.php\"><span class=\"addButton\">Return to customer search</span></a></main>";
    } catch (Exception $e) {
        $message = $e->getMessage();
        $code = $e->getCode();
        header("Location: ../errors/error.php?code=$code&message=$message"); // If there is an error updating the customer, we display this error for the user on the errors page
    } finally {
        mysqli_close($con); // Whether or not there is an error, we close the connection when we are done accessing the database
    }
} else {
    // If the user got to this page without selecting a customer, redirect them to the error page
    header("Location: ../errors/error.php?message=Warning: Could not find CustomerID! Customer not updated!");
}

?>
<?php include '../view/footer.php'; ?>