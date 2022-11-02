<?php require('../model/database.php'); include '../view/header.php'; ?>
<main>
    <!-- ADD PRODUCT -->
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
                    <tr><td colspan="2"><input type="submit" value="Add Product"></td></tr>
                </tr>
            </form>
        </table>
        <br>
         <a class="viewButton" href="index.php">View Product List</a>
<!--        <button type="button" class="viewButton" onclick="hideAddSection()">View Product List</button>-->
    </section>
    <!-- END ADD PRODUCT-->

</main>

<?php include '../view/footer.php'; ?>