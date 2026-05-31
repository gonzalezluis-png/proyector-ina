<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Content-Type');

$file = __DIR__ . '/himno_actual.json';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $body = file_get_contents('php://input');
    $data = json_decode($body, true);
    if (!$data) { http_response_code(400); echo '{"error":"invalid json"}'; exit; }
    $data['ts'] = time();
    file_put_contents($file, json_encode($data));
    echo json_encode(['ok' => true]);
} else {
    if (!file_exists($file)) {
        echo json_encode(['numero' => '', 'libro' => '', 'ts' => 0]);
    } else {
        echo file_get_contents($file);
    }
}
