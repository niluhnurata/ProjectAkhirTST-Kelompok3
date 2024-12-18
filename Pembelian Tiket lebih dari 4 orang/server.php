<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");
header("Content-Type: application/json");

// Cek jika $_SERVER['PATH_INFO'] ada atau tidak
$pathInfo = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : null;

// Cek apakah metode HTTP yang digunakan GET
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Pastikan parameter query ada
    if (isset($_GET['userId']) && isset($_GET['numOfPeople']) && isset($_GET['totalPrice'])) {
        $userId = $_GET['userId'];
        $numOfPeople = (int) $_GET['numOfPeople'];
        $totalPrice = (float) $_GET['totalPrice'];

        // Logika jika jumlah orang >= 4, beri cashback 10%
        if ($numOfPeople >= 4) {
            $cashbackAmount = $totalPrice * 0.1;

            // Respons sukses
            $response = [
                "userId" => $userId,
                "cashbackAmount" => $cashbackAmount,
                "message" => "Anda mendapatkan cashback sebesar " . number_format($cashbackAmount, 2) . "!",
                "status" => "success"
            ];
        } else {
            // Respons jika pembelian kurang dari 4 orang
            $response = [
                "message" => "Pembelian kurang dari 4 tiket. Tidak ada cashback yang diberikan.",
                "status" => "info"
            ];
        }

        // Kirimkan respons dalam format JSON
        echo json_encode($response);
    } else {
        // Jika parameter tidak valid
        $response = [
            "message" => "Parameter tidak valid. Harap sertakan userId, numOfPeople, dan totalPrice.",
            "status" => "error"
        ];
        echo json_encode($response);
    }
} else {
    // Jika bukan metode GET, kirimkan error 405 Method Not Allowed
    http_response_code(405);
    $response = [
        "message" => "Metode tidak diizinkan. Gunakan metode GET.",
        "status" => "error"
    ];
    echo json_encode($response);
}
?>
