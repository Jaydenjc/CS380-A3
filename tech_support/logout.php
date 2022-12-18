<!-- Jayden Cooper 11/30/2022 -->
<?php
session_start();       //resume current session
session_unset();      //remove session variables
session_destroy();    //destroy session
header("Location: index.php");
?>
