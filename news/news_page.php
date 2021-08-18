<?php 
include '../entity/News.php';
session_start();
$deliver = new News();

$data = $deliver->index();

?>
<!DOCTYPE html>
<html>
	<head>
    	<meta charset="UTF-8">
    	<link rel="shortcut icon" type="image/x-icon" href="../images/logo.ico"media="screen" />
    	<title>Latest Release</title>
    	<link rel="stylesheet" href="../css/news.css" >
	</head>
<body>
		<form method="post" id="home" action="../index.php">
            <button class="homeButton" type="submit" >Home</button>
         	<?php if($_SESSION['username'] == 'admin'): ?>
            <button class="homeButton" type="button" onclick="location.href='../admin.php'">Return</button>
            <?php endif; ?>
        </form>
        
        <h2>  &nbsp; </h2>
        <h2>  &nbsp; </h2>
        
	
<div class="container">
 	<?php  if($_SESSION['username'] == 'admin'): ?>
 		<a class="button" href="create.php">CREATE NEW POST</a>
	<?php  endif;?>
	
	<?php foreach($data['posts'] as $post): ?>
		<div class="container-item">
			<?php if ($_SESSION['username'] == 'admin'): ?>
				<form action="" method="post">
					<a class="button" href="update.php?id=<?php echo $post['id'] ?>">UPDATE</a>
					<a class="button" type="submit"  
						href="delete.php?id=<?php echo $post['id']; ?>" onclick="return confirm('Are you sure to delete this record?')">DELETE</a>
				</form>
			<?php endif; ?>
		<h2>
			 <a class="postTitle" href="readnews.php?id=<?php echo $post['id']; ?>">
					<?php echo $post['title']?>
					</a>
		</h2>
		
		<h3>
			<?php echo 'Created on: ' . date('d F Y H:i', strtotime($post['create_time'])) ?>
		</h3>
		
		<p>
			<?php echo iconv_substr($post['body'],0,40) . "..." ?>
		</p>
		</div>
	<?php endforeach;?>
</div>
</body>
</html>

<!--
    The display page of news.
    @author Lin Han 
    @date 27.3.2021
-->