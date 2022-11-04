<?php require('../model/database.php'); include '../view/header.php'; ?>
<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    if (empty($_POST['id']) or empty($_POST['fname']) or empty($_POST['lname']) or empty($_POST['email']) or empty($_POST['phone']) or empty($_POST['password'])) throw new Exception("form fields not filled in");

    $id = $_POST['id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    $query = "INSERT INTO technicians VALUES('$id', '$fname', '$lname', '$email', '$phone', '$password')";
    $result = mysqli_query($con, $query) or die('insert failed: ' . mysqli_errno($con));
} catch (Exception $e){
    $message = $e->getMessage();
    $code = $e->getCode();
    header("Location: error.php?code=$code&message=$message");
}
finally{
    mysqli_close($con);
}
?>

    <html>
    <body>
    <h2 style="text-align: center;">Record added <?php echo $id?></h2>
    <br>
    <br>
    <a href="index.php">Back</a>
    </body>
    </html>

<?php include '../view/footer.php'; ?>