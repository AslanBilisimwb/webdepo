<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('system/config-global.php');

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $details = $product->details($id);
    $allreviews = $product->getReviews($id);
    $sumreviews = $product->sumReviews($id);
    $num = $product->countReview($id);
	
    $allquestions = $product->getQuestions($id);
    $num2 = $product->countQuestion($id);
	
    if($details['cat_id']!='0'){
    $cat = $product->catdetails($details['cat_id']);
    $cat1 = $cat['name'];
    $cat2 = $cat['id'];
    }
    else{
        $cat1 = $l['no_category'];
    }
    if ($details) {
        $query = $DB_con->prepare("UPDATE tsm_products SET views = views + 1 WHERE id = ?");
        $query->execute(array($id));
    } else {
        display_post_not_found($id);
        exit();
    }

//userdelete
if(!empty($_GET['del']) && $user->is_loggedin()){
    
    $idcomm = $_GET['del'];
    $query = $DB_con->prepare("UPDATE tsm_reviews SET status = 0 WHERE id = ? AND user_id = ?");
    $query->execute(array($idcomm,$_SESSION['uid']));
    header('Location: item.php?id='.$id.'');
    exit();
}
//moderatordelete
if(!empty($_GET['delp']) && $userDetails['moderator'] == 1){
    
    $idcomm = $_GET['delp'];
    $query = $DB_con->prepare("UPDATE tsm_reviews SET status = 0 WHERE id = ?");
    $query->execute(array($idcomm));
    header('Location: item.php?id='.$id.'');
    exit();
}
if(!empty($_GET['delq']) && $userDetails['moderator'] == 1){
    
    $idques = $_GET['delq'];
    $query = $DB_con->prepare("UPDATE tsm_questions SET status = 0 WHERE id = ?");
    $query->execute(array($idques));
    header('Location: item.php?id='.$id.'');
    exit();
}

$pageTitle = $details['name'];;

require_once('system/assets/header.php');

