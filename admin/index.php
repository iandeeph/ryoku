<?php
ob_start();
ini_set("display_errors", "1");
ini_set('error_reporting', E_ALL);
error_reporting(E_ALL);
session_start();

require "../sql/connect.php";

foreach($_POST as $key => $val) {
  if (!is_array($val)) {
    $_POST[$key] = mysql_real_escape_string($val);
  }
}

$menu = isset($_GET['menu'])?$_GET['menu']:'';
?><!DOCTYPE html>
<html>
  <head>
    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css"  media="screen,projection"/>
    <link rel="stylesheet" href="../css/style.css">

    <!-- ICON -->
    <link rel="apple-touch-icon" sizes="57x57" href="../icon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="../icon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="../icon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="../icon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="../icon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="../icon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="../icon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="../icon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="../icon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="../icon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../icon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="../icon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../icon/favicon-16x16.png">
    <link rel="manifest" href="../icon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="../icon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Admin Panel</title>
  </head>
  <body>
	<header>
		<div class="navbar-fixed">
			<nav>
				<div class="nav-wrapper navbar-fixed grey darken-3 valign-wrapper">
					<a href="#" data-activates="side-menu" class="button-collapse left"><i class="material-icons">menu</i></a>
					<a href="#!" class="center brand-logo"><img src="../images/logo.png" width="110px"></a>
					<div style="width:100%" class="hide-on-med-and-down"><h4 class="right-align mr-30">Admin Control Panel</h4></div>
				</div>
			</nav>
		</div>
		<ul id="side-menu" class="side-nav fixed" style="width: 240px; top: 100px">
			<li class="bold"><a href="./index.php?menu=banner"><i class="material-icons mt-20 left">home</i>Home Banner</a></li>
			<li class="bold no-padding">
				<ul class="collapsible" data-colapsible="accordion">
				  <li>
				    <a class="collapsible-header"><i class="material-icons left">business</i>About</a>
				    <div class="collapsible-body">
				      <ul>
				        <li class="bold"><a href="./index.php?menu=about&cat=company">Company Profile</a></li>
				        <li class="bold"><a href="./index.php?menu=about&cat=service">Service</a></li>
				        <li class="bold"><a href="./index.php?menu=about&cat=client">Client</a></li>
				        <li class="bold"><a href="./index.php?menu=about&cat=social">Social</a></li>
				        <li class="bold"><a href="./index.php?menu=about&cat=contact">Contact</a></li>
				      </ul>
				    </div>
				  </li> 
				</ul>
			</li>
			<li class="bold no-padding">
				<ul class="collapsible" data-colapsible="accordion">
				  <li>
				    <a class="collapsible-header"><i class="material-icons left">toys</i>Product</a>
				    <div class="collapsible-body">
				      <ul>
				        <li class="bold"><a href="./index.php?menu=product&cat=brand">Brand</a></li>
				        <li class="bold"><a href="./index.php?menu=product&cat=list">List Product</a></li>
				      </ul>
				    </div>
				  </li> 
				</ul>
			</li>
			<li class="bold"><a href="./index.php?menu=project"><i class="material-icons mt-20 left">work</i>Project</a></li>
			<li class="bold"><a href="./index.php?menu=user"><i class="material-icons mt-20 left">person</i>User</a></li>
			<li class="bold"><a href="./index.php?menu=visitor"><i class="material-icons mt-20 left">contact_mail</i>Visitor</a></li>
		</ul>
	</header>
    <main>
    	<div class="menu-admin">
	    	<?php
	        switch ($menu) {
	          case 'banner':
	            include 'home.php';
	            break;

	          case 'about':
	            include 'about.php';
	            break;
	          
	          case 'product':
	            include 'product.php';
	            break;

	          case 'user':
	            include 'contact.php';
	            break;

	          case 'visitor':
	            include 'project.php';
	            break;

	          default:
	            include 'home.php';
	            break;
	        }
	      ?>
    	</div>
    	</div>
    </main>
    <script type="text/javascript" src="../js/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="../js/materialize.min.js"></script>
    <script src="../js/owl.carousel.js"></script>
    <script src="../js/jquery.swipebox.min.js"></script>
    <script type="text/javascript" src="../js/collapsibleLists.min.js"></script>
    <script type="text/javascript" src="../js/ryoku.js"></script>
  </body>
</html>