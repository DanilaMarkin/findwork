<?php
// Подключение к API GPT-3 (нужно использовать ваш API ключ)
$api_key = "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";
$url = "https://api.openai.com/v1/chat/completions";
$headers = array(
    "Content-Type: application/json",
    "Authorization: Bearer $api_key"
);

// Получение данных из формы
$user_message = $_POST['user_message'];

// Формирование запроса к GPT-3
$data = array(
    "model" => "gpt-3.5-turbo",
    "messages" => array(
        array(
            "role" => "user",
            "content" => $user_message
        )
    ),
    "temperature" => 0.7 // "Температура" генерации (насколько "креативные" ответы)
);
$data_json = json_encode($data);

// Отправка запроса к GPT-3
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$response = curl_exec($ch);
curl_close($ch);

// Вывод ответа от GPT-3
echo "<h2>Результат:</h2>";
echo "<p>$response</p>";
?>