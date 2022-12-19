<!-- Jayden Cooper 11/02/2022, Ben Yuter 11/09/2022, John Giaquinto 12/18/2022 -->
<?php require('../model/database.php');
include '../view/header.php'; ?>
<?php
// check login
session_start();
if (isset($_SESSION['login']) and $_SESSION['login'] == "admin") {
?>
<main>
    <!-- PRODUCT LIST -->
    <section class="viewTable">
        <h1>Product List</h1>
        <!-- INSERT TABLE -->
        <table>
            <?php
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

            try {
                // Delete a product if we have the product code
                if (!empty($_POST['productCode'])) {
                    $code = htmlspecialchars($_POST['productCode']);
                    $query = "DELETE FROM products WHERE productCode='$code';";
                    $result = mysqli_query($con, $query);
                }

                // Run a SQL SELECT query to select everything from the products table
                $query = "SELECT * FROM products;";
                ($result = mysqli_query($con, $query)) or die('Query failed: ' . mysqli_errno($con));

                // First row (with table headers)
                echo "<tr><th id='codeTitle'>Code</th><th>Name</th><th id='versionTitle'>Version</th><th>Release Date</th><th></th></tr>";

                // Loop through every record in products table, and add the field values to our table rows
                while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    // Create a table row for our record. Each row has its own form
                    echo "<tr><form method='POST' action='index.php'>";

                    // Every field value in the record goes in its own column in the table (and in its own input box)
                    foreach ($line as $key => $value) {
                        echo "<td><input class='" . $key . "input' value='" . $value . "' name='" . $key . "' readonly='readonly' style='border: 0; outline: 0'></td>";
                    }

                    echo "<td><input type='submit' value='Delete' name='delete product'></td></tr>";
                    // Now that we have every field value from this record in our table, we close the table row and go onto the next record (if there is a next record)
                    echo "</tr></form>";
                }
            } catch (Exception $e) {
                $message = $e->getMessage();
                $code = $e->getCode();
                header("Location: ../errors/error.php?code=$code&message=$message"); // If there is an error doing this, print out the error for the user on the error page
            } finally {
                mysqli_close($con); // Regardless of whether we have an error, we close the connection
            }
            ?>
        </table>
        <!-- END TABLE -->
        <br>
        <span class="addButton" onclick="viewAddSection()">Add Product</span>
    </section>
    <!--     END PRODUCT LIST-->

    <!--     ADD PRODUCT (this section will only display when the "Add Product" button is clicked) -->
    <section class="addForm">
        <h1>Add Product</h1>
        <form action="addProduct.php" method="post">
            <table>
                <!-- The user enters all of these values manually -->
                <tr>
                    <td><label for="code">Code:</label></td>
                    <td><input type="text" name="code" id="code" required></td>
                </tr>
                <tr>
                    <td><label for="pro_name">Name:</></td>
                    <td><input type="text" name="pro_name" id="pro_name" required></td>
                </tr>
                <tr>
                    <td><label for="version">Version:</label></td>
                    <td><input type="text" name="version" id="version" required></td>
                </tr>
                <tr>
                    <td><label for="release_date">Release Date:</label></td>
                    <td><input type="date" name="release_date" id="release_date" required></td>
                    <td>Use 'yyyy-mm-dd' format</td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type='submit' value='Add Product' name='add product' required></td>
                </tr>
            </table>
        </form>
        <br>
        <!-- When the "View Product List" button is clicked, this section of the page is hidden and the product list is redisplayed -->
        <span class="viewButton" onclick="hideAddSection()">View Product List</span>
    </section>
    <!-- END ADD PRODUCT-->
    <p style="text-align:left;">  <?php echo "You are logged in as " . $_SESSION['username'] . "" ?></p>
    <a href="../logout.php">
        <button type="button">Logout</button>
    </a>
</main>
<?php
} else // If an admin is not logged in, redirect to the admin login page
    header("Location: ../admin/index.php");
?>
<?php include '../view/footer.php'; ?>