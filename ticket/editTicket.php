<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" type="image/x-icon" href="../images/logo.ico"media="screen" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/tickets.css">

    <title>Edit Ticket</title>
  </head>
  <body>
       <form method="post" id="home" action="../index.php">
            <button class="homeButton" type="submit" >Home</button>
            <button class="homeButton" type="button" onclick="location.href='ticketAdmin.php'">Back</button>
    </form>
    <div class="container">
      <div class="row">
        <div class="col-md-12 mt-5">
          <h1 class="text-center">Edit Ticket</h1>
          <hr style="height: 1px;color: black;background-color: black;">
        </div>
      </div>
      <div class="row">
        <div class="col-md-5 mx-auto">
          <?php
              include '../entity/TicketDB.php';
              $ticketdb = new TicketDB();
              $id = $_REQUEST['id'];
              $row = $ticketdb->edit($id);

              if (isset($_POST['update'])) {
                if (isset($_POST['name']) && isset($_POST['detail']) && isset($_POST['price']) && isset($_POST['amount'])) {
//                   if (!empty($_POST['name']) && !empty($_POST['detail']) && !empty($_POST['price']) && !empty($_POST['amount']) ) {
                    
                    $data['id'] = $id;
                    $data['name'] = $_POST['name'];
                    $data['price'] = $_POST['price'];
                    $data['detail'] = $_POST['detail'];
                    $data['amount'] = $_POST['amount'];

                    $update = $ticketdb->update($data);

                    if($update){
                      echo "<script>alert('record update successfully');</script>";
                      echo "<script>window.location.href = 'ticketAdmin.php';</script>";
                    }else{
                      echo "<script>alert('record update failed');</script>";
                      echo "<script>window.location.href = 'ticketAdmin.php';</script>";
                    }

                  }else{
                    echo "<script>alert('empty');</script>";
                    header("Location: editTicket.php?id=$id");
                  }
//                 }
              }

          ?>
          <form action="" method="post">
            <div class="form-group">
              <label for="">Name</label>
              <input type="text" name="name" required='required'value="<?php echo $row['name']; ?>" class="form-control">
            </div>
            <div class="form-group">
              <label for="">detail</label>
              <input type="detail" name="detail" required='required' value="<?php echo $row['detail']; ?>" class="form-control">
            </div>
            <div class="form-group">
              <label for="">price</label>
              <input type="text" name="price" required='required' value="<?php echo $row['price']; ?>" class="form-control">
            </div>
            <div class="form-group">
              <label for="">amount</label>
              <textarea name="amount" id="" cols="" rows="3" required='required' class="form-control"><?php echo $row['amount']; ?></textarea>
            </div>
            <div class="button-group">
              <button type="submit" name="update" class="submit_button">Submit</button>
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
    The edit page of a certain ticket for admin.
    @author Yuning Bao 
    @date 1.4.2021
-->