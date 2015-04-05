<?php
include('connect.php');
include('header.php');
?>

<h2>Books</h2>
<table width="100%">
    <!-- Table headers -->
    <tr>
        <td width="50%"><h3>Title</h3></td>
        <td width="50%"><h3>Author(s)</h3></td>
    </tr>
    <!-- Code for one book -->
    <tr>
        <td width="50%"><a href=""><?php echo "Title of book"; ?></a></td>
        <td width="50%"><?php echo "Author(s) of book"; ?></td>
    </tr>
</table>

<?php include('footer.php'); ?>
