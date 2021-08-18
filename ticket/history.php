<!DOCTYPE html>
<html>
  <head>
      <meta charset="UTF-8">
        <!-- Bootstrap CSS -->
    	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    	<link rel="stylesheet" href="../css/tickets.css">
      <link rel="shortcut icon" type="image/x-icon" href="../images/logo.ico"media="screen" />
      <title>My Order</title>
  </head>
  <body>
      	<form method="post" id="home" action="../index.php">
            <button class="homeButton" type="submit" >Home</button>         
    	</form>
    <div class="container">

   <div class="welcome">Welcome <?php 
   session_start();
   echo $_SESSION['username']?> </div>
    
      <div class="row">
        <div class="col-md-12 mt-5">
          <h1 class="text-center">My order</h1>
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
              </tr>
            </thead>
            <tbody>
              <?php

                require_once ('../entity/OrderDB.php');
                session_start();

                $Order = new OrderDB();

                $username = $_SESSION['username'];

                $rows = $Order->findUserOrder($username);
 
                foreach($rows['orders'] as $order):

              ?>
              <tr>
                <td><?php echo $order['o_id'] ?></td>
                <td><?php echo $order['o_total']; ?></td>
                <td><?php echo $order['username']; ?></td>
                <td><?php echo $order['status']; ?></td>
            
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
    The history of orders for a logged in user.
    @author Yuning Bao 
    @date 2.4.2021
-->