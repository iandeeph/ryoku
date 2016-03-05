<?php
	$postMessages = isset($postMessages)?$postMessages:'';
	$colorMessages = isset($colorMessages)?$colorMessages:'';
	if(isset($_POST['btnAddNewAboutSocial']) && isset($_POST['addImagesPathAboutSocial']) && $_POST['addImagesPathAboutSocial'] != ''){
		$postTitleAboutSocial = mysqli_real_escape_string($conn, $_POST['addAboutSocialTitle']);
		$postLinkAboutSocial = mysqli_real_escape_string($conn, $_POST['addAboutSocialLink']);
		$uploadOk = 1;
		$target_dir = "../images/";
		$target_file = $target_dir . basename($_FILES["addImageFileAboutSocial"]["name"]);
		$filePath = "images/" . basename($_FILES["addImageFileAboutSocial"]["name"]);
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// Check if image file is a actual image or fake image
	    $check = getimagesize($_FILES["addImageFileAboutSocial"]["tmp_name"]);
	    if($check !== false) {
	        $postMessages = "File is an image - " . $check["mime"] . ".";
	        $colorMessages = "green-text";
	        $uploadOk = 1;
	    } else {
	        $uploadImages = "File is not an image.";
	        $colorMessages = "red-text";
	        $uploadOk = 0;
	    }
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		    $postMessages = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	        $colorMessages = "green-text";
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
			$filenameAdmin=basename($filePath,$imageFileType);
			$newFileNameAdmin=$filenameAdmin.time().".".$imageFileType;
		    if (move_uploaded_file($_FILES["addImageFileAboutSocial"]["tmp_name"], "../images/".$newFileName)) {
				$insertAddAboutSocial = "INSERT INTO social (name, link) VALUES ('".$postTitleAboutSocial."', '".$postLinkAboutSocial."')";
				if(mysqli_query($conn, $insertAddAboutSocial)){
					$LastIdAboutSocial = mysqli_insert_id($conn);
				    logging($now, $user, "Add New Social Item", "Name : ".$postTitleAboutSocial."<br>Link : ".$postLinkAboutSocial, $LastIdAboutSocial);

					$insertAddImages = "INSERT INTO images (title, path, owner, idowner) VALUES ('Social Images', 'images/".$newFileNameAdmin."', 'social', '".$LastIdAboutSocial."')";
					if(mysqli_query($conn, $insertAddImages)){

						$postMessages = "New social added";
				        $colorMessages = "green-text";
				        header('Location: ./index.php?menu=about&cat=social');
				    }else{
				    	$postMessages = "ERROR: Could not able to execute ".$insertAddImages.". " . mysqli_error($conn);
			        	$colorMessages = "red-text";
				    }
				} else{
					$postMessages = "ERROR: Could not able to execute ".$insertAddAboutSocial.". " . mysqli_error($conn);
			        $colorMessages = "red-text";
				}
		    } else {
		        $postMessages = "Sorry, there was an error uploading your file.";
	        	$colorMessages = "red-text";
		    }
		}
	}
// ============================== BUTTON DELETE CLICK ==========================================================
	if(isset($_POST['btnDeleteAboutSocial'])){
		foreach ($_POST['checkboxAboutSocial'] as $selectedIdAboutSocial) {
			$delAboutSocialQry = "DELETE FROM social WHERE idsocial = '".$selectedIdAboutSocial."'";
			$delImagesQry = "DELETE FROM images WHERE owner = 'social' AND idowner = '".$selectedIdAboutSocial."'";

			// ================================== LOGGING
				$nameDelSocialQry = "";
				$nameDelSocialQry = "SELECT name, link FROM social WHERE idsocial = '".$selectedIdAboutSocial."' LIMIT 1";
				if($resultDelNameSocialQry = mysqli_query($conn, $nameDelSocialQry)){
					if (mysqli_num_rows($resultDelNameSocialQry) > 0) {
						$rowDelNameSocial = mysqli_fetch_array($resultDelNameSocialQry);
						$nameDelSocial        	= $rowDelNameSocial['name'];
						$linkDelSocial        	= $rowDelNameSocial['link'];
					}
				}
			// ================================== LOGGING
			if (mysqli_query($conn, $delAboutSocialQry) && mysqli_query($conn, $delImagesQry)) {
				logging($now, $user, "Delete Social Item", "Name : ".$nameDelSocial."<br>Link : ".$linkDelSocial, $selectedIdAboutSocial);
			    $postMessages =  "Record deleted successfully";
				$colorMessages = "green-text";
			} else {
			    $postMessages = "Error deleting record: " . mysqli_error($conn);
	        	$colorMessages = "red-text";
			}
		}
	}

