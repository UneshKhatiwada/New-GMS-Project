<?php
$epay_url = "https://rc-epay.esewa.com.np/api/epay/main/v2/form";
$successurl = "";
$amount = "100";
$tax_amount = "10";
$total_amount = "110";
$transaction_uuid = "unique-transaction-id";
$product_code = "GMS111";
$success_url = "https://esewa.com.np";
$failure_url = "https://google.com";
$signed_field_names = "total_amount,transaction_uuid,product_code";
$secret_key = "GMS111";
$merchant_code = "EPAYTEST"; 
$fraudcheck_url = "https://uat.esewa.com.np/epay/transrec";


// Construct the data to be signed
$data_to_sign = "total_amount=$total_amount&transaction_uuid=$transaction_uuid&product_code=$product_code";

// Generate the signature using HMAC SHA-256
$signature = hash_hmac('sha256', $data_to_sign, $secret_key);

?>