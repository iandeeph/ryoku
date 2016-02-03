<?php
	$postMessages = "";
	$colorMessages = "";
	if(isset($_POST['btnAddNewAboutService']) && isset($_POST['addImagesPathAboutService']) && $_POST['addImagesPathAboutService'] != ''){
		$postTitleAboutService = mysqli_real_escape_string($conn, $_POST['addAboutServiceTitle']);
		$postContentWordAboutService = mysqli_real_escape_string($conn, $_POST['addAboutServiceContentWord']);
		$uploadOk = 1;
		$target_dir = "../images/";
		$target_file = $target_dir . basename($_FILES["addImageFileAboutService"]["name"]);
		$filePath = "images/" . basename($_FILES["addImageFileAboutService"]["name"]);
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// Check if image file is a actual image or fake image
	    $check = getimagesize($_FILES["addImageFileAboutService"]["tmp_name"]);
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
		    if (move_uploaded_file($_FILES["addImageFileAboutService"]["tmp_name"], $target_file)) {
				$insertAddAboutService = "INSERT INTO service (name, contentWord) VALUES ('".$postTitleAboutService."', '".$postContentWordAboutService."')";
				if(mysqli_query($conn, $insertAddAboutService)){
					$LastIdAboutService = mysqli_insert_id($conn);

					$insertAddImages = "INSERT INTO images (title, path, owner, idowner) VALUES ('Service Images', '".$filePath."', 'Service', '".$LastIdAboutService."')";
					if(mysqli_query($conn, $insertAddImages)){

						$postMessages = "New Service added";
				        $colorMessages = "green-text";
				        header('Location: ./index.php?menu=about&cat=service');
				    }else{
				    	$postMessages = "ERROR: Could not able to execute ".$insertAddImages.". " . mysqli_error($conn);
			        	$colorMessages = "red-text";
				    }
				} else{
					$postMessages = "ERROR: Could not able to execute ".$insertAddAboutService.". " . mysqli_error($conn);
			        $colorMessages = "red-text";
				}
		    } else {
		        $postMessages = "Sorry, there was an error uploading your file.";
	        	$colorMessages = "red-text";
		    }
		}
	}
