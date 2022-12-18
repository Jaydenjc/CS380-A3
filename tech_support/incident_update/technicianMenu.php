<!-- John Giaquinto 12/18/2022 -->
<?php require('../model/database.php');
include '../view/header.php'; ?>
<?php
// check login
session_start();
if (isset($_SESSION['login']) and $_SESSION['login'] == "technician") {
?>
<main>
    <section id="techMenu" class="subMenu">
        <h2>Select Incident</h2>
        <?php
        if (isset($_SESSION['techID'])) {
            try {
                $query = mysqli_prepare($con, "SELECT * FROM incidents WHERE techID=?");
                mysqli_stmt_bind_param($query, "s", $_SESSION['techID']);
                mysqli_stmt_execute($query);
                $result = mysqli_stmt_get_result($query);

                echo "<table><tr><th>incidentID</th><th>CustomerID</th><th>productCode</th><th>techID</th><th>dateOpened</th><th>dateClosed</th><th>title</th><th>description</th></tr>";
                while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    // Create a table row for our record. Each row has its own form
                    echo "<tr><form method='POST' action='index.php'>";

                    // Every field value in the record goes in its own column in the table (and in its own input box)
                    foreach ($line as $key => $value) {
                        echo "<td><input class='" . $key . "input' value='" . $value . "' name='" . $key . "' readonly='readonly' style='border: 0; outline: 0'></td>";
                    }
                    echo "</tr></form>";
                }
                echo "</table>";
            } catch (Exception $e) {
                $message = $e->getMessage();
                $code = $e->getCode();
                // If there is an error selecting the customer or products, display the error on the errors page
                header("Location: ../errors/error.php?code=$code&message=$message");
            } // Regardless of whether we have an error, we always close the connection
            finally {
                mysqli_close($con);
            }
        }
        ?>
        <a href="technicianScript.php">Refresh List of Incident</a>

        <p style="text-align:left;">  <?php echo "You are logged in as " . $_SESSION['email'] . "" ?></p>
        <a href="../logout.php">
            <button type="button">Logout</button>
        </a>
    </section>
</main>
<?php
} else
header("Location: technicianScript.php");
?>
<?php include '../view/footer.php'; ?>