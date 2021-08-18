  
<?php 

	include '../entity/News.php';
	$db = new News();
	$id = $_GET['id'];
	echo $id;
	$delete = $db->deletePost($id);

	if ($delete) {
	    
		echo " <script>
 if(confirm) {
 alert(' successful ');
 } else {
 false;
 }
 </script>";
		echo "<script>window.location.href = 'news_page.php';</script>";
	}
	

 ?>
 
 <script>
 if(confirm) {
 alert(' successful ');
 } else {
 false;
 }
 </script>

 <!--
    The delete function of a news for admin.
    @author Lin Han 
    @date 30.3.2021
-->