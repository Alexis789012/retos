<?php
// 1. Intentar leer la variable directamente desde el sistema de Vercel u hospedaje en la nube
$apiKey = getenv('GROQ_API_KEY') ?: ($_ENV['GROQ_API_KEY'] ?? null);

// 2. Si el paso anterior falla (por ejemplo, en local), intentar leer el archivo .env de respaldo
if (empty($apiKey)) {
    $envPath = __DIR__ . '/../.env';
    if (file_exists($envPath)) {
        $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            if (strpos(trim($line), '#') === 0) continue;
            if (strpos($line, '=') !== false) {
                list($name, $value) = explode('=', $line, 2);
                if (trim($name) === 'GROQ_API_KEY') {
                    $apiKey = trim($value, " \t\n\r\0\x0B\"'");
                    break;
                }
            }
        }
    }
}

// Retornar la API Key de forma segura sin romper el flujo
return [
    "api_key" => $apiKey
];
