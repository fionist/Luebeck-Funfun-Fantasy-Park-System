<!DOCTYPE html>
<html>

<?php 
    require_once ("entity/UserInfoDeliver.php");
    
    $deliver = new UserInfoDeliver();
    $username = $_SESSION["username"];
    $password = $_SESSION["password"];
    
    $deliver->login();

?>

<head>
	<meta charset="UTF-8">
    <link rel="shortcut icon" type="image/x-icon" href="images/logo.ico"media="screen" />
	<title>Admin Page</title>
	<link rel="stylesheet" href="css/login.css" >
</head>

<body>
	<form method="post" id="home" action="index.php">
            <button class="homeButton" type="submit" >Home</button>
        </form>
	<div id="login">  
        <h1>Admin</h1>  
        <div class="admin_png" align="center">
        	<img alt="admin" src="/images/admin.png">
    	</div>
        <form id="user_form" action="login.php" method="post">  
 <!--            <input type="text" form="user_form" required="required" placeholder="<?php // echo $username?>" name="username"></input>  
<!--             <input type="password" form="user_form" required="required" placeholder="Password" name="password"></input>   -->
<!--             <button class="button" form="user_form" type="submit">Edit</button>   -->
            <button class="button" form="user_form" type="button" onclick="location.href='/news/news_page.php'">News Management</button>
            <button class="button" form="user_form" type="button" onclick="location.href='ticket/ticketAdmin.php'">Ticket Management</button>
            <button class="button" form="user_form" type="button" onclick="location.href='/order/orderAdmin.php'">Order Management</button>        
        </form>  
    </div>  
    
 
</body>
	
	
</html>

<!--
    The admin page which shows the operations admins can do.
    @author Lin Han 
    @date 6.4.2021
-->