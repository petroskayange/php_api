<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/branch.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog branch object
  $branch = new Branch($db);

  // Get raw posted data
  // $data = json_decode(file_get_contents("php://input"));

  // Set ID to update
  $branch->id = $_GET['id'];

  // Delete branch
  if($branch->delete()) {
    echo json_encode(
      array('message' => $_GET['id'])
    );
  } else {
    echo json_encode(
      array('message' => 'Branch Not Deleted')
    );
  }

