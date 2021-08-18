<?php
include '../entity/News.php';
$db = new News();

    if (!empty($_GET['id'])) {
        $row = $db->findPostById($_GET['id']);
    }
?>

<html>
	<head>
    	<meta charset="UTF-8">
    	<title>Latest Release</title>
        <link rel="shortcut icon" type="image/x-icon" href="../images/logo.ico"media="screen" />
    	<link rel="stylesheet" href="../css/news.css" >
	</head>
	<body>
		<form action="readnews.php" >
            <button class="homeButton" type="button" onclick="location.href='../index.php'">Home</button>
            <button class="homeButton" type="button" onclick="location.href='news_page.php'">Back</button>
        </form>
        <div class="container">
            <h2> <?php echo $row['title']; ?></h2>
            <h3>Create on: <?php echo $row['create_time']; ?></h3>
            <p><?php echo nl2br($row['body']); ?>
        </div>
	</body>
</html>

<!--
    The content page of a certain news.
    @author Lin Han 
    @date 29.3.2021
-->