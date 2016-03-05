<?php
	$aboutQry = "SELECT 
					profile.idprofile,
					profile.name,
					profile.aboutWord,
					images.title,
					images.path
					FROM profile, images
					WHERE images.owner = 'about' LIMIT 1";
	if($resultAboutQry = mysqli_query($conn, $aboutQry)){
		if(mysqli_num_rows($resultAboutQry) > 0){
			$rowAboutQry = mysqli_fetch_array($resultAboutQry);
			$idprofile 		= $rowAboutQry['idprofile'];
			$nameAbout 		= $rowAboutQry['name'];
			$aboutWordAbout	= $rowAboutQry['aboutWord'];
			$titleAbout		= $rowAboutQry['title'];
			$pathAbout 		= $rowAboutQry['path'];
		}
	}

	$postMessages = "";
	$colorMessages = "";
	if(isset($_POST['btnUpdateAboutCompany'])){
		if(isset($_POST['changeAboutCompanyPath']) && ($_POST['changeAboutCompanyPath'] != '')){
			$uploadOk = 1;
			$target_dir = "../images/";
			$target_file = $target_dir . basename($_FILES["changeAboutCompanyFile"]["name"]);
			$filePath = "images/" . basename($_FILES["changeAboutCompanyFile"]["name"]);
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			// Check if image file is a actual image or fake image
		    $check = getimagesize($_FILES["changeAboutCompanyFile"]["tmp_name"]);
		    if($check !== false) {
		        echo "File is an image - " . $check["mime"] . ".";
		        $uploadOk = 1;
		    } else {
		        $uploadOk = 0;
		    }
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
			    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			    $uploadOk = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
			    $postMessages = "Sorry, your file was not uploaded.";
		        $colorMessages = "red-text";
			// if everything is ok, try to upload file
			} else {
				$filename=basename($target_file,$imageFileType);
                $newFileName=$filename.time().".".$imageFileType;
			    if (move_uploaded_file($_FILES["changeAboutCompanyFile"]["tmp_name"], "../images/".$newFileName)) {

			    	$delPrevImages = "SELECT idimages, path FROM images WHERE owner = 'about'";
			    	if($resultDelete = mysqli_query($conn, $delPrevImages)){
						if(mysqli_num_rows($resultDelete) > 0){
							$rowDeleteAbout = mysqli_fetch_array($resultDelete);
							$idImagesAbout = $rowDeleteAbout['idimages'];
							$pathImagesAbout = $rowDeleteAbout['path'];
							unlink("../".$pathImagesAbout);
						}
					}

					$updateImagesAboutProfile = "UPDATE images SET path = 'images/".$newFileName."' WHERE owner = 'about'";
					if(mysqli_query($conn, $updateImagesAboutProfile)){
    					logging($now, $user, "Update Images About Company", $_POST['changeAboutCompanyPath'], $idImagesAbout);
						$postMessages = "Images Profile Updated";
				        $colorMessages = "green-text";
				        header('Location: ./index.php?menu=about&cat=company');
				    }else{
				    	$postMessages = "ERROR: Could not able to execute ".$updateImagesAboutProfile.". " . mysqli_error($conn);
			        	$colorMessages = "red-text";
				    }
				}
			}
	    }

		if(isset($_POST['changeAboutCompanyTextarea']) && strip_tags($_POST['changeAboutCompanyTextarea']) != strip_tags($aboutWordAbout)){
			$postContentWordAbout = $_POST['changeAboutCompanyTextarea'];
			$updateAboutProfile = "UPDATE profile SET aboutWord = '".$postContentWordAbout."'";
		// ================================== LOGGING
			$logingContentText = "Old Description :<br>".$aboutWordAbout."<br><br>New Description :<br>".$postContentWordAbout;
		// ================================== LOGGING
			if(mysqli_query($conn, $updateAboutProfile)){
    			logging($now, $user, "Update Description Company Profile", $logingContentText, '1');
		        header('Location: ./?menu=about&cat=company');
			} else{
				$postMessages = "ERROR: Could not able to execute ".$updateAboutProfile.". " . mysqli_error($conn);
		        $colorMessages = "red-text";
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
			<div class="file-field input-field container">
				<img id="<?php echo 'image_upload_preview'.$idprofile ;?>" class="responsive-img img-center mb-30" src="<?php echo "../".$pathAbout; ?>" alt="<?php echo $nameAbout; ?>" title="<?php echo $titleAbout; ?>">
				<div class="btn green darken-4">
					<span>Change</span>
					<input id="<?php echo 'changeImageFile'.$idprofile ;?>" name="changeAboutCompanyFile" type="file">
				</div>
				<div class="file-path-wrapper">
					<input class="file-path validate" name="changeAboutCompanyPath" type="text">
				</div>
			</div>
		</div>
		<div class="container">
			<div class="col s12">
				<textarea id="wysiwygEditor" name="changeAboutCompanyTextarea" class="materialize-textarea"><?php echo $aboutWordAbout; ?></textarea>
			</div>
			<div class="col s6 mt-30">
				<span class="<?php echo $colorMessages;?>"><?php echo $postMessages;?></span>
			</div>
			<div class="col s6 mt-30">
				<button name="btnUpdateAboutCompany" class="right waves-effect waves-light btn blue darken-4"><i class="material-icons left">subdirectory_arrow_left</i>Update</button>
			</div>
		</div>
	</form>
</div>