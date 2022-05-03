<?php

// $data = hmart('tomatoes');
// print_r($data);

function hmart($keyword){

    include_once('simple_html_dom.php');
    $dom = new simple_html_dom();

    $domain = 'https://www.hmart.com';

    $keyword = str_replace(' ','+', $keyword);

    $url = 'http://api.scraperapi.com?api_key=7ec31355f74d1a928af22a6cc9c0753e&url=https://www.hmart.com/catalogsearch/result/index/?product_list_order=price_asc&q=' . $keyword;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 12_2_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36');
    $html = curl_exec($ch);

    // $html = file_get_contents('html.html');

    $dom->load($html);

    $target_div = $dom->find('div[class="product details product-item-details"]');


    if ( count($target_div) == 0 ){
        return [];
    }

    $data = [];
    $data['search_link'] = $url;

    // Main div for Target product
    $target_product = $target_div[0];

    $product_link = $target_product->find('a[class="product-item-link"]');

    if ( count($product_link) != 0 ) {

        $product_link = $product_link[0];

        $data['link'] = $product_link->href;

        $title = trim( $product_link->plaintext );
        $data['title'] = preg_replace('/\s+/', ' ', $title);

        // echo $data['link']  . "\n";
        // echo  $data['title'] . "\n";

    }
    else {
        echo [];
    }

    $product_price = $target_product->find('span[data-price-type="finalPrice"]');

    if ( count($product_price) != 0 ) {
        $product_price = $product_price[0];
        $price = trim( $product_price->plaintext );
        $data['price'] =  preg_replace('/\s+/', ' ', $price);

    }

    return $data;
}
