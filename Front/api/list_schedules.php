<?php
header("Content-Type: application/json");
require_once __DIR__ . "/Schedule.php";

$schedule = new Schedule();
$schedules = $schedule->getAll();

echo json_encode([
    "success" => true,
    "schedules" => $schedules
]);
?>
