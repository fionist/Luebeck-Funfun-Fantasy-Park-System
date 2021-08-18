<?php
include '../entity/News.php';
$db = new News();

if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    $row = $db->findPostById($id);
}

$db->update($id);

?>

<html>
	<head>
    	<meta charset="UTF-8">
    	<title>Update Post</title>
      <link rel="shortcut icon" type="image/x-icon" href="../images/logo.ico"media="screen" />
    	<link rel="stylesheet" href="../css/news.css" >
	</head>
	<body>
		<form method="post" id="home" action="../index.php">
            <button class="homeButton" type="submit" >Home</button>
            <button class="homeButton" type="button" onclick="location.href='news_page.php'">Back</button>
        </form>
        <form action="update.php?id=<?php echo $id?>" method="post">
<div class="container center">
	<h1>Update post</h1>
            <div class="form-group">
              <h4>Title</h4>
              <input type="text" name="title" required="required" class="form-control" value=" <?php echo $row['title']?> " >
            </div>
            <div class="form-group">
              <h4>Body</h4>
              <textarea name="body" class="form-control" ><?php echo $row['body'] ?></textarea>
            </div>
            <div class="form-group">
              <button type="submit" name="submit" value='submit' class="submit_button update_submit" onclick="return confirm('Are you sure to update this record?')">Submit</button>
            </div>
</div>
          </form>

	</body>
</html>
<!--
    The update page of a certain news for an admin.
    @author Lin Han 
    @date 4.4.2021
-->
