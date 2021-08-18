<?php
require_once (__DIR__ . "/../entity/Ticket.php");

/**
 * opreations on tickets and provide connection to database
 * @author Yuning Bao
 * @refactor Lin Han
 *
 */
class TicketDB {
    
    /**
     * field of the class, provides database connection
     */
    private $host ="localhost";
    private $user ="root";
    private $pwd ="123456";
    private $dbName ="ticket";
    private $conn;
    
    private $statement;
    private $dbHandler;
    
    /**
     * construction, connect to the database
     */
    public function __construct(){
      try {
        
        $this->conn = new mysqli($this->host,$this->user,$this->pwd,$this->dbName);
      } catch (Exception $e) {
        echo "connection failed" . $e->getMessage();
      }
        }

     public function getConnect(){
      $connect = $this->conn;
      return $connect;
        }


    /**
     * get all tickets from database
     * @return array $data, all tickets in the database
     */
    public function fetch(){
      $data = null;

      $query = "SELECT * FROM ticket";
      if ($sql = $this->conn->query($query)) {
        while ($row = mysqli_fetch_assoc($sql)) {
          $data[] = $row;
        }
      }
      return $data;
    }

    /**
     * delete a ticket from database
     * @param int $id, ticket id
     * @return boolean, return true after execution
     */
    public function delete($id){

      $query = "DELETE FROM ticket where id = '$id'";
      if ($sql = $this->conn->query($query)) {
        return true;
      }else{
        return false;
      }
    }

    /**
     * insert a ticket in the database
     */
    public function insert(){

      if (isset($_POST['submit'])) {
        if (isset($_POST['name']) && isset($_POST['detail']) && isset($_POST['price']) && isset($_POST['amount'])) {
//           if (!empty($_POST['name']) && !empty($_POST['detail']) && !empty($_POST['price']) && !empty($_POST['amount'])) {

           if (!preg_match("/^[1-9][0-9]*$/",$_POST['amount'])){
            echo "<script>alert('Amount should be a positive integer!');</script>";
            echo "<script>window.location.href = 'createTicket.php';</script>";
            die(); 
           }

           if ( $_POST['price'] == 0 || !preg_match("/(?:^[1-9]([0-9]+)?(?:\.[0-9]{1,2})?$)|(?:^(?:0)$)|(?:^[0-9]\.[0-9](?:[0-9])?$)/",$_POST['price'])){
            echo "<script>alert('Price should be a positive number!');</script>";
            echo "<script>window.location.href = 'createTicket.php';</script>";
            die();
            }

            $name = $_POST['name'];
            $price = $_POST['price'];
            $detail = $_POST['detail'];
            $amount = $_POST['amount'];

            $query = "INSERT INTO ticket (name,detail,price,amount) VALUES ('$name','$detail','$price','$amount')";
            if ($sql = $this->conn->query($query)) {
              echo "<script>alert('ticket added successfully');</script>";
              echo "<script>window.location.href = 'ticketAdmin.php';</script>";
            }
        }
//        }
      }
    }

    /**
     * get the ticket with id from database
     * @param int $id, ticket id
     * @return array $data, the specific ticket with certain id
     */
    public function fetch_single($id){

      $data = null;

      $query = "SELECT * FROM ticket WHERE id = '$id'";
      if ($sql = $this->conn->query($query)) {
        while ($row = $sql->fetch_assoc()) {
          $data = $row;
        }
      }
      return $data;
    }

    /**
     * edit a ticket
     * @param int $id, ticket id
     * @return array $data, the ticket
     */
    public function edit($id){

      $data = null;

      $query = "SELECT * FROM ticket WHERE id = '$id'";
      if ($sql = $this->conn->query($query)) {
        while($row = $sql->fetch_assoc()){
          $data = $row;
        }
      }
      return $data;
    }

    /**
     * update a ticket 
     * @param array $data, contains info of a data
     * @return boolean, true after execution
     */
    public function update($data){

       if (!preg_match("/^[1-9][0-9]*$/",$data['amount'])){
            echo "<script>alert('Amount should be a positive integer!');</script>";
            echo "<script>window.location.href = 'ticketAdmin.php';</script>";
            die();
       }

       if ( $data['price'] == 0 || !preg_match("/(?:^[1-9]([0-9]+)?(?:\.[0-9]{1,2})?$)|(?:^(?:0)$)|(?:^[0-9]\.[0-9](?:[0-9])?$)/",$data['price'])){
            echo "<script>alert('Price should be a positive number!');</script>";
            echo "<script>window.location.href = 'ticketAdmin.php';</script>";
            die();
      }

      $query = "UPDATE ticket SET name='$data[name]', detail='$data[detail]', price='$data[price]', amount='$data[amount]' WHERE id='$data[id] '";

      if ($sql = $this->conn->query($query)) {
        return true;
      }else{
        return false;
      }
    }


    /**
     * function to provides connection to the database
     * @return PDO
     */
    protected function connect() {
    $dsn = 'mysql:host=' . $this->host .';dbname=' . $this->dbName;
    $pdo = new PDO($dsn, $this ->user, $this->pwd);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
    }
    
    /**
     * rewrite function of query, doing a query in database
     * @param string $sql, a sql string which needed to be execuated in the database
     */
    public function query($sql){
        $this->statement = $this->connect()->query($sql);
    }
    
    /**
     * function to count rows of a result after query
     * @return number, the rows of result
     */
    public function rowCount() {
        return $this->statement->rowCount();
    }
    
    /**
     * execuate a fetch function for external classes
     * @return mixed, the result that sql sentence fetched
     */
    public function fetchFor() {
        return $this->statement->fetch();
    }

  }

 ?>





