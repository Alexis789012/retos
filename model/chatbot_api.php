<?php
session_start();
header('Content-Type: application/json; charset=UTF-8');

$config = include __DIR__ . "/config.php";
$apiKey = $config["api_key"];

$input = json_decode(file_get_contents("php://input"), true);
$userMessage = trim($input["message"] ?? "");

if (!$userMessage) {
    echo json_encode(["response" => "No se recibió ningún mensaje."]);
    exit;
}

// ══════════════════════════════════════════════
//  BASE DE DATOS DE PSICÓLOGOS POR ESTADO
// ══════════════════════════════════════════════
$psicologos = [
    "cdmx" => [
        "nombre_estado" => "Ciudad de México (CDMX)",
        "recursos" => [
            ["nombre" => "SAPTEL (Crisis 24h)", "tel" => "55 5259-8121", "tipo" => "Línea de crisis gratuita, 24/7"],
            ["nombre" => "UNAM – Servicio de Atención Psicológica", "tel" => "55 5025-8270", "tipo" => "Atención gratuita para jóvenes"],
            ["nombre" => "IMSS – Módulo de Salud Mental", "tel" => "800 623-2323", "tipo" => "Servicio médico del IMSS, consulta con seguro"],
            ["nombre" => "Centro de Salud Mental (CENSAM)", "tel" => "55 5513-3835", "tipo" => "Secretaría de Salud CDMX, bajo costo"],
            ["nombre" => "Línea de la Vida (SSA)", "tel" => "800 911-2000", "tipo" => "Línea nacional gratuita 24/7"],
        ]
    ],
    "jalisco" => [
        "nombre_estado" => "Jalisco",
        "recursos" => [
            ["nombre" => "Línea de Crisis Jalisco", "tel" => "33 3030-4222", "tipo" => "Atención en crisis, gratuita"],
            ["nombre" => "Hospital Civil de Guadalajara – Psiquiatría", "tel" => "33 3614-7743", "tipo" => "Atención de bajo costo"],
            ["nombre" => "IMSS Jalisco – Salud Mental", "tel" => "800 623-2323", "tipo" => "Seguro IMSS"],
            ["nombre" => "Universidad de Guadalajara – Clínica Psicológica", "tel" => "33 3134-2222", "tipo" => "Bajo costo para estudiantes y comunidad"],
            ["nombre" => "Línea de la Vida (SSA)", "tel" => "800 911-2000", "tipo" => "Línea nacional gratuita 24/7"],
        ]
    ],
    "nuevo leon" => [
        "nombre_estado" => "Nuevo León",
        "recursos" => [
            ["nombre" => "UANL – Centro de Orientación Psicológica", "tel" => "81 8329-4000", "tipo" => "Gratuito para estudiantes y comunidad"],
            ["nombre" => "Hospital Universitario – Psiquiatría", "tel" => "81 8347-3481", "tipo" => "Bajo costo"],
            ["nombre" => "Centro de Salud Mental Nuevo León", "tel" => "81 8342-4570", "tipo" => "Secretaría de Salud NL"],
            ["nombre" => "IMSS Nuevo León – Salud Mental", "tel" => "800 623-2323", "tipo" => "Seguro IMSS"],
            ["nombre" => "Línea de la Vida (SSA)", "tel" => "800 911-2000", "tipo" => "Línea nacional gratuita 24/7"],
        ]
    ],
    "puebla" => [
        "nombre_estado" => "Puebla",
        "recursos" => [
            ["nombre" => "BUAP – Centro de Atención Psicológica", "tel" => "222 229-5500 ext. 7570", "tipo" => "Gratuito para estudiantes y comunidad"],
            ["nombre" => "Hospital General de Puebla – Psiquiatría", "tel" => "222 249-0740", "tipo" => "Bajo costo SSA"],
            ["nombre" => "IMSS Puebla – Salud Mental", "tel" => "800 623-2323", "tipo" => "Seguro IMSS"],
            ["nombre" => "Línea de la Vida (SSA)", "tel" => "800 911-2000", "tipo" => "Línea nacional gratuita 24/7"],
        ]
    ],
    "estado de mexico" => [
        "nombre_estado" => "Estado de México",
        "recursos" => [
            ["nombre" => "UAEM – Centro de Atención Psicológica", "tel" => "72 2272-9600", "tipo" => "Gratuito para estudiantes"],
            ["nombre" => "Hospital Psiquiátrico 'Adolfo M. Nieto'", "tel" => "72 2217-6900", "tipo" => "Servicio público, bajo costo"],
            ["nombre" => "DIF Estado de México – Psicología", "tel" => "800 701-0800", "tipo" => "Apoyo familiar gratuito"],
            ["nombre" => "Línea de la Vida (SSA)", "tel" => "800 911-2000", "tipo" => "Línea nacional gratuita 24/7"],
        ]
    ],
    "veracruz" => [
        "nombre_estado" => "Veracruz",
        "recursos" => [
            ["nombre" => "UV – Centro de Atención Psicológica", "tel" => "228 842-1700", "tipo" => "Bajo costo para estudiantes y comunidad"],
            ["nombre" => "Hospital Psiquiátrico de Veracruz", "tel" => "228 812-2323", "tipo" => "Servicio público SSA"],
            ["nombre" => "IMSS Veracruz – Salud Mental", "tel" => "800 623-2323", "tipo" => "Seguro IMSS"],
            ["nombre" => "Línea de la Vida (SSA)", "tel" => "800 911-2000", "tipo" => "Línea nacional gratuita 24/7"],
        ]
    ],
    "guanajuato" => [
        "nombre_estado" => "Guanajuato",
        "recursos" => [
            ["nombre" => "Universidad de Guanajuato – Psicología", "tel" => "47 3732-0006", "tipo" => "Bajo costo para comunidad"],
            ["nombre" => "Hospital General de León – Psiquiatría", "tel" => "47 7716-3232", "tipo" => "SSA bajo costo"],
            ["nombre" => "DIF Guanajuato – Apoyo Psicológico", "tel" => "47 3735-1060", "tipo" => "Gratuito"],
            ["nombre" => "Línea de la Vida (SSA)", "tel" => "800 911-2000", "tipo" => "Línea nacional gratuita 24/7"],
        ]
    ],
    "chihuahua" => [
        "nombre_estado" => "Chihuahua",
        "recursos" => [
            ["nombre" => "UACH – Centro de Orientación Psicológica", "tel" => "61 4439-1500", "tipo" => "Bajo costo para estudiantes"],
            ["nombre" => "Centro Estatal de Salud Mental Chihuahua", "tel" => "61 4415-0023", "tipo" => "SSA bajo costo"],
            ["nombre" => "Línea de la Vida (SSA)", "tel" => "800 911-2000", "tipo" => "Línea nacional gratuita 24/7"],
        ]
    ],
    "yucatan" => [
        "nombre_estado" => "Yucatán",
        "recursos" => [
            ["nombre" => "UADY – Centro de Atención Psicológica", "tel" => "99 9924-8000", "tipo" => "Bajo costo para estudiantes y comunidad"],
            ["nombre" => "Hospital Psiquiátrico Yucatán", "tel" => "99 9923-5757", "tipo" => "SSA bajo costo"],
            ["nombre" => "Línea de la Vida (SSA)", "tel" => "800 911-2000", "tipo" => "Línea nacional gratuita 24/7"],
        ]
    ],
    "oaxaca" => [
        "nombre_estado" => "Oaxaca",
        "recursos" => [
            ["nombre" => "UABJO – Clínica Psicológica", "tel" => "95 1516-0008", "tipo" => "Bajo costo para comunidad"],
            ["nombre" => "Hospital General de Oaxaca – Psiquiatría", "tel" => "95 1515-9800", "tipo" => "SSA bajo costo"],
            ["nombre" => "Línea de la Vida (SSA)", "tel" => "800 911-2000", "tipo" => "Línea nacional gratuita 24/7"],
        ]
    ],
];

