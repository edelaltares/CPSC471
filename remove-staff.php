<?php
include('connect.php');
include('header.php');
?>

<h2>Remove Staff</h2>

<?php
    // If form is submitted
    if(isset($_POST['submit'])) {
        $staff = db_quote($_POST['Staff'], $connection);
        
        $insert = removeStaff($staff, $connection);
    }
?>

<form action="remove-staff.php" method="POST">
    Staff Number:<br />
    <input type="text" name="Staff" /><br />
    <br />
    <input type="submit" name="submit" value="Submit"></input>
</form>

<?php include('footer.php'); ?>