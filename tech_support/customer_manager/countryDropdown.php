<?php require('../model/database.php'); include '../view/header.php'; ?>
<?php


// Connect to MySQL, select database
//$con = mysqli_connect("byuter.bentley.edu","byuter","","tech_support");
//Select database and load countries table records

$query = "SELECT * FROM countries ORDER BY countryName;";

$result = mysqli_query($con, $query) or die('Query failed: ' . mysqli_errno($con));

//how many records in result set
$rows = mysqli_num_rows($result);

// if empty bands table, error, redirect to error.php
if ($rows < 1)
    header("Location: errors/error.php");

// loop over result set. Print a table row for each record
while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

    echo '<option value=' . $line ['countryCode'] . '>' . $line ['countryName'] . ' </option>';
}
mysqli_close($con);


?>
