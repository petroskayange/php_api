<?php 
  class Payment {
    // DB stuff
    private $conn;
    private $table = 'payment';

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
    public $paymentMethod;
    public $paymentAt;
    public $quantity;
    public $destination;
    public $status;

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

    // Get Single Post
    public function read_single() {
          // Create query
          $query = 'SELECT c.name,c.quantity, c.destination, p.amount, p.status
                                    FROM ' . $this->table . ' p
                                    LEFT JOIN
                                      parcel c ON p.referenceNumber = c.referenceNumber
                                    WHERE
                                      p.referenceNumber = ?
                                    LIMIT 0,1';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Bind ID
          $stmt->bindParam(1, $this->referenceNumber);

          // Execute query
          $stmt->execute();

          $row = $stmt->fetch(PDO::FETCH_ASSOC);

          // Set properties
          $this->name = $row['name'];
          $this->status = $row['status'];
          $this->quantity = $row['quantity'];
          $this->destination = $row['destination'];
          $this->amount = $row['amount'];
    }

    // Create Post
    public function create() {
          // Create query
          $query = 'INSERT INTO ' . $this->table . ' SET referenceNumber = :referenceNumber, amount = :amount, type = :type, userID = :userID, date = :date, paymentMethod = :paymentMethod, paymentAt = :paymentAt, status = :status';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->referenceNumber = htmlspecialchars(strip_tags($this->referenceNumber));
          $this->amount = htmlspecialchars(strip_tags($this->amount));
          $this->type = htmlspecialchars(strip_tags($this->type));
          $this->userID = htmlspecialchars(strip_tags($this->userID));
          $this->date = htmlspecialchars(strip_tags($this->date));
          $this->status = htmlspecialchars(strip_tags($this->status));
          $this->paymentMethod = htmlspecialchars(strip_tags($this->paymentMethod));
          $this->paymentAt = htmlspecialchars(strip_tags($this->paymentAt));

          // Bind data
          $stmt->bindParam(':referenceNumber', $this->referenceNumber);
          $stmt->bindParam(':amount', $this->amount);
          $stmt->bindParam(':type', $this->type);
          $stmt->bindParam(':userID', $this->userID);
          $stmt->bindParam(':date', $this->date);
          $stmt->bindParam(':status', $this->status);
          $stmt->bindParam(':paymentMethod', $this->paymentMethod);
          $stmt->bindParam(':paymentAt', $this->paymentAt);

          // Execute query
          if($stmt->execute()) {
            return true;
      }

      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

      return false;
    }

    // Update Post
    public function update() {
          // Create query
          $query = 'UPDATE ' . $this->table . '
                                SET status = :status
                                WHERE referenceNumber = :referenceNumber';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->status = htmlspecialchars(strip_tags($this->status));
          $this->referenceNumber = htmlspecialchars(strip_tags($this->referenceNumber));

          // Bind data
          
          $stmt->bindParam(':status', $this->status);
          $stmt->bindParam(':referenceNumber', $this->referenceNumber);

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