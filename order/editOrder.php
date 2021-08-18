<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	  <link rel="stylesheet" href="../css/tickets.css">

    <link rel="shortcut icon" type="image/x-icon" href="../images/logo.ico"media="screen" />

    <title>Edit Order</title>
  </head>
  <body>
       <form method="post" id="home" action="../index.php">
            <button class="homeButton" type="submit" >Home</button>
    </form>
     <form method="post" id="home" action="./orderAdmin.php">
            <button class="homeButton" type="submit" >Back</button>
    </form>
    <div class="container">
      <div class="row">
        <div class="col-md-12 mt-5">
          <h1 class="text-center">Edit Order</h1>
          <hr style="height: 1px;color: black;background-color: black;">
        </div>
      </div>
      <div class="row">
        <div class="col-md-5 mx-auto">
          <?php
              include '../entity/OrderDB.php';
              $orderdb = new OrderDB();
              $o_id = $_REQUEST['o_id'];

              $row = $orderdb->findOrderById($o_id);


              if (isset($_POST['update'])) {
                if (isset($_POST['o_total'])&& isset($_POST['username'])&& isset($_POST['status'])) {
                if (!empty($_POST['o_total']) && !empty($_POST['username'])&& !empty($_POST['status'])) {
                    
                    $data['o_id'] = $o_id;
                    $data['o_total'] = $_POST['o_total'];
                    $data['username'] = $_POST['username'];
                    $data['status'] = $_POST['status'];

                    $updateOrder = $orderdb->updateOrder($data);
                      echo "<script>alert('record update successfully');</script>";
                      echo "<script>window.location.href = 'orderAdmin.php';</script>";     
      }
    }
              }

          ?>
          <form action="" method="post">
            <div class="form-group">
              
              <div class="form-group">
              <label for="">Total</label>
              <input type="text" name="o_total" value="<?php echo $row['o_total']; ?>" class="form-control">
            </div>
            <div class="form-group">
              <label for="">UserName</label>
              <input type="text" readonly="readonly" name="username" value="<?php echo $row['username']; ?>" class="form-control">
            </div>
            <div class="form-group">
              <label for="">Status</label>
              <input type="text" name="status" list='status' placeholder="<?php echo $row['status']; ?>" class="form-control">
              <datalist id='status'>
                <option>notok</option>
                <option>OK</option>
              </datalist>
            </div>
            <div class="form-group">
              <button type="submit" value='submit'name="update" class="submit_button" onclick="return confirm('Are you sure to change this record?')">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>

<!--
    The edit page of a order for admin.
    @author Yuning Bao 
    @date 1.4.2021
-->