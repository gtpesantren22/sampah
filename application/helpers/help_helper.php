<?php

function fetchApiGet($url, $token)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: Bearer " . $token,
        "Accept: application/json"
    ]);

    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo json_encode([
            'status' => 'error',
            'message' => curl_error($ch)
        ]);
        curl_close($ch);
        return;
    }
    curl_close($ch);

    $decoded = json_decode($result, true);
    return $decoded;
}

function callApi($url, $apiKey, $method = 'GET', $params = [])
{
    $ch = curl_init();

    if (strtoupper($method) === 'GET') {
        // hanya apiKey
        $query = http_build_query(['apiKey' => $apiKey]);
        curl_setopt($ch, CURLOPT_URL, $url . '?' . $query);
    } else {
        // POST atau lainnya
        $postData = ['apiKey' => $apiKey];
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
    }

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        $error = curl_error($ch);
        curl_close($ch);
        return [
            'status' => 'error',
            'message' => $error
        ];
    }

    curl_close($ch);

    // Jika JSON decode otomatis
    $decoded = json_decode($response, true);
    return $decoded ?: $response;
}
