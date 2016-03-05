<?php
	$postMessages = isset($postMessages)?$postMessages:'';
	$colorMessages = isset($colorMessages)?$colorMessages:'';
	if(isset($_POST['btnAddNewAboutClient']) && isset($_POST['addImagesPathAboutClient']) && $_POST['addImagesPathAboutClient'] != ''){
		$postTitleAboutClient = mysqli_real_escape_string($conn, $_POST['addAboutClientTitle']);
		$uploadOk = 1;
		$target_dir = "../images/";
		$target_file = $target_dir . basename($_FILES["addImageFileAboutClient"]["name"]);
		$filePath = "images/" . basename($_FILES["addImageFileAboutClient"]["name"]);
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// Check if image file is a actual image or fake image
	    $check = getimagesize($_FILES["addImageFileAboutClient"]["tmp_name"]);
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
		    if (move_uploaded_file($_FILES["addImageFileAboutClient"]["tmp_name"], "../images/".$newFileName)) {
				$insertAddAboutClient = "INSERT INTO client (name) VALUES ('".$postTitleAboutClient."')";
				if(mysqli_query($conn, $insertAddAboutClient)){
					$LastIdAboutClient = mysqli_insert_id($conn);

					$insertAddImages = "INSERT INTO images (title, path, owner, idowner) VALUES ('Client Images', 'images/".$newFileNameAdmin."', 'client', '".$LastIdAboutClient."')";
					if(mysqli_query($conn, $insertAddImages)){
						logging($now, $user, "Add New Client Item", "Client Name : ".$postTitleAboutClient."<br>Client Images : ".$newFileName, $LastIdAboutClient);
						$postMessages = "New client added";
				        $colorMessages = "green-text";
				        // header('Location: ./index.php?menu=project&cat=client');
				    }else{
				    	$postMessages = "ERROR: Could not able to execute ".$insertAddImages.". " . mysqli_error($conn);
			        	$colorMessages = "red-text";
				    }
				} else{
					$postMessages = "ERROR: Could not able to execute ".$insertAddAboutClient.". " . mysqli_error($conn);
			        $colorMessages = "red-text";
				}
		    } else {
		        $postMessages = "Sorry, there was an error uploading your file.";
	        	$colorMessages = "red-text";
		    }
		}
	}
