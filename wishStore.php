<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
  http_response_code(200);
  exit;
}

header("Content-Type: application/json; charset=UTF-8");

define('JSON_FILE', 'wishes.json');

// Ensure file exists
if (!file_exists(JSON_FILE)) {
  file_put_contents(JSON_FILE, json_encode(['wishes' => []]));
}

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
  $data = json_decode(file_get_contents(JSON_FILE), true);
  echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
} elseif ($method === 'POST') {
  $input = json_decode(file_get_contents('php://input'), true);

  $requiredFields = ['url', 'imgUrl', 'title', 'desc', 'category', 'id'];
  foreach ($requiredFields as $field) {
    if (!isset($input[$field]) || empty($input[$field])) {
      http_response_code(400);
      echo json_encode(['error' => "Field '$field' is required."]);
      exit;
    }
  }

  // Read current wishes
  $data = json_decode(file_get_contents(JSON_FILE), true);

  // Make sure top-level 'wishes' exists
  if (!isset($data['wishes']) || !is_array($data['wishes'])) {
    $data['wishes'] = [];
  }

  // Add new wish
  $data['wishes'][] = [
    'url' => $input['url'],
    'imgUrl' => $input['imgUrl'],
    'title' => $input['title'],
    'desc' => $input['desc'],
    'category' => $input['category'],
    'id' => $input['id']
  ];

  // Save back
  file_put_contents(JSON_FILE, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));

  echo json_encode(['success' => true, 'wish' => $input]);
} else {
  http_response_code(405);
  echo json_encode(['error' => 'Method not allowed']);
}
