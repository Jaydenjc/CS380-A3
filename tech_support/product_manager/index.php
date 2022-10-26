<?php require('../model/database.php'); include '../view/header.php'; ?>
<main>
<!-- PRODUCT LIST -->
    <section class="viewTable">
        <h1>Product List</h1>
        <!-- INSERT TABLE -->
        <table>
            <?php
            // run SQL SELECT query to select everything from the person table
            $query = "SELECT * FROM products;";
            ($result = mysqli_query($con, $query)) or die('Query failed: ' . mysqli_errno($con));

            echo "<tr><th>Code</th><th>Name</th><th>Version</th><th>Release Date</th></tr>";

            // loop through every record in person table, and add the field values to our table rows
            while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                // create a table row for our record
                echo "<tr>";

                // every field value in the record goes in its own column in the table
                foreach ($line as $field_value) {
                    echo "<td>", "$field_value", "</td>";
                }

                echo "<td><button type=\"button\" onclick=".mysqli_query($con, "DELETE FROM products WHERE productCode=$field_value;").">Delete</button></td>";
                // now that we have every field value from this record in our table, we close the table row and go onto the next record (if there is a next record)
                echo "</tr>";
            }

            // close the connection to the database
            mysqli_close($con);
            ?>
        </table>
        <!-- END TABLE -->
        <span>Add Product</span>
    </section>
<!-- END PRODUCT LIST-->
<!-- ADD PRODUCT -->
    <section class="addForm">
        <h1>Add Product</h1>
        <table>
            <form action="" method="post">
                <tr>
                    <td>Code:</td>
                    <td><input type="text" name="code" id="code"></td>
                </tr>
                <tr>
                    <td>Name:</td>
                    <td><input type="text" name="pro_name" id="pro_name"></td>
                </tr>
                <tr>
                    <td>Version:</td>
                    <td><input type="text" name="version" id="version"></td>
                </tr>
                <tr>
                    <td>Release Date:</td>
                    <td><input type="text" name="release_date" id="release_date"></td>
                    <td>Use 'yyyy-mm-dd' format</td>
                </tr>
                <tr>
                    <td></td>
                    <td><button type="submit" name="btnAddProduct" onclick="return validateForm()">Add Product</button></td>
                </tr>
            </form>
        </table>
        <span>View Product List</span>
    </section>
<!-- END ADD PRODUCT-->
</main>

<?php include '../view/footer.php'; ?>