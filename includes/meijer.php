<?php

// $data = meijer('tomatoes');
// print_r($data);

function meijer( $keyword ) {

    // $keyword = 'almond milk';
    $keyword = str_replace(' ','%20', $keyword);

    $url = 'https://ac.cnstrc.com/search/' . $keyword . '?c=ciojs-client-2.15.0&key=key_GdYuTcnduTUtsZd6&i=b1b2b6be-5bef-43c1-9177-85a8c303c5ec&s=1&us=web&page=1&filters%5BavailableInStores%5D=20&sort_by=discountSalePriceValue&sort_order=ascending&fmt_options%5Bgroups_max_depth%5D=3&fmt_options%5Bgroups_start%5D=current&_dt=1645935745073';

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

    // $json = file_get_contents('meijer_error_handle.json');
    // $json = file_get_contents('meijer.json');

    $json_data = json_decode( $json_string , true);

    if (count($json_data) == 0 ) {
        return [];
    }

    $response = $json_data['response'];

    $result = $response['results'];

    if ( count($result) != 0 ) {

        $data = [];
        
        $product = $result[0];

        $target_product = $product['data'];

        $data['price'] = '$' . $target_product['price'];
        $data['id'] = $target_product['id'];
        
        $data['title'] = $product['value'];

        // echo $price . "\n";
        // echo $title . "\n";
        // echo $link . "\n";

        return $data;

    }
    else {
        return [];
    }

}

?>
