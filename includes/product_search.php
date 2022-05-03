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


  .card:hover 
  {
    box-shadow: 0 8px 12px 0 rgba(0, 0, 0, 0.2)
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

<div class="row text-center">


  <div class="col-sm-4">
    <div class="card mb-3">
      <div class="card-header bg-dark text-white"><h4>Walmart</h4></div>
      <div class="card-body text-dark" style="background-color: #eee;">
        <a href="<?php echo $walmart['link']; ?>" target="_blank" class="card-title"><?php echo $walmart['title']; ?></a>
        <p class="card-text mt-5"></p><?php echo $walmart['price']; ?>
        <div class="mt-5">
          <a href="#" class="button">Add to Cart</a>
        </div>
        
      </div>
    </div>
  </div>


  <div class="col-sm-4">
    <div class="card mb-3">
      <div class="card-header bg-success text-white"><h4>Hmart</h4></div>
      <div class="card-body text-dark" style="background-color: #eee;">
        <a href="<?php echo $hmart['link']; ?>" target="_blank" class="card-title"><?php echo $hmart['title']; ?></a>
        <p class="card-text mt-5"></p><?php echo $hmart['price']; ?>
        <div class="mt-5">
          <a href="#" class="button">Add to Cart</a>
        </div>
        
      </div>
    </div>
  </div>

  <div class="col-sm-4">
    <div class="card mb-3">
      <div class="card-header bg-dark text-white"><h4>Meijer</h4></div>
      <div class="card-body text-dark" style="background-color: #eee;">
        <a href="<?php echo $meijer['link']; ?>" target="_blank" class="card-title"><?php echo $meijer['title']; ?></a>
        <p class="card-text mt-5"></p><?php echo $meijer['price']; ?>
        <div class="mt-5">
          <a href="#" class="button">Add to Cart</a>
        </div>
        
      </div>
    </div>
  </div>

</div>



<div class="row text-center mt-2">


  <div class="col-sm-4">
    <div class="card mb-3">
      <div class="card-header bg-dark text-white"><h4>99 Ranch Market</h4></div>
      <div class="card-body text-dark" style="background-color: #eee;">
        <a href="<?php echo $ranch_market['link']; ?>" target="_blank" class="card-title"><?php echo $ranch_market['title']; ?></a>
        <p class="card-text mt-5"></p><?php echo $ranch_market['price']; ?>
        <div class="mt-5">
          <a href="#" class="button">Add to Cart</a>
        </div>
        
      </div>
    </div>
  </div>


  <div class="col-sm-4">
    <div class="card mb-3">
      <div class="card-header bg-success text-white"><h4>Wholefood</h4></div>
      <div class="card-body text-dark" style="background-color: #eee;">
        <a href="<?php echo $wholefood['link']; ?>" target="_blank" class="card-title"><?php echo $wholefood['title']; ?></a>
        <p class="card-text mt-5"></p><?php echo $wholefood['price']; ?>
        <div class="mt-5">
          <a href="#" class="button">Add to Cart</a>
        </div>
        
      </div>
    </div>
  </div>

</div>



</body>
</html>
