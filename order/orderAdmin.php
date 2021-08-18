<?php 
include '../entity/OrderDB.php';
session_start();
$deliver = new OrderDB();

$data = $deliver->index();

?>
<!DOCTYPE html>
<html>
  <head>
      <meta charset="UTF-8">
        <!-- Bootstrap CSS -->
    	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    	<link rel="stylesheet" href="../css/tickets.css">

      <link rel="shortcut icon" type="image/x-icon" href="../images/logo.ico"media="screen" />
      
      <title>Order Display</title>
  </head>
  <body>
      	<form method="post" id="home" action="../index.php">
            <button class="homeButton" type="submit" >Home</button>
         	<?php if($_SESSION['username'] == 'admin'): ?>
            <button class="homeButton" type="button" onclick="location.href='../admin.php'">Return</button>
            <?php endif; ?>
		</form>
    <div class="container">
    
      <div class="row">
        <div class="col-md-12 mt-5">
          <h1 class="text-center">Order Display</h1>
          <hr style="height: 1px;color: black;background-color: black;">
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <table class="table">
            <thead>
              <tr>
                <th>ID</th>
                <th>Total</th>
                <th>Username</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php

                require_once ('../entity/OrderDB.php');
                session_start();

                $Order = new OrderDB();

                $rows = $Order->index();

                foreach($rows['orders'] as $order):
              ?>
              <tr>
                <td><?php echo $order['o_id'] ?></td>
                <td><?php echo $order['o_total']; ?></td>
                <td><?php echo $order['username']; ?></td>
                <td><?php echo $order['status']; ?></td>
              
                <td>
                  <a href="editOrder.php?o_id=<?php echo $order['o_id']; ?>" class="badge badge-danger button" >Edit</a>    
                </td>
              </tr>
            </tbody>
                      <?php endforeach;?>
          </table>

        </div>
      </div>
    </div>
  </body>
</html>

<!--
    The complete page of showing all the orders for admin.
    @author Yuning Bao 
    @date 6.4.2021
-->