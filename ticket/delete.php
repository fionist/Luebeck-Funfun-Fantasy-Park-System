<?php

include '../entity/TicketDB.php';
$ticketdb = new TicketDB();
$id = $_REQUEST['id'];
$delete = $ticketdb->delete($id);

if ($delete) {
    echo "<script>alert('delete successfully');</script>";
    echo "<script>window.location.href = 'ticketAdmin.php';</script>";
}

?>

<!--
    The delete function of ticket for admin.
    @author Yuning Bao 
    @date 1.4.2021
-->