<?php 
include '../entity/UserInfoDeliver.php';
   
$deliver = new UserInfoDeliver();

?>
    
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Register Page</title>
    <link rel="shortcut icon" type="image/x-icon" href="../images/logo.ico"media="screen" />
	<link rel="stylesheet" href="../css/login.css" >
</head>

<body>
	<form method="POST" id="home" action="../index.php">
            <button class="homeButton" type="submit" >Home</button>
            <button class="homeButton" type="button" onclick="location.href='login.php'">Back</button>
            
        </form>
	<div id="login" class="registerContainer">  
        <h1>Register</h1>  
        <form id="user_form" action="register.php" method="POST" >  
            <input type="text" form="user_form" required="required" placeholder="Username" name="username"></input>  
            <input type="email" form="user_form" required="required" placeholder="Enter an email account" name='email'></input>
            <input type="password" form="user_form" required="required" placeholder="Password" name="password"></input>  
            <input type="password" form="user_form" required="required" placeholder="Repeat password" name="repeat"></input>  
            <button class="button" form="user_form" type="submit">Finish</button>  
        </form>  
    </div>  
    
<?php 
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $repeat = $_POST['repeat'];
    
    $deliver->register();

 ?>
</body>
	
	
</html>
<!--
    The registration page which delivers the information to the database.
    @author Lin Han 
    @date 23.3.2021
-->