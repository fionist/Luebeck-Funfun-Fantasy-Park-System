<?php 
require_once ('TicketDB.php');
/**
 * operations on orders with connection to the database
 * @author Yuning Bao
 *
 */
class OrderDB extends TicketDB{
    
    /**
     * field of the class, a database variable
     */
    private $db;
    
    /**
     * constructor, provides connection to the database
     */
    public function __construct() {
        $this->db = new TicketDB();
    }
    
    /**
     * to judge if the logged user is Admin
     * @return boolean, if is admin, return true
     */
    public function isAdmin() {
        if ($_SESSION['username'] == 'admin') {
            return true;
        } else {
            return false;
        }
    }

    /**
     * method to show all the orders when required
     * @return array $data, all posts
     */
    public function index() {
        $orders = $this->findAllOrders();
        
        $data = ['orders' => $orders];
        return $data;
    }

    /**
     * method to find a specific order with username in the database
     * @param int $username, the name of the user
     * @return array $data, return the order
     */
    public function findUserOrder($username) {
        $orders = $this->findOrderByUser($username);
        
        $data = ['orders' => $orders];
        return $data;
    }
    
    /**
     * method to find all orders in the database
     * @return array $results, all orders in the database
     */
    public function findAllOrders() {
        $sql = 'SELECT * FROM `order`';
        $stmt = $this->db->connect()->query($sql);
        $results = $stmt->fetchAll();
        
        return $results;
    }
    
    /**
     * method to find a specific order with id in the database
     * @param int $id, the id of the order
     * @return array $results, return the order
     */
    public function findOrderById($o_id) {
        $sql = "SELECT * FROM `order` WHERE o_id = '$o_id'";
        $stmt = $this->db->connect()->query($sql);

       $results = $stmt->fetch();
        
       return $results;
    }
    
    /**
     * method to find a specific order with username in the database
     * @param $username, the name of the order
     * @return array $results, return the order
     */
    public function findOrderByUser($username) {
        $sql = "SELECT * FROM `order` WHERE username = '$username'";
        $stmt = $this->db->connect()->query($sql);

       $results = $stmt->fetchAll();
        
       return $results;
    }

    /**
     * function to update a order in the database
     * @param array $data, info of the order
     * @return boolean, return true after execution
     */
    public function updateOrder($data){

      $query = "UPDATE `order` SET  o_total='$data[o_total]' , username='$data[username]', status='$data[status]' WHERE o_id='$data[o_id]' ";

      if ($this->db->query($query)) {
        return true;
      }
      else{
        return false;
      }
    }

    
    /**
     * @param unknown $o_id
     * @return NULL|unknown
     */
    public function editOrder($o_id){
      $data = null;
      $query = "SELECT * FROM order WHERE o_id = '$o_id'";
      if ($sql = $this->db->query($query)) {
        while($row = $sql->fetch_assoc()){
          $data = $row;
        }
      }
      return $data;
    }

    /**
     * insert a new order in the database
     */
    public function insert(){

       if (isset($_GET["submit"])) {
            if (isset($_GET['o_id'])  && isset($_GET['o_total'])&& isset($_GET['username'])){
            if (!empty($_GET['o_id'])  && !empty($_GET['o_total']) && !empty($_GET['username'])) {          
           $o_id = $_GET['o_id'];
           $o_total = $_GET['o_total'];
           $username = $_GET['username'];

           $query = "INSERT INTO `order` (o_id,o_total, username, status) VALUES ('$o_id','$o_total','$username','notok')";

            if ($this->db->query($query)) {
              echo "<script>alert('order added successfully');</script>";
              echo "<script>window.location.href = 'history.php';</script>";
            }else{
                echo "<script>alert('order added successfully');</script>";
              echo "<script>window.location.href = 'history.php';</script>";   
            }
          }else{
            echo "<script>alert('Please log in with an account');</script>";
            echo "<script>window.location.href = 'ticketUser.php';</script>";
          }
        }
      }
    }
     

    /**
     * delete an order in the database with the specific id
     * @param int $id, order id
     * @return boolean, return true after execution
     */
    public function deleteOrder($o_id) {
        $sql = "DELETE FROM order WHERE o_id = '$o_id'";
        $stmt = $this->db->connect()->query($sql);
        
        return  true;
    }


    /**
     * {@inheritDoc}
     * @see TicketDB::connect()
     */
    protected function connect() {
    $dsn = 'mysql:host=' . $this->host .';dbname=' . $this->dbName;
    $pdo = new PDO($dsn, $this ->user, $this->pwd);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
    }
    
    /**
     * {@inheritDoc}
     * @see TicketDB::query()
     */
    public function query($sql){
        $this->statement = $this->connect()->query($sql);
    }
    
    /**
     * {@inheritDoc}
     * @see TicketDB::rowCount()
     */
    public function rowCount() {
        return $this->statement->rowCount();
    }

  }
    


?>