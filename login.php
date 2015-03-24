<?php

include('connect.php');
include('header.php');

?>

<h2>Login</h2>

<form>
<table>
  <tr>
    <td>Username:</td>
    <td><input type="form" name="username"></input></td>
  </tr>
  <tr>
    <td>Password:</td>
    <td><input type="form" name="password"></input></td>
  </tr>
  <tr colspan="2">
    <td><input type="button" name="Submit"></input></td>
  </tr>
</table>
</form>

<?php include('footer.php'); ?>
