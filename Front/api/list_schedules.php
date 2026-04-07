<?php
header("Content-Type: application/json");

$file = __DIR__ . "/schedules.json";

if (!file_exists($file)) {
    echo json_encode(["success" => true, "schedules" => []]);
    exit;
}

$data = json_decode(file_get_contents($file), true);
if (!is_array($data)) {
    $data = [];
}

echo json_encode([
    "success" => true,
    "schedules" => $data
]);