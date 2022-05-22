<?php 
  class Notification {
    // DB stuff
    private $conn;
    private $table = 'notification';

    // Post Properties
    public $id;
    public $name;
    public $referenceNumber;
    public $amount;
    public $type;
    public $date;
    public $weight;

    public $quantity;
    public $category_name;
    public $receiver_phone;
    public $description;
    public $destination;
    public $created_at;
    public $PackageStatus;
    public $location;
    public $parcelID;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get Posts
    public function read() {
      // Create query
      $query = 'SELECT * FROM ' . $this->table . ' n
                                LEFT JOIN
                                parcel p ON p.parcelID = n.notificationParcelID';
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Get Single Post
    public function read_single() {
      // Create query
      $query = 'SELECT * FROM ' . $this->table . ' p
                                LEFT JOIN
                                  parcel c ON p.parcelID = c.parcelID
                                WHERE
                                  referenceNumber = ?
                                  order by notificationID desc
                                LIMIT 0,1';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Bind ID
      $stmt->bindParam(1, $this->referenceNumber);

      // Execute query
      $stmt->execute();

      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      // Set properties
      $this->referenceNumber = $row['referenceNumber'];
      $this->PackageStatus = $row['location'];
}

    // Create Post
   // Create Post
   public function create() {

     // Create query
     $query = 'UPDATE ' . $this->table . '
     SET currentLocation = :currentLocation WHERE parcelID = :parcelID';

    // Prepare statement
    $stmt = $this->conn->prepare($query);

    // Bind data
    $stmt->bindParam(':currentLocation', $this->location);
    $stmt->bindParam(':parcelID', $this->parcelID);
    $stmt->execute();

    // n.currentLocation,
    // Create query
    $query = 'INSERT INTO ' . $this->table . ' SET PackageStatus = :PackageStatus, parcelID = :parcelID, location = :location';

    // Prepare statement
    $stmt = $this->conn->prepare($query);

    // Clean data
    $this->PackageStatus = htmlspecialchars(strip_tags($this->PackageStatus));
    $this->parcelID = htmlspecialchars(strip_tags($this->parcelID));
    $this->location = htmlspecialchars(strip_tags($this->location));

    // Bind data
    $stmt->bindParam(':PackageStatus', $this->PackageStatus);
    $stmt->bindParam(':parcelID', $this->parcelID);
    $stmt->bindParam(':location', $this->location);

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