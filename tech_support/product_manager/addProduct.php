<?php require('../model/database.php');
include '../view/header.php'; ?>
<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    // The user needs to fill in the form fields, otherwise an exception will be thrown
    if (empty($_POST['code']) or empty($_POST['pro_name']) or empty($_POST['version']) or empty($_POST['release_date'])) throw new Exception("Form fields not filled in");

    $Code = $_POST['code'];
    $Name = $_POST['pro_name'];
    $Version = $_POST['version'];
    $ReleaseDate = $_POST['release_date'];

    // Insert the product information given to us by the user into our products table
    $query = mysqli_prepare($con, "INSERT INTO products VALUES(?, ?, ?, ?)");
    mysqli_stmt_bind_param($query, "ssss", $Code, $Name, $Version, $ReleaseDate);
    mysqli_stmt_execute($query) or die('insert failed: ' . mysqli_errno($con));
    $result = mysqli_stmt_get_result($query);
} catch (Exception $e) {
    $message = $e->getMessage();
    $code = $e->getCode();
    header("Location: ../errors/error.php?code=$code&message=$message"); // If there is an error doing this, print out the error for the user
} finally {
    mysqli_close($con); // Regardless of whether we have an error, we always close the connection
}
?>

<html lang="en">
<body>
<main>
    <!-- "Record added" should display whether or not there is an error. But if there is an error, the error will be displayed for the user-->
    <h2 style="text-align: center;">Record added <?php echo $Code ?></h2>
    <br>
    <br>
    <a href="index.php">Back</a>
</main>
</body>
</html>

<?php include '../view/footer.php'; ?>