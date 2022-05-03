<?php

// $data = wholefood('milk');
// print_r($data);

function wholefood( $keyword ) {

    $keyword = str_replace(' ','%20', $keyword);

    $url = 'https://www.wholefoodsmarket.com/api/search?text=' . $keyword . '&sort=priceasc&store=10612&limit=60&offset=0';

    // Sending Request
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 12_2_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36');
    $json_string = curl_exec($ch);
    
    if(curl_errno($ch)){
        throw new Exception(curl_error($ch));
        return [];
    }

    curl_close($ch);

    //$json_string = file_get_contents('wholefood.json');

    if ($json_string == '') {
        return [];
    }

    $json_data = json_decode( $json_string , true );

    if ( count($json_data) == 0 ) {
        return [];
    }

    $product = $json_data['results'];

    $target_product = $product[0];

    $data = [];

    $data['price'] = '$' . $target_product['regularPrice'];
    $data['title'] = $target_product['name'];
    $data['link'] = 'https://www.wholefoodsmarket.com/product/' . $target_product['slug'];
    
    return $data;

}

?>
