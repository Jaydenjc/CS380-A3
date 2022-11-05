<?php require('../model/database.php'); include '../view/header.php'; ?>
<?php

$result = NULL;

if (! empty($_POST['lname'])) {
    $lname = $_POST['lname'];
    $query = "SELECT * FROM customers WHERE lastName='$lname';";
    $result = mysqli_query($con, $query);
}

echo'
    <!DOCTYPE html>
    <html>
    <head>
    </head>
    <body>
    <h1>Customer Search</h1>
    
    <form action="index.php" method="post" >
        <label for="lname">Last Name:</label>
        <input type="text" name="lname" class="solid">
        <input type="submit" value="Submit">
    </form>
    <br/>
    <h1>Results:</h1>
    </body>
    </html>
';

if (! is_null($result)){
    echo "<table>";
    echo "<tr><th>First</th><th>Last</th><th>Email</th><th>City</th></tr>";

    while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        // create a table row for our record
        echo "<tr><form method='POST' action='selectCustomer.php'>";

        // every field value in the record goes in its own column in the table

        foreach ($line as $key => $value) {
            if ($key == "customerID"){
                echo "<td style='display: none'><input class='" . $key . "input' value='" . $value . "' name='" . $key . "' readonly='readonly' style='border: 0; outline: 0'></td>";
            }
            if ($key == "firstName") {
                echo "<td><input class='" . $key . "input' value='" . $value . "' name='" . $key . "' readonly='readonly' style='border: 0; outline: 0'></td>";
            }
            if ($key == "lastName") {
                echo "<td><input class='" . $key . "input' value='" . $value . "' name='" . $key . "' readonly='readonly' style='border: 0; outline: 0'></td>";
            }
            if ($key == "email") {
                $email = $value;
            }
            if ($key == "city") {
                echo "<td><input class='" . $key . "input' value='" . $value . "' name='" . $key . "' readonly='readonly' style='border: 0; outline: 0'></td>";
            }
        }
        echo "<td><input class='" . "email" . "input' value='" . $email . "' name='" . "email" . "' readonly='readonly' style='border: 0; outline: 0'></td>";
        echo "<td><input type='submit' value='Select' name='select customer'></td></tr>";
    }
    echo "</table>";
}
?>
<?php include '../view/footer.php'; ?>