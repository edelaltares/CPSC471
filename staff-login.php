<?php
include('connect.php');
include('header.php');

if(isset($_SESSION['staff'])) { header("Location: staff-panel.php"); }
else {
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

<?php
}
include('footer.php'); ?>
