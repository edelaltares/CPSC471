<?php
include('connect.php');
include('header.php');

if(isset($_SESSION['patron'])) { header("Location: patron-panel.php"); }
?>

<h2>Patron Login</h2>
<form action="patron-panel.php" method="POST">
    <table>
        <tr>
            <td>Username:</td>
            <td><input type="form" name="username" /></td>
        </tr>
        <tr>
            <td>Password:</td>
            <td><input type="form" name="password" /></td>
        </tr>
        <tr>
            <td><input type="submit" value="Login" /></td>
            <td><input type="button" value="Register" onclick="gotoregister()" /></td>
        </tr>
    </table>
</form>

<?php include('footer.php'); ?>
