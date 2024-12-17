<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");
header("Content-Type: application/json");


// Validasi metode HTTP
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['userId']) && isset($_GET['depositAmount'])) {
        $userId = $_GET['userId'];
        $depositAmount = (float) $_GET['depositAmount'];

        // Cek nominal deposit
        if ($depositAmount > 10000000) {
            $response = [
                "userId" => $userId,
                "kodeVoucher" => "VOUCHER-" . time(),
                "pesan" => "Setoran lebih dari 10 juta! Anda mendapatkan voucher liburan.",
                "status" => "success"
            ];
            echo json_encode($response);
        } else {
            $response = [
                "pesan" => "Setoran kurang dari 10 juta. Tidak ada voucher yang diberikan.",
                "status" => "info"
            ];
            echo json_encode($response);
        }
    } else {
        $response = [
            "pesan" => "Parameter tidak valid. Harap sertakan userId dan depositAmount.",
            "status" => "error"
        ];
        echo json_encode($response);
    }
} else {
    http_response_code(405);
    $response = [
        "pesan" => "Metode tidak diizinkan. Gunakan metode GET.",
        "status" => "error"
    ];
    echo json_encode($response);
}


