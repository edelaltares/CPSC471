<?php

static $connection;

if(!isset($connection)){
    $config = parse_ini_file('config.ini');
    $connection = mysqli_connect('localhost', $config['username'], $config['password'], $config['dbname']);
}

if($connection == false) {
   echo "Did not connect!";
   return mysqli_connect_error();
}

?>