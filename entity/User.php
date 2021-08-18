<?php
include 'TicketDB.php';
/**
 * User class, provides connection to the database
 * @author Lin Han
 *
 */
class User extends TicketDB {
    
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
     * function of login operation
     * @param string $username, username that user entered
     * @param string $password, password that user entered
     * @return array|boolean, return result if password correct, false if wrong

     */
    public function login($username, $password) {
        
        $sql = "SELECT * FROM users WHERE username = '$username'";
//         $stmt = $this->db->connect()->query($sql);
        $this->db->query($sql);
        
        $row = $this->db->fetchFor();
        
//         $row = $stmt->fetch();
        $hashedPassword = $row['password'];
        $rowCount = $this->db->rowCount();
        
        if ( $rowCount == 0) {
            echo "<script> alert('Username does not exist!') </script>";
        } else {
                if (password_verify($password, $hashedPassword)) {
        
                    return $row;
                }
                else {
                    return false;
                }
        }
    }
        
        
        
//         if($this->db->rowCount() > 0){
//             if (isset($row['password'])) {
//                 if ($check != $row['password']) {
//                     echo "<script> alert('Wrong password!') </script>";
//                 }elseif(
//                     password_verify($password, $hashedPassword)) {
//                         return $row;
//                 }}
//                 else{ echo "<script> alert('Username does not exist!') </script>";
//                 }
//         }
//     }
    

    // } public function login($username, $password) {
        
    //     $sql = "SELECT * FROM users WHERE username = '$username'";
    //     $stmt = $this->db->connect()->query($sql);
  
    //     $row = $stmt->fetch();
    //     $hashedPassword = $row['password'];

//          if($stmt->rowCount() > 0){ 
//             if (isset($row['password'])) {
//                 if ($check != $row['password']) {
//                     echo "<script> alert('Wrong password!') </script>";
//                 }elseif(
//                   password_verify($password, $hashedPassword)) {
//                   return $row;
//             }}
//         else{ echo "<script> alert('Username does not exist!') </script>";
//       }
//      }
//     }
 
    
    /**
     * function to register a account in the database
     * @param string $username, the username that user entered
     * @param string $email, the email that user entered
     * @param string $password, the password that user entered
     * @return boolean, return true after execution
     */
    public function register($username, $email, $password) {
        $this->db->connect()->query("INSERT INTO users (username, email, password) 
                            VALUES ('$username', '$email', '$password') ");
            return true;
        
        
    }
    
    /**
     * function to find a user info with name
     * @param string $name, the username
     * @return boolean, return true if find successfully, false if failed
     */
    public function findUserByName($name) {
        $sql = "SELECT * FROM users WHERE username = '$name'";
        $stmt = $this->db->query($sql);
        
        if ($this->db->rowCount() > 1) {
            return true;
        } else {
            return false;
        }
    }
    
    
    /**
     * function to find a user info with email 
     * @param string $email, the email account
     * @return boolean, return true if find successfully, false if failed
     */
    public function findUserByEmail($email) {
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $stmt = $this->db->query($sql);
        
        if ($this->db->rowCount() > 1) {
            return true;
        } else {
            return false;
        }
    }
}