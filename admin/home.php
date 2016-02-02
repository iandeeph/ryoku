<?php
	$postMessages = "";
	$colorMessages = "";
	if(isset($_POST['btnAddNewBanner'])){
		$postTitleBanner = mysqli_real_escape_string($conn, $_POST['addBannerTitle']);
		$postContentWordBanner = mysqli_real_escape_string($conn, $_POST['addBannerContentWord']);
		$uploadOk = 1;
		$target_dir = "../images/";
		$target_file = $target_dir . basename($_FILES["addImageFile"]["name"]);
		$filePath = "images/" . basename($_FILES["addImageFile"]["name"]);
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// Check if image file is a actual image or fake image
	    $check = getimagesize($_FILES["addImageFile"]["tmp_name"]);
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
		    if (move_uploaded_file($_FILES["addImageFile"]["tmp_name"], $target_file)) {
				$insertAddBanner = "INSERT INTO banner (contentWord) VALUES ('".$postContentWordBanner."')";
				if(mysqli_query($conn, $insertAddBanner)){
					$LastIdBanner = mysqli_insert_id($conn);

					$insertAddImages = "INSERT INTO images (title, path, owner, idowner) VALUES ('".$postTitleBanner."', '".$filePath."','banner','".$LastIdBanner."')";
					if(mysqli_query($conn, $insertAddImages)){

						$postMessages = "New banner added";
				        $colorMessages = "green-text";
				        header('Location: ./index.php?menu=banner');
				    }else{
				    	$postMessages = "ERROR: Could not able to execute ".$insertAddImages.". " . mysqli_error($conn);
			        	$colorMessages = "red-text";
				    }
				} else{
					$postMessages = "ERROR: Could not able to execute ".$insertAddBanner.". " . mysqli_error($conn);
			        $colorMessages = "red-text";
				}
		    } else {
		        $postMessages = "Sorry, there was an error uploading your file.";
	        	$colorMessages = "red-text";
		    }
		}
	}
