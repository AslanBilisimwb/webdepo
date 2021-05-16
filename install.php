<!DOCTYPE html>
<html>
<head>
<title>ScriptMarketim - Kurulum</title>
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.11/semantic.min.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.11/semantic.min.js"></script>
</head>
<?php
$step = (isset($_GET['step']) && $_GET['step'] != '') ? $_GET['step'] : '';
switch($step){
  case '1':
  step_1();
  break;
  case '2':
  step_2();
  break;
  case '3':
  step_3();
  break;
  case '4':
  step_4();
  break;
  case '5':
  step_5();
  break;
  default:
  step_1();
}
?>
<body>
<?php
function step_1(){ 
?>
<div class="ui text container">
  <div class="ui middle aligned center aligned grid">
    <div class="column">
      <div class="ui segments">
        <div class="ui inverted orange segment">
          <div class="ui small breadcrumb">
            <div class="section active"><b><u>Başla</u></b></div>
            >
            <div class="section">Lisans</div>
            >
            <div class="section">Gereksinimler</div>
            >
            <div class="section">Veri Tabanı</div>
            >
            <div class="section">Son</div>
          </div>
          <div class="ui divider hidden"> </div>
          <h1>ScriptMarketim Kurulum</h1>
          <p>Satın aldığınız için teşekkür ederiz</p>
          <p><a href="install.php?step=2" class="ui right labeled icon button"> <i class="right arrow icon"></i> Kuruluma Başla </a></p>
          <div class="ui divider hidden"> </div>
        </div>
        <div class="ui stacked secondary segment">
          <p>&copy ZodiaxWeb <?php echo date('Y');?></p>
        </div>
      </div>
    </div>
  </div>
</div>
<?php 
}
function step_2(){ 
 if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['agree'])){
  echo'<script>window.location = "install.php?step=3"</script>';
  exit;
 }
 if($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_POST['agree'])){
  echo '<div class="ui error attached message">Lisans sözleşmesini kabul etmeniz gerekiyor!</div>';
 }
?>
<div class="ui text container">
  <div class="ui middle aligned center aligned grid">
    <div class="column">
      <div class="ui segments">
        <div class="ui inverted orange segment">
          <div class="ui small breadcrumb">
            <div class="section">Başla</div>
            >
            <div class="section sctive"><b><u>Lisans</u></b></div>
            >
            <div class="section">Gereksinimler</div>
            >
            <div class="section">Veri Tabanı</div>
            >
            <div class="section">Son</div>
          </div>
          <div class="ui divider hidden"> </div>
          <h1> ScriptMarketim Lisans Anlaşması</h1>
          <p>Aşağıdaki anlaşmayı kabul ederek devam edebilirsiniz!</p>
          <p>
          <form action="install.php?step=2" class="ui form" method="post">
            <div style="height:320px;width:100%;border:2px solid #ccc; border-radius: 2px;padding: 20px;overflow:auto; text-align: left;background: #fff;">
              <h2 class="ui header"> Son Kullanıcı Lisans Anlaşması (EULA)</h2>
                <div class="ui header"><h4>Son Kullanıcı Lisansı (EULA), bir ürünün sizin tarafınızdan veya bir müşteri adına kişisel veya ticari kullanım için bir projede kullanılmasına izin verir. Ürün kendi başına veya bir projenin parçası olarak tekrar satılamaz, ücretli yada ücretsiz dağıtılamaz.</h4></div>
              
              <div class="ui message">
                <div class="header"> Scripti sizden alıp satabilirmiyim? </div>
                <p>Hayır, bu lisans size sadece kullanım hakkı verir!</p>
              </div>
              <div class="ui message">
                <div class="header"> Bu lisansla scripti kaç domainde kullanabilirim? </div>
                <p>Her lisans sadece 1 domain için kullanım hakkı verir!</p>
              </div>
            </div>
            <br>
            <div class="ui checkbox">
              <input name="agree" type="checkbox" required>
              <label style="color: #fff;">Lisans anlaşmasını kabul ediyorum!</label>
            </div>
            <br>
            <br>
            <a href="install.php?step=1" class="ui left labeled icon button"> <i class="left arrow icon"></i> Geri </a>
            <button type="submit" class="ui right labeled icon button" value="Devam"><i class="right arrow icon"></i>Devam</button>
          </form>
          </p>
          <div class="ui divider hidden"> </div>
        </div>
        <div class="ui stacked secondary segment">
          <p>&copy ZodiaxWeb <?php echo date('Y');?></p>
        </div>
      </div>
    </div>
  </div>
</div>
<?php 
}

