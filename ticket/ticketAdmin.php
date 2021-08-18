<?php 
session_start();
?>
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
    <title>Ticket Display</title>
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
          <h1 class="text-center">Ticket Display</h1>
          <hr style="height: 1px;color: black;background-color: black;">
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <table class="table">
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Detail</th>
                <th>Pirce</th>
                <th>Amount</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php

                include '../entity/TicketDB.php';


                $ticketdb = new TicketDB();
                $rows = $ticketdb->fetch();

                $i = 1;
                if(!empty($rows)){
                  foreach($rows as $row){ 
              ?>
              <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['detail']; ?></td>
                <td><?php echo $row['price']; ?></td>
                <td><?php echo $row['amount']; ?></td>
               


                <td>
                  <a href="delete.php?id=<?php echo $row['id']; ?>" class="badge badge-danger button" onclick="return confirm('Are you sure to delete this record?')">Delete</a>
                  <a href="editTicket.php?id=<?php echo $row['id']; ?>" class="badge badge-success button">Edit</a>
                </td>

              </tr>

              <?php
                }
              }else{
                echo "no data";
            }

              ?>
            </tbody>
          </table>
          <a href="createTicket.php" class="badge badge-success button">Create</a>
        </div>
      </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>

<!--
    The ticket management page for administrators only, which is linked to database.
    @author Yuning Bao 
    @date 6.4.2021
-->