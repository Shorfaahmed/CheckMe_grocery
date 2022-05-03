<?php

// $data = ranch_market('milk');
// print_r($data);

function ranch_market( $keyword ) {

    // $keyword = 'almond milk';
    $keyword = str_replace(' ','%20', $keyword);

    $url = 'http://api.scraperapi.com/?api_key=7ec31355f74d1a928af22a6cc9c0753e&url=https://api.freshop.com/1/products?app_key=99_ranch_market&fields=id%2Cidentifier%2Creference_id%2Creference_ids%2Cupc%2Cname%2Cstore_id%2Cdepartment_id%2Csize%2Ccover_image%2Cprice%2Csale_price%2Csale_price_md%2Csale_start_date%2Csale_finish_date%2Cprice_disclaimer%2Csale_price_disclaimer%2Cis_favorite%2Crelevance%2Cpopularity%2Cshopper_walkpath%2Cfulfillment_walkpath%2Cquantity_step%2Cquantity_minimum%2Cquantity_initial%2Cquantity_label%2Cquantity_label_singular%2Cvarieties%2Cquantity_size_ratio_description%2Cstatus%2Cstatus_id%2Csale_configuration_type_id%2Cfulfillment_type_id%2Cfulfillment_type_ids%2Cother_attributes%2Cclippable_offer%2Cslot_message%2Ccall_out%2Chas_featured_offer%2Ctax_class_label%2Cpromotion_text%2Csale_offer%2Cstore_card_required%2Caverage_rating%2Creview_count%2Clike_code%2Cshelf_tag_ids%2Coffers%2Cis_place_holder_cover_image%2Cvideo_config%2Cenforce_product_inventory%2Cdisallow_adding_to_cart%2Csubstitution_type_ids%2Cunit_price%2Coffer_sale_price%2Ccanonical_url%2Coffered_together%2Csequence&include_offered_together=true&limit=15&price_sort=asc&q=' . $keyword . '&render_id=1648526400094&sort=price&store_id=4643&token=e22cdaca10f2fa442aa194ade6ed9051';

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

    $json_data = json_decode( $json_string , true);

    if (count($json_data) == 0 ) {
        return [];
    }
    if ( isset( $json_data['total'] ) && $json_data['total'] == 0 ) {
        return [];
    }

    $response = $json_data['items'];

    $result = $response[0];

    if ( count($result) != 0 ) {

        $data['price'] = $result['unit_price'];

        $data['link'] = $result['canonical_url'];
        
        $data['title'] = $result['name'];

        return $data;

    }
    else {
        return [];
    }

}

?>
