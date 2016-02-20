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
					if(!mysqli_query($conn, $insertAddImages)){
						$postMessages = "ERROR: Could not able to execute ".$insertAddImages.". " . mysqli_error($conn);
			        	$colorMessages = "red-text";
				    }
				}else{
					$filename=basename($file_name,$ext);
					$newFileName=$filename.time().".".$ext;
					move_uploaded_file($file_tmp=$_FILES["addImageFileProjectDetail"]["tmp_name"][$key],"../images/".$newFileName);
					$insertAddImages = "INSERT INTO images (title, path, owner, idowner) VALUES ('Product Images', 'images/".$newFileName."', 'project', '".$detail."')";
					if(!mysqli_query($conn, $insertAddImages)){
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
		    if (move_uploaded_file($_FILES["addImageFileAddProjectClient"]["tmp_name"], $target_file)) {
				$insertAddProjectDetail = "INSERT INTO client (name) VALUES ('".$postClient."')";
				if(mysqli_query($conn, $insertAddProjectDetail)){
					$LastIdProjectDetail = mysqli_insert_id($conn);

					$insertAddImages = "INSERT INTO images (title, path, owner, idowner) VALUES ('Client Images', '".$filePath."', 'client', '".$LastIdProjectDetail."')";
					if(mysqli_query($conn, $insertAddImages)){
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
		$postclientProjDetail 		= $_POST['clientProdDetail'];
		$postlocationProjDetail 	= $_POST['locationProjDetail'];
		$postdateProjectList 		= date("Y-m-d", strtotime(str_replace(',', '', mysqli_real_escape_string($conn, $_POST['dateProjectList']))));
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
									idclient = '".$idclient."',
									location = '".$postlocationProjDetail."',
									date = '".$postdateProjectList."',
									contentWord = '".$postcontentWordProjectList."'
									WHERE idproject = '".$postidProject."'";
		if(mysqli_query($conn, $updateProjectContent)){
	        header('Location: ./index.php?menu=project&cat=list&detail='.$detail.'');
	    }else{
	    	$postMessages = "ERROR: Could not able to execute ".$updateProjectContent.". " . mysqli_error($conn);
        	$colorMessages = "red-text";
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
            $dateProjDetail  		= strtotime($rowProjDetail['date']);
        }
    }
?>
<div class="col s12">
	<div class="col s12 mt-20 center">
		<h4><?php echo $nameProjDetail;?></h4>
	</div>

	<div class="col s12">
		<a href="./index.php?menu=project&cat=list" class="waves-effect waves-light btn-large"><i class="material-icons left">keyboard_arrow_left</i>Back</a>
	</div>
	<div class="col s12 border-bottom pdb-10">
		<h5 class="col s12 m6 l6">Manage Image</h5>
		<a href="#modalAddProjectDetailItems" class="modal-trigger btn-floating btn-large waves-effect waves-light green darken-4 right mb-30" title="Add more images"><i class="material-icons">add</i></a>
	</div>
	<div class="col s12 red-text">
		*klick images for delete
	</div>
	<div class="col s12 mt-30 border-bottom">
		<?php
		$imagesDetProjectQry = "SELECT idimages, path FROM images WHERE (owner = 'project' AND idowner = '".$idDetProject."')";
		if ($resultImagesDetProjectQry = mysqli_query($conn, $imagesDetProjectQry)) {
        	if (mysqli_num_rows($resultImagesDetProjectQry) > 0) {
				while($rowImagesDetProject 	= mysqli_fetch_array($resultImagesDetProjectQry)){
					$idImagesDetProject  = $rowImagesDetProject['idimages'];
					$pathImagesDetProject  = $rowImagesDetProject['path'];
					?>
						<form action="#" method="post" enctype="multipart/form-data">
							<div style="height: 300px;" class="col l2 m4 s12">
								<a href="<?php echo "#modalProject".$idImagesDetProject; ?>" class="modal-trigger">
									<img src="<?php echo "../".$pathImagesDetProject; ?>" class="responsive-img ml-10 mr-10" title="klick to delete image">
								</a>
							</div>
							<!-- =========================================== modal =========================== -->
							<div id="<?php echo "modalProject".$idImagesDetProject; ?>" class="modal">
								<div class="modal-content center">
									<div class="border-bottom mb-10"><h4>Image Delete</h4></div>
									<p>Are you sure want to delete this image ?</p>
									<img src="<?php echo "../".$pathImagesDetProject; ?>" class="responsive-img ml-10 mr-10">
								</div>
								<div class="modal-footer">
									<button name="<?php echo "btnDelImagesDetProject".$idImagesDetProject; ?>" id="<?php echo "btnDelImagesDetProject".$idImagesDetProject; ?>" class="red accent-4 white-text modal-action modal-close waves-effect waves-green btn-flat">Yes..!!</button>
									<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">NO..</a>
								</div>
							</div>
							<!-- =========================================== modal =========================== -->
							<?php
								if(isset($_POST['btnDelImagesDetProject'.$idImagesDetProject])){
									$delImagesQry = "DELETE FROM images WHERE idimages = '".$idImagesDetProject."'";

									if (mysqli_query($conn, $delImagesQry)) {
								        header('Location: ./index.php?menu=project&cat=list&detail='.$detail.'');
								    }else{
									    $postMessages = "Error deleting record: " . mysqli_error($conn);
							        	$colorMessages = "red-text";
								    }
								}
							?>
						</form>
					<?php
				}
			}
		}
		?>
	</div>
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
			<input id="locationProjDetail" name="locationProjDetail" type="text" class="validate" value="<?php echo $locationProjDetail; ?>">
			<label for="locationProjDetail">Project Location</label>
		</div>
		<div class="input-field col s12 m6 l6">
			<input id="dateProjectList" name="dateProjectList" type="date" class="datepicker" value="<?php echo date('j F, Y', $dateProjDetail); ?>">
			<label for="dateProjectList">Date Project</label>
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