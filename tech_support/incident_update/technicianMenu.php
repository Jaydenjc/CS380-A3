<!-- John Giaquinto 12/18/2022 -->
<?php require('../model/pdo.php');
include '../view/header.php'; ?>
<?php
// check login
session_start();
if (isset($_SESSION['login']) and $_SESSION['login'] == "technician") {
?>
<main>
    <section id="techMenu" class="subMenu">
        <h2>Select Incident</h2>
        <table>
        <?php
        if (isset($_SESSION['techID'])) {
            try {

                $sql = "SELECT * FROM incidents WHERE techID=?";

                // For selecting the technician incidents we will use PDO instead of mysqli
                $pstmt = $pdo->prepare($sql);
                $pstmt->execute([$_SESSION['techID']]);

                if ($pstmt == null) throw PDOException("null result set");

                echo "<tr><th>ID</th><th>Customer</th><th>Product Code</th><th>techID</th><th>Date Opened</th><th>Tile</th><th>Description</th></tr>";

                $openIncidentCount = 0;

                // for each incident, grab its information and echo it onto the page
                foreach ($pstmt as $row) {
                    $incidentID = $row['incidentID'];
                    $customerID = $row['customerID'];
                    $productCode = $row['productCode'];
                    $techID = $row['techID'];
                    $dateOpened = date('d/M/Y', strtotime($row['dateOpened']));
                    $title = $row['title'];
                    $description = $row['description'];
                    if(!isset($row['dateClosed'])) { //We only want to display open incidents
                        $openIncidentCount ++;
                        echo "<tr><td>$incidentID</td><td>$customerID</td><td>$productCode</td><td>$techID</td><td>$dateOpened</td><td>$title</td><td>$description</td></tr>";
                    }
                }
            } catch (PDOException $e) {
                $message = $e->getMessage();
                header("Location: ../errors/error.php?message=$message");
            }
        }
        ?>
        </table>
        <a href="technicianScript.php">Refresh List of Incident</a>
        <br><br>
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