<?php

include('connect.php');
include('header.php');

?>

<h2>Register Patron</h2>

<form action="action_page.php">
    Card Number:<br />
    <input type="text" name="CardNo"><br />
    <br />
    First Name:<br />
    <input type="text" name="FirstName" ><br />
    <br />
    Last Name:<br />
    <input type="text" name="LastName"><br />
    <br />
    Email:<br />
    <input type="text" name="Email"><br />
    <br />
    Address:<br />
    <input type="text" name="Address"><br />
    <br />
    City:<br />
    <input type="text" name="City"><br />
    <br />
    Postal Code:<br />
    <input type="text" name="PostalCode"><br />
    <br /> 
    Card Expiry:<br />
    <input type="text" name="CardExpiry"><br />
    <br />
    Account Type:<br />
    <input type="text" name="AccountType"><br />
    <br />
    Password:<br />
    <input type="text" name="Password">
    <br />
    <br />
    <input type="submit" value="Submit">
</form> 

<?php include('footer.php'); ?>