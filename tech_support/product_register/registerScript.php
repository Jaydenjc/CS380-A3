<?php require('../model/database.php'); include '../view/header.php'; ?>

<?php
if (! empty($_POST['product']) and !empty($_POST['id'])) {
    $product = $_POST['product'];
    $customerID = $_POST['id'];
}

$date = date('Y/m/d', time());
$query = "INSERT INTO registrations VALUES ('$customerID', '$product', '$date')";
$result = mysqli_query($con, $query);

echo'
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
            <p>Product <b>' . $product . '</b> was registered successfully</p>
        </main>
    </body>
    </html>
';

?>
<?php include '../view/footer.php'; ?>

