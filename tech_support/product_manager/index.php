<?php require('../model/database.php'); include '../view/header.php'; ?>
<main>
<!-- PRODUCT LIST -->
    <section class="viewTable">
        <h1>Product List</h1>
        <!-- INSERT TABLE -->
        <table>
            <?php

            //Delete
            if (! empty($_POST['productCode'])) {
                $code = $_POST['productCode'];
                $query = "DELETE FROM products WHERE productCode='$code';";
                $result = mysqli_query($con, $query);
            }

            //add
            if (empty($_POST['productCode']))
            {
                $Code = $_POST['code'];
                $Name = $_POST['pro_name'];
                $Version = $_POST['version'];
                $ReleaseDate = $_POST['release_date'];

                $statement = "INSERT INTO products VALUES('$Code', '$Name', '$Version', '$ReleaseDate')";

                $new = mysqli_query($con, $statement) or die('insert failed: '.mysqli_errno($con));
            }



            // run SQL SELECT query to select everything from the person table
            $query = "SELECT * FROM products;";
            ($result = mysqli_query($con, $query)) or die('Query failed: ' . mysqli_errno($con));

            echo "<tr><th id='codeTitle'>Code</th><th>Name</th><th id='versionTitle'>Version</th><th>Release Date</th><th></th></tr>";

            // loop through every record in person table, and add the field values to our table rows
            while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                // create a table row for our record
                echo "<tr><form method='POST' action='index.php'>";

                // every field value in the record goes in its own column in the table

                foreach ($line as $key => $value) {
                    echo "<td><input class='".$key."input' value='" . $value . "' name='" . $key . "' readonly='readonly' style='border: 0; outline: 0'></td>";
                }

                echo "<td><input type='submit' value='Delete' name='delete product'></td></tr>";;
                // now that we have every field value from this record in our table, we close the table row and go onto the next record (if there is a next record)
                echo "</tr></form>";
            }

            // close the connection to the database
            mysqli_close($con);
            ?>
        </table>
        <!-- END TABLE -->
        <br>
        <span class="addButton" onclick="viewAddSection()">Add Product</span>
<!--         <a class="addButton" href="addProduct.php">Add Product</a>-->
    </section>
<!--     END PRODUCT LIST-->
<!--     ADD PRODUCT -->
        <section class="addForm">
            <h1>Add Product</h1>
            <table>
                <form action="index.php" method="post">
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
                        <td><input type="date" name="release_date" id="release_date"></td>
                        <td>Use 'yyyy-mm-dd' format</td>
                    </tr>
                    <tr>
                        <td></td>
                        <!-- <td><button type="submit" name="btnAddProduct" onclick="return validateForm()">Add Product</button></td> -->
                        <td><input type='submit' value='Add Product' name='add product'></td>
                    </tr>
                </form>
            </table>
            <br>
           <span class="viewButton" onclick="hideAddSection()">View Product List</span>
<!--            <a class="viewButton" href="index.php">View Product List</a>-->
        </section>
<!--    END ADD PRODUCT-->

</main>

<?php include '../view/footer.php'; ?>