<?php

include('connect.php');
include('header.php');

?>

<h2>Login</h2>

<?php
if(!isset($_GET[POST])) {
?>
<form ation="login.php" method="POST">
<table>
  <tr>
    <td>Username:</td>
    <td><input type="form" name="username" /></td>
  </tr>
  <tr>
    <td>Password:</td>
    <td><input type="form" name="password" /></td>
  </tr>
  <tr colspan="2">
    <td><input type="submit" value="Login" /></td>
  </tr>
</table>
</form>
<?php
}

include('footer.php'); ?>
