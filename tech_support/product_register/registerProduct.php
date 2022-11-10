<?php require('../model/database.php');
include '../view/header.php'; ?>

<?php
if (!empty($_POST['email'])) {
    $email = $_POST['email'];

    try {
        $query = mysqli_prepare($con, "SELECT customerID, firstName, lastName FROM customers WHERE email=?");
        mysqli_stmt_bind_param($query, "s", $email);
        mysqli_stmt_execute($query);
        $result = mysqli_stmt_get_result($query);

        if (mysqli_num_rows($result) > 0) {
            while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                // create a table row for our record
                foreach ($line as $key => $value) {
                    if ($key == "customerID") {
                        $customerID = $value;
                    }
                    if ($key == "firstName") {
                        $firstName = $value;
                    } elseif ($key == "lastName") {
                        $lastName = $value;
                    }
                }
            }
        } else {
            header("Location: invalidEmail.php");
        }

        $query = "SELECT productCode, name FROM products;";
        $result = mysqli_query($con, $query);

        $productCodeArray = [];
        $productNameArray = [];
        while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            // create a table row for our record
            foreach ($line as $key => $value) {
                if ($key == "productCode") {
                    $productCodeArray[] = $value;
                } elseif ($key == "name") {
                    $productNameArray[] = $value;
                }
            }
        }
    } catch (Exception $e) {
        $message = $e->getMessage();
        $code = $e->getCode();
        header("Location: error.php?code=$code&message=$message"); // If there is an error doing this, print out the error for the user
    } finally {
        mysqli_close($con); // Regardless of whether we have an error, we always close the connection
    }
} else {
    header("Location: index.php"); // If the user somehow gets to this page without having entered an email they are sent back to the index
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register Product</title>
</head>
<body>
<main class="viewRegister">
    <h1>Register Product</h1>
    <table>
        <tr>
            <td>
                <p>Customer:</p>
            </td>
            <td>
                <p> <?php echo $firstName . " " . $lastName ?></p>
            </td>
        </tr>
    </table>
    <form method='POST' action='registerScript.php'>
        <input type="hidden" name="id" value="<?php echo $customerID ?>" class="solid">
        <table>
            <tr>
                <td>
                    <label for="product">Product: </label>
                </td>
                <td>
                    <select name="product" id="product">
                        <?php for ($i = 0; $i < sizeof($productNameArray); $i++) : ?>
                            <option value="<?php echo $productCodeArray[$i]; ?>">
                                <?php echo $productNameArray[$i]; ?>
                            </option>
                        <?php endfor; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                </td>
                <td>
                    <input type='submit' value='Register Product' name='register product'>
                </td>
            </tr>
        </table>
    </form>
</main>
</body>
</html>
<?php include '../view/footer.php'; ?>