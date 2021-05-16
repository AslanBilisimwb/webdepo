<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('system/config-global.php');


if(isset($_GET['id'])){
    $id = $_GET['id'];

$catpro = $product->getCProducts(null,$_GET['id']);
$catname = $product->catdetails($_GET['id']);

$pageTitle = $catname['name'];
require_once('system/assets/header.php');
?>
<main>
  
  <!-- Masthead -->
  
  <header class="bg-light text-dark text-left mb-3 mt-0 p-4 rounded-0 box-shadow">
    <div class="overlay rounded-0 box-shadow"></div>
    <div class="container">
      <h1 class="mb-1 font-weight-light p-15"><?php echo $catname['name']; ?></h1>
    </div>
  </header>
  <br>
  <div class="container">
    <div class="row p-15">
      <div class="col-lg-3 mb-3">
        <div class="card box-shadow mb-3">
          <div class="card-header font-weight-bold bg-light"> <?php echo $l['current_category']?> </div>
          <div class="list-group bg-light"> <a href="<?php echo $setting['website_url']; ?>/category/<?php echo $catname['id']; ?>/" class="list-group-item list-group-item-action active"> <span class="ml-2 font-weight-bold"><i class="fas fa-folder"></i> <?php echo $catname['name']; ?></span> </a>
            <?php $subcat = $product->dispsubcategories($catname['id']); foreach($subcat as $scat) { ?>
            <a href="<?php echo $setting['website_url']; ?>/subcat/<?php echo $scat['id']; ?>/" class="list-group-item list-group-item-action"><span class="ml-3"><i class="fas fa-folder-open"></i> <?php echo $scat['name']; ?></span></a>
            <?php } ?>
          </div>
        </div>
        <div class="card box-shadow">
          <div class="card-header font-weight-bold bg-light"> <?php echo $l['all_category']?> </div>
          <div class="list-group bg-light">
            <?php
$category = $product->get_categories();
foreach($category as $cat) {
?>
            <a href="<?php echo $setting['website_url']; ?>/category/<?php echo $cat['id']; ?>/" class="list-group-item list-group-item-action"> <span class="ml-2 font-weight-bold"><i class="fas fa-folder"></i> <?php echo $cat['name']; ?></span> </a>
            <?php } ?>
          </div>
        </div>
      </div>
      <!-- /.col-lg-3 -->
      <div class="col-lg-9">
        <?php
    if ($catpro) {
    } else {
    echo '<div class="alert alert-warning" role="alert">'.$l['noitemsincategory'].'</div>';
    }
	?>
        <div class="row">
          <?php
      foreach( $catpro as $row ) {
          $str = $row['name'];
      ?>
          <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100 box-shadow">
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
                <a href="<?php echo $setting['website_url']; ?>/item/<?php echo $row['id']?>/<?php echo wordwrap(strtolower($str), 1, '-', 0); ?>" class="btn btn-sm btn-outline-secondary box-shadow"><?php echo $l['view_product']?></a> </div>
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
                  <span class="badge badge-dark bd1"><?php echo number_format($averagerating, 1, '.', ','); ?></b><i class="fas fa-star" ></i></span>
                  <?php } ?>
                  <button type="button" class="btn btn-info btn-sm float-right font-weight-bold"><?php echo $setting['currency_sym'].$row['price'];?></button>
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>
          <?php
    }
?>
        </div>
      </div>
      <!-- /.col-lg-9 --> 
    </div>
  </div>
  </main>
<?php require_once('system/assets/footer.php');?>
<?php } ?>