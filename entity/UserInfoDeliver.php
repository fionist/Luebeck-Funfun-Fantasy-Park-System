<?php
session_start();
/**
 * deliver between user interface and database, send data between
 * @author Lin Han
 *
 */
class UserInfoDeliver {
    
    /**
     * constructor, import the user info
     */
    public function __construct(){
        require_once 'User.php';
        $this->user = new User();
    }
    
    /**
     * login function, called in the login process
     * check the info of username and password if entered or not
     * create a session of the user if login successfully, or show alert if failed
     */
    public function login() {
        $username = '';
        $password = '';
        $usernameError = '';
        $passwordError = '';
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);
            
            
            if (empty($username)) {
                $usernameError = 'Enter an username';
            }
            
            if (empty($password)) {
                $passwordError = 'Enter the password';
            }
            
          
            if (empty($usernameError) && empty($passwordError)) {
                $loggedUser = $this->user->login($username, $password);
                if ($loggedUser) {
                    $this->createSession($loggedUser);
                }
                else {
                    $passwordError = 'Wrong Username or Password!';
                    echo "<script> alert('Wrong Password!'); </script>";
                    
                }
            }
        }
        
        else {
            $username = '';
            $password = '';
            $usernameError = '';
            $passwordError = '';
        }
    }
    
    /**
     * create a user session, store info of logged user
     * @param array $user, the user info to be stored
     * 
     * jump to admin page if admin
     * jump to main page if not after 1 seconds
     */
    public function createSession($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];
        if ($_SESSION['username'] == "admin") {
            header('refresh:0;url=../admin.php');
        } else {
        echo "<script> alert('Login successfully, will return to home page in 3 seconds'); </script>";
        header('refresh:1;url=../index.php');
        }
    }
    
    /**
     * log out function, delete the sesstion of logged user
     */
    public function logout(){
        unset($_SESSION['user_id']);
        unset($_SESSION['username']);
        unset($_SESSION['email']);
        header('location:../index.php');
    }
        
    /**
     * register function, called in the register process
     * check and validate the info of username, email and password 
     * jump to login page after registered
     */
    public function register() {
        $username = '';
        $password = '';
        $repeat = '';
        $email = '';
        $usernameError = '';
        $emailError = '';
        $passwordError = '';
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            $username = trim($_POST['username']);
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
            $repeat = trim($_POST['repeat']);
            
            $nameValidate = "/^[a-zA-Z0-9]*$/";
            
            if (empty($username)) {
                $usernameError = "Enter your username";
            } elseif (!preg_match($nameValidate, $username)) {
                $usernameError = "Name can only contain letters and numbers";
            } else {
                if ($this->user->findUserByName($username)) {
                    $emailError = "This username has already registered.";
                    echo "<script> alert('This username has already registered.'); </script>";
                };
            }
            
            if (empty($email)) {
                $emailError = "Enter your email";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailError = 'enter the correct format';
                echo "<script> alert('enter the correct email format'); </script>";
            } else {
                if ($this->user->findUserByEmail($email)) {
                    $emailError = "This email account has already registered.";
                    echo "<script> alert('This email account has already registered.'); </script>";
                };
            }
            
            if (strlen($password) < 6) {
                $passwordError = "must over 6";
                echo "<script> alert('Password must be at least 6 characters.'); </script>";
            }
            
            if ($password != $repeat) {
                $passwordError = "different password";
                echo "<script> alert('The password repeatation does not match.'); </script>";
                
            }
            
            if (empty($usernameError) && empty($emailError) && empty($passwordError)) {
                $password = password_hash($password, PASSWORD_DEFAULT);
                
                
                if ($this->user->register($username, $email, $password)) {
                    echo "<script> alert('Registered successfully, will return to login page in 3 seconds'); </script>";
                    header('refresh:1;url=../user/login.php');
                }
            }
 
        }
    }
    
   
}