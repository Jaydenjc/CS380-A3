<?php require('../model/database.php'); include '../view/header.php'; ?>
<main>
<!-- TECHNICIAN LIST -->
    <section class="viewTable">
        <h1>Technician List</h1>
        <!-- INSERT TABLE -->
        <table>
            <?php

            if (! empty($_POST['techID'])) {
                $code = $_POST['techID'];
                $query = "DELETE FROM technicians WHERE techID='$code';";
                $result = mysqli_query($con, $query);
            }

            // run SQL SELECT query to select everything from the technician table
            $query = "SELECT * FROM technicians;";
            ($result = mysqli_query($con, $query)) or die('Query failed: ' . mysqli_errno($con));

            echo "<tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Phone</th><th>Password</th></tr>";

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
        <span class="addButton" onclick="" lick="viewAddSection()">Add Product</span>
    </section>
<!-- END TECHNICIAN LIST-->
<!-- ADD TECHNICIAN -->
    <section class="addForm">
        <h1>Add Technician</h1>
        <table>
            <form action="" method="post">
                <tr>
                    <td>First Name:</td>
                    <td><input type="text" name="first_name" id="first_name"></td>
                </tr>
                <tr>
                    <td>Last Name:</td>
                    <td><input type="text" name="last_name" id="last_name"></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><input type="text" name="email" id="email"></td>
                </tr>
                <tr>
                    <td>Phone:</td>
                    <td><input type="text" name="phone" id="phone"></td>
                </tr>
                <tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="text" name="password" id="password"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><button type="submit" name="btnAddTechnician" onclick="return validateForm()">Add Technician</button></td>
                    <!-- <tr><td colspan="2"><input type="submit" value="Add Technician"></td></tr> -->
                </tr>
            </form>
        </table>
        <br>
        <span class="viewButton" onclick="hideAddSection()">View Technician List</span>
    </section>
<!-- END ADD TECHNICIAN-->

</main>

<?php include '../view/footer.php'; ?>