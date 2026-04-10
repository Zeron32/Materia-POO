<?php
header("Content-Type: application/json");
require_once __DIR__ . "/Schedule.php";

$schedule = new Schedule();
$data = json_decode(file_get_contents("php://input"), true);

$error = $schedule->validate($data);
if ($error) {
    echo json_encode(["success" => false, "message" => $error]);
    exit;
}

if ($schedule->save($data)) {
    echo json_encode(["success" => true, "message" => "Agendamento salvo com sucesso!"]);
} else {
    echo json_encode(["success" => false, "message" => "Erro ao salvar."]);
}
?>