function detectarEstado($mensaje, $psicologos) {
    $mensaje = mb_strtolower($mensaje, 'UTF-8');
    $aliases = [
        "cdmx"           => ["cdmx", "ciudad de mexico", "ciudad de méxico", "df", "d.f.", "capital"],
        "jalisco"        => ["jalisco", "guadalajara", "zapopan"],
        "nuevo leon"     => ["nuevo leon", "nuevo león", "monterrey", "nl"],
        "puebla"         => ["puebla"],
        "estado de mexico" => ["estado de mexico", "estado de méxico", "edomex", "toluca", "nezahualcoyotl", "nezahualcóyotl", "ecatepec", "neza"],
        "veracruz"       => ["veracruz", "xalapa", "boca del rio"],
        "guanajuato"     => ["guanajuato", "leon", "irapuato", "celaya"],
        "chihuahua"      => ["chihuahua", "juarez", "ciudad juárez"],
        "yucatan"        => ["yucatan", "yucatán", "merida", "mérida"],
        "oaxaca"         => ["oaxaca"],
    ];
    foreach ($aliases as $key => $words) {
        foreach ($words as $word) {
            if (strpos($mensaje, $word) !== false) {
                return $key;
            }
        }
    }
    return null;
}

$estadoDetectado = detectarEstado($userMessage, $psicologos);
if ($estadoDetectado) {
    $_SESSION['estado_usuario'] = $estadoDetectado;
}

