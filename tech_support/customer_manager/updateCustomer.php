<?php require('../model/database.php'); include '../view/header.php'; ?>

<?php
if (! empty($_POST['id'])) {
    $ID = $_POST['id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $pcode = $_POST['pcode'];
    $ccode = $_POST['ccode'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
}
    $query = "UPDATE customers SET firstName='$fname', lastName='$lname', address='$address', city='$city', state='$state', postalCode='$pcode', countryCode='$ccode', phone='$phone', email='$email', password='$password' WHERE CustomerID = '$ID';";

    $result = mysqli_query($con, $query);

?>
<?php include '../view/footer.php'; ?>