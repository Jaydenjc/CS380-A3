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

            $pstmt = $pdo->prepare($sql);
            $pstmt->execute();

            if ($pstmt == null) throw PDOException("null result set");

            echo "<tr><th>Incident ID</th><th>Product Code</th><th>Tile</th><th>Description</th></tr>";

            $openIncidentCount = 0;

            //using a foreach loop
            foreach ($pstmt as $row) {
                $incidentID = $row['incidentID'];
                $productCode = $row['productCode'];
                $title = $row['title'];
                $description = $row['description'];
                if(!isset($row['dateClosed'])) {
                    $openIncidentCount ++;
                    echo "<tr><td>$incidentID</td><td>$productCode</td><td>$title</td><td>$description</td></tr>";
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
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
} else
    header("Location: ../admin/index.php");
?>
<?php include '../view/footer.php'; ?>