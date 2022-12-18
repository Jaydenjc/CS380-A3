<!-- John Giaquinto 12/18/2022 -->
<?php require('../model/pdo.php');
include '../view/header.php'; ?>
<?php
// check login
session_start();
if (isset($_SESSION['login']) and $_SESSION['login'] == "admin") {
?>
<main>
    <h1>Incident List</h1>
    <!-- INSERT TABLE -->
    <table>
        <?php
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        try {

            $sql = "SELECT * FROM incidents";

            $pstmt = $pdo->prepare($sql);
            $pstmt->execute();

            if ($pstmt == null) throw PDOException("null result set");

            echo "<tr><th>incidentID</th><th>customerID</th><th>productCode</th><th>techID</th><th>dateOpened</th><th>dateClosed</th><th>title</th><th>description</th></tr>";

            //using a foreach loop
            foreach ($pstmt as $row) {
                $incidentID = $row['incidentID'];
                $customerID = $row['customerID'];
                $productCode = $row['productCode'];
                $techID = $row['techID'];
                $dateOpened = $row['dateOpened'];
                $dateClosed = $row['dateClosed'];
                $title = $row['title'];
                $description = $row['description'];
                echo "<tr><td>$incidentID</td><td>$productCode</td><td>$customerID</td><td>$techID</td><td>$dateOpened</td><td>$dateClosed</td><td>$title</td><td>$description</td></tr>";
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        ?>
    </table>
    <p style="text-align:left;">  <?php echo "You are logged in as " . $_SESSION['username'] . "" ?></p>
    <a href="../logout.php">
        <button type="button">Logout</button>
    </a>
</main>
<?php
} else
    header("Location: ../admin/adminMenu.php");
?>
<?php include '../view/footer.php'; ?>