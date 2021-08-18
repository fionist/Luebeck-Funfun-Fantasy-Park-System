<?php 
include 'TicketDB.php';
/**
 * Info processor of Latest Release page, contains operations on posts
 * @author Lin Han
 *
 */
class News extends TicketDB{
    
    /**
     * fields of the class which generates a database variable
     */
    private $db;
    
    /**
     * constructor to create the db object, provides connection to the database
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
     * method to find all latest release in the database, ordered by 'create_time'
     * @return array $results, all posts in the database
     */
    public function findAllPosts() {
        $sql = 'SELECT * FROM news ORDER BY create_time DESC';
        $stmt = $this->db->connect()->query($sql);
        $results = $stmt->fetchAll();
        
        return $results;
    }
    
    /**
     * function to add a new post in the database
     * @param array $data, send title and body to the database
     * @return boolean, return true after execution
     */
    public function addPost($data) {
        $id = '99109';
        $title = $data['title'];
        $body = $data['body'];
        
        $sql = "INSERT INTO news (user_id, title, body) VALUES ('$id', '$title', '$body')";
        $stmt = $this->db->connect()->query($sql);
        
        return true;
    }
    
    /**
     * method to find a specific latest release(post) with id in the database
     * @param int $id, the id of the post
     * @return array, return the post
     */
    public function findPostById($id) {
        $sql = "SELECT * FROM news WHERE id = '$id'";
        $stmt = $this->db->connect()->query($sql);
        $row = $stmt->fetch();
        
        return $row;
    }
    
    /**
     * method to show all the posts when page opened
     * @return array $data, all posts
     */
    public function index() {
        $posts = $this->findAllPosts();
        
        $data = ['posts' => $posts];
        return $data;
    }
    
    /**
     * function to create a post in the database
     */
    public function create() {
        if ($this->isAdmin()) {
            header('location:../news/create.php');
        }
        
        $data = ['title' => '', 'body' => '', 'titleError' => '', 'bodyError' => ''];
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            $data = [
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'titleError' => '',
                'bodyError' => '',
            ];
            
            
            if (empty($data['title'])) {
                $data['titleError'] = 'The title can not be empty.';
            }
            
            if (empty($data['body'])) {
                $data['bodyError'] = 'The content can not be empty.';
            }
            
            if (empty($data['titleError']) && empty($data['bodyError'])) {
                $this->addPost($data);
                header('location:../news/news_page.php');
            }
        }
        
    }
    
    /**
     * function to update a post in the database
     * @param array $data, info of the post, contains title and body
     * @return boolean, return true after execution
     */
    public function updatePost($data) {
        $id = $data['id'];
        $title = $data['title'];
        $body = $data['body'];
        
        $sql = "UPDATE news SET title = '$title', body = '$body' WHERE id = '$id'";
        $stmt = $this->db->connect()->query($sql);
        
        return  true;
    }
    
    /**
     * funcion to update a post with the specific id
     * @param int $id, post id
     */
    public function update($id) {
        $post = $this->findPostById($id);
        
        if ($this->isAdmin()) {
            header('location: ../news/update.php');
        }
        
        $data = [
            'post' => $post,
            'title' => '',
            'body' => '',
            'titleError' => '',
            'bodyError' => ''
        ];
        
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            $data = [
                'id' => $id,
                'post' => $post,
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'titleError' => '',
                'bodyError' => ''
            ];
            
            if (empty($data['title'])) {
                $data['titleError'] = 'The title can not be empty.';
            }
            
            if (empty($data['body'])) {
                $data['bodyError'] = 'The content can not be empty.';
            }
            
            if ($data['title'] == $this->findPostById($id)->title) {
                $data['titleError'] = 'At least change the title';
            }
            
            if ($data['body'] == $this->findPostById($id)->body) {
                $data['bodyError'] = 'At least change the content';
            }
            
            if (empty($data['titleError']) && empty($data['bodyError'])) {
                $this->updatePost($data);
                header('location:../news/news_page.php');
            }
        
        }
    }
    
    /**
     * delete a post in the database with the specific id
     * @param int $id, post id
     * @return boolean, return true after execution
     */
    public function deletePost($id) {
        $sql = "DELETE FROM news WHERE id = '$id'";
        $stmt = $this->db->connect()->query($sql);
        
        return  true;
    }
    

    
    
}

?>