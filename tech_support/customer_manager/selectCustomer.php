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
    <h1>View / Update Customer</h1>
    <form action="updateCustomer.php" method="post" >
        <input type="hidden" name="id" value="<?php echo $ID?>" class="solid"><br>
        <label for="fname">First Name:</label>
        <input type="text" name="fname" value="<?php echo $fname?>" class="solid"><br>
        <label for="lname">Last Name:</label>
        <input type="text" name="lname" value="<?php echo $lname?>" class="solid"><br>
        <label for="address">Address:</label>
        <input type="text" name="address" value="<?php echo $address?>" class="solid"><br>
        <label for="city">City:</label>
        <input type="text" name="city" value="<?php echo $city?>" class="solid"><br>
        <label for="state">State:</label>
        <input type="text" name="state" value="<?php echo $state?>" class="solid"><br>
        <label for="pcode">Postal Code:</label>
        <input type="text" name="pcode" value="<?php echo $pcode?>" class="solid"><br>
        <label for="ccode">Country Code:</label>
        <input type="text" name="ccode" value="<?php echo $ccode?>" class="solid"><br>
        <label for="phone">Phone:</label>
        <input type="text" name="phone" value="<?php echo $phone?>" class="solid"><br>
        <label for="email">Email:</label>
        <input type="text" name="email" value="<?php echo $email?>" class="solid"><br>
        <label for="password">Password:</label>
        <input type="text" name="password" value="<?php echo $password?>" class="solid"><br>
        <input type="submit" value="Update Customer">
    </form>
<?php include '../view/footer.php'; ?>