<?php

include('connect.php');
include('header.php');

?>

<h2>Add Book</h2>

<form action="action_page.php">
    Barcode:<br />
    <input type="text" name="Barcode"><br />
    <br />
    ISBN:<br />
    <input type="text" name="ISBN" ><br />
    <br />
    Call Number:<br />
    <input type="text" name="Call Number"><br />
    <br />
    Title:<br />
    <input type="text" name="Title"><br />
    <br />
    Branch Number:<br />
    <input type="text" name="Branch Number"><br />
    <br />
    Summary:<br />
    <textarea rows="4" cols="50" name="Summary"></textarea><br />
    <br />
    Publisher Name:<br />
    <input type="text" name="Branch Number"><br />
    <br />
    Author ID:<br />
    <input type="text" name="Branch Number">
    <br />
    <br />
    <input type="submit" value="Submit">
</form> 


<?php include('footer.php'); ?>