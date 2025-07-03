<?php
/*Install Midtrans PHP Library (https://github.com/Midtrans/midtrans-php)
composer require midtrans/midtrans-php
                              
Alternatively, if you are not using **Composer**, you can download midtrans-php library 
(https://github.com/Midtrans/midtrans-php/archive/master.zip), and then require 
the file manually.   

require_once dirname(__FILE__) . '/pathofproject/Midtrans.php'; */

require_once dirname(__FILE__) . '/midtrans-php-master/Midtrans.php';

//SAMPLE REQUEST START HERE

// Set your Merchant Server Key
\Midtrans\Config::$serverKey = 'SB-Mid-server-3Er9EYN-cebia58pTr1GqrCH';
// Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
\Midtrans\Config::$isProduction = false;
// Set sanitization on (default)
\Midtrans\Config::$isSanitized = false;
// Set 3DS transaction for credit card to true
\Midtrans\Config::$is3ds = true;



// Baca JSON dari request POST
$postData = file_get_contents("php://input");
$data = json_decode($postData, true);
// Pastikan data tidak kosong atau tidak null
if ($data) {
    $params = array(
        'transaction_details' => array(
            'order_id' => rand(),  // Menggunakan nomor acak untuk ID pesanan
            'gross_amount' => $data['total'],  // Mengambil total dari JSON yang dikirim
        ),
        //'item_details' => $data['items'],  // Mengambil item details dari JSON yang dikirim
        'customer_details' => array(
            'first_name' => $data['nama'],  // Mengambil nama dari JSON
            'email' => $data['email'],  // Mengambil email dari JSON
            'phone' => $data['phone'],  // Mengambil nomor telepon dari JSON
        ),
    );

    // Tampilkan data untuk memeriksa hasilnya
    $snapToken = \Midtrans\Snap::getSnapToken($params);

    echo $snapToken;
    exit;
} else {
    echo json_encode(array('status' => 'error', 'message' => 'Invalid JSON input.'));
}

