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
	<div class="col s12">
	  <div class="container">
	    <div class="col s12 center">
	      <h3 class="black-text">ABOUT COMPANY</h3>
	    </div>
		<div class="col s12 valign-wrapper">
			<img class="responsive-img img-center mb-30" src="<?php echo $pathAbout; ?>" alt="<?php echo $nameAbout; ?>" title="<?php echo $nameAbout; ?>">
		</div>
		<div class="col s12">
			<p style="text-align:justify">
				<?php echo $aboutWordAbout; ?>
			</p>
		</div>
		<div class="col s12 center">
	      <h3 class="black-text">OUR CLIENT</h3>
	    </div>
	    <div class="col s12 center border-bottom">
	    	<?php
	    	$clientQry = "SELECT * FROM client";
			if($resultClientQry = mysqli_query($conn, $clientQry)){
				if(mysqli_num_rows($resultClientQry) > 0){
					while ($rowClientQry = mysqli_fetch_array($resultClientQry)) {
						$idclient 	= $rowClientQry['idclient'];
						$nameClient	= $rowClientQry['name'];

						$imagesClientQry = "SELECT * FROM images WHERE owner = 'client' AND idowner = '".$idclient."' LIMIT 1";
						if($resultImagesClientQry = mysqli_query($conn, $imagesClientQry)){
							if(mysqli_num_rows($resultImagesClientQry) > 0){
								$rowImagesClientQry = mysqli_fetch_array($resultImagesClientQry);
								$idimagesClient	= $rowImagesClientQry['idimages'];
								$titleClient	= $rowImagesClientQry['title'];
								$pathClient 	= $rowImagesClientQry['path'];
								?>
	    							<img class="responsive-img ml-10 mr-10 mt-10 mb-10" alt="<?php echo $titleClient;?>" title="<?php echo $nameClient;?>" src="<?php echo $pathClient;?>" width="150px">
	    						<?php
							}
						}
					}
				}
			}
	    	?>
		</div>
	</div>
</div>