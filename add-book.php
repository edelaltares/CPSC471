<?php

include('connect.php');
include('header.php');

if(isset($_POST['submit'])) {
    if(!isset($_POST['Genre'])) { $Genre = "''"; }
    else { $Genre = db_quote($_POST['Genre'], $connection); }
    
    $type = db_quote($_POST['Type'], $connection);
    $ISBN = db_quote($_POST['ISBN'], $connection);
    $CallNo = db_quote($_POST['CallNumber'], $connection);
    $Title = db_quote($_POST['Title'], $connection);
    $Publisher = db_quote($_POST['Publisher'], $connection);
    $FName = db_quote($_POST['First'], $connection);
    $MName = db_quote($_POST['Middle'], $connection);
    $LName = db_quote($_POST['Last'], $connection);
    $BranchNo = db_quote($_POST['BranchNumber'], $connection);
    $Summary = db_quote($_POST['Summary'], $connection);

    $result = addBook($type, $ISBN, $CallNo, $Title, $BranchNo, $Summary, $Publisher, $FName, $MName, $LName, $Genre, $connection);
}

?>

<h2>Add Book</h2>

<form action="add-book.php" method="POST">
    Book Type: 
    <select name="Type">
        <option value="Normal">Normal</option>
        <option value="Audiobook">Audiobook</option>
        <option value="Journal">Journal</option>
    </select><br />
    <br />
    ISBN:<br />
    <input type="text" name="ISBN" ><br />
    <br />
    Call Number:<br />
    <input type="text" name="CallNumber"><br />
    <br />
    Title:<br />
    <input type="text" name="Title"><br />
    <br />
    Publisher Name:<br />
    <input type="text" name="Publisher"><br />
    <br />
    Author Name:<br />
    <input type="text" name="First"> 
    <input type="text" name="Middle"> 
    <input type="text" name="Last"><br />
    <br />
    Genre: <br />
    <input type="text" name="Genre" /><br />
    <br />
    Branch Number:<br />
    <input type="text" name="BranchNumber"><br />
    <br />
    Summary:<br />
    <textarea rows="4" cols="50" name="Summary"></textarea><br />
    <br />
    <input type="submit" value="Submit" name="submit">
</form> 


<?php include('footer.php'); ?>