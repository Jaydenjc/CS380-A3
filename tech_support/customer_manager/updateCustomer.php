<?php require('../model/database.php'); include '../view/header.php'; ?>

<?php
if (! empty($_POST['id'])) {
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

    $query = "UPDATE customers SET firstName='$fname', lastName='$lname', address='$address', city='$city', state='$state', postalCode='$pcode', countryCode='$ccode', phone='$phone', email='$email', password='$password' WHERE CustomerID = '$ID';";
    $result = mysqli_query($con, $query);

    echo "<p>Customer updated</p>";
    echo "<a href=\"index.php\"><span class=\"addButton\">Return to customer search</span></a>";
}
else{
    echo "<p>Warning: Could not find CustomerID! Customer not updated!</p>";
}


?>
<?php include '../view/footer.php'; ?>