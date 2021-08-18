<?php
session_start();
$ticket_ids = array();

if(filter_input(INPUT_POST,'add_to_cart')){
  if(isset($_SESSION['shopping_cart'])){

   $count = count($_SESSION['shopping_cart']);
   $ticket_ids = array_column($_SESSION['shopping_cart'],'id');

   if(!in_array(filter_input(INPUT_GET, 'id'),$ticket_ids)){
    $_SESSION['shopping_cart'][$count] = array(
   
    'id'=>filter_input(INPUT_GET,'id'),
    'name' => filter_input(INPUT_POST,'name'),
    'price' => filter_input(INPUT_POST,'price'),
    'quantity' => filter_input(INPUT_POST,'quantity')
    );
   
   }
   else{ //exists, increae
      for ($i = 0; $i< count($ticket_ids); $i++){
        if($ticket_ids[$i] == filter_input(INPUT_GET,'id')){
          //add item quantity to the array
          $_SESSION['shopping_cart'][$i]['quantity'] += filter_input(INPUT_POST,'quantity');
        }

      }

   }
}
  else{
    $_SESSION['shopping_cart'][0] = array(
   
    'id'=>filter_input(INPUT_GET,'id'),
    'name' => filter_input(INPUT_POST,'name'),
    'price' => filter_input(INPUT_POST,'price'),
    'quantity' => filter_input(INPUT_POST,'quantity')
    );
   }
}


if(filter_input(INPUT_GET,'action') == 'delete'){
  
  foreach($_SESSION['shopping_cart'] as $key => $ticket){
     if($ticket['id'] == filter_input(INPUT_GET, 'id')){
      //For remove the item
        unset($_SESSION['shopping_cart'][$key]);
     }
  }

   $_SESSION['shopping_cart'] = array_values($_SESSION['shopping_cart']);
}


function pre_r($array){
   echo '<pre>';
   print_r($array);
   echo '</pre>';
}

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/tickets.css">

    <title>Ticket Buy</title>

  </head>
  <body>
      	<form method="post" id="home" action="../index.php">
            <button class="homeButton" type="submit" >Home</button>
    	</form>
     	<form method="post" id="history" action="history.php">
            <button class="homeButton" type="submit" >History</button>
    	</form>
    	<h1 class="text-center">Shopping Cart</h1>
    <div class="container">
    <?php

     include '../entity/TicketDB.php';
     $ticketdb = new TicketDB();
     $connect = $ticketdb->getConnect();

    $query ="select *from ticket";
    $result = mysqli_query($connect,$query);

    if($result):
      if(mysqli_num_rows($result)>0):
        while($ticket = mysqli_fetch_assoc($result)):
      ?>

      <div class='col-sm-4 col-md-3'>
        <form method='post' action="ticketUser.php?action=add&id=<?php echo $ticket['id']; ?>">
          <div class="tickets">
            <h4 class='text-info'><?php echo $ticket['name']; ?></h4>
            <h4>$ <?php echo $ticket['price']; ?></h4>

            
            <div class="numbercount oneline">
                <input type='text' id="amount <?php echo $ticket['id']?>" name='quantity' readonly="readonly" class='form-control oneline' value='1' style="width: 60px;" />
            </div>
                <input type='hidden' name='name' value="<?php echo $ticket['name']; ?>" />
                <input type='hidden' name='price' value="<?php echo $ticket['price']; ?>" />
                <input type='submit' name='add_to_cart' class="btn btn-info" value="Add to Cart" style="margin-top: 5px;"/>

    </div>
  </form>


</div>
    <?php
    endwhile;
  endif;
endif;
?>
      <div style="clear:both"></div>
      <br></br>
      <table class="table">
        <tr><th colspan='5'><h3>Order Details</h3></th></tr>
      <tr>
        <th width="40%">Ticket Name</th>
        <th width="10%">Quantity</th>
        <th width="20%">Price</th>
        <th width="15%">Total</th>
        <th width="5%">Action</th>
      </tr>
      <?php
      if(!empty($_SESSION['shopping_cart'])):

        $total =0;

        foreach($_SESSION['shopping_cart']  as $key => $ticket):
    ?>

  
<form action="" method="post">
    	
    <tr>

     <td><div class="form-group"><input type="text" disabled="disabled"name="o_name" class="form-control"
              value="<?php echo $ticket['name']; ?>"></div></td>

     <td><div class="form-group"><input type="text" disabled="disabled"name="o_quantity" class="form-control"
              value="<?php echo $ticket['quantity']; ?>"></div></td>

     <td><div class="form-group"><input type="text" disabled="disabled"name="o_price" class="form-control"
              value="$ <?php echo $ticket['price']; ?>"></div></td>

     <td><div class="form-group"><input type="text" disabled="disabled"name="o_total" class="form-control"
              value="$ <?php echo number_format($ticket['quantity'] *$ticket['price'],2); ?>"></div></td>

    <td>
      <a href="ticketUser.php?action=delete&id=<?php echo $ticket['id']; ?>" class="badge badge-danger button" 
      style="height: 34px; background-color: #dc3545; margin: auto; text-align: center; padding: 8px;">Remove</a>  
    </td>
     
  </tr>             
</form>


  <?php
   $total = $total + ($ticket['quantity'] *$ticket['price']);
 endforeach;
  ?>

  <tr style="font-weight: bold;">
    <td colspan="3" align="right"> Total </td>
    <td align="right" style="color: orange; font-size: 18px;"> $ <?php echo number_format($total, 2);?></td>
    <td></td>
  </tr>
  <tr>
    <td colspan="5">
      <?php
      if(isset($_SESSION['shopping_cart'])):
        if(count($_SESSION['shopping_cart']) >0):
      ?>


     <form action='#' method='get' >
     
			<div style="display: none;">
              <input type="o_id"  readonly="readonly" name="o_id"  value="<?php echo time(); ?>"/>
              <input type="username"  readonly="readonly"name="username"  value="<?php echo $_SESSION['username']?>"/>
              <input type="o_total"  readonly="readonly"name="o_total" value="$ <?php echo number_format($total, 2);?>"/>
			</div>
			<div style="float: right;">
            <button type="submit" value="Confirm" name="submit">Confirm</button>
            </div>
      </form>
    <?php
              require_once '../entity/OrderDB.php';
              $orderdb = new OrderDB();
              $insert = $orderdb->insert();
            
?>
 


      <?php endif; endif; ?>
  </td>
</tr>
    <?php endif; ?>

</table>
</div>
     
  </body>
</html>

<!--
    The shpping cart page for a logged in user.
    @author Yuning Bao 
    @date 2.4.2021
-->
