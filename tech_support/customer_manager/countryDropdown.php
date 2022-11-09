<?php require('../model/database.php'); ?>
<?php

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

mysqli_close($con); // Close the connection
?>
