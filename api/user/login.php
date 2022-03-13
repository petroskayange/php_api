<?php
 // Headers
 header('Access-Control-Allow-Origin: *');
 header('Content-Type: application/json');
 header('Access-Control-Allow-Methods: POST');
 header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

 
 include_once '../../config/Database.php';
 include_once '../../models/login.php';
 include_once '../../models/user.php';

 if($_POST['username']  && $_POST['password'])
 {
     // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $post = new Login($db);

  // Get ID
  $post->username = $_POST['username'];
  $post->password = $_POST['password'];

  // Get post
  $post->read_single();
// Create array
if($post->username)
{
    $post_arr = array(
    'username' => $post->username,
    'loginID' => $post->loginID,
    'Contact' => $post->Contact,
    'Address' => $post->Address,
    'Email' => $post->Email,
    'LastName' => $post->LastName,
    'firstName' => $post->firstName,
    'role' => $post->role
  );

  // Make JSON
  print_r(json_encode($post_arr));
}
else
header('HTTP/1.1 401 Unauthorized', true, 401);
  
    
 }else
header('HTTP/1.1 401 Unauthorized', true, 401);

function console_log($message) {
    $STDERR = fopen("php://stderr", "w");
              fwrite($STDERR, "\n".$message."\n\n");
              fclose($STDERR);
}
?>