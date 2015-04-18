<?php

include('connect.php');

include('header.php');

$id = 1;
$bookNo = 1;
$bno = 1;
$CardNo = 2;
$SIN = 2;

removeAuthor($id, $connection);

removeBook($bookNo, $connection);

removeBranch($bno, $connection);

removePatron($CardNo, $connection);

removeStaff($SIN, $connection);

include('footer.php');

?>