<?php 
  class Login {
    // DB stuff
    private $conn;
    private $table = 'login';

    // Post Properties
    public $id;
    public $paymentID;
    public $referenceNumber;
    public $amount;
    public $type;
    public $date;
    public $userID;

    public $category_id;
    public $category_name;
    public $title;
    public $body;
    public $author;
    public $created_at;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get Posts
    public function read() {
      // Create query
      $query = 'SELECT c.name as category_name, p.id, p.category_id, p.title, p.body, p.author, p.created_at
                                FROM ' . $this->table . ' p
                                LEFT JOIN
                                  categories c ON p.category_id = c.id
                                ORDER BY
                                  p.created_at DESC';
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }
  public function getLoginId(){
    // Create query
    $query = 'SELECT loginID FROM ' . $this->table . ' ORDER BY loginID DESC LIMIT 1';

    // Prepare statement
    $stmt = $this->conn->prepare($query);

    // Execute query
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
              
              
    // Set properties
    $loginID = $row['loginID'];
    return $loginID;
  }
    // Get Single Post
    public function read_single() {
          // Create query
          $query = 'SELECT p.username, p.password,p.role , c.loginID, c.Contact, c.Address, c.Email, c.LastName, c.firstName
                                    FROM ' . $this->table . ' p
                                    LEFT JOIN
                                    user c ON p.loginID = c.loginID
                                    WHERE
                                      p.username = ? && p.password = ?
                                    LIMIT 0,1';

                                    

          // Prepare statement
          $stmt = $this->conn->prepare($query);
          
          // Bind ID
          $stmt->bindParam(1, $this->username);
          $stmt->bindParam(2, $this->password);
          // Execute query
          $stmt->execute();
        // }
        // else
        // header('HTTP/1.1 401 Unauthorized', true, 401);
      
        
          $row = $stmt->fetch(PDO::FETCH_ASSOC);
          
          
          // Set properties
          $this->username = $row['username'];
          $this->loginID = $row['loginID'];
          $this->Contact = $row['Contact'];
          $this->Address = $row['Address'];
          $this->Email = $row['Email'];
          $this->LastName = $row['LastName'];
          $this->firstName = $row['firstName'];
          $this->role = $row['role'];

         
    }
    public function read_single_username() {
      // Create query
      $query = 'SELECT * FROM ' . $this->table . ' WHERE username = ? ';

                                

      // Prepare statement
      $stmt = $this->conn->prepare($query);
      
      // Bind ID
      $stmt->bindParam(1, $this->username);
      // Execute query
      $stmt->execute();
      if($stmt->fetch(PDO::FETCH_ASSOC) != "") {
        return false;
      }

      return true;
}
    function console_log($message) {
      $STDERR = fopen("php://stderr", "w");
                fwrite($STDERR, "\n".$message."\n\n");
                fclose($STDERR);
  }
    // Create Post
    public function createLogin() {
          // Create query
          $query = 'INSERT INTO ' . $this->table . ' SET username = :username, password = :password, role = :role';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->username = htmlspecialchars(strip_tags($this->username));
          $this->password = htmlspecialchars(strip_tags($this->password));
          $this->role = htmlspecialchars(strip_tags($this->role));

          // Bind data
          $stmt->bindParam(':username', $this->username);
          $stmt->bindParam(':password', $this->password);
          $stmt->bindParam(':role', $this->role);

          // Execute query
          $stmt->execute();
      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

      return false;
    }

    // Update Post
    public function update() {
          // Create query
          $query = 'UPDATE ' . $this->table . '
                                SET title = :title, body = :body, author = :author, category_id = :category_id
                                WHERE id = :id';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->title = htmlspecialchars(strip_tags($this->title));
          $this->body = htmlspecialchars(strip_tags($this->body));
          $this->author = htmlspecialchars(strip_tags($this->author));
          $this->category_id = htmlspecialchars(strip_tags($this->category_id));
          $this->id = htmlspecialchars(strip_tags($this->id));

          // Bind data
          $stmt->bindParam(':title', $this->title);
          $stmt->bindParam(':body', $this->body);
          $stmt->bindParam(':author', $this->author);
          $stmt->bindParam(':category_id', $this->category_id);
          $stmt->bindParam(':id', $this->id);

          // Execute query
          if($stmt->execute()) {
            return true;
          }

          // Print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);

          return false;
    }

    // Delete Post
    public function delete() {
          // Create query
          $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->id = htmlspecialchars(strip_tags($this->id));

          // Bind data
          $stmt->bindParam(':id', $this->id);

          // Execute query
          if($stmt->execute()) {
            return true;
          }

          // Print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);

          return false;
    }
    
  }