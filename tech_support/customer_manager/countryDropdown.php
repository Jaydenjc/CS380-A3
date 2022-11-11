<!-- Jayden Cooper 11/09/2022, John Giaquinto 11/10/2022 -->
<?php require('../model/database.php'); ?>
<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    // Select database and load countries table records
    $query = "SELECT * FROM countries ORDER BY countryName;";
    $result = mysqli_query($con, $query) or die('Query failed: ' . mysqli_errno($con));

    // How many records in result set
    $rows = mysqli_num_rows($result);

    // If the countries table is empty, redirect to error.php
    if ($rows < 1)
        header("Location: errors/error.php?message='countries not found'");

    // Loop over result set, and create an option for each record
    while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        // We display the country names for the user, but the values submitted by the user are the corresponding country codes
        echo '<option value=' . $line ['countryCode'] . '>' . $line ['countryName'] . ' </option>';
    }
} catch (Exception $e) {
    $message = $e->getMessage();
    $code = $e->getCode();
    header("Location: error.php?code=$code&message=$message"); // If there is an error selecting the countries, we display this error for the user on the errors page
} finally {
    mysqli_close($con); // Close the connection to the database
}
?>
