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
        $postData = array_merge(['apiKey' => $apiKey], $params);
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

function tanggalIndonesia($tanggal)
{
    // Array nama hari dan bulan dalam bahasa Indonesia
    $hariIndo = [
        'Sunday' => 'Minggu',
        'Monday' => 'Senin',
        'Tuesday' => 'Selasa',
        'Wednesday' => 'Rabu',
        'Thursday' => 'Kamis',
        'Friday' => 'Jumat',
        'Saturday' => 'Sabtu'
    ];

    $bulanIndo = [
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember'
    ];

    // Pastikan format input valid
    $timestamp = strtotime($tanggal);
    if (!$timestamp) return '-';

    // Ambil nama hari & tanggal
    $hari = $hariIndo[date('l', $timestamp)];
    $tgl = date('j', $timestamp);
    $bulan = $bulanIndo[(int)date('n', $timestamp)];
    $tahun = date('Y', $timestamp);

    return "$hari, $tgl $bulan $tahun";
}