// ============================== BUTTON DELETE CLICK ==========================================================
	if(isset($_POST['btnDeleteAboutClient'])){
		foreach ($_POST['checkboxAboutClient'] as $selectedIdAboutClient) {
			$delAboutClientQry = "DELETE FROM client WHERE idclient = '".$selectedIdAboutClient."'";
			$delImagesQry = "DELETE FROM images WHERE owner = 'client' AND idowner = '".$selectedIdAboutClient."'";

			// ====================================== LOGING
				$nameDelClientQry = "";
				$nameDelClientQry = "SELECT idclient, name FROM client WHERE idclient in (".implode($_POST['checkboxAboutClient'], ',').")";
				if($resultDelNameClientQry = mysqli_query($conn, $nameDelClientQry)){
					if (mysqli_num_rows($resultDelNameClientQry) > 0) {
						while($rowDelNameClient = mysqli_fetch_array($resultDelNameClientQry)){
							$idDelClient	= $rowDelNameClient['idclient'];
							$nameDelClient 	= $rowDelNameClient['name'];
						}
					}
				}
			// ====================================== LOGING
			if (mysqli_query($conn, $delAboutClientQry) && mysqli_query($conn, $delImagesQry)) {
    			logging($now, $user, "Delete Client Items", "Name : ".$nameDelClient, $idDelClient);
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

	if(isset($_POST['updateSelectionAboutClientButton'])){
		foreach ($_POST['checkboxAboutClient'] as $selectedIdAboutClient) {
			$postUpdateTitleAboutClient = $_POST['titleAboutClient'.$selectedIdAboutClient];

			$updateAboutClientQry = "UPDATE client SET name = '".$postUpdateTitleAboutClient."' WHERE idclient = '".$selectedIdAboutClient."'";

			// ================================== LOGGING
				$nameUpdateProjectClientQry = "";
				$nameUpdateProjectClientQry = "SELECT name FROM client WHERE idclient = '".$selectedIdAboutClient."' LIMIT 1";
				if($resultUpdateProjectClientQry = mysqli_query($conn, $nameUpdateProjectClientQry)){
					if (mysqli_num_rows($resultUpdateProjectClientQry) > 0) {
						$rowUpdateProjectClient = mysqli_fetch_array($resultUpdateProjectClientQry);
						$nameUpdateProjectClient        	= $rowUpdateProjectClient['name'];
					}
				}
				$logingContentText = "Old Name : ".$nameUpdateProjectClient."<br>New Name : ".$postUpdateTitleAboutClient;
			// ================================== LOGGING
			if($postUpdateTitleAboutClient != $nameUpdateProjectClient){
				if (mysqli_query($conn, $updateAboutClientQry))	 {
					logging($now, $user, "Update Client Items", $logingContentText, $selectedIdAboutClient);
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
?>
<div class="col s12 border-bottom grey lighten-2 mb-50">
	<h3 class="left-align">Clients</h3>
</div>
<div class="col s12">
	<form action="#" method="post" enctype="multipart/form-data">
		<div class="col s12">
			<?php
				if($_SESSION['privilege'] == '1'){
					?>
						<a id="delSelectionAboutClientButton" href="#modalDelAboutClientItems" class="waves-effect waves-light btn red accent-4 disabled" disabled><i class="material-icons left">delete</i>Delete</a>
					<?php
				}
			?>
			<button id="updateSelectionAboutClientButton" name="updateSelectionAboutClientButton" class="waves-effect waves-light btn blue darken-4 disabled" disabled><i class="material-icons left">subdirectory_arrow_left</i>Update</button>
			<a href="#modalAddAboutClientItems" class="modal-trigger btn-floating btn-large waves-effect waves-light green darken-4 right"><i class="material-icons">add</i></a>
		</div>
		<div class="col s12">
			<span class="<?php echo $colorMessages;?>"><?php echo $postMessages;?></span>
		</div>
		<table class="highlight">
			<thead>
				<tr>
					<th width="50px">
						<p>
							<input type="checkbox" id="checkAll" />
							<label for="checkAll"></label>
						</p>
					</th>
					<th width="250px">
						Images
					</th>
					<th width="800px">
						Name
					</th>
					<th class="center" width="250px">
						Total Product
					</th>
				</tr>
			</thead>
			<tbody>
				<?php
			    	$clientQry = "SELECT * FROM client ORDER BY idclient DESC";
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
										$pathClient 	= $rowImagesClientQry['path'];

										$countProjClientQry = "SELECT count(idclient) as countProject FROM project WHERE idclient = '".$idclient."'";
										if($resultCountProj = mysqli_query($conn, $countProjClientQry)){
											if(mysqli_num_rows($resultCountProj) > 0){
												$rowCountProj = mysqli_fetch_array($resultCountProj);
												$projectCount = $rowCountProj['countProject'];
											}
										}
										?>
										<tr>
											<td>
												<p>
													<input name="checkboxAboutClient[]" type="checkbox" id="<?php echo "checkboxAboutClient".$idimagesClient; ?>" value="<?php echo $idclient; ?>" <?php echo ($projectCount > 0)? "disabled" : "";?>/>
													<label for="<?php echo "checkboxAboutClient".$idimagesClient; ?>"></label>
												</p>
											</td>
											<td>
												<a href="<?php echo "#uploadModal".$idimagesClient; ?>" class="modal-trigger"><img src="<?php echo "../".$pathClient; ?>" class="responsive-img" title="klick to change image"></a>
											</td>
											<td>
												<div class="input-field">
													<input id="<?php echo "titleAboutClient".$idclient; ?>" name="<?php echo "titleAboutClient".$idclient; ?>" class="validate" value="<?php echo $nameClient; ?>">
												</div>
											</td>
											<td class="center">
												<?php echo $projectCount; ?>
											</td>
										</tr>
										<!-- ======================== MODAL =========================================================== -->
										<div id="<?php echo "uploadModal".$idimagesClient; ?>" class="modal">
											<div class="modal-content">
												<div class="border-bottom mb-10"><h4>Change Image</h4></div>
												<div class="col s12 mb-30 mt-30 center container">
													<div class="file-field input-field col s12">
														<img id="<?php echo "image_upload_preview_about_client".$idimagesClient; ?>" max-width="500px" src="<?php echo "../".$pathClient; ?>" class="responsive-img">
														<div class="file-field input-field col s12">
															<div class="btn green darken-4">
																<span>Change</span>
																<input id="<?php echo "changeImageFileAboutClient".$idimagesClient; ?>" name="<?php echo "changeImageFileAboutClient".$idimagesClient; ?>" type="file">
															</div>
															<div class="file-path-wrapper">
																<input id="<?php echo "changeImagesPathAboutClient".$idimagesClient; ?>" name="<?php echo "changeImagesPathAboutClient".$idimagesClient; ?>" class="file-path validate" type="text">
															</div>
														</div>
														<div class="col s12">
															<button type="submit" id="<?php echo "btnChangeImagesAboutClient".$idimagesClient; ?>" name="<?php echo "btnChangeImagesAboutClient".$idimagesClient; ?>" class="waves-effect waves-light btn blue darken-4 right"><i class="material-icons left">subdirectory_arrow_left</i>Update</button>
														</div>
													</div>
												</div>
											</div>
										</div>
										<!-- ======================== MODAL =========================================================== -->
										<?php
										$btnChangeImagesAboutClient 	= "btnChangeImagesAboutClient".$idimagesClient;
										$changeImageFileAboutClient 	= "changeImageFileAboutClient".$idimagesClient;
										$changeImagesPathAboutClient 	= "changeImagesPathAboutClient".$idimagesClient;
										if(isset($_POST[$btnChangeImagesAboutClient])){
											$uploadOk = 1;
											if(isset($_POST[$changeImagesPathAboutClient]) && $_POST[$changeImagesPathAboutClient] != ''){
												$target_dir = "../images/";
												$target_file = $target_dir . basename($_FILES[$changeImageFileAboutClient]["name"]);
												$filePath = "images/" . basename($_FILES[$changeImageFileAboutClient]["name"]);
												$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
												// Check if image file is a actual image or fake image
											    $check = getimagesize($_FILES[$changeImageFileAboutClient]["tmp_name"]);
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
												    if (move_uploaded_file($_FILES[$changeImageFileAboutClient]["tmp_name"], "../images/".$newFileName)) {

												    	$delPrevImagesAboutClient = "SELECT path FROM images WHERE owner = 'Client' AND idimages = '".$idimagesClient."'";
												    	if($resultAboutClient = mysqli_query($conn, $delPrevImagesAboutClient)){
															if(mysqli_num_rows($resultAboutClient) > 0){
																$rowDeleteAboutClient = mysqli_fetch_array($resultAboutClient);
																$pathImagesAboutClient = $rowDeleteAboutClient['path'];
																unlink("../".$pathImagesAboutClient);
															}
														}

														$updateChangeImagesFile = "UPDATE images SET path = 'images/".$newFileNameAdmin."' WHERE owner = 'Client' AND idimages = '".$idimagesClient."'";
														if(mysqli_query($conn, $updateChangeImagesFile)){
															logging($now, $user, "Update Client Images", "../images/".$newFileName, $idimagesClient);
															$postMessages = "Images Updated";
													        $colorMessages = "green-text";
					        								header('Location: ./index.php?menu=project&cat=client');
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
		<div id="modalDelAboutClientItems" class="modal">
			<div class="modal-content">
				<h4>Deleting Confirmation</h4>
				<h5>Are you sure want to delete selected item(s) ?</h5>
			</div>
			<div class="modal-footer col s12 mb-20">
				<button type="submit" name="btnDeleteAboutClient" class="waves-effect waves-light btn green darken-4 right">Yes</button>
				<a href="#!" class="modal-action modal-close waves-effect waves-light btn blue darken-4 right">Cancel</a>
			</div>
		</div>
	</form>
	<div id="modalAddAboutClientItems" class="modal">
		<div class="modal-content">
			<div class="border-bottom mb-10"><h4>Add Top Banner</h4></div>
			<div class="col s12 mt-30 center container">
				<form action="#" method="post" enctype="multipart/form-data">
					<div class="file-field input-field col s12">
						<img id="image_upload_preview_about_client" max-width="500px" class="image_upload_preview responsive-img img-center mb-30" src="<?php echo "../images/emptyimages.bmp"; ?>">
						<div class="btn green darken-4">
							<span>Upload Image</span>
							<input id="changeImageFileAboutClient" name="addImageFileAboutClient" type="file" required>
						</div>
						<div class="file-path-wrapper">
							<input id="addImagesPathAboutClient" name="addImagesPathAboutClient" class="file-path validate" type="text" required>
						</div>
					</div>
					<div class="file-field input-field col s12">
						<input id="addAboutClientTitle" name="addAboutClientTitle" type="text" class="validate" required>
						<label for="addAboutClientTitle">Client Name</label>
					</div>
					<div class="input-field col s12 mb-50">
						<button type="submit" name="btnAddNewAboutClient" class="waves-effect waves-light btn green darken-4 right">Add</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>