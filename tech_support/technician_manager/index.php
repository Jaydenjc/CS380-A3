<!-- Ileaqua Adams 11/02/2022, Ben Yuter 11/09/2022, John Giaquinto 12/18/2022 -->
<?php require('../model/database.php');
include '../view/header.php'; ?>
<?php
// check login
session_start();
if (isset($_SESSION['login']) and $_SESSION['login'] == "admin") {
?>
<main>
    <!-- TECHNICIAN LIST -->
    <section class="viewTable">
        <h1>Technician List</h1>
        <!-- INSERT TABLE -->
        <table>
            <?php
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

            try {
                // If the user has selected a technician to delete, we will delete that technician from the technicians table based on the techID
                if (!empty($_POST['techID'])) {
                    $ID = htmlspecialchars($_POST['techID']);
                    $query = "DELETE FROM technicians WHERE techID='$ID';";
                    $result = mysqli_query($con, $query);
                }

                // Run SQL SELECT query to select everything from the technicians table
                $query = "SELECT * FROM technicians;";
                ($result = mysqli_query($con, $query)) or die('Query failed: ' . mysqli_errno($con));

                // First row (with column headers)
                echo "<tr><th id='firstTitle'>First</th><th id='lastTitle'>Last</th><th id='emailTitle'>Email</th><th id='phoneTitle'>Phone</th><th id='passwordTitle'>Password</th></tr>";

                // Loop through every record in technicians table, and add the field values to our table rows
                while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    // Create a table row for our record with a new form
                    echo "<tr><form method='POST' action='index.php'>";

                    // Every field value in the record goes in its own column (and form input) in the table
                    foreach ($line as $key => $value) {
                        // We don't want the user to see the techID, so we hide it using style='display: none'
                        if ($key != "techID") {
                            echo "<td><input class='" . $key . "input' value='" . $value . "' name='" . $key . "' readonly='readonly' style='border: 0; outline: 0'></td>";
                        } else {
                            echo "<td style='display: none'><input class='" . $key . "input' value='" . $value . "' name='" . $key . "' readonly='readonly' style='border: 0; outline: 0'></td>";
                        }
                    }

                    echo "<td><input type='submit' value='Delete' name='delete technician'></td></tr>";
                    // Now that we have every field value from this record in our table, we close the table row and go onto the next record (if there is a next record)
                    echo "</tr></form>";
                }
            } catch (Exception $e) {
                $message = $e->getMessage();
                $code = $e->getCode();
                header("Location: ../errors/error.php?code=$code&message=$message"); // If there is an error selecting the technicians or deleting a technician, this error is printed on the error page
            } finally {
                mysqli_close($con); // Regardless of whether we have an error, we close the connection
            }
            ?>
        </table>
        <!-- END TABLE -->
        <br>
        <span class="addButton" onclick="viewAddSection()">Add Technician</span>
        <!-- Hide the technician list and display the form to add technicians-->
    </section>
    <!-- END TECHNICIANS LIST-->

    <!-- ADD TECHNICIAN -->
    <section class="addForm">
        <h1>Add Technician</h1>
        <form action="addTechnician.php" method="post">
            <!-- We will get the technician information via user input-->
            <table>
                <tr>
                    <td><label for="id">ID:</label></td>
                    <td><input type="text" name="id" id="id" required></td>
                </tr>
                <tr>
                    <td><label for="fname">First Name:</label></td>
                    <td><input type="text" name="fname" id="fname" required></td>
                </tr>
                <tr>
                    <td><label for="lname">Last Name:</label></td>
                    <td><input type="text" name="lname" id="lname" required></td>
                </tr>
                <tr>
                    <td><label for="phone">Phone:</label></td>
                    <td><input type="text" name="phone" id="phone" required></td>
                </tr>
                <tr>
                    <td><label for="email">Email:</label></td>
                    <td><input type="text" name="email" id="email" required></td>
                </tr>
                <tr>
                    <td><label for="password">Password:</label></td>
                    <td><input type="text" name="password" id="password" required></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type='submit' value='Add Technician' name='add technician'></td>
                </tr>
            </table>
        </form>
        <br>
        <!-- Hide the form to add technicians and display the technicians list -->
        <span class="viewButton" onclick="hideAddSection()">View Technician List</span>
    </section>
    <!-- END ADD TECHNICIAN -->
    <p style="text-align:left;">  <?php echo "You are logged in as " . $_SESSION['username'] . "" ?></p>
    <a href="../logout.php">
        <button type="button">Logout</button>
    </a>
</main>
<?php
} else // If an admin is not logged in, redirect to the admin login page
    header("Location: ../admin/index.php");
?>
<?php include '../view/footer.php'; ?>