// ============================== BUTTON DELETE CLICK ==========================================================

// ============================== BUTTON UPDATE CLICK ==========================================================

	if(isset($_POST['updateSelectionAboutSocialButton'])){
		foreach ($_POST['checkboxAboutSocial'] as $selectedIdAboutSocial) {
			$postUpdateTitleAboutSocial = $_POST['titleAboutSocial'.$selectedIdAboutSocial];
			$postUpdateLinkAboutSocial 	= $_POST['linkAboutSocial'.$selectedIdAboutSocial];

			$updateAboutSocialQry = "UPDATE social SET name = '".$postUpdateTitleAboutSocial."', link = '".$postUpdateLinkAboutSocial."' WHERE idsocial = '".$selectedIdAboutSocial."'";

		// ================================== LOGGING
			$nameUpdateSocialQry = "";
			$nameUpdateSocialQry = "SELECT name, link FROM social WHERE idsocial = '".$selectedIdAboutSocial."' LIMIT 1";
			if($resultUpdateSocialQry = mysqli_query($conn, $nameUpdateSocialQry)){
				if (mysqli_num_rows($resultUpdateSocialQry) > 0) {
					$rowUpdateSocial = mysqli_fetch_array($resultUpdateSocialQry);
					$nameUpdateSocial        	= $rowUpdateSocial['name'];
					$linkUpdateSocial        	= $rowUpdateSocial['link'];
				}
			}

			if($postUpdateTitleAboutSocial != $nameUpdateSocial || $postUpdateLinkAboutSocial != $linkUpdateSocial){
				$logingContentText = "Old Name : ".$nameUpdateSocial."<br>Old Link : ".$linkUpdateSocial."<br>New Name : ".$postUpdateTitleAboutSocial."<br>New Link : ".$postUpdateLinkAboutSocial;
			// ================================== LOGGING
				if (mysqli_query($conn, $updateAboutSocialQry))	 {
					logging($now, $user, "Update Social Item", $logingContentText, $selectedIdAboutSocial);
				    $postMessages =  "Record update successfully";
					$colorMessages = "green-text";
				} else {
				    $postMessages = "Error updating record: " . mysqli_error($conn);
		        	$colorMessages = "red-text";
				}
			}
		}
	}
// ============================== BUTTON UPDATE CLICK ==========================================================

// ============================== BUTTON UPDATE WORD SOCIAL CLICK ==========================================================

