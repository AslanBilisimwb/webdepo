<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('system/config-global.php');

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $details = $pages->details($id);
    

$pageTitle = $details['title'];;

require_once('system/assets/header.php');

?>

<main>
  <header class="bg-light text-dark text-left mb-3 mt-0 p-4 rounded-0 box-shadow">
    <div class="overlay rounded-0 box-shadow"></div>
    <div class="container">
      <h1 class="mb-1 font-weight-light p-15"><?php echo $details['title']; ?></h1>
    </div>
  </header>
  <div class="container">
    <div class="row p-15">
      <div class="col-sm-12 mb-3">
        <?php if($details['level'] == '1'){ ?>
        <?php if($user->is_loggedin()){ ?>
        <div class="card mt-3 box-shadow">
          <div class="card-body"> <?php echo $details['content']; ?> </div>
        </div>
        <?php } else{ ?>
        <div class="alert alert-warning" role="alert"> You need to be logged in to see this </div>
        <?php } ?>
        <?php } elseif($details['level'] == '0'){ ?>
        <div class="card mt-3 box-shadow">
          <div class="card-body"> <?php echo $details['content']; ?> </div>
        </div>
        <?php } ?>
      </div>
    </div>
  </div>
</main>
<?php require_once('system/assets/footer.php');?>
<?php } ?>