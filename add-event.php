<?php

include('connect.php');
include('header.php');

// Show the form if the form is not submitted
if(!isset($_POST['submit'])) {
?>

<h2>Add Event</h2>

<form action="add-event.php?result" method="POST">
    Event Name:<br />
    <input type="text" name="EventName"><br />
    <br />
    Date (YYYY-MM-DD HH:MM:SS):<br />
    <input type ="text" name="Date"><br />
    <br />
    Branch Number:<br />
    <input type="text" name="BranchNumber"><br />
    <br />
    Staff:<br />
    <input type="text" name="StaffSIN"><br />
    <br />
    Description:<br />
    <textarea rows="4" cols="50" name="Description"></textarea><br />
    <br />
    <input type="submit" name="submit" value="submit">
</form> 

<?php
}
// Insert the event is form is submitted
else {
    $name = db_quote($_POST['EventName'],$connection);
    $date = db_quote($_POST['Date'],$connection);
    $desc = db_quote($_POST['Description'],$connection);
    $bnum = db_quote($_POST['BranchNumber'],$connection);
    $ssin = db_quote($_POST['StaffSIN'],$connection);
    
    $event = addEvent($name, $date, $desc, $bnum, null,$connection);
}

include('footer.php');

?>