// ============================== BUTTON DELETE CLICK ==========================================================
	if(isset($_POST['btnDeleteAboutService'])){
		foreach ($_POST['checkboxAboutService'] as $selectedIdAboutService) {
			$delAboutServiceQry = "DELETE FROM service WHERE idservice = '".$selectedIdAboutService."'";
			$delImagesQry = "DELETE FROM images WHERE owner = 'service' AND idowner = '".$selectedIdAboutService."'";

			if (mysqli_query($conn, $delAboutServiceQry) && mysqli_query($conn, $delImagesQry)) {
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

	if(isset($_POST['updateSelectionAboutServiceButton'])){
		foreach ($_POST['checkboxAboutService'] as $selectedIdAboutService) {
			$postUpdateTitleAboutService = mysqli_real_escape_string($conn, $_POST['titleAboutService'.$selectedIdAboutService]);
			$postUpdateContentWordAboutService = mysqli_real_escape_string($conn, $_POST['contentWordAboutService'.$selectedIdAboutService]);

			$updateAboutServiceQry = "UPDATE service SET contentWord = '".$postUpdateContentWordAboutService."', name = '".$postUpdateTitleAboutService."' WHERE idservice = '".$selectedIdAboutService."'";

			if (mysqli_query($conn, $updateAboutServiceQry))	 {
			    $postMessages =  "Record update successfully";
				$colorMessages = "green-text";
			} else {
			    $postMessages = "Error updating record: " . mysqli_error($conn);
	        	$colorMessages = "red-text";
			}
		}
	}
// ============================== BUTTON UPDATE CLICK ==========================================================
?>
<div class="col s12 border-bottom grey lighten-2 mb-50">
	<h3 class="left-align">Service</h3>
</div>
<div class="col s12">
	<form action="#" method="post" enctype="multipart/form-data">
		<div class="col s12">
			<a id="delSelectionAboutServiceButton" href="#modalDelAboutServiceItems" class="modal-trigger waves-effect waves-light btn red accent-4 disabled"><i class="material-icons left">delete</i>Delete</a>
			<button id="updateSelectionAboutServiceButton" name="updateSelectionAboutServiceButton" class="waves-effect waves-light btn blue darken-4 disabled"><i class="material-icons left">subdirectory_arrow_left</i>Update</button>
			<a href="#modalAddAboutServiceItems" class="modal-trigger btn-floating btn-large waves-effect waves-light green darken-4 right"><i class="material-icons">add</i></a>
		</div>
		<div class="col s12">
			<span class="<?php echo $colorMessages;?>"><?php echo $postMessages;?></span>
		</div>
		<table class="highlight">
			<thead>
				<tr>
					<td width="50px">
						<p>
							<input type="checkbox" id="checkAllAboutService" />
							<label for="checkAllAboutService"></label>
						</p>
					</td>
					<td width="250px">
						Images
					</td>
					<td width="300px">
						Name
					</td>
					<td width="800px">
						Content Word
					</td>
				</tr>
			</thead>
			<tbody>
				<?php
					if($resultServiceQry = mysqli_query($conn, "SELECT * FROM service ORDER BY idservice DESC")){
						if (mysqli_num_rows($resultServiceQry) > 0) {
							while ($rowService = mysqli_fetch_array($resultServiceQry)) {
								$idservice          = $rowService['idservice'];
								$nameService        = $rowService['name'];
								$contentWordService = $rowService['contentWord'];

								$imagesServiceQry = "SELECT * FROM images WHERE (owner = 'Service' AND idowner = '".$idservice."') LIMIT 1";

								if ($resultImagesServiceQry = mysqli_query($conn, $imagesServiceQry)) {
									if (mysqli_num_rows($resultImagesServiceQry) > 0) {
										$rowImagesService = mysqli_fetch_array($resultImagesServiceQry);
										$idimages           = $rowImagesService['idimages'];
										$pathImagesService  = $rowImagesService['path'];
										?>
											<tr>
												<td>
													<p>
														<input name="checkboxAboutService[]" type="checkbox" id="<?php echo "checkboxAboutService".$idimages; ?>" value="<?php echo $idservice; ?>"/>
														<label for="<?php echo "checkboxAboutService".$idimages; ?>"></label>
													</p>
												</td>
												<td>
													<a href="<?php echo "#uploadModal".$idimages; ?>" class="modal-trigger"><img src="<?php echo "../".$pathImagesService; ?>" class="responsive-img" title="klick to change image"></a>
												</td>
												<td>
													<div class="input-field">
														<input id="<?php echo "titleAboutService".$idservice; ?>" name="<?php echo "titleAboutService".$idservice; ?>" class="validate" value="<?php echo $nameService; ?>">
													</div>
												</td>
												<td>
													<div class="input-field col s12">
														<textarea id="<?php echo "contentWordAboutService".$idservice; ?>" name="<?php echo "contentWordAboutService".$idservice; ?>" class="materialize-textarea"><?php echo $contentWordService; ?></textarea>
													</div>
												</td>
											</tr>
											<!-- ======================== MODAL =========================================================== -->
											<div id="<?php echo "uploadModal".$idimages; ?>" class="modal">
												<div class="modal-content">
													<div class="border-bottom mb-10"><h4>Change Image</h4></div>
													<div class="col s12 mb-30 mt-30 center container">
														<div class="file-field input-field col s12">
															<img id="<?php echo "image_upload_preview_about_service".$idimages; ?>" max-width="500px" src="<?php echo "../".$pathImagesService; ?>" class="responsive-img">
															<div class="file-field input-field col s12">
																<div class="btn green darken-4">
																	<span>Change</span>
																	<input id="<?php echo "changeImageFileAboutService".$idimages; ?>" name="<?php echo "changeImageFileAboutService".$idimages; ?>" type="file">
																</div>
																<div class="file-path-wrapper">
																	<input id="<?php echo "changeImagesPathAboutService".$idimages; ?>" name="<?php echo "changeImagesPathAboutService".$idimages; ?>" class="file-path validate" type="text">
																</div>
															</div>
															<div class="col s12">
																<button type="submit" id="<?php echo "btnChangeImagesAboutService".$idimages; ?>" name="<?php echo "btnChangeImagesAboutService".$idimages; ?>" class="waves-effect waves-light btn blue darken-4 right"><i class="material-icons left">subdirectory_arrow_left</i>Update</button>
															</div>
														</div>
													</div>
												</div>
											</div>
											<!-- ======================== MODAL =========================================================== -->
										<?php
										$btnChangeImagesAboutService = "btnChangeImagesAboutService".$idimages;
										$changeImageFileAboutService = "changeImageFileAboutService".$idimages;
										$changeImagesPathAboutService = "changeImagesPathAboutService".$idimages;
										if(isset($_POST[$btnChangeImagesAboutService])){
											$uploadOk = 1;
											if(isset($_POST[$changeImagesPathAboutService]) && $_POST[$changeImagesPathAboutService] != ''){
												$target_dir = "../images/";
												$target_file = $target_dir . basename($_FILES[$changeImageFileAboutService]["name"]);
												$filePath = "images/" . basename($_FILES[$changeImageFileAboutService]["name"]);
												$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
												// Check if image file is a actual image or fake image
											    $check = getimagesize($_FILES[$changeImageFileAboutService]["tmp_name"]);
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
												    if (move_uploaded_file($_FILES[$changeImageFileAboutService]["tmp_name"], $target_file)) {

												    	$delPrevImagesAboutService = "SELECT path FROM images WHERE owner = 'Service' AND idimages = '".$idimages."'";
												    	if($resultAboutService = mysqli_query($conn, $delPrevImagesAboutService)){
															if(mysqli_num_rows($resultAboutService) > 0){
																$rowDeleteAboutService = mysqli_fetch_array($resultAboutService);
																$pathImagesAboutService = $rowDeleteAboutService['path'];
																unlink("../".$pathImagesAboutService);
															}
														}

														$updateChangeImagesFile = "UPDATE images SET path = '".$filePath."' WHERE owner = 'Service' AND idimages = '".$idimages."'";
														if(mysqli_query($conn, $updateChangeImagesFile)){

															$postMessages = "Images Updated";
													        $colorMessages = "green-text";
					        								header('Location: ./index.php?menu=about&cat=service');
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
		<div id="modalDelAboutServiceItems" class="modal">
			<div class="modal-content">
				<h4>Deleting Confirmation</h4>
				<h5>Are you sure want to delete selected item(s) ?</h5>
			</div>
			<div class="modal-footer col s12 mb-50">
				<button type="submit" name="btnDeleteAboutService" class="waves-effect waves-light btn green darken-4 right">Yes</button>
				<a href="#!" class="modal-action modal-close waves-effect waves-light btn blue darken-4 right">Cancel</a>
			</div>
		</div>
	</form>
	<div id="modalAddAboutServiceItems" class="modal">
		<div class="modal-content">
			<div class="border-bottom mb-10"><h4>Add Top Banner</h4></div>
			<div class="col s12 mt-30 center container">
				<form action="#" method="post" enctype="multipart/form-data">
					<div class="file-field input-field col s12">
						<img id="image_upload_preview_about_service" max-width="500px" class="image_upload_preview responsive-img img-center mb-30" src="<?php echo "../images/emptyimages.bmp"; ?>">
						<div class="btn green darken-4">
							<span>Upload Image</span>
							<input id="changeImageFileAboutService" name="addImageFileAboutService" type="file" required>
						</div>
						<div class="file-path-wrapper">
							<input id="addImagesPathAboutService" name="addImagesPathAboutService" class="file-path validate" type="text" required>
						</div>
					</div>
					<div class="file-field input-field col s12">
						<input id="addAboutServiceTitle" name="addAboutServiceTitle" type="text" class="validate" required>
						<label for="addAboutServiceTitle">Service Name</label>
					</div>
					<div class="file-field input-field col s12">
						<textarea id="addAboutServiceContentWord" name="addAboutServiceContentWord" class="materialize-textarea" required></textarea>
						<label for="addAboutServiceContentWord">Service Content Word</label>
					</div>
					<div class="input-field col s12 mb-50">
						<button type="submit" name="btnAddNewAboutService" class="waves-effect waves-light btn green darken-4 right">Add</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>