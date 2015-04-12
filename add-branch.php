<?php

include('connect.php');
include('header.php');

?>

<h2>Add a Branch</h2>

<form action="action_page.php">
    Branch Number:<br />
    <input type="text" name="BranchNo"><br /><br />
    
    Branch Name:<br />
    <input type="text" name="BranchName" ><br /><br />
    
    Phone Number:<br />
    <input type="text" name="PhoneNo"><br /><br />
    
    Address:<br />
    <input type="text" name="Address"><br /><br />
    
    Manager SIN:<br />
    <input type="text" name="ManagerSIN"><br /><br />
    
    <input type="submit" value="Submit">
</form> 

<?php include('footer.php'); ?>