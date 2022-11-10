<?php require('../model/database.php'); include '../view/header.php'; ?>

<?php

if (! empty($_POST['customerID'])) {
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    $ID = $_POST['customerID'];
    $query = "SELECT * FROM customers WHERE customerID='$ID';";
    $result = mysqli_query($con, $query);
    while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        // create a table row for our record
        foreach ($line as $key => $value) {
            if($key == "customerID"){
                $ID = $value;
            }
            elseif($key == "firstName"){
                $fname = $value;
            }
            elseif($key == "lastName"){
                $lname = $value;
            }
            elseif($key == "address"){
                $address = $value;
            }
            elseif($key == "city"){
                $city = $value;
            }
            elseif($key == "state"){
                $state = $value;
            }
            elseif($key == "postalCode"){
                $pcode = $value;
            }
            elseif($key == "countryCode"){
                $ccode = $value;
            }
            elseif($key == "phone"){
                $phone = $value;
            }
            elseif($key == "email"){
                $email = $value;
            }
            elseif($key == "password"){
                $password = $value;
            }
        }
    }
}

?>
<main class="selectCustomer">
    <h1>View / Update Customer</h1>
        <form action="updateCustomer.php" method="post" >
            <input type="hidden" name="id" value="<?php echo $ID?>" class="solid" >
        <table>
            <tr>
                <td>
                    <label for="fname">First Name:</label>
                </td>
                <td>
                    <input type="text" name="fname" id="fname" value="<?php echo $fname?>" class="solid" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="lname">Last Name:</label>
                </td>
                <td>
                    <input type="text" name="lname" id="lname" value="<?php echo $lname?>" class="solid" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="address">Address:</label>
                </td>
                <td class="extraLength">
                    <input type="text" name="address" id="address" value="<?php echo $address?>" class="solid" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="city">City:</label>
                </td>
                <td>
                    <input type="text" name="city" id="city" value="<?php echo $city?>" class="solid" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="state">State:</label>
                </td>
                <td>
                    <input type="text" name="state" id="state" value="<?php echo $state?>" class="solid" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="pcode">Postal Code:</label>
                </td>
                <td>
                    <input type="text" name="pcode" id="pcode" value="<?php echo $pcode?>" class="solid" required>
                </td>
            </tr>
            <tr>
                 <td class="vt"><label for="countries">Country:</label></td>
                 <td>
                    <select name="countries" id="countries">
                        <?php
                        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

                        $query = "SELECT countryName FROM countries WHERE countryCode='$ccode';";
                        $result = mysqli_query($con, $query);
                        while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                            // create a table row for our record
                            foreach ($line as $key => $value) {
                                if ($key == "countryName") {
                                    $cname = $value;
                                }
                            }
                        }
                        ?>
                        <option value="<?php echo $ccode?>" selected><?php echo $cname?></option>
                        <?php
                        //access database for <option> values
                        include("countryDropdown.php");
                        ?>
                    </select>
                 </td>
            </tr>
            <tr>
                <td>
                    <label for="phone">Phone:</label>
                </td>
                <td>
                    <input type="text" name="phone" id="phone" value="<?php echo $phone?>" class="solid">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="email">Email:</label>
                </td>
                <td class="extraLength">
                    <input type="text" name="email" id="email" value="<?php echo $email?>" class="solid">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="password">Password:</label>
                </td>
                <td>
                    <input type="text" name="password" id="password" value="<?php echo $password?>" class="solid">
                </td>
            </tr>
            <tr>
                <td>
                </td>
                <td>
                    <input type="submit" value="Update Customer">
                </td>
            </tr>
        </table>
        </form>
    <a href="index.php"><span class="addButton">Search Customers</span></a>
</main>
<?php include '../view/footer.php'; ?>