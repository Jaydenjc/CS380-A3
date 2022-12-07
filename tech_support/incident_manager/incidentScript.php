<!-- Ben Yuter 11/23/2022, John Giaquinto 11/23/2022 -->
<?php require('../model/database.php');
include '../view/header.php'; ?>
<?php
// Set the default timezone to New York for when we grab today's date
date_default_timezone_set('America/New_York');

// We can only create an incident if we know the product id, customer id, and incident title and description
if (!empty($_POST['product']) and !empty($_POST['id']) and !empty($_POST['title']) and !empty($_POST['description'])) {
    $product = htmlspecialchars($_POST['product']);
    $customerID = htmlspecialchars($_POST['id']);
    $title = htmlspecialchars($_POST['title']);
    $description = htmlspecialchars($_POST['description']);

    $date = date('Y/m/d', time()); // Today's date in year/month/day format

    try {
        $query = "INSERT IGNORE INTO incidents (customerID, productCode, dateOpened, title, description) VALUES ('$customerID', '$product', '$date', '$title', '$description');";
        $result = mysqli_query($con, $query);
    } catch (Exception $e) {
        $message = $e->getMessage();
        $code = $e->getCode();
        header("Location: ../errors/error.php?code=$code&message=$message"); // If there is an error creating the incident, print out the error for the user on the errors page
    } finally {
        mysqli_close($con); // Close the connection to the database
    }
} else {
    // If the user somehow gets to this page without having filled in the form fields, they are sent back to the index to login again
    // The user is meant to go from index.php to createIncident.php to incidentScript.php
    header("Location: index.php");
}

echo '
    <!DOCTYPE html>
    <html lang="en">
    <head>
    <title>
        Create Incident
    </title>
    </head>
    <body>
        <main>
            <h1>Create Incident</h1>
            <p>The incident was added to our database</p>
        </main>
    </body>
    </html>
';

?>
<?php include '../view/footer.php'; ?>