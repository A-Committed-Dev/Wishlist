
<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $input = json_decode(file_get_contents('php://input'), true);

  if ($input === null) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid JSON input']);
    exit;
  }

  if (!isset($input['wishes']) || !is_array($input['wishes'])) {
    http_response_code(400);
    echo json_encode(['error' => "Input must contain a 'wishes' array"]);
    exit;
  }

  // Directly overwrite file
  $result = file_put_contents(
    JSON_FILE,
    json_encode($input, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
  );

  if ($result === false) {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to write to file']);
  } else {
    echo json_encode(['success' => true, 'message' => 'Wishes file updated']);
  }
} else {
  http_response_code(405);
  echo json_encode(['error' => 'Method not allowed']);
}
