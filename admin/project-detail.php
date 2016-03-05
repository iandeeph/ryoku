<?php
$detail = isset($_GET['detail'])?$_GET['detail']:'';
// ========================================== add new images start ===============================
	if(isset($_POST['btnAddNewProjectDetail']) && isset($_POST['addImagesPathProjectDetail']) && $_POST['addImagesPathProjectDetail'] != ''){
		extract($_POST);
		$error=array();
		$extension=array("jpeg","jpg","png");
		foreach($_FILES["addImageFileProjectDetail"]["tmp_name"] as $key=>$tmp_name){
			$file_name=$_FILES["addImageFileProjectDetail"]["name"][$key];
			$file_tmp=$_FILES["addImageFileProjectDetail"]["tmp_name"][$key];
			$ext=pathinfo($file_name,PATHINFO_EXTENSION);
			if(in_array($ext,$extension)){
				if(!file_exists("../images/".$file_name)){
					move_uploaded_file($file_tmp=$_FILES["addImageFileProjectDetail"]["tmp_name"][$key],"../images/".$file_name);
					$insertAddImages = "INSERT INTO images (title, path, owner, idowner) VALUES ('Project Images', 'images/".$file_name."', 'project', '".$detail."')";
					if(mysqli_query($conn, $insertAddImages)){
						$LastIdImagesProjectDetail = mysqli_insert_id($conn);
						logging($now, $user, "Add new project images", "images/".$file_name, $LastIdImagesProjectDetail);
					}else{
						$postMessages = "ERROR: Could not able to execute ".$insertAddImages.". " . mysqli_error($conn);
			        	$colorMessages = "red-text";
				    }
				}else{
					$filename=basename($file_name,$ext);
					$newFileName=$filename.time().".".$ext;
					move_uploaded_file($file_tmp=$_FILES["addImageFileProjectDetail"]["tmp_name"][$key],"../images/".$newFileName);
					$insertAddImages = "INSERT INTO images (title, path, owner, idowner) VALUES ('Product Images', 'images/".$newFileName."', 'project', '".$detail."')";
					if(mysqli_query($conn, $insertAddImages)){
						$LastIdImagesProjectDetail = mysqli_insert_id($conn);
						logging($now, $user, "Add new project images", "images/".$newFileName, $LastIdImagesProjectDetail);
					}else{
						$postMessages = "ERROR: Could not able to execute ".$insertAddImages.". " . mysqli_error($conn);
			        	$colorMessages = "red-text";
				    }
				}
			}else{
				array_push($error,"$file_name, ");
			}
		}
	}
// ========================================== add new images ends ================================
// ========================================== add new Client start ===============================
	if(isset($_POST['addClientDetproject']) && isset($_POST['addImagesPathAddProjectClient']) && $_POST['addImagesPathAddProjectClient'] != ''){
		$postClient = $_POST['addClientProjDet'];
		$uploadOk = 1;
		$target_dir = "../images/";
		$target_file = $target_dir . basename($_FILES["addImageFileAddProjectClient"]["name"]);
		$filePath = "images/" . basename($_FILES["addImageFileAddProjectClient"]["name"]);
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// Check if image file is a actual image or fake image
	    $check = getimagesize($_FILES["addImageFileAddProjectClient"]["tmp_name"]);
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
		    if (move_uploaded_file($_FILES["addImageFileAddProjectClient"]["tmp_name"], $newFileName)) {
				$insertAddProjectDetail = "INSERT INTO client (name) VALUES ('".$postClient."')";
				if(mysqli_query($conn, $insertAddProjectDetail)){
					$LastIdProjectDetail = mysqli_insert_id($conn);

					$insertAddImages = "INSERT INTO images (title, path, owner, idowner) VALUES ('Client Images', '".$newFileNameAdmin."', 'client', '".$LastIdProjectDetail."')";
					if(mysqli_query($conn, $insertAddImages)){
						logging($now, $user, "Add New CLient Items ", "Name : ".$postClient."<br>Images : ".$newFileName, $LastIdProjectDetail);
				        header('Location: ./index.php?menu=project&cat=list&detail='.$detail.'');
				    }else{
				    	$postMessages = "ERROR: Could not able to execute ".$insertAddImages.". " . mysqli_error($conn);
			        	$colorMessages = "red-text";
				    }
				} else{
					$postMessages = "ERROR: Could not able to execute ".$insertAddProjectDetail.". " . mysqli_error($conn);
			        $colorMessages = "red-text";
				}
		    } else {
		        $postMessages = "Sorry, there was an error uploading your file.";
	        	$colorMessages = "red-text";
		    }
		}
	}
