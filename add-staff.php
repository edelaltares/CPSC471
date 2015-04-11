<?php

include('connect.php');
include('header.php');

?>

<h2>Add Staff</h2>

<form action="action_page.php">
    SIN:<br />
    <input type="text" name="SIN"><br />
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
    Wage:<br />
    <input type="text" name="Wage"><br />
    <br />
    Position:<br />
    <input type="text" name="Position"><br />
    <br />
    Super SIN:<br />
    <input type="text" name="SuperSIN"><br />
    <br />
    Branch Number:<br />
    <input type="text" name="BranchNo"><br />
    <br />
    Password:<br />
    <input type="text" name="Password">
    <br />
    <br />
    <input type="submit" value="Submit">
</form> 


<?php include('footer.php'); ?>