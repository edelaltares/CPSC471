<?php
include('connect.php');
include('header.php');
?>

<h2>Register</h2>

<?php

// If the values are posted, insert them into the database.
if (isset($_POST['password'])){
    
    // Store input into variables
    // Username = id counter thing
    $firstName = $_POST['firstname'];	
    $middleName = $_POST['middlename'];
    $lastName = $_POST['lastname'];
    $street = $_POST['streetadress'];
    $city = $_POST['city'];	
    $postalcode = $_POST['postalcode'];	
    $email = $_POST['email'];	
    $password = $_POST['password'];
    
    // Check if input is empty
    if(!empty($firstName) && !empty($middleName) && !empty($lastName) && !empty($street) 
            && !empty($city) && !empty($postalcode) && !empty($email) && !empty($password)){
        
        $query = "INSERT INTO `patron` VALUES ('$firstName','$middleName','$lastName','$street','$city','$postalcode','$email','$password')"; 
        $result = mysqli_query($con,$query);
        
        if($result){
            $msg = "User Created Successfully.";
        }
    }
    else{
    $msg = "Please fill in all the fields.";
    }
}
?>

<form method="post" action="register.php" >
    <b>First Name:</b><br />
    <input type="text" name="firstname"><br /><br />


    <b>Middle Name:</b><br />
    <input type="text" name="middlename"><br /><br />


    <b>Last Name:</b><br />
    <input type="text" name="lastname"><br /><br />


    <b>Street Address:</b><br />
    <input type="text" name="streetaddress"><br /><br />


    <b>City:</b><br />
    <input type="text" name="city"><br /><br />


    <b>Postal Code:</b><br />
    <input type="text" name="postalcode"><br /><br />


     <b>Email:</b><br />
    <input type="text" name="email"><br /><br />


    <b>Password:</b><br />
    <input name="password" type="password"></input><br /><br />


    <input type="submit" value="Register"/>
    <input type="button" value="Login" onclick="gotologin()"><br />
</form>

<?php
if(isset($msg) & !empty($msg)){
        echo $msg;
}
include('footer.php');
?>
