<?php

define('ABA_PAYWAY_API_URL', 'https://checkout-sandbox.payway.com.kh/api/payment-gateway/v1/payments/purchase');

define('ABA_PAYWAY_API_KEY', 'c3c9dda7b9503335447e818a22095e587a75ee2a');

define('ABA_PAYWAY_MERCHANT_ID', 'ec449305');

class PayWayApiCheckout
{

    public static function getHash($str)
    {

        $hash = base64_encode(hash_hmac('sha512', $str, ABA_PAYWAY_API_KEY, true));
        return $hash;
    }

    public static function getApiUrl()
    {
        return ABA_PAYWAY_API_URL;
    }
}
