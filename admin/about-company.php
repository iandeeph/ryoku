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
<div class="col s12 border-bottom grey lighten-2 mb-50">
	<h3 class="left-align">Company Profile</h3>
</div>
<div class="col s12">
	<form action="#" method="post" enctype="multipart/form-data">
		<div class="col s12">
			<img class="responsive-img img-center mb-30" src="<?php echo "../".$pathAbout; ?>" alt="<?php echo $nameAbout; ?>" title="<?php echo $nameAbout; ?>">
			<div class="file-field input-field container">
				<div class="btn green darken-4">
					<span>Change</span>
					<input type="file">
				</div>
				<div class="file-path-wrapper">
					<input class="file-path validate" type="text">
				</div>
			</div>
		</div>
		<div class="container">
			<div class="col s12">
				<textarea id="wysiwygEditor" class="materialize-textarea"><?php echo $aboutWordAbout; ?></textarea>
			</div>
			<div class="col s12 mt-30">
				<a class="right waves-effect waves-light btn blue darken-4 disabled"><i class="material-icons left">subdirectory_arrow_left</i>Update</a>
			</div>
		</div>
	</form>
</div>