function step_3(){
  if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['pre_error'] ==''){
   echo'<script>window.location = "install.php?step=4"</script>';
   exit;
  }
  if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['pre_error'] != '')
   echo $_POST['pre_error'];
      
  if (phpversion() < '5.6') {
   $pre_error = '<div class="ui error attached message">PHP 5.6 ve daha üstü gerekiyor!</div>';
  }
  if (!extension_loaded('pdo')) {
   $pre_error .= '<div class="ui error attached message">PDO eklentisinin aktif olması gerekiyor!</div>';
  }
  if (!is_writable('system/db.php')) {
   $pre_error .= '<div class="ui error attached message">db.php dosyasının yazılabilir olması gerekiyor!</div>';
  }
  ?>
<div class="ui text container">
  <div class="ui middle aligned center aligned grid">
    <div class="column">
      <div class="ui segments">
        <div class="ui inverted orange segment">
          <div class="ui small breadcrumb">
            <div class="section">Başla</div>
            >
            <div class="section">Lisans</div>
            >
            <div class="section active"><b><u>Gereksinimler</u></b></div>
            >
            <div class="section">Veri Tabanı</div>
            >
            <div class="section">Son</div>
          </div>
          <div class="ui divider hidden"> </div>
          <h1>ScriptMarketim Kurulum Gereksinimleri</h1>
          <p>Devam etmeniz için aşapıdaki gereksinimler sağlanmalıdır!</p>
          <p>
          <table class="ui definition table">
            <thead>
            <th>Kontrol Edilenler</th>
              <th>Gereken</th>
              <th>Sağlanan</th>
              <th>Durum</th>
                </thead>
            <tr>
              <td>PHP Versiyon:</td>
              <td><div class="ui horizontal label">PHP 5.6+</div></td>
              <td><div class="ui blue horizontal label"><?php echo phpversion(); ?></div></td>
              <td><?php echo (phpversion() >= '5.6') ? '<div class="ui green horizontal label">Ok</div>' : '<div class="ui red horizontal label">Fail</div>'; ?></td>
            </tr>
            <tr>
              <td>PDO Extention:</td>
              <td><div class="ui horizontal label">Açık</div></td>
              <td><?php echo extension_loaded('pdo') ? '<div class="ui blue horizontal label">Açık</div>' : '<div class="ui red horizontal label">Kapalı</div>'; ?></td>
              <td><?php echo extension_loaded('pdo') ? '<div class="ui green horizontal label">OK</div>' : '<div class="ui red horizontal label">Hata</div>'; ?></td>
            </tr>
            <tr>
              <td>db.php</td>
              <td><div class="ui horizontal label">Yazılabilir</div></td>
              <td><?php echo is_writable('system/db.php') ? '<div class="ui blue horizontal label">Yazılabilir</div>' : '<div class="ui red horizontal label">Yazılamaz</div>'; ?></td>
              <td><?php echo is_writable('system/db.php') ? '<div class="ui green horizontal label">OK</div>' : '<div class="ui red horizontal label">Hata</div>'; ?></td>
            </tr>
          </table>
          <div class="ui divider hidden"> </div>
          <form action="install.php?step=3" method="post">
            <input type="hidden" name="pre_error" id="pre_error" value="" />
            <p><a href="install.php?step=2" class="ui left labeled icon button"> <i class="left arrow icon"></i> Geri </a>
              <button type="submit" name="Devam" class="ui right labeled icon button"> <i class="right arrow icon"></i> Sonraki</button>
            </p>
          </form>
          </p>
          <div class="ui divider hidden"> </div>
        </div>
        <div class="ui stacked secondary segment">
          <p>&copy ZodiaxWeb <?php echo date('Y');?></p>
        </div>
      </div>
    </div>
  </div>
</div>
<?php 
}

