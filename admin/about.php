<?php
	$aboutQry = "SELECT * FROM profile LIMIT 1";
	if($resultAboutQry = mysqli_query($conn, $aboutQry)){
		if(mysqli_num_rows($resultAboutQry) > 0){
			$rowAboutQry = mysqli_fetch_array($resultAboutQry);
			$idprofile 		= $rowAboutQry['idprofile'];
			$nameAbout 		= $rowAboutQry['name'];
			$aboutWordAbout	= $rowAboutQry['aboutWord'];

			$imagesAboutQry = "SELECT * FROM images WHERE owner = 'about' AND idowner = '".$idprofile."' LIMIT 1";
			if($resultImagesAboutQry = mysqli_query($conn, $imagesAboutQry)){
				if(mysqli_num_rows($resultImagesAboutQry) > 0){
					$rowImagesAboutQry = mysqli_fetch_array($resultImagesAboutQry);
					$idimagesAbout	= $rowImagesAboutQry['idimages'];
					$titleAbout		= $rowImagesAboutQry['title'];
					$pathAbout 		= $rowImagesAboutQry['path'];
				}
			}
		}
	}
?>
<div class="row">
	<?php
        switch ($cat) {
          case 'company':
            include 'about-company.php';
            break;

          case 'service':
            include 'about-service.php';
            break;
          
          case 'social':
            include 'about-social.php';
            break;

          case 'contact':
            include 'about-contact.php';
            break;

          default:
            include 'about-company.php';
            break;
        }
    ?>
</div>