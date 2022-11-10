<?php require('../model/database.php'); include '../view/header.php'; ?>

<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    // If the user did not fill in the all of the technician information, we throw an exception
    if (empty($_POST['id']) or empty($_POST['fname']) or empty($_POST['lname']) or empty($_POST['email']) or empty($_POST['phone']) or empty($_POST['password'])) throw new Exception("form fields not filled in");

    $id = $_POST['id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    // We run a SQL query to add a new technician to the technicians table based on the user input
    $query = mysqli_prepare($con, "INSERT INTO technicians VALUES(?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($query, "ssssss", $id, $fname, $lname, $email, $phone, $password);
    mysqli_stmt_execute($query) or die('insert failed: ' . mysqli_errno($con));
    $result = mysqli_stmt_get_result($query);
} catch (Exception $e){
    $message = $e->getMessage();
    $code = $e->getCode();
    header("Location: error.php?code=$code&message=$message"); // If there is an error adding the technician, we display this error for the user
}
finally{
    mysqli_close($con); // Whether or not there is an error, we close the connection when we are done accessing the database
}
?>

<html lang="en">
<body>
    <main>
        <!-- This header will tell the user that a record was added regardless of whether an error occurred, but any errors will be visible to the user -->
        <h2 style="text-align: center;">Record added <?php echo $id?></h2>
        <br>
        <br>
        <a href="index.php">Back</a>
    </main>
</body>
</html>

<?php include '../view/footer.php'; ?>