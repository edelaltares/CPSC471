<?php
// 7C-L55sK
include('connect.php');
include('header.php');
?>

<h2>Latest Books</h2>
<table width="100%">
    <!-- Table headers -->
    <tr>
        <td width="50%"><h3>Title</h3></td>
        <td width="50%"><h3>Author(s)</h3></td>
    </tr>
    <!-- Code for one book -->
    
    <?php 
        viewLatestBooks($connection);
    ?>
    
</table>

<?php include('footer.php'); ?>
