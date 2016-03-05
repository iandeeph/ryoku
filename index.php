<?php
ob_start();
ini_set("display_errors", "1");
ini_set('error_reporting', E_ALL);
error_reporting(E_ALL);
session_start();

require "sql/connect.php";

foreach($_POST as $key => $val) {
  if (!is_array($val)) {
    $_POST[$key] = mysqli_real_escape_string($conn, $val);
  }
}

$menu = isset($_GET['menu'])?$_GET['menu']:'';
$brand = isset($_GET['brand'])?$_GET['brand']:'';
$cat = isset($_GET['cat'])?$_GET['cat']:'';

$companyQry = "";
$companyQry = "SELECT * FROM company LIMIT 1";
if($resultCompanyQry = mysqli_query($conn, $companyQry)){
  if(mysqli_num_rows($resultCompanyQry) > 0){
    $rowCompanyQry = mysqli_fetch_array($resultCompanyQry);
    $idcompany    = $rowCompanyQry['idcompany'];
    $nameCompany  = $rowCompanyQry['name'];

    $imagesCompanyQry = "";
    $imagesCompanyQry = "SELECT * FROM images WHERE owner = 'company' AND idowner = '".$idcompany."' LIMIT 1";
    if($resultImagesCompanyQry = mysqli_query($conn, $imagesCompanyQry)){
      if(mysqli_num_rows($resultImagesCompanyQry) > 0){
        $rowImagesCompanyQry = mysqli_fetch_array($resultImagesCompanyQry);
        $idimagesCompany  = $rowImagesCompanyQry['idimages'];
        $titleCompany   = $rowImagesCompanyQry['title'];
        $pathCompany    = $rowImagesCompanyQry['path'];
      }
    }

    $outletCompanyQry = "";
    $outletCompanyQry = "SELECT * FROM outlet LIMIT 1";
    if($resultOutletCompanyQry = mysqli_query($conn, $outletCompanyQry)){
      if(mysqli_num_rows($resultOutletCompanyQry) > 0){
        $rowOutletCompanyQry = mysqli_fetch_array($resultOutletCompanyQry);
        $idoutlet       = $rowOutletCompanyQry['idoutlet'];
        $addressoutlet  = $rowOutletCompanyQry['address'];
      }
    }

    $phoneCompanyQry = "";
    $phoneCompanyQry = "SELECT * FROM phone WHERE idoutlet = '".$idoutlet."' LIMIT 1";
    if($resultPhoneCompanyQry = mysqli_query($conn, $phoneCompanyQry)){
      if(mysqli_num_rows($resultPhoneCompanyQry) > 0){
        $rowPhoneCompanyQry = mysqli_fetch_array($resultPhoneCompanyQry);
        $idphone      = $rowPhoneCompanyQry['idphone'];
        $phoneCompany = $rowPhoneCompanyQry['phone'];
        $faxCompany   = $rowPhoneCompanyQry['fax'];
      }
    }
  }
}
?>
<!DOCTYPE html>
<html>
  <head>
    <!--Import Google Icon Font-->
    <link href="css/material-icon.css" rel="stylesheet">

    <script src='js/tinymce/tinymce.min.js'></script>
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
    <link href="css/owl.carousel.css" rel="stylesheet">
    <link rel="stylesheet" href="css/swipebox.css">
    <link rel="stylesheet" href="css/owl.theme.css">
    <link rel="stylesheet" href="css/style.css">
    <!-- ICON -->
    <link rel="apple-touch-icon" sizes="57x57" href="icon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="icon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="icon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="icon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="icon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="icon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="icon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="icon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="icon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="icon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="icon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="icon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="icon/favicon-16x16.png">
    <link rel="manifest" href="icon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="icon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Ryoku Petrojaya Mandiri</title>
  </head>

  <body>
    <header>
      <div class="navbar-fixed">
        <nav>
          <div class="nav-wrapper blue darken-4 valign-wrapper">
            <div class="container">
              <div class="row valign-wrapper">
                <a href="#" data-activates="mobile-demo" class="button-collapse left mt-10"><i class="material-icons">menu</i></a>
                <div class="col s12 right">
                  <div class="nav-wrapper blue darken-4 hide-on-large-only">
                    <div class="container hide-on-large-only">
                      <a href="./" class="center brand-logo mt-10"><img title="<?php echo $nameCompany?>" alt="<?php echo $titleCompany?>" src="<?php echo $pathCompany?>" width="85px"></a>
                    </div>
                  </div>
                  <ul id="projectDropDown" class="dropdown-content mt-50">
                    <li><a href="./index.php?menu=project&cat=engineering">Engineering</a></li>
                    <li class="divider"></li>
                    <li><a href="./index.php?menu=project&cat=civil">Civil Construction</a></li>
                    <li class="divider"></li>
                    <li><a href="./index.php?menu=project&cat=experience">Experience List</a></li>
                  </ul>
                  <ul id="productDropDown" class="dropdown-content mt-50">
                    <li><a href="./index.php?menu=product&cat=engineering">Engineering</a></li>
                    <li class="divider"></li>
                    <li><a href="./index.php?menu=product&cat=civil">Civil Construction</a></li>
                  </ul>
                  <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <li class="<?php echo ($menu == 'home')? "active" : "";?>"><a class="menu-btn" href="./index.php?menu=home">Home</a></li>
                    <li class="<?php echo ($menu == 'about')? "active" : "";?>"><a class="menu-btn" href="./index.php?menu=about">About</a></li>
                    <li class="<?php echo ($menu == 'product')? "active" : "";?>"><a class="menu-btn dropdown-button" href="#!" data-activates="productDropDown">Product<i class="material-icons right mt-30">arrow_drop_down</i></a></li>
                    <li class="<?php echo ($menu == 'project')? "active" : "";?>"><a class="menu-btn dropdown-button" href="#!" data-activates="projectDropDown">Project<i class="material-icons right mt-30">arrow_drop_down</i></a></li>
                    <li class="<?php echo ($menu == 'gallery')? "active" : "";?>"><a class="menu-btn" href="./index.php?menu=gallery">Gallery</a></li>
                    <li class="<?php echo ($menu == 'contact')? "active" : "";?>"><a class="menu-btn" href="./index.php?menu=contact">Contact</a></li>
                  </ul>
                </div>
              </div>
            </div>
            <ul class="side-nav" id="mobile-demo">
              <li class="bold <?php echo ($menu == 'home')? "active" : "";?>"><a href="./index.php?menu=home">Home</a></li>
              <li class="bold <?php echo ($menu == 'about')? "active" : "";?>"><a href="./index.php?menu=about">About</a></li>
              <li class="bold no-padding <?php echo ($menu == 'product')? "active" : "";?>">
                <ul class="collapsible" data-colapsible="accordion">
                  <li class="<?php echo ($menu == 'product')? "active" : "";?>">
                    <a class="collapsible-header <?php echo ($menu == 'product')? "active" : "";?>">Product</a>
                    <div class="collapsible-body">
                      <ul>
                        <li class="bold <?php echo ($menu == 'product' && $cat == 'engineering')? "active" : "";?>"><a href="./index.php?menu=product&cat=engineering">Engineering</a></li>
                        <li class="bold <?php echo ($menu == 'product' && $cat == 'civil')? "active" : "";?>"><a href="./index.php?menu=product&cat=civil">Civil Construction</a></li>
                      </ul>
                    </div>
                  </li> 
                </ul>
              </li>
              <li class="bold no-padding <?php echo ($menu == 'project')? "active" : "";?>">
                <ul class="collapsible" data-colapsible="accordion">
                  <li class="<?php echo ($menu == 'project')? "active" : "";?>">
                    <a class="collapsible-header <?php echo ($menu == 'project')? "active" : "";?>">Product</a>
                    <div class="collapsible-body">
                      <ul>
                        <li class="bold <?php echo ($menu == 'engineering' && $cat == 'project')? "active" : "";?>"><a href="./index.php?menu=project&cat=engineering">Engineering</a></li>
                        <li class="bold <?php echo ($menu == 'civil' && $cat == 'product')? "active" : "";?>"><a href="./index.php?menu=project&cat=civil">Civil Construction</a></li>
                        <li class="bold <?php echo ($menu == 'experience' && $cat == 'product')? "active" : "";?>"><a href="./index.php?menu=project&cat=experience">Experience List</a></li>
                      </ul>
                    </div>
                  </li> 
                </ul>
              </li>
              <li class="bold"><a href="./index.php?menu=gallery">Gallery</a></li>
              <li class="bold"><a href="./index.php?menu=contact">Contact</a></li>
            </ul>
          </div>
        </nav>
      </div>
      <nav class="hide-on-med-and-down">
        <div class="nav-wrapper blue darken-2">
          <div class="container">
            <a href="./" class="center brand-logo"><img title="<?php echo $nameCompany?>" alt="<?php echo $titleCompany?>" src="<?php echo $pathCompany?>" width="110px"></a>
          </div>
        </div>
      </nav>
    </header>
    <main>
      <?php
        switch ($menu) {
          case 'home':
            include 'home.php';
            break;

          case 'about':
            include 'about.php';
            break;
          
          case 'product':
            include 'product.php';
            break;

          case 'contact':
            include 'contact.php';
            break;

          case 'project':
            include 'project.php';
            break;

          case 'gallery':
            include 'gallery.php';
            break;

          default:
            include 'home.php';
            break;
        }
      ?>

      <!-- GET IN TOUCH START -->
      <div class="row border-top">
        <div class="col s12">
          <div class="container">
            <div class="col s12 center">
              <h3 class="black-text">KEEP IN TOUCH</h3>
            </div>
            <div class="col s12 center">
              <p class="grey-text darken-5-text">
                <?php
                  $contactWordQty = "SELECT contentWord FROM social LIMIT 1";
                  if($resultWord = mysqli_query($conn, $contactWordQty)){
                    $rowWord = mysqli_fetch_array($resultWord);
                    echo $rowWord['contentWord'];
                  }
                ?>
                </p>
            </div>
            <div class="col s12 center" style="mt-30 mb-30">
              <?php
                $socialQry = "SELECT * FROM social";
                if($resultSocialQry = mysqli_query($conn, $socialQry)){
                  if(mysqli_num_rows($resultSocialQry) > 0){
                    while($rowSocial = mysqli_fetch_array($resultSocialQry)){
                      $idsocial   = $rowSocial['idsocial'];
                      $nameSocial = $rowSocial['name'];
                      $linkSocial = $rowSocial['link'];

                      $imagesSocialQry = "SELECT * FROM images WHERE (owner = 'social' and idowner = '".$idsocial."')";
                      if($resultImagesSocial = mysqli_query($conn, $imagesSocialQry)){
                        if(mysqli_num_rows($resultImagesSocial) > 0){
                          while($rowImagesSocial = mysqli_fetch_array($resultImagesSocial)){
                            $idimages     = $rowImagesSocial['idimages'];
                            $pathSocial   = $rowImagesSocial['path'];
                            ?>
                              <a href="<?php echo $linkSocial; ?>">
                                <img class="responsive-img" alt="<?php echo $nameSocial; ?>" title="<?php echo $nameSocial; ?>" src="<?php echo $pathSocial; ?>" width="64">
                              </a>
                            <?php
                          }
                        }
                      }
                    }
                  }
                }
              ?>
            </div>
          </div>
        </div>
      </div>
      <!-- GET IN TOUCH END -->
    </main>

    <!-- FOOTER START -->
    <footer class="page-footer blue darken-2">
      <div class="container">
        <div class="row">
          <div class="col s12">
            <h5 class="white-text">Contact</h5>
            <div class="col s12">
              <div>
                <i class="material-icons grey-text text-lighten-4 left">phone</i>
              </div>
              <div style="margin-left:50px">
                <p class="grey-text text-lighten-4">
                  <?php echo $phoneCompany; ?>
                </p>  
              </div>
              <div>
                <i class="material-icons grey-text text-lighten-4 left">location_on</i>
              </div>
              <div style="margin-left:50px">
                <p class="grey-text text-lighten-4">
                  <?php echo $addressoutlet; ?>
                </p>  
              </div>
          </div>
        </div>
      </div>
    </div>
      <div class="footer-copyright blue darken-4">
        <div class="container">
          &copy 2016 All Right Reserved
          <a class="grey-text text-lighten-4 right" href="#!"><?php echo $nameCompany; ?></a>
        </div>
      </div>
    </footer>
    <!-- FOOTER END -->

    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script src="js/owl.carousel.js"></script>
    <script src="js/jquery.swipebox.min.js"></script>
    <script type="text/javascript" src="js/collapsibleLists.min.js"></script>
    <script type="text/javascript" src="js/ryoku.js"></script>
    <script type="text/javascript" src="js/jssor.slider.debug.js"></script>
  </body>
</html>