if(isset($_POST['addtowishlist'])){
    $addtw = $wishlist->add($_SESSION['uid'], $id);
}
?>
<main><?php echo ($details['active']=='2'?'<div class="alert alert-danger mb-0" role="alert">'.$l['item_paused'].'</div>':'');?>
  
  <div class="jumbotron p-0 pt-5 bg-light border-bottom">
    <div class="container">
      <div class="col-md-12 px-0">
        <div class="row p-15">
          <div class="p-15 pb-5"> <img class="pull-left thumb-lg m-r-md rounded mr-3" src="<?php echo $setting['website_url']; ?>/system/assets/uploads/products/<?php echo $details['icon_img'];?>" alt="<?php echo $details['name']; ?>" width="80" height="80"> </div>
          <div class="col-sm-10">
            <h2 class="text-dark"><?php echo $details['name']; ?></h2>
            <h6><?php echo $details['short_des']; ?></h6>
          </div>
        </div>
        <ul class="nav nav-tabs">
          <li class="active"><a class="nav-link active" data-toggle="tab" href="#menu1"><b><?php echo $l['overview']; ?></b></a></li>
          <?php if($details['reviews_off'] == '0'){?>
          <li><a class="nav-link" data-toggle="tab" href="#menu2"><b><?php echo $l['reviews']; ?></b></a></li>
          <?php } else{ } ?>
          <?php if($details['free'] == '0'){?>
          <li><a class="nav-link" data-toggle="tab" href="#menu3"><b><?php echo $l['support']; ?></b></a></li>
          <?php } else{ } ?>
          <li><a class="nav-link" data-toggle="tab" href="#menu4"><b><?php echo $l['question']; ?></b></a></li>
        </ul>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row p-15">
      <div class="col-sm-8">
        <div class="tab-content">
          <div id="menu1" class="tab-pane active">
            <div class="card text-center box-shadow">
              <div class="card-body p-0"> <img class="card-img-top" src="<?php echo $setting['website_url']; ?>/system/assets/uploads/products/<?php echo $details['preview_img'];?>" alt="<?php echo $details['name']; ?>"> </div>
              <div class="card-footer text-muted">
                <div class="btn-group" role="group" aria-label="Basic example">
                  <?php if(!empty($details['demo'])){ ?>
                  <a target="_blank" href="<?php echo $details['demo'];?>" class="btn btn-info mr-2 rounded"><?php echo $l['live_preview']; ?></a>
                  <?php }?>
                  <?php
	if($user->is_loggedin()){
	if($wishlist->is_alreadyadd($_SESSION['uid'],$id)){

	} else{ ?>
                  <form action="item.php?id=<?php echo $id;?>" method="POST">
                    <a>
                    <button name="addtowishlist" type="submit" class="btn btn-danger"><?php echo $l['add_to_wish']; ?></button>
                    </a>
                  </form>
                  <?php }} ?>
                </div>
              </div>
            </div>
            <div class="card mt-3 box-shadow">
              <div class="card-header">
                <h4><?php echo $l['description']; ?></h4>
              </div>
              <div class="card-body"> <?php echo $details['description']; ?> </div>
            </div>
          </div>
          <?php if($details['reviews_off'] == '0'){?>
          <div id="menu2" class="tab-pane">
            <div class="card mt-1 box-shadow">
              <div class="card-body">
                <?php if($user->is_loggedin() && $purchases->is_purchased($_SESSION['uid'],$id) && !$product->is_alreadyadd($_SESSION['uid'],$id)){ ?>
                <form id="review">
                  <input type="hidden" class="form-control" name="username" value="<?php echo $userDetails['username']; ?>" ="">
                  <input type="hidden" class="form-control" name="name" value="<?php echo $userDetails['fname']; ?>" ="">
                  <div class="form-group">
                    <input type="hidden" name="email" class="form-control" value="<?php echo $userDetails['email']; ?>" ="">
                  </div>
                  <div class="form-group">
                    <input type="hidden" name="subject" class="form-control" value="<?php echo $details['name']; ?>" ="">
                  </div>
                  <input type="hidden" class="form-control" name="uid" value="<?php echo $_SESSION['uid']; ?>">
                  <input type="hidden" class="form-control" name="pid" value="<?php echo $details['id']; ?>">
                  <div align="center" class="card-body">
                    <h4 class="text-center mb-4 font-weight-bold"><?php echo $l['write_rev']; ?></h4>
                    <input type="radio" name="rating" id="5" value="5" checked="checked" class="btn">
                    <label for="5">Harika</label>
                    </label>
                    &nbsp;&nbsp;
                    <input type="radio" name="rating" id="4" value="4" class="btn">
                    <label for="4"> &nbsp; &nbsp;İyi &nbsp; &nbsp; </label>
                    </label>
                    &nbsp;&nbsp;
                    <input type="radio" name="rating" id="3" value="3">
                    <label for="3"> &nbsp; Orta &nbsp; </label>
                    </label>
                    &nbsp;&nbsp;
                    <input type="radio" name="rating" id="2" value="2">
                    <label for="2"> &nbsp; Kötü &nbsp; </label>
                    </label>
                    &nbsp;&nbsp;
                    <input type="radio" name="rating" id="1" value="1">
                    <label for="1">Çok Kötü</label>
                    </label>
                  </div>
                  <div class="form-group">
                    <h6><?php echo $l['review']; ?> (Max. 250 karakter)</h6>
                    <textarea name="review" class="form-control" id="review"  minlength="4" maxlength="250" required></textarea>
                  </div>
                  <div id="result1">
                    <button type="submit" class="btn btn-success submit"><?php echo $l['submit']; ?></button>
                  </div>
                </form>
                <?php } ?>
                <?php if($user->is_loggedin() && !$purchases->is_purchased($_SESSION['uid'],$id)){ ?>
                <div class="alert alert-warning" role="alert"> <?php echo $l['purchase2rev']; ?>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                </div>
                <?php } ?>
                <?php if(!$user->is_loggedin()){ ?>
                <div class="alert alert-warning" role="alert"> <?php echo $l['loggedin2rev']; ?>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                </div>
                <?php } ?>
                <?php if($user->is_loggedin() && $product->is_alreadyadd($_SESSION['uid'],$id)){ ?>
                <div class="alert alert-warning" role="alert"> <?php echo $l['alreadyleftrev']; ?>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                </div>
                <?php } ?>
                <br>
                <h4 class="text-center mb-4 font-weight-bold"><?php echo $l['all_rev']; ?></h4>
                <?php     
      if($num > 0){ 
	  $averagerating = $sumreviews/$num;
	?>
                <div class="my-1 p-1 bg-light rounded box-shadow">
                  <div class="card m-b-0">
                    <ul class="list-group text-center list-group-flush  scroll">
                      <?php

      foreach( $allreviews as $row ) {
        $uname = $user->details($row['user_id']);
        $uname = $uname['username'];
          ?>
                      <div class="my-1 p-1 bg-light rounded box-shadow">
                        <div class="card m-b-0">
                          <li class="list-group-item text-left">
                            <div> <b><span class="text-blue"><?php echo $uname; ?> :</span></b> <span class="purcheasedbadge badge badge-dark">SATIN&nbsp;ALDI</span> </div>
                            <div class="star">
                              <?php
	for($i = 1; $i <= 5; $i++) {
	if($i <= $row['rating']) {
	?>
                              <span class="star_rated" onclick="ratestar(<?php echo $row['rating']; ?>, <?php echo $i; ?>)"><i class="fas fa-star"></i></span>
                              <?php }  else {  ?>
                              <span class="not_rated" onclick="ratestar(<?php echo $row['rating']; ?>, <?php echo $i; ?>)"><i class="fas fa-star"></i></span>
                              <?php  }
	}
	?>
                            </div>
                            <?php echo $row['review']; ?>
                            <div class="fright">
                              <?php if($user->is_loggedin() && $row['user_id']==$_SESSION['uid']){ ?>
                              <a href="<?php echo $setting['website_url']; ?>/item.php?id=<?php echo $id;?>&del=<?php echo $row['id']; ?>" name="delete" title="Yorumunuzu silebilirsiniz" data-toggle="tooltip"><i class="fas fa-trash-alt text-red"></i></a>
                              <?php } elseif($user->is_loggedin() && $userDetails['moderator'] == 1){ ?>
                              <a href="<?php echo $setting['website_url']; ?>/item.php?id=<?php echo $id;?>&delp=<?php echo $row['id']; ?>" name="delete" title="Moderator Silebilir" data-toggle="tooltip"><i class="fas fa-trash-alt text-red"></i></a>
                              <?php } ?>
                            </div>
                          </li>
                        </div>
                      </div>
                      <?php } ?>
                    </ul>
                  </div>
                </div>
                <?php } else { echo '<div class="alert alert-warning" role="alert"> <i class="far fa-frown"></i> '.$l['no-rev'].'</div>'; 
 $averagerating = '0';
}?>
              </div>
            </div>
          </div>
          <?php } else { } ?>
          <div id="menu3" class="tab-pane">
            <div class="card mt-3 box-shadow">
              <div class="card-body"> <?php echo ($details['support']=='1'?'':'<div class="alert alert-danger" role="alert"> '.$l['do_not_support'].'</div>');?>
                <?php if($user->is_loggedin() && $purchases->is_purchased($_SESSION['uid'],$id) && $details['support']=='1'){ ?>
                <h4 class="text-center mb-4 font-weight-bold"><?php echo $l['supp_title']; ?></h4>
                <form id="support">
                  <div class="input-group mb-3">
                    <div class="input-group-prepend"> <span class="input-group-text" id="basic-addon1"><i class="fas fa-user-circle" aria-hidden="true"></i></span> </div>
                    <input type="text" class="form-control" name="username" value="<?php echo $userDetails['username']; ?>" ="" readonly="readonly">
                  </div>
                  <input type="hidden" class="form-control" name="name" value="<?php echo $userDetails['fname']; ?>" ="">
                  <div class="input-group mb-3">
                    <div class="input-group-prepend"> <span class="input-group-text" id="basic-addon1"><i class="fas fa-envelope" aria-hidden="true"></i></span> </div>
                    <input type="text" name="email" class="form-control" value="<?php echo $userDetails['email']; ?>" ="" readonly="readonly">
                  </div>
                  <div class="form-group">
                    <input type="hidden" name="subject" class="form-control" value="<?php echo $details['name']; ?>" ="">
                  </div>
                  <div class="form-group">
                    <h6><?php echo $l['message']; ?></h6>
                    <textarea name="message" class="form-control" id="exampleInputPassword1"></textarea>
                  </div>
                  <div id="result2">
                    <button type="submit" class="btn btn-success submit"><?php echo $l['submit']; ?></button>
                  </div>
                </form>
                <?php } elseif($details['support']=='1'){?>
                <div class="alert alert-warning" role="alert"> <?php echo $l['loggedin2supp']; ?>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                </div>
                <?php } else{} ?>
              </div>
            </div>
          </div>
          <div id="menu4" class="tab-pane">
            <div class="card mt-3 box-shadow">
              <div class="card-body">
                <?php if($user->is_loggedin() && $purchases->is_purchased($_SESSION['uid'],$id)){ ?>
                <div class="alert alert-warning" role="alert"> <?php echo $l['ask_notice']; ?>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                </div>
                <?php } ?>
                <?php if($user->is_loggedin() && !$purchases->is_purchased($_SESSION['uid'],$id)){ ?>
                <h4 class="text-center mb-4 font-weight-bold"><?php echo $l['que_title']; ?></h4>
                <form id="question">
                  <div class="input-group mb-3">
                    <div class="input-group-prepend"> <span class="input-group-text" id="basic-addon1"><i class="fas fa-user-circle" aria-hidden="true"></i></span> </div>
                    <input type="hidden" class="form-control" name="uid" value="<?php echo $_SESSION['uid']; ?>">
                    <input type="hidden" class="form-control" name="pid" value="<?php echo $details['id']; ?>">
                    <input type="text" class="form-control" name="username" value="<?php echo $userDetails['username']; ?>" ="" readonly="readonly">
                  </div>
                  <input type="hidden" class="form-control" name="name" value="<?php echo $userDetails['fname']; ?>" ="">
                  <div class="input-group mb-3">
                    <div class="input-group-prepend"> <span class="input-group-text" id="basic-addon1"><i class="fas fa-envelope" aria-hidden="true"></i></span> </div>
                    <input type="text" name="email" class="form-control" value="<?php echo $userDetails['email']; ?>" ="" readonly="readonly">
                  </div>
                  <div class="form-group">
                    <input type="hidden" name="subject" class="form-control" value="<?php echo $details['name']; ?>" ="">
                  </div>
                  <div class="form-group">
                    <h6><?php echo $l['question']; ?> (Max. 250 karakter)</h6>
                    <textarea name="message" class="form-control" id="exampleInputPassword1" minlength="10" maxlength="250" required></textarea>
                  </div>
                  <div id="result3">
                    <button type="submit" class="btn btn-success submit"><?php echo $l['submit']; ?></button>
                  </div>
                </form>
                <?php  } ?>
                <?php if(!$user->is_loggedin()){ ?>
                <div class="alert alert-primary" role="alert"> <?php echo $l['loggedin2ask']; ?>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                </div>
                <?php } ?>
                <h4 class="text-center mb-4 font-weight-bold"><?php echo $l['all_ques']; ?></h4>
                <?php     
      if($num2 > 0){ 
	?>
                <div class="my-1 p-1 bg-light rounded box-shadow">
                  <div class="card m-b-0">
                    <ul class="list-group text-center list-group-flush scroll">
                      <?php

      foreach( $allquestions as $row ) {
        $uname = $user->details($row['user_id']);
        $uname = $uname['username'];
          ?>
                      <div class="my-1 p-1 bg-light rounded box-shadow">
                        <div class="card m-b-0">
                          <li class="list-group-item text-left">
                            <div> <b><span class="text-blue"><?php echo $uname; ?> :</span></b></div>
                            <?php echo $row['question']; ?>
                            <div class="date small"> <?php echo $row['qdate']; ?> </div>
                            <div class="fright">
                              <?php if($user->is_loggedin() && $userDetails['moderator'] == 1){ ?>
                              <a href="<?php echo $setting['website_url']; ?>/item.php?id=<?php echo $id;?>&delq=<?php echo $row['id']; ?>" name="delete" title="Sorunuzu silebilirsiniz" data-toggle="tooltip"><i class="fas fa-trash-alt text-red"></i></a>
                              <?php } ?>
                            </div>
                          </li>
                          <li class="list-group-item text-left">
                            <?php if ($user->is_loggedin() && $userDetails['moderator'] == 1 && $row['answer'] ==''){ ?>
                            <form id="answer">
                              <input type="hidden" class="form-control" name="id" value="<?php echo $row['id']; ?>">
                              <div class="form-group">
                                <h6><?php echo $l['answer']; ?></h6>
                                <textarea name="answer" class="form-control" id="exampleInputPassword1" minlength="5" maxlength="250" required></textarea>
                              </div>
                              <div id="result4">
                                <button type="submit" class="btn btn-success submit"><?php echo $l['submit']; ?></button>
                              </div>
                            </form>
                            <?php }else{ ?>
                            <div><b><span class="text-orange">ADMİN :</span></b></div>
                            <?php echo $row['answer']; } ?>
                            <div class="date small"> <?php echo $row['adate']; ?> </div>
                          </li>
                        </div>
                      </div>
                      <?php } ?>
                    </ul>
                  </div>
                </div>
                <?php } else { echo '<div class="alert alert-warning" role="alert"> <i class="far fa-frown"></i> '.$l['no-ques'].'</div>'; 
 $averagerating = '0';
}?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <?php if($details['free'] == '1'){?>
        <div class="card mb-3 box-shadow text-center">
          <div class="card-body">
            <h5 class="card-title"><?php echo $l['ffotw']; ?></h5>
            <p class="card-text text-left"><?php echo $l['ffinfo']; ?></p>
            <a data-toggle="modal" class="btn btn-success btn-lg btn-block font-bold text-white mt-4" data-target="#freeModal"><i class="fas fa-download"></i> <?php echo $l['download_now']; ?></a> </div>
        </div>
        <?php } ?>
        <?php if($details['free'] == '0'){?>
        <div class="card box-shadow">
          <div class="card-body">
            <div class="clearfix mb-4">
              <div class="text-center"> <span class="h2 text-right-xs " content="<?php echo $setting['currency'];?>"><?php echo $setting['currency_sym'];?><span class="h1 text-right-xs font-bold " data-licence="regular" content="<?php echo $details['price'];?>"><?php echo $details['price'];?></span> </span> </div>
            </div>
            <div class="clear m-t-md m-b-md text-md"> <?php echo ($details['support']=='1'?'<i class="fa fa-check-circle text-success fa-fw"></i> '.$l['we_do_support'].'<br>':'<i class="fa fa-times-circle text-danger fa-fw"></i> '.$l['do_not_support'].'<br>');?>
              <?php if ($details['free_ins']=='1') echo '<i class="fa fa-check-circle text-success fa-fw"></i> '.$l['free_installation'].'<br>' ?>
              <i class="fa fa-check-circle text-success fa-fw"></i> <?php echo $l['future_updates']; ?><br>
              <i class="fa fa-check-circle text-success fa-fw"></i> <?php echo $l['unlimited_downloads']; ?><br>
            </div>
            <?php 
  if($details['stock_on']=='1' && $details['stock'] <= 0) { 
      echo '<div class="alert alert-danger mt-3 mb-0" role="alert">'.$l['out_of_stock'].'</div>'; 
    } 
        elseif($details['stock_on']=='1' && $user->is_loggedin() && $purchases->is_purchased($_SESSION['uid'],$id)){
         echo '<div class="alert alert-danger mt-3 mb-0" role="alert">'.$l['already_purchased'].'</div>';
    }
    elseif($details['stock_on']=='1' && $details['stock'] >= 0) { 
      echo '<div class="alert alert-success mt-3 mb-0" role="alert">'.$l['in_stock'].'</div><a class="tsm-btn" data-pid="'.$id.'">'.$l['buy_now'].'</a>';
    } 
  
  if($details['stock_on']=='0' && $user->is_loggedin() && $purchases->is_purchased($_SESSION['uid'],$id)){
      echo '<div class="alert alert-danger mt-3 mb-0" role="alert">'.$l['already_purchased'].'</div>';
    }
  elseif($details['stock_on']=='0'){
     echo '<a class="tsm-btn" data-pid="'.$id.'">'.$l['buy_now'].'</a>'; 
  }
?>
          </div>
          <div class="card-footer text-muted text-center"> <i class="fab fa-cc-visa fa-2x"></i> <i class="fab fa-cc-paypal fa-2x"></i> <i class="fab fa-cc-mastercard fa-2x"></i> <i class="fab fa-cc-discover fa-2x"></i> </div>
        </div>
        <?php } ?>
        <?php echo ($details['featured']=='2'?'<div class="alert alert-warning mt-3 mb-0" role="alert">'.$l['hasbeenfeat'].'</div>':'');?>
        <div class="card mt-3 box-shadow">
          <div class="card-header text-left">
            <h5> <?php echo $l['information']; ?></h5>
          </div>
          <div class="table-responsive">
            <table class="table table-striped mb-0">
              <tbody>
                <tr>
                  <td class="col-xs-5"><?php echo $l['category']; ?></td>
                  <td class="col-xs-7"><a href="<?php echo $setting['website_url']; ?>/category.php?id=<?php echo $cat2; ?>" title=""><?php echo $cat1; ?></a></td>
                </tr>
                <tr>
                  <td><?php echo $l['first_release']; ?></td>
                  <td><?php 
      
       $created = $details['created'];
                                    $date = new DateTime($created);
                                    echo $date->format('j F Y');?></td>
                </tr>
                <tr>
                  <td><?php echo $l['last_updated']; ?></td>
                  <td><?php 
      
       $modified = $details['modified'];
                                    $date = new DateTime($modified );
                                    echo $date->format('j F Y');?></td>
                </tr>
                <?php if($details['reviews_off'] == '0'){?>
                <tr>
                  <td>Puan ( <?php echo $num; ?> )</td>
                  <td><?php if ($num > '0'){ 
	    $averagerating = $sumreviews/$num;
		?>
                    <h6>Ort.Puan: <span class="star_rated badge badge-dark"><?php echo number_format($averagerating, 1, '.', ','); ?><i class="fas fa-star text-yellow"></i></span> / 5</h6>
                    <?php }else{ ?>
                    <h6>Ort.Puan: <span class="star_rated badge badge-dark"><?php echo $l['not_voted'] ?></span></h6>
                    <?php } ?></td>
                </tr>
                  <?php }else{} ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="card mt-3 box-shadow">
          <div class="card-body"> <i class="fas fa-shopping-basket"></i> <?php echo $details['sales'];?> <?php echo $l['sales']; ?> </div>
        </div>
      </div>
    </div>
  </div>
  <!--Similar Items-->
  <div class="container mt-5">
    <div class="wrapper mb-3 p-15"> <span class="font-weight-bold h4 m-t-sm"><?php echo $l['similarprod']?></span> </div>
    <div class="row p-15">
      <?php
     $similar = $product->getSimilarProducts($cat2);
      foreach( $similar as $row ) {
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
  </div>
  <?php if($details['free'] == '1'){?>
  <!-- FreeModal -->
  <div class="modal fade" id="freeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><?php echo $l['freedl']; ?> </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
        </div>
        <div class="modal-body">
          <?php if($user->is_loggedin()){ ?>
          <form id="free">
            <div class="form-group">
              <input type="hidden" class="form-control" name="name" placeholder="Enter Name" value="<?php echo $userDetails['fname']; ?>" ="">
            </div>
            <input type="hidden" class="form-control" name="uid" value="<?php echo $_SESSION['uid']; ?>">
            <input type="hidden" class="form-control" name="pid" value="<?php echo $details['id']; ?>">
            <div class="form-group">
              <input type="hidden" name="email" class="form-control" value="<?php echo $userDetails['email']; ?>" ="">
            </div>
            <button type="submit" class="btn btn-success btn-lg btn-block submit"><i class="fas fa-download"></i> <?php echo $l['download_now']; ?></button>
            <div id="result2" align="center"></div>
          </form>
          <?php } elseif($details['free']=='1'){?>
          <div class="alert alert-primary" role="alert"> <?php echo $l['loggedinaccess']; ?> </div>
          <?php } else{} ?>
        </div>
      </div>
    </div>
  </div>
  <?php } ?>
  
  </main>
  <script>
$(document).ready(function (e) {
	$("#review").on('submit',(function(e) {
		e.preventDefault();
		$.ajax({
        	url: "<?php echo $setting['website_url'];?>/system/assets/ajax/form-process-review.php",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
    	    cache: false,
			processData:false,
			beforeSend: function() 
        {
            $("#result1").html('Veriler işleniyor...');
        },  
        success: function(response)
        {
            $("#result1").html(response);
        }        
	   });
	}));
	
	$("#support").on('submit',(function(e) {
		e.preventDefault();
		$.ajax({
        	url: "<?php echo $setting['website_url'];?>/system/assets/ajax/form-process.php",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
    	    cache: false,
			processData:false,
			beforeSend: function() 
        {
            $("#result2").html('Veriler işleniyor...');
        },  
        success: function(response)
        {
            $("#result2").html(response);
        }        
	   });
	}));
	
	$("#question").on('submit',(function(e) {
		e.preventDefault();
		$.ajax({
        	url: "<?php echo $setting['website_url'];?>/system/assets/ajax/form-process-question.php",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
    	    cache: false,
			processData:false,
			beforeSend: function() 
        {
            $("#result3").html('Veriler işleniyor...');
        },  
        success: function(response)
        {
            $("#result3").html(response);
        }        
	   });
	}));
	
	$("#answer").on('submit',(function(e) {
		e.preventDefault();
		$.ajax({
        	url: "<?php echo $setting['website_url'];?>/system/assets/ajax/form-process-answer.php",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
    	    cache: false,
			processData:false,
			beforeSend: function() 
        {
            $("#result4").html('Veriler işleniyor...');
        },  
        success: function(response)
        {
            $("#result4").html(response);
        }        
	   });
	}));
	
	$("#free").on('submit',(function(e) {
		e.preventDefault();
		$.ajax({
        	url: "<?php echo $setting['website_url'];?>/system/assets/ajax/form-process-download.php",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
    	    cache: false,
			processData:false,
			beforeSend: function() 
        {
            $("#result2").html('<hr><div class="alert alert-primary" role="alert"><i class="fas fa-circle-notch fa-spin"></i> Veriler işleniyor...</div>');
        },  
        success: function(response)
        {
            $("#result2").html(response);
        }        
	   });
	}));
	
});
</script>
  <?php require_once('system/assets/footer.php');?>
  <?php
}else{
    header('Location:index.php');
}

function display_post_not_found($id) {
    echo "Böyle bir ürün yok!";
}

