<?php

require_once 'walmart.php';
require_once 'hmart.php';
require_once 'meijer.php';
require_once 'ranch_market.php';
require_once 'wholefood.php';

# proxy_url = http://api.scraperapi.com?api_key=7ec31355f74d1a928af22a6cc9c0753e&url=

if ( isset($_POST['keyword']) && $_POST['keyword'] != '' ) {

    $default = ['title' => 'Not Found' , 'price' => 'NB.' , 'link' => '' ];

    $keyword = strtolower( $_POST['keyword'] );
    
    //Code For walmart
    $walmart = walmart($keyword);
    if ( count($walmart) == 0 ) {
        $walmart = $default;
    }

    // Code For hmart
    $hmart = hmart($keyword);
    if ( count($hmart) == 0 ) {
        $hmart = $default;
    }

    // Code For Meijer
    $meijer = meijer($keyword);
    if ( count($meijer) == 0 ) {
        $meijer = $default;
    }
    else {
        $title = $meijer['title'];
        $title = strtolower($title);
        $title = str_replace('.','',$title );
        $title = str_replace(',','',$title );
        $meijer['link'] = 'https://www.meijer.com/shopping/product/' . str_replace(' ','-',$title ) . '/' . $meijer['id'] . '.html';
    }

    // Code Whole Food Market
    $wholefood = wholefood( $keyword );
    if ( count($wholefood) == 0 ) {
      $wholefood = $default;
    }

    // Code Whole Food Market
    $ranch_market = ranch_market( $keyword );
    if ( count($ranch_market) == 0 ) {
      $ranch_market = $default;
    }

}
else {
    echo "Please put a product name ";
}

?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="priceCompare.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link href="priceCompare.css" rel="stylesheet">

<style>
  .popover
  {
    width: 100%;
    max-width: 800px;
  }
</style>


</head>
<body>
  
  <div class="container">
    
  <div>
      <h2 style="text-align: center;">Pricing Major Groceries</h2>
      <a id="cart-popover" class="btn" data-placement="bottom" title="Shopping Cart" href="Cart.html">
        <span class="glyphicon glyphicon-shopping-cart"></span>
        <span class="badge"></span>
        <span class="total_price">Shopping Cart</span>
      </a>
    </div>
      

    <div id="popover_content_wrapper" style="display: none">
       <span id="cart_details"></span>
       <div align="right">
    
    <a href="#" class="btn btn-default" id="clear_cart">
    <span class="glyphicon glyphicon-trash"></span> Clear
    </a>
  </div>
</div>


<div id="display_item">
</div>


<div class="columns">
  <ul class="price">
    <li class="header">Walmart</li>
    <li class="grey"><a href="<?php echo $walmart['link']; ?>" target="_blank"> <?php echo $walmart['title']; ?> </a></li>
    <li class="grey" > <?php echo $walmart['price']; ?> </li>

    <li class="grey"><a href="#" class="button">Add to Cart</a></li>
  </ul>
</div>

<div class="columns">
  <ul class="price">
    <li class="header" style="background-color:#4CAF50">Hmart</li>

    <li class="grey"><a href="<?php echo $hmart['link']; ?>" target="_blank" > <?php echo $hmart['title']; ?> </a></li>
    <li class="grey" > <?php echo $hmart['price']; ?> </li>

    <li class="grey"><a href="#" class="button">Add to Cart</a></li>
  </ul>
</div>

<div class="columns">
  <ul class="price">
    <li class="header">Meijer</li>
    <li class="grey"><a href="<?php echo $meijer['link']; ?>" target="_blank" > <?php echo $meijer['title']; ?> </a></li>
    <li class="grey" > <?php echo $meijer['price']; ?> </li>

    <li class="grey"><a href="#" class="button">Add to Cart</a></li>
  </ul>
</div>


<div class="columns mt-5">
  <ul class="price">
    <li class="header">99 Ranch Market</li>
    <li class="grey"><a href="<?php echo $ranch_market['link']; ?>" target="_blank" > <?php echo $ranch_market['title']; ?> </a></li>
    <li class="grey" > <?php echo $ranch_market['price']; ?> </li>

    <li class="grey"><a href="#" class="button">Add to Cart</a></li>
  </ul>
</div>

<div class="columns">
  <ul class="price">
    <li class="header">Wholefood</li>
    <li class="grey"><a href="<?php echo $wholefood['link']; ?>"> <?php echo $wholefood['title']; ?> </a></li>
    <li class="grey" > <?php echo $wholefood['price']; ?> </li>

    <li class="grey"><a href="#" class="button">Add to Cart</a></li>
  </ul>
</div>

</body>
</html>
