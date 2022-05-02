<?php 
  class Parcel {
    // DB stuff
    private $conn;
    private $table = 'parcel';

    // Post Properties
    public $id;
    public $name;
    public $referenceNumber;
    public $amount;
    public $paymentMethod;
    public $type;
    public $date;
    public $weight;
    public $status;

    public $quantity;
    public $category_name;
    public $receiver_phone;
    public $description;
    public $destination;
    public $created_at;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }
    public function getParcelLastId(){
      // Create query
      $query = 'SELECT parcelID FROM ' . $this->table . ' ORDER BY parcelID DESC LIMIT 1';
  
      // Prepare statement
      $stmt = $this->conn->prepare($query);
  
      // Execute query
      $stmt->execute();
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
                
                
      // Set properties
      $loginID = $row['parcelID'];
      return $loginID;
    }
    // Get Posts
    public function read() {
      // Create query
      $query = 'SELECT * FROM ( SELECT 
              p.parcelID,
              p.name,
              p.description, 
              p.type,
              p.fee,
              p.destination, 
              p.referenceNumber, 
              p.weight,
              p.amount,
              p.receiver_phone, 
              p.quantity,
              n.PackageStatus, 
              n.message,
              n.location,
              n.notificationID,
              t.status,
              t.paymentMethod
              FROM ' . $this->table . ' p
                                INNER JOIN notification n ON p.parcelID = n.parcelID 
                                LEFT JOIN payment t ON t.referenceNumber = p.referenceNumber 
                                order by n.notificationID desc) AS tmp_table GROUP BY parcelID';
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Get Single Post
    public function read_single() {
          // Create query
          $query = 'SELECT c.name,c.quanity, c.destination, c.fee, 
                                    FROM ' . $this->table . ' p
                                    LEFT JOIN
                                      categories c ON p.category_id = c.id
                                    WHERE
                                      p.id = ?
                                    LIMIT 0,1';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Bind ID
          $stmt->bindParam(1, $this->id);

          // Execute query
          $stmt->execute();

          $row = $stmt->fetch(PDO::FETCH_ASSOC);

          // Set properties
          $this->title = $row['title'];
          $this->body = $row['body'];
          $this->author = $row['author'];
          $this->category_id = $row['category_id'];
          $this->category_name = $row['category_name'];
    }

    // Create Post
    public function create() {
          // Create query
          $query = 'INSERT INTO ' . $this->table . ' SET name = :name, amount = :amount, weight = :weight, quantity = :quantity, referenceNumber = :referenceNumber, receiver_phone = :receiver_phone, description = :description, destination = :destination';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->name = htmlspecialchars(strip_tags($this->name));
          $this->weight = htmlspecialchars(strip_tags($this->weight));
          $this->amount = htmlspecialchars(strip_tags($this->amount));
          $this->quantity = htmlspecialchars(strip_tags($this->quantity));
          $this->referenceNumber = htmlspecialchars(strip_tags($this->referenceNumber));
          $this->receiver_phone = htmlspecialchars(strip_tags($this->receiver_phone));
          $this->description = htmlspecialchars(strip_tags($this->description));
          $this->destination = htmlspecialchars(strip_tags($this->destination));

          // Bind data
          $stmt->bindParam(':name', $this->name);
          $stmt->bindParam(':amount', $this->amount);
          $stmt->bindParam(':weight', $this->weight);
          $stmt->bindParam(':quantity', $this->quantity);
          $stmt->bindParam(':referenceNumber', $this->referenceNumber);
          $stmt->bindParam(':receiver_phone', $this->receiver_phone);
          $stmt->bindParam(':description', $this->description);
          $stmt->bindParam(':destination', $this->destination);

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
                                SET PackageStatus = :PackageStatus WHERE parcelID = :parcelID';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->PackageStatus = htmlspecialchars(strip_tags($this->PackageStatus));
          $this->parcelID = htmlspecialchars(strip_tags($this->parcelID));

          // Bind data
          $stmt->bindParam(':PackageStatus', $this->PackageStatus);
          $stmt->bindParam(':parcelID', $this->parcelID);

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