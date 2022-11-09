<?php require('../model/database.php'); include '../view/header.php'; ?>
<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    if (empty($_POST['code']) or empty($_POST['pro_name']) or empty($_POST['version']) or empty($_POST['release_date'])) throw new Exception("form fields not filled in");

    $Code = $_POST['code'];
    $Name = $_POST['pro_name'];
    $Version = $_POST['version'];
    $ReleaseDate = $_POST['release_date'];

    $query = "INSERT INTO products VALUES('$Code', '$Name', '$Version', '$ReleaseDate')";
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
    <main>
        <h2 style="text-align: center;">Record added <?php echo $Code?></h2>
        <br>
        <br>
        <a href="index.php">Back</a>
    </main>
</body>
</html>

<?php include '../view/footer.php'; ?>