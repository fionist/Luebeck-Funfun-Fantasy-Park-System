<?php
include '../entity/News.php';
$db = new News();

$db->create();
?>

<html>
	<head>
    	<meta charset="UTF-8">
    	<title>Create Post</title>
    	<link rel="stylesheet" href="../css/news.css" >
        <link rel="shortcut icon" type="image/x-icon" href="../images/logo.ico"media="screen" />
	</head>
	<body>
		<form method="post" id="home" action="../index.php">
            <button class="homeButton" type="submit" >Home</button>
            <button class="homeButton" type="button" onclick="location.href='news_page.php'">Back</button>
            
        </form>
        <div class='container center'>
        	<h1>Create new post</h1>
        	<form action="create.php" method='post'>
        		<div class='form-item'>
        			<input type="text" name="title" required="required" placeholder="Enter the title...">
        			<span class="invalidFeedback">
        				<?php echo $data['titleError']; ?>
        			</span>
        		</div>
        		<div class="form-item">
        			<textarea name='body' id='newsbody' placeholder="Enter the content..." required></textarea>
        			<span class="invalidFeedback">
        			  <?php echo $data['bodyError']; ?>
        			</span>
        		</div>
        		<div class="form-item">
        			<button class="submit_button" name='submit' type="submit" onclick="return confirm('Are you sure to add this news?')">Submit</button>
        		</div>
         
        	</form>
        </div>
	</body>
</html>

<!--
    The create page of a news for admin.
    @author Lin Han 
    @date 29.3.2021
-->