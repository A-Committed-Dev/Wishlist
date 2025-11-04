<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

if (!isset($_GET['url'])) {
    http_response_code(400);
    echo json_encode(["error" => "Missing url parameter"]);
    exit;
}

$url = $_GET['url'];

// Basic validation
if (!filter_var($url, FILTER_VALIDATE_URL)) {
    http_response_code(400);
    echo json_encode(["error" => "Invalid URL"]);
    exit;
}

// Prevent accessing internal addresses (simple SSRF protection)
$forbidden = ['/^https?:\/\/(localhost|127\.0\.0\.1|::1)/i'];
foreach ($forbidden as $pattern) {
    if (preg_match($pattern, $url)) {
        http_response_code(403);
        echo json_encode(["error" => "Access denied"]);
        exit;
    }
}

// Use cURL to fetch the remote HTML
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_USERAGENT, 'MyScraper/1.0'); // polite UA
$html = curl_exec($ch);
$err = curl_error($ch);
$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($html === false || $code >= 400) {
    http_response_code(502);
    echo json_encode(["error" => "Failed to fetch page", "details" => $err, "http_code" => $code]);
    exit;
}

echo json_encode(["html" => $html]);