// ========================================== add new Client ends ================================
// ========================================== Update Content Start ===============================
	if(isset($_POST['btnSubmitContentProjectList'])){
		$postidProject 				= $_POST['idproject'];
		$postnameProject 			= $_POST['nameProject'];
		$postcategoryProdDetail		= $_POST['categoryProdDetail'];
		$postprodProjDetail			= $_POST['prodProjDetail'];
		$postclientProjDetail 		= $_POST['clientProdDetail'];
		$postlocationProjDetail 	= $_POST['locationProjDetail'];
		$postdateProjectList 		= $_POST['dateProjectList'];
		$postcontentWordProjectList = $_POST['contentWordProjectList'];

		$clientIdQry = "SELECT idclient FROM client WHERE name = '".$postclientProjDetail."'";

		if($resultclientIdQry = mysqli_query($conn, $clientIdQry) or die("Query failed :".mysqli_error($conn))){
	        if(mysqli_num_rows($resultclientIdQry) > 0){
	            $rowClientId = mysqli_fetch_array($resultclientIdQry);
	            $idclient = $rowClientId['idclient'];
	        }
	    }

		$updateProjectContent = "UPDATE project SET
									name = '".$postnameProject."',
									category = '".$postcategoryProdDetail."',
									location = '".$postlocationProjDetail."',
									date = '".$postdateProjectList."',
									product = '".$postprodProjDetail."',
									contentWord = '".$postcontentWordProjectList."',
									idclient = '".$idclient."'
									WHERE idproject = '".$postidProject."'";

		// ============================================================================ LOGING
			$upprojDetQry = "SELECT 
                    project.idproject as idproject,
                    project.name as name,
                    project.contentWord as contentWord,
                    project.location as location,
                    project.date as date,
                    project.category as category,
                    project.product as product,
                    client.name as clientName
                    FROM 
                        project,
                        client
                    WHERE project.idclient = client.idclient AND project.idproject = '".$postidProject."'";


		    if($upresultProjDetail = mysqli_query($conn, $upprojDetQry) or die("Query failed :".mysqli_error($conn))){
		        if(mysqli_num_rows($upresultProjDetail) > 0){
		            $uprowProjDetail = mysqli_fetch_array($upresultProjDetail);
		            $upidProject         		= $uprowProjDetail['idproject'];
		            $upnameProjDetail       	= $uprowProjDetail['name'];
		            $upcontentWordProjDetail  	= $uprowProjDetail['contentWord'];
		            $upnameClientProjDetail		= $uprowProjDetail['clientName'];
		            $uplocationProjDetail     	= $uprowProjDetail['location'];
		            $updateProjDetail  			= $uprowProjDetail['date'];
		            $upcatProjDetail  			= $uprowProjDetail['category'];
		            $upprodProjDetail  			= $uprowProjDetail['product'];

					$updateGalleryNameQry = "UPDATE gallery SET name = '".$postnameProject."' WHERE name = '".$upnameProjDetail."'";
					if(!mysqli_query($conn, $updateGalleryNameQry)){
						$postMessages = "ERROR: Could not able to execute ".$updateGalleryNameQry.". " . mysqli_error($conn);
	        			$colorMessages = "red-text";
					}
		        }
		    }
		    $logingText = "Old Name : ".$upnameProjDetail."<br>Old Category : ".$upcatProjDetail."<br>Old Location : ".$uplocationProjDetail."<br>Old Date : ".$updateProjDetail."<br>Old Product : ".$upprodProjDetail."<br>Old Client Name : ".$upnameClientProjDetail."<br>Old Description :<br>".$upcontentWordProjDetail."<br><br>New Name : ".$postnameProject."<br>New Category : ".$postcategoryProdDetail."<br>New Location : ".$postlocationProjDetail."<br>New Date : ".$postdateProjectList."<br>New Product : ".$postprodProjDetail."<br>New Client Name : ".$postclientProjDetail."<br>New Description :<br>".$postcontentWordProjectList;
		// ============================================================================ LOGING
		if($postnameProject != $upnameProjDetail || $postcategoryProdDetail != $upcatProjDetail || $postlocationProjDetail != $uplocationProjDetail || $postdateProjectList != $updateProjDetail || $postprodProjDetail != $upprodProjDetail || strip_tags($postcontentWordProjectList) != strip_tags($upcontentWordProjDetail)){
			if(mysqli_query($conn, $updateProjectContent)){
				logging($now, $user, "Update Project Content ", $logingText, $postidProject);
		        // header('Location: ./index.php?menu=project&cat=list&detail='.$detail.'');
		    }else{
		    	$postMessages = "ERROR: Could not able to execute ".$updateProjectContent.". " . mysqli_error($conn);
	        	$colorMessages = "red-text";
		    }
		}
	}
