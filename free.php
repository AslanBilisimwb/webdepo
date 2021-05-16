<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$pageTitle = 'Ücretsiz Ürünler';

require_once('system/config-global.php');

require_once('system/assets/header.php');

?>
<main>
  
  <!-- Masthead -->
  
  <header class="masthead text-white text-center mb-3 mt-0 rounded-0 box-shadow">
    <div class="overlay rounded-0 box-shadow"></div>
    <div class="container">
      <div class="row">
        <div class="col-xl-9 mx-auto">
          <h1 class="mb-1 font-weight-bold"><?php echo $l['limitedfree']?></h1>
          <h2><?php echo $l['downloadb4gone']?></h2>
        </div>
      </div>
    </div>
  </header>
  <br>
  <div class="container">
    <div class="row p-15">
      <div class="col-lg-12">
        <div class="row">
          <?php
     $free = $product->getFreeProducts();
      foreach( $free as $row ) {
          $str = $row['name'];
          ?>
          <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="card box-shadow h-100">
              <div class="relativel"> <a href="<?php echo $setting['website_url']; ?>/item/<?php echo $row['id']?>/<?php echo wordwrap(strtolower($str), 1, '-', 0); ?>"> <img class="card-img-top" src="<?php echo $setting['website_url']; ?>/system/assets/uploads/products/<?php echo $row['preview_img']?>" alt="<?php echo $row['name']?>"></a> </div>
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
      </div>
      <!-- /.col-lg-9 --> 
    </div>
  </div>
  </main>
<?php require_once('system/assets/footer.php');?>