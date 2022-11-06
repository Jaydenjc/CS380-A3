<?php require('../model/database.php'); include '../view/header.php'; ?>

<?php
if (! empty($_POST['email'])) {
    $email = $_POST['email'];
    $query = "SELECT firstName, lastName FROM customers WHERE email='$email';";
    $result = mysqli_query($con, $query);
    while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        // create a table row for our record
        foreach ($line as $key => $value) {
            if($key == "firstName"){
                $firstName = $value;
            }
            elseif($key == "lastName") {
                $lastName = $value;
            }
        }
    }
}

?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<h1>Register Product</h1>
<p>Customer: <?php echo $firstName . " " . $lastName?></p>
</body>
</html>
<?php include '../view/footer.php'; ?>
