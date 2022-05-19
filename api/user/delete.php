<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  
  include_once '../../config/Database.php';
  include_once '../../models/login.php';
  include_once '../../models/user.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog user object
  $user = new User($db);
  $login = new Login($db);

  // Get raw posted data
  // $data = json_decode(file_get_contents("php://input"));

  // Set ID to update
  $user->loginID = $_POST['loginID'];
  $login->loginID = $_POST['loginID'];

  // Update user
  if($user->delete() && $login->delete()) {
    echo json_encode(
      array('message' => 'Deleted')
    );
  } else {
    echo json_encode(
      array('message' => 'Post Not Deleted')
    );
  }

