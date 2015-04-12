<?php

include('connect.php');
include('header.php');

?>

<h2>Add Journal</h2>

<form action="action_page.php">
    <!-- Include regular book adding stuff -->
    Journal Number:<br />
    <input type="text" name="JournalNumber"><br />
    <br />
    Institution:<br />
    <input type="text" name="Institution" >
    <br />
    <br />
    <input type="submit" value="Submit">
</form> 


<?php include('footer.php'); ?>