<?php

include('connect.php');
include('header.php');

?>

<h2>Add Event</h2>

<form action="action_page.php">
    Event Name:<br />
    <input type="text" name="EventName"><br />
    <br />
    Date:<br />
    <input type="text" name="Date" ><br />
    <br />
    Branch Number:<br />
    <input type="text" name="BranchNumber"><br />
    <br />
    Description:<br />
    <textarea rows="4" cols="50" name="Description"></textarea><br />
    <br />
    <input type="submit" value="Submit">
</form> 


<?php include('footer.php'); ?>