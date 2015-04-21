<?php
include('connect.php');
include('header.php');

$type = "Patron";
    
if (isset($_POST['username']) and isset($_POST['password'])) {
    $username = db_quote($_POST['username'],$connection);
    $password = db_quote($_POST['password'],$connection);
    
    $login = login($username,$password,$type,$connection);
}
if(isset($_SESSION['patron']) || $login == true) {
    if(isset($_SESSION['patron'])) { $username = $_SESSION['patron']; }
    $username = $_SESSION['patron'];
    ?>

<h2>Patron Panel: <?php viewUserName($username, $type, $connection); ?></h2>

<?php
patronInfo($username, $connection);
$username = substr($username, 1, strlen($username) - 2); ?>

<ul>
    <li><a href="view-patrons-books.php?patron=<?php echo $username; ?>">Borrowed Books</a></li>
    <li><a href="view-reserves.php?patron=<?php echo $username; ?>">Reserved</a></li>
    <li><a href="view-rated.php?patron=<?php echo $username; ?>">Rated</a></li>
    <li><a href="view-payments.php?patron=<?php echo $username; ?>">Payments</a></li>
    <li><a href="view-events-registered.php?patron=<?php echo $username; ?>">Registered Events</a></li>
    <li><a href="view-fees.php?patron=<?php echo $username; ?>">Fees</a></li>
</ul>

<p><a href="patron-logout.php">Logout</a></p>

<?php
}
include('footer.php'); ?>
