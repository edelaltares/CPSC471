<?php

include('connect.php');
include('header.php');

if(isset($_POST['submit'])) {
    echo "Submitting staff account...";
    $givenSIN = db_quote($_POST['SIN'], $connection);
    $givenPhoneNo = db_quote($_POST['PhoneNo'],$connection);
    $givenFirstName = db_quote($_POST['FirstName'],$connection);
    $givenMiddleName = db_quote($_POST['MiddleName'],$connection);
    $givenLastName = db_quote($_POST['LastName'],$connection);
    $givenEmail = db_quote($_POST['Email'],$connection);
    $givenAddress = db_quote($_POST['Address'],$connection);
    $givenCity = db_quote($_POST['City'],$connection);
    $givenPostalCode = db_quote($_POST['PostalCode'],$connection);
    $decidedWage = db_quote($_POST['Wage'],$connection);
    $decidedPosition = db_quote($_POST['Position'],$connection);
    $theirSupervisorSSN = db_quote($_POST['SuperSIN'],$connection);
    $givenBranchNo = db_quote($_POST['BranchNo'],$connection);


    $password = db_quote($_POST['Password'],$connection);

    $result = hireStaff($givenPhoneNo, $givenSIN, $givenFirstName, $givenMiddleName, $givenLastName, $givenEmail, $givenAddress, $givenCity, $givenPostalCode, $decidedWage, $decidedPosition, $theirSupervisorSSN, $givenBranchNo, $password, $connection);
}
?>

<h2>Add Staff</h2>

<form action="add-staff.php" method="POST">
    SIN:<br />
    <input type="text" name="SIN"><br />
    <br />
    First Name:<br />
    <input type="text" name="FirstName" ><br />
    <br />
    Middle Name:<br />
    <input type="text" name="MiddleName" ><br />
    <br />
    Last Name:<br />
    <input type="text" name="LastName"><br />
    <br />
    Email:<br />
    <input type="text" name="Email"><br />
    <br />
    PhoneNo:<br />
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
    <input type="submit" value="Submit" name="submit">
</form> 


<?php include('footer.php'); ?>