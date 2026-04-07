<?php
header("Content-Type: application/json");

$file = __DIR__ . "/schedules.json";

$data = json_decode(file_get_contents("php://input"), true);

$requiredFields = ['produto', 'tamanho', 'cor', 'quantidade', 'customerName', 'customerEmail', 'customerPhone', 'scheduledDate'];
foreach ($requiredFields as $field) {
    if (empty($data[$field])) {
        echo json_encode(["success" => false, "message" => "O campo '$field' é obrigatório."]);
        exit;
    }
}

if (!file_exists($file)) {
    file_put_contents($file, json_encode([]));
}

$current = json_decode(file_get_contents($file), true);
if (!is_array($current)) {
    $current = [];
}

$current[] = $data;

if (file_put_contents($file, json_encode($current, JSON_PRETTY_PRINT))) {
    echo json_encode(["success" => true, "message" => "Agendamento salvo com sucesso!"]);
} else {
    echo json_encode(["success" => false, "message" => "Erro ao salvar o agendamento."]);
}