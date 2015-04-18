<?php
include('connect.php');
include('header.php');
?>

<h2>Search</h2>


<form action="search.php" method="POST">
    Search: <input type="text" name="search" /> <input type="submit" value="Submit" name="submit" />
</form>

<?php
if(isset($_POST['submit'])) {
    $search = $_POST['search'];
    searchBook($search,$connection);
}
include('footer.php');
?>
