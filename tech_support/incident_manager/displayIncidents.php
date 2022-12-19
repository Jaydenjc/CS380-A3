<!-- John Giaquinto 12/18/2022 -->
<?php require('../model/pdo.php');
include '../view/header.php'; ?>
<?php
// check login
session_start();
if (isset($_SESSION['login']) and $_SESSION['login'] == "admin") {
?>
<main>
    <h1>Open Incidents</h1>
    <!-- INSERT TABLE -->
    <table>
        <?php
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        try {

            $sql = "SELECT * FROM incidents";

            //We will use pdo to select incidents rather than mysqli
            $pstmt = $pdo->prepare($sql);
            $pstmt->execute();

            if ($pstmt == null) throw PDOException("null result set");

            echo "<tr><th>Incident ID</th><th>Product Code</th><th>Tile</th><th>Description</th></tr>";

            $openIncidentCount = 0;

            // for each incident, grab its information and echo it onto the page
            foreach ($pstmt as $row) {
                $incidentID = $row['incidentID'];
                $productCode = $row['productCode'];
                $title = $row['title'];
                $description = $row['description'];
                if(!isset($row['dateClosed'])) { //We only want to display open incidents
                    $openIncidentCount ++;
                    echo "<tr><td>$incidentID</td><td>$productCode</td><td>$title</td><td>$description</td></tr>";
                }
            }
        } catch (PDOException $e) {
            $message = $e->getMessage();
            header("Location: ../errors/error.php?message=$message");
        }
        ?>
    </table>
    <p><?php echo "There are " . $openIncidentCount . " open incidents reported in the database." ?></p>
    <br>
    <p style="text-align:left;">  <?php echo "You are logged in as " . $_SESSION['username'] . "" ?></p>
    <a href="../logout.php">
        <button type="button">Logout</button>
    </a>
</main>
<?php
} else //If an admin is not logged in, redirect to the admin login page
    header("Location: ../admin/index.php");
?>
<?php include '../view/footer.php'; ?>