$bloquePsicologos = "";
$estadoEnSesion = $_SESSION['estado_usuario'] ?? null;
if ($estadoEnSesion && isset($psicologos[$estadoEnSesion])) {
    $est = $psicologos[$estadoEnSesion];
    $bloquePsicologos = "\n\nEl usuario está en {$est['nombre_estado']}. Si pide ayuda psicológica o recursos de apoyo, DEBES proporcionar estos contactos reales:\n";
    foreach ($est['recursos'] as $r) {
        $bloquePsicologos .= "- {$r['nombre']}: Tel. {$r['tel']} ({$r['tipo']})\n";
    }
    $bloquePsicologos .= "Siempre que menciones estos recursos, preséntalos de forma clara con nombre, teléfono y tipo de servicio.";
}

$estadosDisponibles = implode(", ", array_column($psicologos, "nombre_estado"));

// ══════════════════════════════════════════════
//  SYSTEM PROMPT
// ══════════════════════════════════════════════
$systemPrompt = "
Eres ThinkBot, el asistente virtual de ThinkChallenge, una plataforma dedicada a ayudar a jóvenes a evitar retos virales peligrosos en redes sociales y a cuidar su salud mental y bienestar digital.

**Tu personalidad:**
- Empático, amigable y cercano. Hablas con los jóvenes de tú a tú, sin ser condescendiente.
- Nunca juzgas. Siempre ofreces comprensión antes que consejos.
- Eres serio cuando la situación lo requiere (crisis, peligro) pero accesible y humano.

**Temas en los que puedes ayudar:**
1. Retos virales peligrosos: identificarlos, cómo negarse a participar, qué hacer si alguien te presiona.
2. Salud mental: ansiedad, presión social, autoestima, depresión leve, estrés escolar/social.
3. Redes sociales: uso saludable, adicción digital, cyberbullying, privacidad.
4. Apoyo emocional: escuchar, orientar, contener sin diagnosticar.
5. Recursos profesionales: psicólogos y líneas de crisis en México según el estado del usuario.

**Regla de estado/ubicación:**
- Si el usuario pide ayuda psicológica, contactos o recursos profesionales, DEBES preguntarle en qué estado de México vive si aún no lo sabes.
- Estados disponibles con recursos: $estadosDisponibles.
- Si menciona una ciudad o estado fuera de la lista, igual proporciona la Línea de la Vida: 800 911-2000 (gratuita 24/7) y SAPTEL: 55 5259-8121 como opciones nacionales.
- Nunca inventes números de teléfono. Solo usa los que se te proporcionan en el contexto.
$bloquePsicologos

