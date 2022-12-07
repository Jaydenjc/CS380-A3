<!-- Jayden Cooper 11/02/2022, Ileaqua Adams 11/02/2022, Ben Yuter 12/03/2022, John Giaquinto 11/07/2022 -->
<?php include '../view/header.php'; ?>
<main>
        <!--  Create Login Section  -->
        <section class="login">
            <h1>Admin Login</h1>
            <form>
                <table>
                    <tr>
                        <td>
                            <label for="usernameAdmin">Username:</label>
                        </td>
                        <td>
                            <input type="text" minlength="1" maxlength="20" name="usernameAdmin" id="usernameAdmin" value="admin" class="solid" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="passwordAdmin">Password:</label>
                        </td>
                        <td>
                            <input type="text" minlength="1" maxlength="20" name="passwordAdmin" id="passwordAdmin" value="sesame" class="solid" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td><input type="submit" value="Login"></td>
                    </tr>
                </table>
            </form>
        </section>
        <nav id="adminMenu" class="subMenu">
            <h2>Admin Menu</h2>
            <ul>
                <li><a href="../product_manager/index.php">Manage Products</a></li>
                <li><a href="../technician_manager/index.php">Manage Technicians</a></li>
                <li><a href="../customer_manager/index.php">Manage Customers</a></li>
                <li><a href="../errors/index.php">Create Incident</a></li>
                <li><a href="../under_construction.php">Assign Incident</a></li>
                <li><a href="../under_construction.php">Display Incidents</a></li>
            </ul>

            <h2>Login Status</h2> <!-- This message indicates login status. Users can logout using button -->
            <br>
            You are logged in as admin.
            <button>Logout</button>
        </nav>
</main>
<?php include '../view/footer.php'; ?>