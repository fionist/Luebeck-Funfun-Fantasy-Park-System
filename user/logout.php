<?php
require_once  '../entity/UserInfoDeliver.php';

if(isset($_SESSION['username'])){
	 unset($_SESSION['shopping_cart']);
}

UserInfoDeliver::logout();
?>

<!--
    The log out page.
    @author Lin Han 
    @date 23.3.2021
-->