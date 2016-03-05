<?php
ob_start();
ini_set("display_errors", "1");
ini_set('error_reporting', E_ALL);
error_reporting(E_ALL);
session_start();

require "../sql/connect.php";

foreach($_POST as $key => $val) {
  if (!is_array($val)) {
    $_POST[$key] = mysqli_real_escape_string($conn, $val);
  }
}

$menu = isset($_GET['menu'])?$_GET['menu']:'';
$cat = isset($_GET['cat'])?$_GET['cat']:'';
$user = (isset($_SESSION['login']) && $_SESSION['login'] == "logged" )?$_SESSION['firstName']." ".$_SESSION['lastName']:'';
$now = date("Y-m-d H:i:s");

function logging($date, $user, $action, $value, $iditem){
	require "../sql/connect.php";
	$insertLogQry = "";
	$insertLogQry = "INSERT INTO log (date, user, action, value, iditem) VALUES ('".$date."', '".$user."', '".$action."', '".$value."', '".$iditem."')";
	if(!mysqli_query($conn, $insertLogQry)){
    	echo "ERROR: Could not able to execute ".$insertLogQry.". " . mysqli_error($conn);
    }else{
    	echo $insertLogQry;
    }
}

$companyLogoQry = "";
$companyLogoQry = "SELECT * FROM company LIMIT 1";
if($resultCompanyLogoQry = mysqli_query($conn, $companyLogoQry)){
	if(mysqli_num_rows($resultCompanyLogoQry) > 0){
		$rowCompanyLogoQry = mysqli_fetch_array($resultCompanyLogoQry);
		$idCompany  = $rowCompanyLogoQry['idcompany'];

		$imagesLogoCompanyQry = "";
		$imagesLogoCompanyQry = "SELECT path FROM images WHERE owner = 'company' AND idowner = '".$idCompany."' LIMIT 1";
		if($resultImagesLogoCompanyQry = mysqli_query($conn, $imagesLogoCompanyQry)){
			if(mysqli_num_rows($resultImagesLogoCompanyQry) > 0){
				$rowImagesLogoCompanyQry = mysqli_fetch_array($resultImagesLogoCompanyQry);
				$pathLogoCompany    = $rowImagesLogoCompanyQry['path'];
			}else{
				$pathLogoCompany = "";
			}
		}
	}
}
?>
<!DOCTYPE html>
<html>
  <head>
    <!--Import Google Icon Font-->
    <link href="../css/material-icon.css" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css"  media="screen,projection"/>
    <link rel="stylesheet" href="../css/style.css">

    <script src='../js/tinymce/tinymce.min.js'></script>

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
    <link rel="alternate" href="http://example.com/en" hreflang="en" />
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
			<div class="navbar-fixed grey darken-3">
				<nav class="grey darken-3">
					<div class="nav-wrapper navbar-fixed grey darken-3 valign-wrapper left-menu">
						<a href="#" data-activates="side-menu" class="button-collapse left ml-30"><i class="menu-side-icon material-icons">menu</i></a>
						<a href="./" class="center brand-logo"><img class="admin-logo" src="<?php echo "../".$pathLogoCompany; ?>"></a>
						<div style="width:100%" class="hide-on-med-and-down"><h4 class="right-align mr-30">Admin Control Panel</h4></div>
					</div>
				</nav>
			</div>
		  	<?php
		  		if(isset($_SESSION['login']) && $_SESSION['login'] == 'logged'){
		  			$firstName = $_SESSION['firstName'];
		  			$lastName = $_SESSION['lastName'];
		  			?>
						<ul id="side-menu" class="side-nav fixed">
							<li class="bold height-100 valign-wrapper" disabled>Hi, <?php echo $firstName." ".$lastName;?></li>
							<li class="divider"></li>
							<li class="bold no-padding" <?php echo ($menu == 'home')? "active" : "";?>>
								<ul class="collapsible" data-colapsible="accordion">
								  <li class=" <?php echo ($menu == 'about')? "active" : "";?>">
								    <a class="collapsible-header <?php echo ($menu == 'about')? "active" : "";?>"><i class="menu-side-icon material-icons left">home</i>About</a>
								    <div class="collapsible-body">
								      <ul>
								        <li class="bold <?php echo ($menu == 'about' && $cat == 'company')? "active" : "";?>"><a href="./index.php?menu=about&cat=company">Company Profile</a></li>
								        <li class="bold <?php echo ($menu == 'about' && $cat == 'service')? "active" : "";?>"><a href="./index.php?menu=about&cat=service">Service</a></li>
								        <li class="bold <?php echo ($menu == 'about' && $cat == 'social')? "active" : "";?>"><a href="./index.php?menu=about&cat=social">Social</a></li>
								        <li class="bold <?php echo ($menu == 'about' && $cat == 'contact')? "active" : "";?>"><a href="./index.php?menu=about&cat=contact">Contact</a></li>
								      </ul>
								    </div>
								  </li>
								</ul>
							</li>
							<li class="bold <?php echo ($menu == 'product')? "active" : "";?>"><a href="./index.php?menu=product"><i class="menu-side-icon material-icons mt-20 left">toys</i>Product</a></li>
							<li class="bold no-padding" <?php echo ($menu == 'project')? "active" : "";?>>
								<ul class="collapsible" data-colapsible="accordion">
								  <li class=" <?php echo ($menu == 'project')? "active" : "";?>">
								    <a class="collapsible-header <?php echo ($menu == 'project')? "active" : "";?>"><i class="menu-side-icon material-icons left">work</i>Project</a>
								    <div class="collapsible-body">
								      <ul>
								        <li class="bold <?php echo ($menu == 'project' && $cat == 'list')? "active" : "";?>"><a href="./index.php?menu=project&cat=list">Project List</a></li>
								        <li class="bold <?php echo ($menu == 'project' && $cat == 'client')? "active" : "";?>"><a href="./index.php?menu=project&cat=client">Client</a></li>
								      </ul>
								    </div>
								  </li>
								</ul>
							</li>
							<li class="bold <?php echo ($menu == 'gallery')? "active" : "";?>"><a href="./index.php?menu=gallery"><i class="menu-side-icon material-icons mt-20 left">collections</i>Gallery</a></li>
							<?php
								if($_SESSION['privilege'] == '1'){
									?>
										<li class="bold <?php echo ($menu == 'user')? "active" : "";?>"><a href="./index.php?menu=user"><i class="menu-side-icon material-icons mt-20 left">person</i>User</a></li>
										<li class="bold <?php echo ($menu == 'log')? "active" : "";?>"><a href="./index.php?menu=log"><i class="menu-side-icon material-icons mt-20 left">content_paste</i>Activity Log</a></li>
									<?php
								}
							?>
							<li class="bold <?php echo ($menu == 'visitor')? "active" : "";?>"><a href="./index.php?menu=visitor"><i class="menu-side-icon material-icons mt-20 left">contact_mail</i>Visitor</a></li>
							<li class="divider"></li>
							<li class="bold"><a href="./index.php?menu=logout"><i class="menu-side-icon material-icons mt-20 left">exit_to_app</i>Logout</a></li>
						</ul>
					<?php
				}else{
			    	include 'login.php';
			    }
			?>
		</header>
    <main>
    	<div class="menu-admin">
		    <?php
		  		if(isset($_SESSION['login']) && $_SESSION['login'] == 'logged'){
			        switch ($menu) {
			          case 'about':
			            include 'about.php';
			            break;
			          
			          case 'gallery':
			            include 'gallery.php';
			            break;

			          case 'product':
			            include 'product.php';
			            break;

			          case 'project':
			            include 'project.php';
			            break;

			          case 'gallery':
			            include 'gallery.php';
			            break;


			          case 'user':
			            include 'user.php';
			            break;

			          case 'log':
			            include 'log.php';
			            break;

			          case 'visitor':
			            include 'visitor.php';
			            break;

			          case 'logout':
			            include 'logout.php';
			            break;

			          default:
			            include 'welcome.php';
			            break;
			        }
			    }
		    ?>
    	</div>
    </main>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
    <script type="text/javascript" src="../js/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="../js/materialize.min.js"></script>
    <script src="../js/owl.carousel.js"></script>
    <script src="../js/jquery.swipebox.min.js"></script>
    <script type="text/javascript" src="../js/collapsibleLists.min.js"></script>
    <script type="text/javascript" src="../js/ryoku.js"></script>
    <script type="text/javascript" src="../js/jssor.slider.debug.js"></script>
  </body>
</html>