if(isset($_POST['btnAboutSocialContentWord'])){
	$postContentWordAboutSocial = $_POST['aboutSocialContentWord'];
	$postIdSocial = $_POST['aboutSocialId'];

	$updateContentWordAboutSocialQry = "UPDATE social SET contentWord = '".$postContentWordAboutSocial."' WHERE idsocial = '".$postIdSocial."'";

	// ================================== LOGGING
	$nameUpdateContentWordSocialQry = "";
	$nameUpdateContentWordSocialQry = "SELECT contentWord FROM social WHERE idsocial = '".$postIdSocial."' LIMIT 1";
	if($resultUpdateContentWordSocialQry = mysqli_query($conn, $nameUpdateContentWordSocialQry)){
		if (mysqli_num_rows($resultUpdateContentWordSocialQry) > 0) {
			$rowUpdateContentWordSocial = mysqli_fetch_array($resultUpdateContentWordSocialQry);
			$contentWordUpdateSocial   = $rowUpdateContentWordSocial['contentWord'];
		}
	}
	if(strip_tags($postContentWordAboutSocial) != strip_tags($contentWordUpdateSocial)){
		$logingContentText = "Old Description : ".$contentWordUpdateSocial."<br>New Description : ".$postContentWordAboutSocial;
	// ================================== LOGGING
		if (mysqli_query($conn, $updateContentWordAboutSocialQry)){
			logging($now, $user, "Update Social Description", $logingContentText, $postIdSocial);
		 //    $postMessages =  "Word for Social update successfully";
			// $colorMessages = "green-text";
		} else {
		    $postMessages = "Error updating record: " . mysqli_error($conn);
	    	$colorMessages = "red-text";
		}
	}
}
// ============================== BUTTON UPDATE WORD SOCIAL CLICK ==========================================================
?>
<div class="row">
	<div class="col s12 border-bottom grey lighten-2 mb-50">
		<h3 class="left-align">Social</h3>
	</div>
	<div class="col s12">
		<form action="#" method="post" enctype="multipart/form-data">
			<div class="col s12">
				<?php
					if($_SESSION['privilege'] == '1'){
						?>
							<a id="delSelectionAboutSocialButton" href="#modalDelAboutSocialItems" class="waves-effect waves-light btn red accent-4 disabled" disabled><i class="material-icons left">delete</i>Delete</a>
						<?php
					}
				?>
				<button id="updateSelectionAboutSocialButton" name="updateSelectionAboutSocialButton" class="waves-effect waves-light btn blue darken-4 disabled" disabled><i class="material-icons left">subdirectory_arrow_left</i>Update</button>
				<a href="#modalAddAboutSocialItems" class="modal-trigger btn-floating btn-large waves-effect waves-light green darken-4 right"><i class="material-icons">add</i></a>
			</div>
			<div class="col s12">
				<span class="<?php echo $colorMessages;?>"><?php echo $postMessages;?></span>
			</div>
			<table class="highlight border-bottom">
				<thead>
					<tr>
						<td width="50px">
							<p>
								<input type="checkbox" id="checkAll" />
								<label for="checkAll"></label>
							</p>
						</td>
						<td width="100px">
							Images
						</td>
						<td width="300px">
							Name
						</td>
						<td width="500px">
							Link
						</td>
					</tr>
				</thead>
				<tbody>
					<?php
					if($resultSocialQry = mysqli_query($conn, "SELECT * FROM social ORDER BY idsocial DESC")){
				        if (mysqli_num_rows($resultSocialQry) > 0) {
					        while ($rowSocial = mysqli_fetch_array($resultSocialQry)) {
					            $idsocial = $rowSocial['idsocial'];
					            $nameSocial = $rowSocial['name'];
					            $linkSocial = $rowSocial['link'];

					            $imagesSocialQry = "SELECT * FROM images WHERE (owner = 'social' AND idowner = '".$idsocial."') LIMIT 1";
					            
					            if ($resultImagesSocialQry = mysqli_query($conn, $imagesSocialQry)) {
					            	if (mysqli_num_rows($resultImagesSocialQry) > 0) {
										$rowImagesSocial = mysqli_fetch_array($resultImagesSocialQry);
						            	$idimagessocial 	= $rowImagesSocial['idimages'];
										$titleImagesSocial  = $rowImagesSocial['title'];
										$pathImagesSocial  	= $rowImagesSocial['path'];
										?>
										<tr>
											<td>
												<p>
													<input name="checkboxAboutSocial[]" type="checkbox" id="<?php echo "checkboxAboutSocial".$idimagessocial; ?>" value="<?php echo $idsocial; ?>"/>
													<label for="<?php echo "checkboxAboutSocial".$idimagessocial; ?>"></label>
												</p>
											</td>
											<td>
												<a href="<?php echo "#uploadModal".$idimagessocial; ?>" class="modal-trigger"><img width="150px" src="<?php echo "../".$pathImagesSocial; ?>" alt="<?php echo $titleImagesSocial; ?>" class="responsive-img" title="klick to change image"></a>
											</td>
											<td>
												<div class="input-field">
													<input id="<?php echo "titleAboutSocial".$idsocial; ?>" name="<?php echo "titleAboutSocial".$idsocial; ?>" class="validate" value="<?php echo $nameSocial; ?>">
												</div>
											</td>
											<td>
												<div class="input-field">
													<input id="<?php echo "linkAboutSocial".$idsocial; ?>" name="<?php echo "linkAboutSocial".$idsocial; ?>" class="validate" value="<?php echo $linkSocial; ?>">
												</div>
											</td>
										</tr>
										<!-- ======================== MODAL =========================================================== -->
										<div id="<?php echo "uploadModal".$idimagessocial; ?>" class="modal">
											<div class="modal-content">
												<div class="border-bottom mb-10"><h4>Change Image</h4></div>
												<div class="col s12 mb-30 mt-30 center container">
													<div class="file-field input-field col s12">
														<img id="<?php echo "image_upload_preview_about_social".$idimagessocial; ?>" max-width="500px" src="<?php echo "../".$pathImagesSocial; ?>" class="responsive-img">
														<div class="file-field input-field col s12">
															<div class="btn green darken-4">
																<span>Change</span>
																<input id="<?php echo "changeImageFileAboutsocial".$idimagessocial; ?>" name="<?php echo "changeImageFileAboutsocial".$idimagessocial; ?>" type="file">
															</div>
															<div class="file-path-wrapper">
																<input id="<?php echo "changeImagesPathAboutsocial".$idimagessocial; ?>" name="<?php echo "changeImagesPathAboutsocial".$idimagessocial; ?>" class="file-path validate" type="text">
															</div>
														</div>
														<div class="col s12">
															<button type="submit" id="<?php echo "btnChangeImagesAboutsocial".$idimagessocial; ?>" name="<?php echo "btnChangeImagesAboutsocial".$idimagessocial; ?>" class="waves-effect waves-light btn blue darken-4 right"><i class="material-icons left">subdirectory_arrow_left</i>Update</button>
														</div>
													</div>
												</div>
											</div>
										</div>
										<!-- ======================== MODAL =========================================================== -->
										<?php
										$btnChangeImagesAboutsocial = "btnChangeImagesAboutsocial".$idimagessocial;
										$changeImageFileAboutsocial = "changeImageFileAboutsocial".$idimagessocial;
										$changeImagesPathAboutsocial = "changeImagesPathAboutsocial".$idimagessocial;
										if(isset($_POST[$btnChangeImagesAboutsocial])){
											$uploadOk = 1;
											if(isset($_POST[$changeImagesPathAboutsocial]) && $_POST[$changeImagesPathAboutsocial] != ''){
												$target_dir = "../images/";
												$target_file = $target_dir . basename($_FILES[$changeImageFileAboutsocial]["name"]);
												$filePath = "images/" . basename($_FILES[$changeImageFileAboutsocial]["name"]);
												$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
												// Check if image file is a actual image or fake image
											    $check = getimagesize($_FILES[$changeImageFileAboutsocial]["tmp_name"]);
											    if($check !== false) {
											        $postMessages = "File is an image - " . $check["mime"] . ".";
											        $colorMessages = "green-text";
											        $uploadOk = 1;
											    } else {
											        $uploadImages = "File is not an image.";
											        $colorMessages = "red-text";
											        $uploadOk = 0;
											    }
												// Allow certain file formats
												if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
												&& $imageFileType != "gif" ) {
												    $postMessages = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
											        $colorMessages = "green-text";
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
													$filenameAdmin=basename($filePath,$imageFileType);
													$newFileNameAdmin=$filenameAdmin.time().".".$imageFileType;
												    if (move_uploaded_file($_FILES[$changeImageFileAboutsocial]["tmp_name"], "../images/".$newFileName)) {

												    	$delPrevImagesAboutsocial = "SELECT path FROM images WHERE owner = 'social' AND idimages = '".$idimagessocial."'";
												    	if($resultAboutsocial = mysqli_query($conn, $delPrevImagesAboutsocial)){
															if(mysqli_num_rows($resultAboutsocial) > 0){
																$rowDeleteAboutsocial = mysqli_fetch_array($resultAboutsocial);
																$pathImagesAboutsocial = $rowDeleteAboutsocial['path'];
																unlink("../".$pathImagesAboutsocial);
															}
														}

														$updateChangeImagesFile = "UPDATE images SET path = 'images/".$newFileNameAdmin."' WHERE owner = 'social' AND idimages = '".$idimagessocial."'";
														if(mysqli_query($conn, $updateChangeImagesFile)){
															logging($now, $user, "Update Social Images", "../images/".$newFileName, $idimagessocial);
															$postMessages = "Images Updated";
													        $colorMessages = "green-text";
					        								header('Location: ./index.php?menu=about&cat=social');
													    }else{
													    	$postMessages = "ERROR: Could not able to execute ".$updateChangeImagesFile.". " . mysqli_error($conn);
												        	$colorMessages = "red-text";
													    }
												    } else {
												        $postMessages = "Sorry, there was an error changing your file.";
											        	$colorMessages = "red-text";
												    }
												}
											}else {
										        $postMessages = "Sorry, file not selected";
									        	$colorMessages = "red-text";
									        }
										}else{
											$postMessages = "";
											$colorMessages = "";
										}
									}
					            }
							}
						}
					}
					?>
				</tbody>
			</table>
			<div id="modalDelAboutSocialItems" class="modal">
				<div class="modal-content">
					<h4>Deleting Confirmation</h4>
					<h5>Are you sure want to delete selected item(s) ?</h5>
				</div>
				<div class="modal-footer col s12 mb-50">
					<button type="submit" name="btnDeleteAboutSocial" class="waves-effect waves-light btn green darken-4 right">Yes</button>
					<a href="#!" class="modal-action modal-close waves-effect waves-light btn blue darken-4 right">Cancel</a>
				</div>
			</div>
		</form>
		<div id="modalAddAboutSocialItems" class="modal">
			<div class="modal-content">
				<div class="border-bottom mb-10"><h4>Add Top Banner</h4></div>
				<div class="col s12 mt-30 center container">
					<form action="#" method="post" enctype="multipart/form-data">
						<div class="file-field input-field col s12">
							<img id="image_upload_preview_about_service" max-width="500px" class="image_upload_preview responsive-img img-center mb-30" src="<?php echo "../images/emptyimages.bmp"; ?>">
							<div class="btn green darken-4">
								<span>Upload Image</span>
								<input id="changeImageFileAboutSocial" name="addImageFileAboutSocial" type="file" required>
							</div>
							<div class="file-path-wrapper">
								<input id="addImagesPathAboutSocial" name="addImagesPathAboutSocial" class="file-path validate" type="text" required>
							</div>
						</div>
						<div class="file-field input-field col s12">
							<input id="addAboutSocialTitle" name="addAboutSocialTitle" type="text" class="validate" required>
							<label for="addAboutSocialTitle">Social Name</label>
						</div>
						<div class="file-field input-field col s12">
							<textarea id="addAboutSocialLink" name="addAboutSocialLink" class="materialize-textarea" required></textarea>
							<label for="addAboutSocialLink">Social Link</label>
						</div>
						<div class="input-field col s12 mb-50">
							<button type="submit" name="btnAddNewAboutSocial" class="waves-effect waves-light btn green darken-4 right">Add</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="col s12 border-bottom grey lighten-2 mt-10">
			<h3 class="left-align">Word for Social</h3>
		</div>
		<form action="#" method="post" enctype="multipart/form-data">
			<div class="col s12 mt-50">
				<?php
                  $contactWordQty = "SELECT idsocial, contentWord FROM social LIMIT 1";
                  if($resultWord = mysqli_query($conn, $contactWordQty)){
                    $rowWord = mysqli_fetch_array($resultWord);
                    $idcontentWordAbout = $rowWord['idsocial'];
                    $contentWordAbout = $rowWord['contentWord'];
                  }
                ?>
				<textarea id="wysiwygEditor" name="aboutSocialContentWord" class="materialize-textarea"><?php echo htmlspecialchars($contentWordAbout); ?></textarea>
				<input type="hidden" name="aboutSocialId" value="<?php echo $idcontentWordAbout; ?>"/>
			</div>
			<div class="col s12 mt-30">
				<button type="submit" id="btnAboutSocialContentWord" name="btnAboutSocialContentWord" class="right waves-effect waves-light btn blue darken-4"><i class="material-icons left">subdirectory_arrow_left</i>Update</button>
			</div>
		</form>
	</div>
</div>