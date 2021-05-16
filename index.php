<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$pageTitle = 'Hazır Kod, Script, Tema Marketi';
require_once('system/config-global.php');
require_once('system/assets/header.php');

$featuredp = $product->getFeaturedProducts();
$newp = $product->getNewProducts();
$popp = $product->getPopularProducts();
$free = $product->getFreeProducts();
$countfree =  $product->countFree();
$countpopular =  $product->countPopular();
?>
<main>
  <!-- Masthead -->
  
  <header class="masthead text-white text-center mb-0 mt-0 rounded-0 box-shadow">
    <div class="overlay rounded-0 box-shadow"></div>
    <div class="container">
      <div class="row">
        <div class="col-xl-9 mx-auto">
          <h1 class="mb-1 font-weight-bold"><?php echo $setting['homepage_header']; ?></h1>
          <h2 class="mb-4 font-weight-bold"><?php echo $setting['homepage_subheader']; ?></h2>
        </div>
        <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
          <div class="subcribe-form" id="mc_embed_signup">
            <form action="<?php echo htmlspecialchars('search.php');?>" method="GET" class="subscription relative">
              <input placeholder="<?php echo $l['searchplaceholder']?>" name="key" minlength="3" required type="text" class="form-control input-sm">
              <button class="search-btn btn-warning align-items-center"><span class="mr-10"><?php echo $l['search']?></span></button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </header>
  <?php if(!$user->is_loggedin()){ ?>
  <div class="bg-dark1 jumbotron text-white text-center mb-4 p-4 rounded-0">
    <div class="container"><span class="h4">Shopier üzerinden <a class="font-weight-bold text-warning">Kredi Kartı </a>ile güvenli satın alın, <strong>anında indirin</strong></span></div>
  </div>
  <?php } ?>
  <br>
  <div class="container">
  <?php if($countfree > 0){ ?>
    <div class="wrapper mb-3"> <span class="font-weight-bold h4 m-t-sm"><?php echo $l['ffotw']?></span> </div>
    <div class="row">
      <?php
      foreach( $free as $row ) {
          $str = $row['name'];
          ?>
      <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
        <div class="card box-shadow h-100">
          <div class="relativel"> <a href="<?php echo $setting['website_url']; ?>/item/<?php echo $row['id']?>/<?php echo wordwrap(strtolower($str), 1, '-', 0); ?>">
            <?php if($row['featured'] == 1){ ?>
            <div class="typebadge"><span class="bg-warning"><i class="fa fa-file mr-1" aria-hidden="true"></i><?php echo $l['featured']?></span></div>
            <?php } ?>
            <img class="card-img-top" src="<?php echo $setting['website_url']; ?>/system/assets/uploads/products/<?php echo $row['preview_img']?>" alt="<?php echo $row['name']?>"></a> </div>
          <div class="card-body text-center">
            <h6 class="card-title mb-3"><?php echo $row['name']?></h6>
            <?php if($setting['show_card_sde'] == '1'){?>
            <p class="card-text small"><?php echo $row['short_des']?></p>
            <?php } ?>
            <a href="<?php echo $setting['website_url']; ?>/item/<?php echo $row['id']?>/<?php echo wordwrap(strtolower($str), 1, '-', 0); ?>" class="btn btn-sm btn-outline-info box-shadow"><?php echo $l['view_product']?></a> </div>
          <div class="card-footer">
            <div class="clearfix">
              <?php if($row['views_off'] == '0'){?>
              <a class="btn btn-sm float-left pr-0"><i class="fa fa-eye" aria-hidden="true"></i> <?php echo $row['views']; ?></a>
              <?php } else{ } ?>
              <?php if($row['price'] == 0){ ?>
              <button type="button" class="btn btn-success btn-sm float-right font-weight-bold"><?php echo $l['free']?></button>
              <?php } elseif($row['free'] == 1){ ?>
              <button type="button" class="btn btn-success btn-sm float-right font-weight-bold"><?php echo $l['free']?></button>
              <?php } else{ ?>
              <a class="btn btn-sm float-left"><i class="fas fa-shopping-basket" aria-hidden="true"></i> <?php echo $row['sales'];?></a>
              <button type="button" class="btn btn-info btn-sm float-right font-weight-bold"><?php echo $setting['currency_sym'].$row['price'];?></button>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
      <?php } ?>
    </div>
  <?php } ?>
    <div class="wrapper mb-3 mt-3"> <span class="font-weight-bold h4 m-t-sm"><?php echo $l['featured_items']?></span> </div>
    <div class="row">
      <?php
      foreach( $featuredp as $row ) {
          $str = $row['name'];
          ?>
      <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
        <div class="card box-shadow h-100">
          <div class="relativel"> <a href="<?php echo $setting['website_url']; ?>/item/<?php echo $row['id']?>/<?php echo wordwrap(strtolower($str), 1, '-', 0); ?>">
            <?php if($row['featured'] == 1){ ?>
            <div class="typebadge"><span class="bg-warning"><i class="fa fa-file mr-1" aria-hidden="true"></i><?php echo $l['featured']?></span></div>
            <?php } ?>
            <img class="card-img-top" src="<?php echo $setting['website_url']; ?>/system/assets/uploads/products/<?php echo $row['preview_img']?>" alt="<?php echo $row['name']?>"></a> </div>
          <div class="card-body text-center">
            <h6 class="card-title mb-3"><?php echo $row['name']?></h6>
            <?php if($setting['show_card_sde'] == '1'){?>
            <p class="card-text small"><?php echo $row['short_des']?></p>
            <?php } ?>
            <a href="<?php echo $setting['website_url']; ?>/item/<?php echo $row['id']?>/<?php echo wordwrap(strtolower($str), 1, '-', 0); ?>" class="btn btn-sm btn-outline-info box-shadow"><?php echo $l['view_product']?></a> </div>
          <div class="card-footer">
            <div class="clearfix">
              <?php if($row['views_off'] == '0'){?>
              <a class="btn btn-sm float-left pr-0"><i class="fa fa-eye" aria-hidden="true"></i> <?php echo $row['views']; ?></a>
              <?php } else{ } ?>
              <?php if($row['price'] == 0){ ?>
              <button type="button" class="btn btn-success btn-sm float-right font-weight-bold"><?php echo $l['free']?></button>
              <?php } elseif($row['free'] == 1){ ?>
              <button type="button" class="btn btn-success btn-sm float-right font-weight-bold"><?php echo $l['free']?></button>
              <?php } else{ ?>
              <a class="btn btn-sm float-left"><i class="fas fa-shopping-basket" aria-hidden="true"></i> <?php echo $row['sales'];?></a>
              <?php  
    $num = $product->countReview($row['id']);
    $sumreviews = $product->sumReviews($row['id']);
      if($num > 0){ 
	  $averagerating = $sumreviews/$num;
	?>
              <span class="badge badge-dark bd1"><?php echo number_format($averagerating, 1, '.', ','); ?><i class="fas fa-star" ></i></span>
              <?php } ?>
              <button type="button" class="btn btn-info btn-sm float-right font-weight-bold"><?php echo $setting['currency_sym'].$row['price'];?></button>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
      <?php } ?>
    </div>
  <?php if($countpopular > 0){ ?>
    <div class="wrapper mb-3 mt-3"> <span class="font-weight-bold h4 m-t-sm"><?php echo $l['popular_items']?></span> </div>
    <div class="row">
      <?php
      foreach( $popp as $row ) {
          $str = $row['name'];
          ?>
      <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
        <div class="card box-shadow h-100">
          <div class="relativel"> <a href="<?php echo $setting['website_url']; ?>/item/<?php echo $row['id']?>/<?php echo wordwrap(strtolower($str), 1, '-', 0); ?>">
            <div class="typebadge"><span class="bg-danger"><i class="fa fa-fire mr-1" aria-hidden="true"></i><?php echo $l['popular']?></span></div>
            <img class="card-img-top" src="<?php echo $setting['website_url']; ?>/system/assets/uploads/products/<?php echo $row['preview_img']?>" alt="<?php echo $row['name']?>"></a> </div>
          <div class="card-body text-center">
            <h6 class="card-title mb-3"><?php echo $row['name']?></h6>
            <?php if($setting['show_card_sde'] == '1'){?>
            <p class="card-text small"><?php echo $row['short_des']?></p>
            <?php } ?>
            <a href="<?php echo $setting['website_url']; ?>/item/<?php echo $row['id']?>/<?php echo wordwrap(strtolower($str), 1, '-', 0); ?>" class="btn btn-sm btn-outline-info box-shadow"><?php echo $l['view_product']?></a> </div>
          <div class="card-footer">
            <div class="clearfix">
              <?php if($row['views_off'] == '0'){?>
              <a class="btn btn-sm float-left pr-0"><i class="fa fa-eye" aria-hidden="true"></i> <?php echo $row['views']; ?></a>
              <?php } else{ } ?>
              <?php if($row['price'] == 0){ ?>
              <button type="button" class="btn btn-success btn-sm float-right font-weight-bold"><?php echo $l['free']?></button>
              <?php } elseif($row['free'] == 1){ ?>
              <button type="button" class="btn btn-success btn-sm float-right font-weight-bold"><?php echo $l['free']?></button>
              <?php } else{ ?>
              <a class="btn btn-sm float-left"><i class="fas fa-shopping-basket" aria-hidden="true"></i> <?php echo $row['sales'];?></a>
              <?php  
    $num = $product->countReview($row['id']);
    $sumreviews = $product->sumReviews($row['id']);
      if($num > 0){ 
	  $averagerating = $sumreviews/$num;
	?>
              <span class="badge badge-dark bd1"><?php echo number_format($averagerating, 1, '.', ','); ?><i class="fas fa-star" ></i></span>
              <?php } ?>
              <button type="button" class="btn btn-info btn-sm float-right font-weight-bold"><?php echo $setting['currency_sym'].$row['price'];?></button>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
      <?php } ?>
    </div>
  <?php } ?>
    <div class="wrapper mb-3 mt-3"> <span class="font-weight-bold h4 m-t-sm"><?php echo $l['new_items']?></span> </div>
    <div class="row">
      <?php
      foreach( $newp as $row ) {
          $str = $row['name'];
          ?>
      <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
        <div class="card box-shadow h-100">
          <div class="relativel"> <a href="<?php echo $setting['website_url']; ?>/item/<?php echo $row['id']?>/<?php echo wordwrap(strtolower($str), 1, '-', 0); ?>">
            <div class="typebadge"><span class="bg-info"><i class="fa fa-star mr-1" aria-hidden="true"></i><?php echo $l['new']?></span></div>
            <img class="card-img-top" src="<?php echo $setting['website_url']; ?>/system/assets/uploads/products/<?php echo $row['preview_img']?>" alt="<?php echo $row['name']?>"></a> </div>
          <div class="card-body text-center">
            <h6 class="card-title mb-3"><?php echo $row['name']?></h6>
            <?php if($setting['show_card_sde'] == '1'){?>
            <p class="card-text small"><?php echo $row['short_des']?></p>
            <?php } ?>
            <a href="<?php echo $setting['website_url']; ?>/item/<?php echo $row['id']?>/<?php echo wordwrap(strtolower($str), 1, '-', 0); ?>" class="btn btn-sm btn-outline-info box-shadow"><?php echo $l['view_product']?></a> </div>
          <div class="card-footer">
            <div class="clearfix">
              <?php if($row['views_off'] == '0'){?>
              <a class="btn btn-sm float-left pr-0"><i class="fa fa-eye" aria-hidden="true"></i> <?php echo $row['views']; ?></a>
              <?php } else{ } ?>
              <?php if($row['price'] == 0){ ?>
              <button type="button" class="btn btn-success btn-sm float-right font-weight-bold"><?php echo $l['free']?></button>
              <?php } elseif($row['free'] == 1){ ?>
              <button type="button" class="btn btn-success btn-sm float-right font-weight-bold"><?php echo $l['free']?></button>
              <?php } else{ ?>
              <a class="btn btn-sm float-left"><i class="fas fa-shopping-basket" aria-hidden="true"></i> <?php echo $row['sales'];?></a>
              <?php  
    $num = $product->countReview($row['id']);
    $sumreviews = $product->sumReviews($row['id']);
      if($num > 0){ 
	  $averagerating = $sumreviews/$num;
	?>
              <span class="badge badge-dark bd1"><?php echo number_format($averagerating, 1, '.', ','); ?><i class="fas fa-star" ></i></span>
              <?php } ?>
              <button type="button" class="btn btn-info btn-sm float-right font-weight-bold"><?php echo $setting['currency_sym'].$row['price'];?></button>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
      <?php } ?>
    </div>
  </div>
  </main>
  <?php require_once('system/assets/footer.php');?>
