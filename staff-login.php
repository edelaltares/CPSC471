<?php
include('connect.php');
include('header.php');

echo showTotalFees(1, $connection);
echo showSeparateFees(1, $connection);
?>

<h2>Staff Login</h2>



<form action="staff-panel.php" method="POST">
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
            <td colspan="2"><input type="submit" value="Login" /></td>
        </tr>
    </table>
</form>

<?php include('footer.php'); ?>
