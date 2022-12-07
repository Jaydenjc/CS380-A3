<!-- Jayden Cooper 11/02/2022, Ileaqua Adams 11/02/2022, Ben Yuter 12/03/2022, John Giaquinto 11/07/2022 -->
<?php include '../view/header.php'; ?>
<main>
    <!--  Create Login Section  -->
    <section class="login">
        <h1>Technician Login</h1>
        You must login before you can update an incident.<br>
        <form>
            <table>
                <tr>
                    <td>
                        <label for="emailTech">Email:</label>
                    </td>
                    <td>
                        <input type="text" minlength="1" maxlength="20" name="emailTech" id="emailTech" value="" class="solid" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="passwordTech">Password:</label>
                    </td>
                    <td>
                        <input type="text" minlength="1" maxlength="20" name="passwordTech" id="passwordTech" value="" class="solid" required>
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
    <section id="techMenu" class="subMenu">
        <h2>Select Incident</h2>
        <p>There are no open incidents for this technician.<!-- IDK IF THIS IS PHP OR JUST TEXT--></p>
        <a href="../under_construction.php">Refresh List of Incident</a>

        <p>You are logged in as <span><!-- ADD EMAIL --></span></p>
        <button>Logout</button>
    </section>
</main>
<?php include '../view/footer.php'; ?>