**Reglas de seguridad:**
- Si el usuario expresa que está en crisis, quiere hacerse daño o habla de suicidio: PRIMERO valida sus sentimientos con empatía, DESPUÉS proporciona inmediatamente la Línea de la Vida: 800 911-2000 y SAPTEL: 55 5259-8121, y pídele que llame ahora.
- Nunca minimices el dolor de alguien ni digas frases como 'no es para tanto'.
- No hagas diagnósticos clínicos. Orienta y refiere a profesionales.

**Restricciones:**
- No respondas preguntas sobre política, religión, finanzas, tecnología ajena al tema, o cualquier tema fuera del bienestar digital y salud mental de jóvenes.
- Si alguien pregunta algo fuera de tu alcance responde: 'Solo puedo ayudarte con temas de salud mental, retos virales y bienestar digital. Para otros temas, busca el servicio adecuado.'

**Formato:**
- Respuestas claras y concisas. Máximo 3-4 párrafos.
- Usa emojis con moderación para humanizar las respuestas (💙🧠✅⚠️).
- Cuando listes recursos, hazlo con viñetas claras: nombre, teléfono, descripción.
";

// ══════════════════════════════════════════════
//  HISTORIAL DE CONVERSACIÓN
// ══════════════════════════════════════════════

// Resetear si algún mensaje tiene formato Gemini (con 'parts')
if (!empty($_SESSION['chat_history'])) {
    foreach ($_SESSION['chat_history'] as $msg) {
        if (isset($msg['parts'])) {
            $_SESSION['chat_history'] = [];
            break;
        }
    }
}
if (!isset($_SESSION['chat_history'])) {
    $_SESSION['chat_history'] = [];
}

// Agregar mensaje del usuario en formato Groq (igual que OpenAI)
$_SESSION['chat_history'][] = ["role" => "user", "content" => $userMessage];

// Limitar a 20 mensajes para no exceder tokens
if (count($_SESSION['chat_history']) > 20) {
    $_SESSION['chat_history'] = array_slice($_SESSION['chat_history'], -20);
}

// Construir array de mensajes con system prompt al inicio
$mensajes = array_merge(
    [["role" => "system", "content" => $systemPrompt]],
    $_SESSION['chat_history']
);

// ══════════════════════════════════════════════
//  LLAMADA A GROQ API (Optimizado para Vercel)
// ══════════════════════════════════════════════
$data = [
    "model" => "llama-3.1-8b-instant",
    "messages"    => $mensajes,
    "max_tokens"  => 500,
    "temperature" => 0.7
];

$url = "https://api.groq.com/openai/v1/chat/completions";

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
    "Authorization: Bearer " . trim($apiKey)
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

// Tiempos de espera obligatorios para evitar huelgas en microservicios cloud
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10); 
curl_setopt($ch, CURLOPT_TIMEOUT, 30); 

// Manejo seguro de certificados SSL en proxies de producción
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

$response = curl_exec($ch);

if (curl_errno($ch)) {
    $errorStr = curl_error($ch);
    echo json_encode(["response" => "⚠️ Error de red en el servidor cloud: $errorStr"]);
    exit;
}

$result = json_decode($response, true);

if (isset($result["choices"][0]["message"]["content"])) {
    $botResponse = trim($result["choices"][0]["message"]["content"]);
    // Guardar respuesta del bot en historial
    $_SESSION['chat_history'][] = ["role" => "assistant", "content" => $botResponse];
    echo json_encode(["response" => $botResponse]);
} else {
    // Si la API Key falla o está vacía, Groq devuelve la estructura de error aquí
    $errorMsg = $result["error"]["message"] ?? "Error de autenticación o cuota excedida con Groq.";
    echo json_encode(["response" => "🤖 Ups, el chatbot experimenta una interrupción: $errorMsg"]);
}
