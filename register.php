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
    <table border="0" >
        <tr>
            <td><b>First Name:</b></td>
            <td><input type="text" name="firstname"></td>
        </tr>
        <tr>
            <td><b>Middle Name:</b></td>
            <td><input type="text" name="middlename"></td>
        </tr>
        <tr>
            <td><b>Last Name:</b></td>
            <td><input type="text" name="lastname"></td>
        </tr>
        <tr>
            <td><b>Street Address:</b></td>
            <td><input type="text" name="streetaddress"></td>
        </tr>
        <tr>
            <td><b>City:</b></td>
            <td><input type="text" name="city"></td>
        </tr>
        <tr>
            <td><b>Postal Code:</b></td>
            <td><input type="text" name="postalcode"></td>
        </tr>
        <tr>
            <td> <b>Email:</b></td>
            <td><input type="text" name="email"></td>
        </tr>
        <tr>
            <td><b>Password:</b></td>
            <td><input name="password" type="password"></input></td>
        </tr>
        <tr>
            <td><input type="submit" value="Register"/>
            <td><input type="button" value="Login" onclick="gotologin()"></td>
        </tr>
    </table>
</form>

<?php
if(isset($msg) & !empty($msg)){
        echo $msg;
}
include('footer.php');
?>
