<?php require('../model/database.php'); ?>
<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try{
    // Select database and load countries table records
    $query = "SELECT * FROM countries ORDER BY countryName;";

    $result = mysqli_query($con, $query) or die('Query failed: ' . mysqli_errno($con));

    // How many records in result set
    $rows = mysqli_num_rows($result);

    // if empty bands table, error, redirect to error.php
    if ($rows < 1)
        header("Location: errors/error.php");

    // Loop over result set. Print a table row for each record
    while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        echo '<option value=' . $line ['countryCode'] . '>' . $line ['countryName'] . ' </option>';
    }
} catch (Exception $e){
    $message = $e->getMessage();
    $code = $e->getCode();
    header("Location: error.php?code=$code&message=$message"); // If there is an error adding the technician, we display this error for the user
}
finally{
    mysqli_close($con); // Close the connection
}


?>