function step_4(){
  if (isset($_POST['submit']) && $_POST['submit']=="Kur") {
   $database_host=isset($_POST['database_host'])?$_POST['database_host']:"";
   $database_name=isset($_POST['database_name'])?$_POST['database_name']:"";
   $database_username=isset($_POST['database_username'])?$_POST['database_username']:"";
   $database_password=$_POST['database_password'];
   $web_url=isset($_POST['web_url'])?$_POST['web_url']:"";
  
  if (empty($web_url) || empty($database_host) || empty($database_username) || empty($database_name)) {
   echo '<div class="ui error message attached">Gerekli alanları doldurun!</div>';
  } else {
  $connection = mysqli_connect($database_host, $database_username, $database_password);
   mysqli_select_db($connection,$database_name);

if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
  
   $file ='install.sql';
   if ($sql = file($file)) {
   $query = '';
   foreach($sql as $line) {
    $tsl = trim($line);
   if (($sql != '') && (substr($tsl, 0, 2) != "--") && (substr($tsl, 0, 1) != '#')) {
   $query .= $line;
  
   if (preg_match('/;\s*$/', $line)) {
  
    mysqli_query($connection,$query);
   $query = '';
   }
   }
   }
   @mysqli_query($connection,"INSERT INTO `tsm_settings` (`setting`, `value`) VALUES ('website_url', '".$web_url."')");
   mysqli_close($connection);
   }
   $f=fopen("system/db.php","w");
   $database_inf="<?php
    DEFINE('DB_host','".$database_host."');
    DEFINE('DB_name','".$database_name."');
    DEFINE('DB_user','".$database_username."');
    DEFINE('DB_pass','".$database_password."');
   ?>";
   
  if (fwrite($f,$database_inf)>0){
   fclose($f);
  }
 echo'<script>window.location = "install.php?step=5"</script>';
  }
  }
?>
<div class="ui text container">
  <div class="ui middle aligned center aligned grid">
    <div class="column">
      <div class="ui segments">
        <div class="ui inverted orange segment">
          <div class="ui small breadcrumb">
            <div class="section">Başla</div>
            >
            <div class="section">Lisans</div>
            >
            <div class="section">Gereksinimler</div>
            >
            <div class="section active"><b><u>Veri Tabanı</u></b></div>
            >
            <div class="section">Son</div>
          </div>
          <div class="ui divider hidden"> </div>
          <h1>Veritabanı bilgilerini giriniz</h1>
          <div class="ui divider hidden"> </div>
          <form method="post" action="install.php?step=4" class="ui form">
            <div class="field">
              <input type="text" name="database_host" placeholder="Database Host" value='localhost' size="30">
            </div>
            <div class="field">
              <input type="text" name="database_name" placeholder="Veritabanı Adı" size="30" value="">
            </div>
            <div class="field">
              <input type="text" name="database_username" placeholder="Kullanıcı Adı" size="30" value="">
            </div>
            <div class="field">
              <input type="text" name="database_password" placeholder="Şifre" size="30" value="">
            </div>
            <div class="ui horizontal inverted divider"> Site Adresi</div>
            <div class="field"> Dikkat: SSL sertifikanız varsa adresi <b><u>https</u> ile giriniz</b>
              <input type="text" name="web_url" value="<?php echo 'http://'.$_SERVER['HTTP_HOST']. dirname($_SERVER['PHP_SELF']); ?>" placeholder="Script Directory URL">
            </div>
            <p><a href="install.php?step=3" class="ui left labeled icon button"> <i class="left arrow icon"></i> Geri </a>
              <input type="submit" name="submit" class="ui button" value="Kur">
            </p>
          </form>
        </div>
        <div class="ui stacked secondary segment">
          <p>&copy ZodiaxWeb <?php echo date('Y');?></p>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
}



function step_5(){
?>
<div class="ui text container">
  <div class="ui middle aligned center aligned grid">
    <div class="column">
      <div class="ui segments">
        <div class="ui inverted orange segment">
          <div class="ui small breadcrumb">
            <div class="section active">Başla</div>
            >
            <div class="section active">Lisans</div>
            >
            <div class="section active">Gereksinimler</div>
            >
            <div class="section active">Veri Tabanı</div>
            >
            <div class="section"><b><u>Son</u></b></div>
          </div>
          <div class="ui divider hidden"> </div>
          <h1>Kurulum Tamamlandı!</h1>
          <p>Kurulum başarıyla gerçekleşti!</p>
          <p>
          <div class="ui left aligned message">
            <div class="header"> Giriş </div>
            <p>Aşağıdaki butona basarak admin panele giriş yapınız:
            <div class="ui green horizontal label">admin@admin.com</div>
            <div class="ui green horizontal label">123456</div>
            </p>
            <p>İlk girişte şifrenizi değiştirmek için yönlendirileceksiniz</p>
            <p><b>install.php</b> ve <b>install.sql</b> dosyalarını silmeyi unutmayınız!</p>
          </div>
          <br>
          <a href="admin/" class="ui right labeled icon button"> <i class="right arrow icon"></i> Admin Panele Git </a>
          </p>
          <div class="ui divider hidden"> </div>
        </div>
        <div class="ui stacked secondary segment">
          <p>&copy ZodiaxWeb <?php echo date('Y');?></p>
        </div>
      </div>
    </div>
  </div>
</div>
<?php 
}
?>
</body>
</html>