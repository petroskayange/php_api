<?php

  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Notification.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  // Instantiate blog notification object
  $notification = new Notification($db);

  // Get ID
  $notification->referenceNumber = isset($_GET['id']) ? $_GET['id'] : die();

  // Get post
  $notification->read_single();

  // Create array
  $notification_arr = array(
    'referenceNumber' => $notification->referenceNumber,
    'PackageStatus' => $notification->PackageStatus
  );

  // Make JSON
  print_r(json_encode($notification_arr));