// ========================================== Update Content Ends ===============================
	$idDetProject = $_GET['detail'];
	$projDetQry = "SELECT 
                    project.idproject as idproject,
                    project.name as name,
                    project.contentWord as contentWord,
                    project.location as location,
                    project.date as date,
                    project.category as category,
                    project.product as product,
                    client.name as clientName
                    FROM 
                        project,
                        client
                    WHERE project.idclient = client.idclient AND project.idproject = '".$idDetProject."'";

    if($resultProjDetail = mysqli_query($conn, $projDetQry) or die("Query failed :".mysqli_error($conn))){
        if(mysqli_num_rows($resultProjDetail) > 0){
            $rowProjDetail = mysqli_fetch_array($resultProjDetail);
            $idProject         		= $rowProjDetail['idproject'];
            $nameProjDetail       	= $rowProjDetail['name'];
            $contentWordProjDetail  = $rowProjDetail['contentWord'];
            $nameClientProjDetail  	= $rowProjDetail['clientName'];
            $locationProjDetail     = $rowProjDetail['location'];
            $dateProjDetail  		= $rowProjDetail['date'];
            $catProjDetail  		= $rowProjDetail['category'];
            $prodProjDetail  		= $rowProjDetail['product'];
        }
    }
// ========================= DELETE IMAGES ================================
	if(isset($_POST['btnDeleteProjectImages'])){
		$delImagesQry = "DELETE FROM images WHERE idimages in (".implode($_POST['chekboxImagesProjectDetail'], ',').")";

		// =================================================== LOGING
        foreach ($_POST['chekboxImagesProjectDetail'] as $selectedIdImagesProject) {
            $upPathImagesProject = "SELECT path FROM images WHERE idimages = '".$selectedIdImagesProject."'";

            if($resultUpImagesPath = mysqli_query($conn, $upPathImagesProject) or die("Query failed :".mysqli_error($conn))){
                if(mysqli_num_rows($resultUpImagesPath) > 0){
                    $delrowImagesProject = mysqli_fetch_array($resultUpImagesPath);
                    $delPathImages = $delrowImagesProject['path'];

                    $logingText = "Name : ".$delPathImages;
                    logging($now, $user, "Delete Project Images", $logingText, $selectedIdImagesProject);
                    unlink("../".$delPathImages);
                }
            }
        }
    // =================================================== LOGING
		if (mysqli_query($conn, $delImagesQry)) {
	        header('Location: ./index.php?menu=project&detail='.$detail.'');
	    }else{
		    $postMessages = "Error deleting record: " . mysqli_error($conn);
        	$colorMessages = "red-text";
	    }
	}
?>
<div class="col s12 grey lighten-2 ">
	<h4 class="left-align"><?php echo $nameProjDetail;?></h4>
