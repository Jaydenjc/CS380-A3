<!-- Ben Yuter 12/7/2022, John Giaquinto 12/18/2022 -->
<?php require('../model/database.php');
include '../view/header.php'; ?>
<?php

// check login
session_start();
error_reporting(0);

// if a username is already being used for the current session, use that username to login
// otherwise, require the password
$username = null;
$password = null;
if (!isset($_SESSION['username'])) {
    if (!empty($_POST['usernameAdmin']) and !empty($_POST['passwordAdmin'])) {
        $username = htmlspecialchars($_POST['usernameAdmin']);
        $password = htmlspecialchars($_POST['passwordAdmin']);
    }
    else{
        header("Location: invalidCredentials.php"); //Both the username and password need to be filled out
    }
} else {
    $username = $_SESSION['username'];
}

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try {
    // Select the admins using a prepared form to prevent SQL injections
    if (!isset($_SESSION['username'])) {
        $query = mysqli_prepare($con, "SELECT * FROM administrators WHERE username=? AND password=?");
        mysqli_stmt_bind_param($query, "ss", $username, $password);
    } else {
        $query = mysqli_prepare($con, "SELECT * FROM administrators WHERE username=?");
        mysqli_stmt_bind_param($query, "s", $username);
    }
    mysqli_stmt_execute($query);
    $result = mysqli_stmt_get_result($query);

    if (mysqli_num_rows($result) > 0) {
        // create session variable containing correct login status for use in other pages
        $_SESSION['login'] = "admin"; //This user can access admin pages
        $_SESSION['username'] = htmlspecialchars($username);
    }
    // If there are no results in the database for the entered username and password,
    // the credentials must be invalid. Redirect to invalid credentials page
    else {
        header("Location: invalidCredentials.php");
    }

} catch (Exception $e) {
    $message = $e->getMessage();
    $code = $e->getCode();
    // If there is an error selecting the admin, display the error on the errors page
    header("Location: ../errors/error.php?code=$code&message=$message");
} // Regardless of whether we have an error, we always close the connection
finally {
    mysqli_close($con);
}
?>
<main>
    <nav id="adminMenu" class="subMenu">
        <h2>Admin Menu</h2>
        <ul>
            <li><a href="../product_manager/index.php">Manage Products</a></li>
            <li><a href="../technician_manager/index.php">Manage Technicians</a></li>
            <li><a href="../customer_manager/index.php">Manage Customers</a></li>
            <li><a href="../incident_manager/index.php">Create Incident</a></li>
            <li><a href="../under_construction.php">Assign Incident</a></li>
            <li><a href="../incident_manager/displayIncidents.php">Display Incidents</a></li>
        </ul>
        <br>
        <h2>Login Status</h2> <!-- This message indicates login status. Users can logout using button -->
        <p style="text-align:left;">  <?php echo "You are logged in as " . $username . "" ?></p>
        <a href="../logout.php">
            <button type="button">Logout</button>
        </a>
    </nav>
</main>
<?php include '../view/footer.php'; ?>