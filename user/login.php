<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <link rel="shortcut icon" type="image/x-icon" href="../images/logo.ico"media="screen" />
	<title>Login Page</title>
	<link rel="stylesheet" href="../css/login.css" >
</head>

<body>
	<form method="post" id="home" action="../index.php">
            <button class="homeButton" type="submit" >Home</button>
        </form>
	<div id="login">  
        <h1>Login</h1>  
        <form id="user_form" action="login.php" method="post">  
            <input type="text" form="user_form" required="required" placeholder="Username" name="username"></input>  
            <input type="password" form="user_form" required="required" placeholder="Password" name="password"></input>  
            <button class="button" form="user_form" type="submit">Login</button>  
            <button class="button" form="user_form" type="button" onclick="location.href='register.php'">Register</button>
        </form>  
    </div>  
    

    
<?php 
    require_once ("../entity/UserInfoDeliver.php");
    
    $deliver = new UserInfoDeliver();
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    $deliver->login();

 ?>
 
</body>
	
	
</html>

<!--
    The log in page for which is connected with database.
    @author Lin Han 
    @date 20.3.2021
-->
