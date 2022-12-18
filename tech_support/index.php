<!-- Jayden Cooper 11/02/2022, Ileaqua Adams 11/02/2022, Ben Yuter 12/03/2022, John Giaquinto 11/07/2022, Ileaqua Adams 12/07/2022 -->
<?php include 'header.php'; ?>
<?php
// check login
session_start();
if (isset($_SESSION['login']) and $_SESSION['login'] == "admin") {
    header("Location: admin/adminMenu.php");
}
if (isset($_SESSION['login']) and $_SESSION['login'] == "customer") {
    header("Location: product_register/registerProduct.php");
}

if (isset($_SESSION['login']) and $_SESSION['login'] == "technician") {
    header("Location: incident_update/technicianScript.php");
}
?>
<main>
    <nav>
        <h2>Main Menu</h2> <!-- Created a new index requiring all users to login including customers, technicians and administrators -->
        <ul>
            <li><a href="admin/index.php" id="adminLogin">Administrator</a></li>
            <li><a href="incident_update/index.php" id="techLogin">Technicians</a></li>
            <li><a href="product_register/index.php" id="customerLogin">Customers</a></li>
        </ul> <!-- When these links are clicked a login form is displayed for the appropriate type of user -->
    </nav>
</main>
<?php include 'view/footer.php'; ?>