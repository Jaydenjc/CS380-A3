<!-- Jayden Cooper 11/09/2022, John Giaquinto 11/09/2022 -->
<?php include '../view/header.php'; ?>
<?php
    $message = "";
    $code = "";
    if (!empty($_GET['message'])) $message=$_GET['message'];
    if (!empty($_GET['code'])) $code=$_GET['code'];
?>
<main>
    <nav>
        <h1>Error</h1>
        <p><?php echo $code; ?></p>
        <p><?php echo $message; ?></p>
    </nav>
</main>
<?php include '../view/footer.php'; ?>