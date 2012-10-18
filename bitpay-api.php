<?php

function bpCurl($url, $post = false) {
    if (variable_get('commerce_bitpay_apikey', '') != '')
        $options['key'] = variable_get('commerce_bitpay_apikey', '');
    else
        $options['key'] = '';

    $curl = curl_init($url);	

    curl_setopt($curl, CURLOPT_HEADER, 0);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($curl, CURLOPT_TIMEOUT, 10);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_USERPWD, $options['key'] . ":" . '');
    //curl_setopt($curl, CURLOPT_FORBID_REUSE, 1);
    //curl_setopt($curl, CURLOPT_FRESH_CONNECT, 1);
    if ($post)
    {
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
    }
    $responseString = curl_exec($curl);

    if($responseString == false) {
            $response = curl_error($curl);
    } else {
            $response = json_decode($responseString, true);
    }
    curl_close($curl);
    return $response;
}

// $orderId: Used to display an orderID to the buyer. In the account summary view, this value is used to 
// identify a ledger entry if present.
//
// $price: by default, $price is expressed in the currency you set in bp_options.php.  The currency can be 
// changed in $options.
//
// $posData: this field is included in status updates or requests to get an invoice.  It is intended to be used by
// the merchant to uniquely identify an order associated with an invoice in their system.  Aside from that, Bit-Pay does
// not use the data in this field.  The data in this field can be anything that is meaningful to the merchant.
//
// $options keys can include any of: 
// ('itemDesc', 'itemCode', 'notificationEmail', 'notificationURL', 'redirectURL', 'SSLcert', 'SSLkey',
//		'currency', 'physical', 'fullNotifications', 'transactionSpeed', 'buyerName', 
//		'buyerAddress1', 'buyerAddress2', 'buyerCity', 'buyerState', 'buyerZip', 'buyerEmail', 'buyerPhone')
// If a given option is not provided here, the value of that option will default to what is found in bp_options.php
// (see api documentation for information on these options).
function bpCreateInvoice($orderId, $price, $posData, $options = array()) {	
	
    $options['key'] = variable_get('commerce_bitpay_apikey', '');
    $options['secret'] = variable_get('commerce_bitpay_secret', '');
    $options['posData'] = '{"posData": "' . $posData . '", "hash": "' . crypt($posData, $options['secret']) . '"}';	
    $options['orderID'] = $orderId;
    $options['price'] = $price;

    $postOptions = array('orderID', 'itemDesc', 'itemCode', 'notificationEmail', 'notificationURL', 'redirectURL', 
            'posData', 'price', 'currency', 'physical', 'fullNotifications', 'transactionSpeed', 'buyerName', 
            'buyerAddress1', 'buyerAddress2', 'buyerCity', 'buyerState', 'buyerZip', 'buyerEmail', 'buyerPhone');
    foreach($postOptions as $o)
            if (array_key_exists($o, $options))
                    $post[$o] = $options[$o];	
    $post = json_encode($post);

    $response = bpCurl('https://bitpay.com/api/invoice', $post);

    return $response;
}

function bpGetInvoice($invoiceId, $options = array()) {

    $response = bpCurl('https://bitpay.com/api/invoice'.$invoiceId);
    if (is_string($response))
            return $response; // error
    $response['posData'] = json_decode($response['posData'], true);
    return $response;	
}

?>
