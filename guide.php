<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" name="viewport" content="wdith=device-width, initial-scale=1"/>
    <link rel="shortcut icon" type="image/x-icon" href="images/logo.ico"media="screen" />
    <title>Latest news</title>
    <link rel="stylesheet" href="css/guide.css">
</head>

<body>
	<form method="post" id="home" action="index.php">
            <button class="homeButton" type="submit" >Home</button>
    </form>
    <div class="pageContent">
    <div id="infoContainer" class="container">
    	<header id="infoTitle" class="title">
    		<h1>Travel Information</h1>
    	</header>
    	<div class="advice">
    		<a href="guide/advice.php">pre-advice</a>
    	</div>
    	<div class="info">
    		<a href="guide/packing.php">packing info</a>
    	</div>
    </div>
    <div id="transportContainer" class="container">
    	<header id="transportTitle" class="title">
    		<h1>Transportation</h1>
    	</header>
    	<div class="subway">
    		<a href="guide/subway.php">subway</a>
    	</div>
    	<div class="coach">
    		<a href="guide/coach.php">coach</a>
    	</div>
    	<div class="car">
    		<a href="guide/car.php">car</a>
    	</div>
    </div>
    </div>
</body>
</html>

<!--
    The Travel guide information page.
    @author Lin Han 
    @date 18.3.2021
-->