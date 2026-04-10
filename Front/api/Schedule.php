<?php
class Schedule {
    private string $filePath;
    
    public function __construct() {
        $this->filePath = __DIR__ . '/../schedules.json';
        $this->ensureFileExists();
    }
    
    private function ensureFileExists(): void {
        if (!file_exists($this->filePath)) {
            file_put_contents($this->filePath, json_encode([]));
        }
    }
    
    public function getAll(): array {
        $data = json_decode(file_get_contents($this->filePath), true);
        return is_array($data) ? $data : [];
    }
    
    
    public function save(array $data): bool {
        $current = $this->getAll();
        $data['id'] = uniqid();
        $data['createdAt'] = date('Y-m-d H:i:s');
        $current[] = $data;
        
        return file_put_contents($this->filePath, json_encode($current, JSON_PRETTY_PRINT)) !== false;
    }
    
    
    public function validate(array $data): ?string {
        $required = ['produto', 'tamanho', 'cor', 'quantidade', 'customerName', 'customerEmail', 'customerPhone', 'scheduledDate'];
        
        foreach ($required as $field) {
            if (empty($data[$field])) {
                return "O campo '$field' é obrigatório.";
            }
        }
        
        if (!filter_var($data['customerEmail'], FILTER_VALIDATE_EMAIL)) {
            return "Email inválido.";
        }
        
        return null;
    }
}
?>