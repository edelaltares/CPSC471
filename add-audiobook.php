<?php

include('connect.php');
include('header.php');

?>

<h2>Add Audiobook</h2>

<form action="action_page.php">
    <!-- Include regular book adding stuff -->
    Audiobook Number:<br />
    <input type="text" name="AudioBookNumber"><br />
    <br />
    Length:<br />
    <input type="text" name="Length" ><br />
    <br />
    Narrator:<br />
    <input type="text" name="Narrator">
    <br />
    <br />
    <input type="submit" value="Submit">
</form> 


<?php include('footer.php'); ?>