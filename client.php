<?php
// URL ke web service
$url = "http://localhost/restsaving/server.php?userId=12345&depositAmount=15000000";

// Kirim request menggunakan file_get_contents
$response = file_get_contents($url);

// Parse respons JSON
$result = json_decode($response, true);

// Proses hasil berdasarkan status
if ($result['status'] === 'success') {
    echo "Sukses: " . $result['pesan'] . "\n";
    echo "Kode Voucher: " . $result['kodeVoucher'] . "\n";
} elseif ($result['status'] === 'info') {
    echo "Info: " . $result['pesan'] . "\n";
} else {
    echo "Error: " . $result['pesan'] . "\n";
}
?>