// ============================== BUTTON DELETE CLICK ==========================================================
	if(isset($_POST['btnDeleteBanner'])){
		foreach ($_POST['checkboxHomeBtn'] as $selectedIdBanner) {
			$delBannerQry = "DELETE FROM banner WHERE idbanner = '".$selectedIdBanner."'";
			$delImagesQry = "DELETE FROM images WHERE owner = 'banner' AND idowner = '".$selectedIdBanner."'";

			if (mysqli_query($conn, $delBannerQry) && mysqli_query($conn, $delImagesQry)) {
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

	if(isset($_POST['updateSelectionHomeButton'])){
		foreach ($_POST['checkboxHomeBtn'] as $selectedIdBanner) {
			$postUpdateTitleBanner = mysqli_real_escape_string($conn, $_POST['titleHomeBanner'.$selectedIdBanner]);
			$postUpdateContentWordBanner = mysqli_real_escape_string($conn, $_POST['contentWordHomeBanner'.$selectedIdBanner]);

			$updateBannerQry = "UPDATE banner SET contentWord = '".$postUpdateContentWordBanner."' WHERE idbanner = '".$selectedIdBanner."'";
			$updateImagesQry = "UPDATE images SET title = '".$postUpdateTitleBanner."' WHERE owner = 'banner' AND idowner = '".$selectedIdBanner."'";

			if (mysqli_query($conn, $updateBannerQry) && mysqli_query($conn, $updateImagesQry    )) {
			    $postMessages =  "Record update successfully";
				$colorMessages = "green-text";
			} else {
			    $postMessages = "Error deleting record: " . mysqli_error($conn);
	        	$colorMessages = "red-text";
			}
		}
	}
// ============================== BUTTON UPDATE CLICK ==========================================================
?>
<div class="row">
	<div class="col s12 border-bottom grey lighten-2 mb-50">
		<h3 class="left-align">Top Banner</h3>
	</div>
	<div class="col s12">
		<form action="#" method="post" enctype="multipart/form-data">
			<div class="col s12">
				<a id="delSelectionHomeButton" href="#modalDelBannerItems" class="modal-trigger waves-effect waves-light btn red accent-4 disabled"><i class="material-icons left">delete</i>Delete</a>
				<button id="updateSelectionHomeButton" name="updateSelectionHomeButton" class="waves-effect waves-light btn blue darken-4 disabled"><i class="material-icons left">subdirectory_arrow_left</i>Update</button>
				<a href="#modalAddBannerItems" class="modal-trigger btn-floating btn-large waves-effect waves-light green darken-4 right"><i class="material-icons">add</i></a>
			</div>
			<div class="col s12">
				<span class="<?php echo $colorMessages;?>"><?php echo $postMessages;?></span>
			</div>
			<table class="highlight">
				<thead>
					<tr>
						<td width="50px">
							<p>
								<input type="checkbox" id="checkAllHomeBanner" />
								<label for="checkAllHomeBanner"></label>
							</p>
						</td>
						<td width="250px">
							Images
						</td>
						<td width="300px">
							Title
						</td>
						<td width="500px">
							Content
						</td>
					</tr>
				</thead>
				<tbody>
					<?php
						if($resultBannerQry = mysqli_query($conn, "SELECT * FROM banner ORDER BY idbanner DESC")){
					        if (mysqli_num_rows($resultBannerQry) > 0) {
					          	while ($rowBanner = mysqli_fetch_array($resultBannerQry)) {
						            $idbanner = $rowBanner['idbanner'];
						            $contentWord = $rowBanner['contentWord'];

						            $imagesBannerQry = "SELECT * FROM images WHERE (owner = 'banner' AND idowner = '".$idbanner."') LIMIT 1";
						            
						            if ($resultImagesBannerQry = mysqli_query($conn, $imagesBannerQry)) {
										$rowImagesBanner = mysqli_fetch_array($resultImagesBannerQry);
						            	$idimages 			= $rowImagesBanner['idimages'];
										$titleImagesBanner  = $rowImagesBanner['title'];
										$pathImagesBanner   = $rowImagesBanner['path'];
										?>
											<tr>
												<td>
													<p>
														<input name="checkboxHomeBtn[]" type="checkbox" id="<?php echo "checkboxHomeBtn".$idimages; ?>" value="<?php echo $idbanner; ?>"/>
														<label for="<?php echo "checkboxHomeBtn".$idimages; ?>"></label>
													</p>
												</td>
												<td>
													<a href="<?php echo "#uploadModal".$idimages; ?>" class="modal-trigger"><img src="<?php echo "../".$pathImagesBanner; ?>" class="responsive-img" title="klick to change image"></a>
												</td>
												<td>
													<div class="input-field col s12">
														<input id="<?php echo "titleHomeBanner".$idbanner; ?>" name="<?php echo "titleHomeBanner".$idbanner; ?>" class="validate" value="<?php echo $titleImagesBanner; ?>">
													</div>
												</td>
												<td>
													<div class="input-field col s12">
														<textarea id="<?php echo "contentWordHomeBanner".$idbanner; ?>" name="<?php echo "contentWordHomeBanner".$idbanner; ?>" class="materialize-textarea"><?php echo $contentWord; ?></textarea>
													</div>
												</td>
											</tr>

											<!-- ======================== MODAL =========================================================== -->
											<div id="<?php echo "uploadModal".$idimages; ?>" class="modal">
												<div class="modal-content">
													<div class="border-bottom mb-10"><h4>Change Image</h4></div>
													<div class="col s12 mb-30 mt-30 center container">
														<div class="file-field input-field col s12">
															<img id="<?php echo "image_upload_preview".$idimages; ?>" max-width="500px" src="<?php echo "../".$pathImagesBanner; ?>" class="responsive-img" title="klick to change image">
															<div class="file-field input-field col s12">
																<div class="btn green darken-4">
																	<span>Change</span>
																	<input id="<?php echo "changeImageFile".$idimages; ?>" name="<?php echo "changeImagesFile".$idimages; ?>" type="file">
																</div>
																<div class="file-path-wrapper">
																	<input id="<?php echo "changeImagesPath".$idimages; ?>" name="<?php echo "changeIMagesPath".$idimages; ?>" class="file-path validate" type="text">
																</div>
															</div>
															<div class="col s12">
																<button type="submit" id="<?php echo "btnChangeImages".$idimages; ?>" name="btnChangeImages" class="waves-effect waves-light btn blue darken-4 right"><i class="material-icons left">subdirectory_arrow_left</i>Update</button>
															</div>
														</div>
													</div>
												</div>
											</div>
											<!-- ======================== MODAL =========================================================== -->
										<?php
										$btnChangeImages = "btnChangeImages".$idimages;
										$changeImagesFile = "changeImagesFile".$idimages;
										if(isset($_POST[$btnChangeImages])){
											$uploadOk = 1;
											if(isset($_POST[$btnChangeImages])){
												$target_dir = "../images/";
												$target_file = $target_dir . basename($_FILES[$changeImagesFile]["name"]);
												$filePath = "images/" . basename($_FILES[$changeImagesFile]["name"]);
												$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
												// Check if image file is a actual image or fake image
											    $check = getimagesize($_FILES[$changeImagesFile]["tmp_name"]);
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
												    if (move_uploaded_file($_FILES[$changeImagesFile]["tmp_name"], $target_file)) {
														$updateChangeImagesFile = "UPDATE images SET path = '".$filePath."' WHERE idimages = '".$idimages."'";
														if(mysqli_query($conn, $updateChangeImagesFile)){

															$postMessages = "Images Updated";
													        $colorMessages = "green-text";
					        								header('Location: ./index.php?menu=banner');
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
					?>
				</tbody>
			</table>
			<div id="modalDelBannerItems" class="modal">
				<div class="modal-content">
					<h4>Deleting Confirmation</h4>
					<h5>Are you sure want to delete selected item(s) ?</h5>
				</div>
				<div class="modal-footer col s12 mb-50">
					<button type="submit" name="btnDeleteBanner" class="waves-effect waves-light btn green darken-4 right">Yes</button>
					<a href="#!" class="modal-action modal-close waves-effect waves-light btn blue darken-4 right">Cancel</a>
				</div>
			</div>
		</form>
		<div id="modalAddBannerItems" class="modal">
			<div class="modal-content">
				<div class="border-bottom mb-10"><h4>Add Top Banner</h4></div>
				<div class="col s12 mt-30 center container">
					<form action="#" method="post" enctype="multipart/form-data">
						<div class="file-field input-field col s12">
							<img id="image_upload_preview" max-width="500px" class="image_upload_preview responsive-img img-center mb-30" src="<?php echo "../images/emptyimages.bmp"; ?>">
							<div class="btn green darken-4">
								<span>Upload Image</span>
								<input id="changeImageFile" name="addImageFile" type="file" required>
							</div>
							<div class="file-path-wrapper">
								<input id="addImagesPath" name="addImagesPath" class="file-path validate" type="text" required>
							</div>
						</div>
						<div class="file-field input-field col s12">
							<input id="addBannerTitle" name="addBannerTitle" type="text" class="validate" required>
							<label for="addBannerTitle">Banner Title</label>
						</div>
						<div class="file-field input-field col s12">
							<textarea id="addBannerContentWord" name="addBannerContentWord" class="materialize-textarea" required></textarea>
							<label for="addBannerContentWord">Banner Content Word</label>
						</div>
						<div class="input-field col s12 mb-50">
							<button type="submit" name="btnAddNewBanner" class="waves-effect waves-light btn green darken-4 right">Add</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>