</div>
<div class="col s12">
	<div class="col s12 mt-20">
		<a href="./index.php?menu=project&cat=list" class="waves-effect waves-light btn-large right"><i class="material-icons left">keyboard_arrow_left</i>Back</a>
	</div>
    <div class="col s12">
        <span class="<?php echo $colorMessages;?>"><?php echo $postMessages;?></span>
    </div>
    <div class="col s12 border-bottom pdb-10">
		<h5>Manage Image</h5>
    </div>
	<div class="col s12 mb-30">
	    <?php
	        if($_SESSION['privilege'] == '1'){
	            ?>
	                <a id="delSelectionImages" href="#modalDelProjectImages" class="waves-effect waves-light btn red accent-4 disabled mt-30" disabled><i class="material-icons left">delete</i>Delete</a>
	            <?php
	        }
	    ?>
		<a href="#modalAddProjectDetailItems" class="modal-trigger btn-floating btn-large waves-effect waves-light green darken-4 right mt-10" title="Add more images"><i class="material-icons">add</i></a>
	</div>
	<form action="#" method="post" enctype="multipart/form-data">
		<div class="row">
				<?php
					$projectGetImagesQry = "";
					$projectGetImagesQry = "SELECT idimages, path, title FROM images WHERE owner = 'project' AND idowner = '".$detail."'";

					if($resultGetImagesProject = mysqli_query($conn, $projectGetImagesQry) or die("Query failed :".mysqli_error($conn))){
			            if(mysqli_num_rows($resultGetImagesProject) > 0){
			                while($rowGetImagesProject = mysqli_fetch_array($resultGetImagesProject)){
			                    $idImagesProject 	= $rowGetImagesProject['idimages'];
			                    $pathImagesProject 	= $rowGetImagesProject['path'];
			                    $titleImagesProject = $rowGetImagesProject['title'];
			                    ?>
									<div class="col s12 m6 l3 bordered">
										<div class="col s12 lighten-1 italic">
											<p>
									            <input type="checkbox" id="<?php echo $idImagesProject;?>" name="chekboxImagesProjectDetail[]" value="<?php echo $idImagesProject; ?>"/>
									            <label for="<?php echo $idImagesProject;?>"></label>
								            </p>
										</div>
										<div class="col s12 center valign-wrapper responsive-img" style="height:350px">
											<div class="col s12">
												<img src="<?php echo "../".$pathImagesProject;?>" alt="<?php echo $titleImagesProject;?>" class="responsive-img" width="250px">
											</div>
										</div>
									</div>
			                	<?php
			                }
			            }
			        }
				?>
		</div>
		<div id="modalDelProjectImages" class="modal">
		    <div class="modal-content">
		        <h4>Deleting Confirmation</h4>
		        <h5>Are you sure you want to delete selected item(s) ?</h5>
		    </div>
		    <div class="modal-footer col s12 mb-30">
		        <button type="submit" name="btnDeleteProjectImages" class="waves-effect waves-light btn green darken-4 right">Yes</button>
		        <a href="#!" class="modal-action modal-close waves-effect waves-light btn blue darken-4 right">Cancel</a>
		    </div>
		</div>
	</form>
	<div class="col s12 border-bottom pdb-10">
		<h5 class="col s12 m6 l6">Manage Content</h5>
	</div>
	<form id="contentForm" action="#" method="post" enctype="multipart/form-data">
		<div class="input-field col s12 m7 l7 mt-30">
			<input id="nameProject" name="nameProject" type="text" class="validate" value="<?php echo $nameProjDetail; ?>">
			<label for="nameProject">Product Name</label>
		</div>
		<div class="input-field col s12 m7 l7">
			<select id="clientProdDetail" name="clientProdDetail">
				<option value="" class="red-text" disabled>Select Client</option>
				<?php
					$clientProjDetQry = "SELECT name FROM client ORDER BY name ASC";
					if ($resultProjDet = mysqli_query($conn, $clientProjDetQry)) {
			        	if (mysqli_num_rows($resultProjDet) > 0) {
							while($rowProjDet 	= mysqli_fetch_array($resultProjDet)){
								$nameClientProj 	= $rowProjDet['name'];
								$selected 	= ($nameClientProj == $nameClientProjDetail) ? 'selected' : '';
								?>
									<option value="<?php echo $nameClientProj;?>" <?php echo $selected;?>><?php echo $nameClientProj;?></option>
								<?php
							}
						}
					}
				?>
			</select>
			<label>Select Client</label>
			<div class="col s12 mb-30"><a href="#modalAddClient" class="modal-trigger blue-text">[+]Add Client</a></div>
		</div>
		<div class="input-field col s12 m6 l6">
			<select id="categoryProdDetail" name="categoryProdDetail">
				<option value="" class="red-text" disabled>Select Client</option>
				<option value="engineering" <?php echo ($catProjDetail == "engineering") ? 'selected' : '';?>>Engineering</option>
				<option value="civil" <?php echo ($catProjDetail == "civil") ? 'selected' : '';?>>Civil Construction</option>
			</select>
			<label>Select Category</label>
		</div>
		<div class="input-field col s12 m6 l6 mb-30">
			<input id="prodProjDetail" name="prodProjDetail" type="text" class="validate" value="<?php echo $prodProjDetail; ?>">
			<label for="prodProjDetail">Product</label>
		</div>
		<div class="input-field col s12 m6 l6">
			<input id="locationProjDetail" name="locationProjDetail" type="text" class="validate" value="<?php echo $locationProjDetail; ?>">
			<label for="locationProjDetail">Project Location</label>
		</div>
		<div class="input-field col s12 m6 l6">
			<select id="dateProjectList" name="dateProjectList">
				<option value="" class="red-text" disabled>Select Year</option>
				<?php
					for ($i=1990; $i < 2030 ; $i++) {
						$selected = (intval($dateProjDetail) == $i)?"selected":"";
						?>
							<option value="<?php echo $i;?>" <?php echo $selected;?>><?php echo $i;?></option>
						<?php
					}
				?>
			</select>
			<label>Date Project</label>
		</div>
		<div class="input-field col s12 mt-30">
			<textarea id="wysiwygEditor" name="contentWordProjectList" class="materialize-textarea"><?php echo $contentWordProjDetail; ?></textarea>
		</div>
		<div class="col s12">
			<input value="<?php echo $idProject?>" name="idproject" type="hidden">
			<button name="btnSubmitContentProjectList" class="mt-30 right waves-effect waves-light btn blue darken-4"><i class="material-icons left">subdirectory_arrow_left</i>Update</button>
		</div>
	</form>
