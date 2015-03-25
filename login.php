<?php
include('connect.php');
include('header.php');
?>

<h2>Login</h2>

<form action="member.php" method="POST">
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
