<!-- Ben Yuter 11/09/2022, John Giaquinto 12/18/2022 -->
<?php require('../model/database.php');
include '../view/header.php'; ?>
<?php
// check login
session_start();
if (isset($_SESSION['login']) and $_SESSION['login'] == "admin") {
    $result = NULL; // The results table will only display is result is not null

// We only run this section of code if the user has submitted a last name into the search box
    if (!empty($_POST['lname'])) {
        $lname = $_POST['lname'];

        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        try {
            $query = mysqli_prepare($con, "SELECT * FROM customers WHERE lastName=?");
            mysqli_stmt_bind_param($query, "s", $lname);
            mysqli_stmt_execute($query);
            $result = mysqli_stmt_get_result($query);
        } catch (Exception $e) {
            $message = $e->getMessage();
            $code = $e->getCode();
            header("Location: ../errors/error.php?code=$code&message=$message"); // If there is an error selecting the customers, we display this error for the user on the error page
        } finally {
            mysqli_close($con); // Whether or not there is an error, we close the connection when we are done accessing the database
        }
    }

    echo '
    <!DOCTYPE html>
    <html lang="en">
    <head>
    <title>Customer Search</title>
    </head>
    <body>
        <main>
            <h1>Customer Search</h1>
    
            <!-- The user enters the customer last name here -->
            <form action="index.php" method="post" >
                <label for="lname">Last Name:</label>
                <input type="text" name="lname" class="solid" required>
                <input type="submit" value="Submit">
            </form>
            <br/>
            <h1>Add a new customer</h1>
            <a href="addCustomer.php">
                <button type="button">Add Customer</button>
            </a>
        </main>
    </body>
    </html>
    ';

    if (!is_null($result)) { // If the user has searched for a customer last name
        if (mysqli_num_rows($result) > 0) { // If the last name exists in the database
            echo "<main><h1>Results</h1><table>";
            echo "<tr><th>First</th><th>Last</th><th>Email</th><th>City</th></tr>"; // Column names

            while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                // create a table row for our record
                echo "<tr><form method='POST' action='selectCustomer.php'>";

                // Every field value in the record goes in its own column in the table
                foreach ($line as $key => $value) {
                    if ($key == "customerID") {
                        // We don't want to display the customer ID for the customer, so we hide it
                        echo "<td style='display: none'><input class='" . $key . "input' value='" . $value . "' name='" . $key . "' readonly='readonly' style='border: 0; outline: 0'></td>";
                    }
                    if ($key == "firstName") {
                        echo "<td><input class='" . $key . "input' value='" . $value . "' name='" . $key . "' readonly='readonly' style='border: 0; outline: 0'></td>";
                    }
                    if ($key == "lastName") {
                        echo "<td><input class='" . $key . "input' value='" . $value . "' name='" . $key . "' readonly='readonly' style='border: 0; outline: 0'></td>";
                    }
                    if ($key == "email") { // Email comes after city in the database, but we want to display it before city. For now we'll create email and city variables
                        $email = $value;
                    }
                    if ($key == "city") {
                        $city = $value;
                    }
                }
                // Now we have the email and city variables, we can display them in order
                echo "<td><input class='emailinput' value='" . $email . "' name='email' readonly='readonly' style='border: 0; outline: 0'></td>";
                echo "<td><input class='cityinput' value='" . $city . "' name='email' readonly='readonly' style='border: 0; outline: 0'></td>";
                echo "<td><input type='submit' value='Select' name='select customer'></td>";
                echo "</form></tr>";
            }
            echo "</table></main>";
        } else {
            echo "<main><h2>No results found</h2></main>"; // Display "No results found" if the user searched for a customer last name that does not exist in the database
        }
    }
    echo '<main><br><p style="text-align:left;">';
    echo "You are logged in as " . $_SESSION['username'] . "";
    echo '</p><a href="../logout.php"><button type="button">Logout</button></a></main>';
} else // If an admin is not logged in, redirect to the admin login page
    header("Location: ../admin/index.php");
?>
<?php include '../view/footer.php'; ?>