<?php

// $data = walmart('tomatoes');
// print_r($data);

function walmart($keyword){

    include_once('simple_html_dom.php');
    $dom = new simple_html_dom();

    $domain = 'https://www.walmart.com';

    $keyword = str_replace(' ','+',$keyword);

    $url = 'https://www.walmart.com/search?q=' . $keyword . '&sort=price_low';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 12_2_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36');
    $html = curl_exec($ch);

    $dom->load($html);

    $target_div = $dom->find('div[class="mb1 ph1 pa0-xl bb b--near-white w-25"]');
    if ( count($target_div) == 0 ){
        return [];
    }

    $data = [];
    $data['search_link'] = $url;

    // Main div for Target product
    $target_product = $target_div[0];

    $product_link = $target_product->find('a[class="absolute w-100 h-100 z-1"]');

    if ( count($product_link) != 0 ) {

        $product_link = $product_link[0];

        $data['link'] = $domain . $product_link->href;

        $data['title'] = $product_link->plaintext;

        // echo $data['link']  . "\n";
        // echo  $data['title'] . "\n";
    }
    else {
        echo [];
    }

    $product_price = $target_product->find('div[class="flex flex-wrap justify-start items-center lh-title mb2 mb1-m"]');

    if ( count($product_price) != 0 ) {
        $product_price = $product_price[0];

        $price = $product_price->find('div[class="b black f5 mr1 mr2-xl lh-copy f4-l"]')[0];
        $data['price'] = $price->plaintext;

        $extra_price = $product_price->find('div[class="f7 f6-l gray mr1"]')[0];
        $data['extra_price'] = $extra_price->plaintext;

        // $data['price'] . "\n";
        // $data['extra_price'] . "\n";

    }

    return $data;
}
