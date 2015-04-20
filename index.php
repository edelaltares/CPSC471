<?php

include('connect.php');
include('header.php');

?>

<h2>Welcome</h2>

<p>Welcome to <em>Hedone Libraries</em>, a small string of privately owned libraries specializing in a variety of genres. Feel free to browse through our books, register for membership, and look at events coming near you!</p>

<h3>Branches</h3>

<?php

viewBranches($connection);
include('footer.php');

?>