</div>
<div id="modalAddClient" class="modal">
	<form action="#" method="post" enctype="multipart/form-data">
		<div class="modal-content">
			<div class="border-bottom mb-10"><h4>Add Clients</h4></div>
			<div class="col s12 mt-30 center container">
				<div class="file-field input-field col s12">
					<img id="image_upload_preview_add_client" max-width="500px" class="image_upload_preview responsive-img img-center mb-30" src="<?php echo "../images/emptyimages.bmp"; ?>">
					<div class="btn green darken-4">
						<span>Upload Image</span>
						<input id="changeImageFileAddProjectClient" name="addImageFileAddProjectClient" type="file" required>
					</div>
					<div class="file-path-wrapper">
						<input id="addImagesPathAddProjectClient" name="addImagesPathAddProjectClient" class="file-path validate" type="text" required>
					</div>
				</div>
				<div class="file-field input-field col s12">
					<input id="addClientProjDet" name="addClientProjDet" type="text" class="validate" required>
					<label for="addClientProjDet">Client Name</label>
				</div>
				<div class="input-field col s12 mb-50">
					<button name="addClientDetproject" class="waves-effect waves-light btn green darken-4 right">Add Client</button>
				</div>
			</div>
		</div>
	</form>
</div>
<div id="modalAddProjectDetailItems" class="modal">
	<div class="modal-content">
		<div class="border-bottom mb-10"><h4>Add Product Images</h4></div>
		<div class="col s12 mt-30 center container">
			<form action="#" method="post" enctype="multipart/form-data">
				<div class="file-field input-field col s12">
					<div class="btn green darken-4">
						<span>Upload Image</span>
						<input id="changeImageFileProjectDetail" name="addImageFileProjectDetail[]" type="file" multiple required>
					</div>
					<div class="file-path-wrapper">
						<input placeholder="Select max. 20 images/upload and max. 8MB total/upload" id="addImagesPathProjectDetail" name="addImagesPathProjectDetail" class="file-path validate" type="text" required>
					</div>
				</div>
				<div class="input-field col s12 mb-50">
					<button type="submit" name="btnAddNewProjectDetail" class="waves-effect waves-light btn green darken-4 right">Add</button>
					<a href="#!" class="modal-action modal-close waves-effect waves-light btn blue darken-4 right">Cancel</a>
				</div>
			</form>
		</div>
	</div>
</div>