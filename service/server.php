<?php

// Allow all origins, methods, and headers for CORS
header("Access-Control-Allow-Origin: *");  // Allow all domains to access the server
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");  // Allow GET, POST, and OPTIONS methods
header("Access-Control-Allow-Headers: Content-Type, SOAPAction, Authorization");

require('VoucherService.php');

$server = new SoapServer('voucher.wsdl');
$server->setClass('VoucherService');
$server->handle();
