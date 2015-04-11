<?php

include('connect.php');
include('header.php');

?>

<h2>Add Author</h2>

<form action="action_page.php">
    Author ID:<br />
    <input type="text" name="AuthorID"><br />
    <br />
    First Name:<br />
    <input type="text" name="FirstName" ><br />
    <br />
    Last Name:<br />
    <input type="text" name="LastName">
    <br />
    <br />
    <input type="submit" value="Submit">
</form> 


<?php include('footer.php'); ?>