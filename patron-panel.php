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
    <li><a href="view-patrons-books.php?patron=<?php echo $username; ?>">Checked Out</a></li>
    <li><a href="">Reserved</a></li>
    <li><a href="">Rated</a></li>
    <li><a href="">Borrow History</a></li>
    <li><a href="">Payment History</a></li>
    <li><a href="">Account</a></li>
    <li><a href="">Fees</a></li>
</ul>

<p><a href="patron-logout.php">Logout</a></p>

<?php
}
include('footer.php'); ?>
