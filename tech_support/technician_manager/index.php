<?php require('../model/database.php'); include '../view/header.php'; ?>
    <main>
        <!-- PRODUCT LIST -->
        <section class="viewTable">
            <h1>Technician List</h1>
            <!-- INSERT TABLE -->
            <table>
                <?php

                //Delete
                if (! empty($_POST['techID'])) {
                    $ID = $_POST['techID'];
                    $query = "DELETE FROM technicians WHERE techID='$ID';";
                    $result = mysqli_query($con, $query);
                }

                // run SQL SELECT query to select everything from the person table
                $query = "SELECT * FROM technicians;";
                ($result = mysqli_query($con, $query)) or die('Query failed: ' . mysqli_errno($con));

                echo "<tr><th id='firstTitle'>First</th><th id='lastTitle'>Last</th><th id='emailTitle'>Email</th><th id='phoneTitle'>Phone</th><th id='passwordTitle'>Password</th></tr>";

                // loop through every record in person table, and add the field values to our table rows
                while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    // create a table row for our record
                    echo "<tr><form method='POST' action='index.php'>";

                    // every field value in the record goes in its own column in the table

                    foreach ($line as $key => $value) {
                        if ($key != "techID") {
                            echo "<td><input class='" . $key . "input' value='" . $value . "' name='" . $key . "' readonly='readonly' style='border: 0; outline: 0'></td>";
                        }
                        else{
                            echo "<td style='display: none'><input class='" . $key . "input' value='" . $value . "' name='" . $key . "' readonly='readonly' style='border: 0; outline: 0'></td>";
                        }
                    }

                    echo "<td><input type='submit' value='Delete' name='delete technician'></td></tr>";;
                    // now that we have every field value from this record in our table, we close the table row and go onto the next record (if there is a next record)
                    echo "</tr></form>";
                }

                // close the connection to the database
                mysqli_close($con);
                ?>
            </table>
            <!-- END TABLE -->
            <br>
            <span class="addButton" onclick="viewAddSection()">Add Technician</span>
            <!--         <a class="addButton" href="addProduct.php">Add Product</a>-->
        </section>
        <!--     END PRODUCT LIST-->
        <!--     ADD PRODUCT -->
        <section class="addForm">
            <h1>Add Technician</h1>
            <table>
                <form action="addTechnician.php" method="post">
                    <tr>
                        <td>ID:</td>
                        <td><input type="text" name="id" id="id"></td>
                    </tr>
                    <tr>
                        <td>First Name:</td>
                        <td><input type="text" name="fname" id="fname"></td>
                    </tr>
                    <tr>
                        <td>Last Name:</td>
                        <td><input type="text" name="lname" id="lname"></td>
                    </tr>
                    <tr>
                        <td>Phone:</td>
                        <td><input type="text" name="phone" id="phone"></td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td><input type="text" name="email" id="email"></td>
                    </tr>
                    <tr>
                        <td>Password:</td>
                        <td><input type="text" name="password" id="password"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <!-- <td><button type="submit" name="btnAddProduct" onclick="return validateForm()">Add Product</button></td> -->
                        <td><input type='submit' value='Add Technician' name='add technician'></td>
                    </tr>
                </form>
            </table>
            <br>
            <span class="viewButton" onclick="hideAddSection()">View Technician List</span>
        </section>
        <!--    END ADD PRODUCT-->

    </main>

<?php include '../view/footer.php'; ?>