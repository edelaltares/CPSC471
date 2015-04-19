<?php

include('connect.php');
include('header.php');

?>

<h2>Register Patron</h2>

<?php
if(isset($_POST['submit'])) {
    if(!empty($_POST)) {
        $PhoneNo = db_quote($_POST['PhoneNo'],$connection);
        $FirstName = db_quote($_POST['FirstName'],$connection);
        $MiddleName = db_quote($_POST['MiddleName'],$connection);
        $LastName = db_quote($_POST['LastName'],$connection);
        $Email = db_quote($_POST['Email'],$connection);
        $Address = db_quote($_POST['Address'],$connection);
        $City = db_quote($_POST['City'],$connection);
        $PostalCode = db_quote($_POST['PostalCode'],$connection);

        $CardExpiry = date('Y-m-d', strtotime(date('Y-m-d'). ' + 1 year'));
        $CardExpiry = db_quote($CardExpiry, $connection);

        $AccountType = db_quote($_POST['AccountType'],$connection);

        $Password = db_quote($_POST['Password'],$connection);

        $result = addPatron($PhoneNo,'null',$FirstName, $MiddleName, $LastName, $Email, $Address, $City, $PostalCode, $CardExpiry, $AccountType, $Password, $connection);
    }
}
?>

<form action="add-patron.php" method="POST">
    First Name:<br />
    <input type="text" name="FirstName" ><br />
    <br />
    Middle Name:<br />
    <input type="text" name="MiddleName"><br />
    <br />
    Last Name:<br />
    <input type="text" name="LastName"><br />
    <br />
    Email:<br />
    <input type="text" name="Email"><br />
    <br />
    Phone Number:<br />
    <input type="text" name="PhoneNo"><br />
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
    Account Type:<br />
    <input type="text" name="AccountType"><br />
    <br />
    Password:<br />
    <input type="text" name="Password">
    <br />
    <br />
    <input type="submit" value="Submit" name="submit">
</form>

<?php include('footer.php'); ?>