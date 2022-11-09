<?php require('../model/database.php'); include '../view/header.php'; ?>

<?php
if (! empty($_POST['customerID'])) {
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
    <table>
        <form action="updateCustomer.php" method="post" >
            <input type="hidden" name="id" value="<?php echo $ID?>" class="solid"><br>
            <tr>
                <td>
                    <label for="fname">First Name:</label>
                </td>
                <td>
                    <input type="text" name="fname" value="<?php echo $fname?>" class="solid"><br>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="lname">Last Name:</label>
                </td>
                <td>
                    <input type="text" name="lname" value="<?php echo $lname?>" class="solid"><br>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="address">Address:</label>
                </td>
                <td class="extraLength">
                    <input type="text" name="address" value="<?php echo $address?>" class="solid"><br>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="city">City:</label>
                </td>
                <td>
                    <input type="text" name="city" value="<?php echo $city?>" class="solid"><br>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="state">State:</label>
                </td>
                <td>
                    <input type="text" name="state" value="<?php echo $state?>" class="solid"><br>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="pcode">Postal Code:</label>
                </td>
                <td>
                    <input type="text" name="pcode" value="<?php echo $pcode?>" class="solid"><br>
                </td>
            </tr>
            <tr>
                 <td class="vt">Country: </td>
                 <td>
                    <select name="countries">
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
                    <input type="text" name="phone" value="<?php echo $phone?>" class="solid"><br>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="email">Email:</label>
                </td>
                <td class="extraLength">
                    <input type="text" name="email" value="<?php echo $email?>" class="solid"><br>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="password">Password:</label>
                </td>
                <td>
                    <input type="text" name="password" value="<?php echo $password?>" class="solid"><br>
                </td>
            </tr>
            <tr>
                <td>
                </td>
                <td>
                    <input type="submit" value="Update Customer">
                </td>
            </tr>
        </form>
    </table>
    <a href="index.php"><span class="addButton">Search Customers</span></a>
</main>
<?php include '../view/footer.php'; ?>