<?php
	$idGallery = (isset($_GET['detail']))?$_GET['detail']:"";
// ========================================== add new images start ===============================
	if(isset($_POST['btnAddNewImagesGallery']) && isset($_POST['addImagesPathGalleryDetail']) && $_POST['addImagesPathGalleryDetail'] != ''){
		extract($_POST);
		$error=array();
		$extension=array("jpeg","jpg","png");
		foreach($_FILES["addImageFileGalleryDetail"]["tmp_name"] as $key=>$tmp_name){
			$file_name=$_FILES["addImageFileGalleryDetail"]["name"][$key];
			$file_tmp=$_FILES["addImageFileGalleryDetail"]["tmp_name"][$key];
			$ext=pathinfo($file_name,PATHINFO_EXTENSION);
			if(in_array($ext,$extension)){
				if(!file_exists("../images/".$file_name)){
					move_uploaded_file($file_tmp=$_FILES["addImageFileGalleryDetail"]["tmp_name"][$key],"../images/".$file_name);
					$insertAddImages = "INSERT INTO images (title, path, owner, idowner) VALUES ('Gallery Images', 'images/".$file_name."', 'gallery', '".$idGallery."')";
					if(mysqli_query($conn, $insertAddImages)){
						$LastIdImagesGalleryDetail = mysqli_insert_id($conn);
						logging($now, $user, "Add new gallery images", "images/".$file_name, $LastIdImagesGalleryDetail);
					}else{
						$postMessages = "ERROR: Could not able to execute ".$insertAddImages.". " . mysqli_error($conn);
			        	$colorMessages = "red-text";
				    }
				}else{
					$filename=basename($file_name,$ext);
					$newFileName=$filename.time().".".$ext;
					move_uploaded_file($file_tmp=$_FILES["addImageFileGalleryDetail"]["tmp_name"][$key],"../images/".$newFileName);
					$insertAddImages = "INSERT INTO images (title, path, owner, idowner) VALUES ('Gallery Images', 'images/".$newFileName."', 'gallery', '".$idGallery."')";
					if(mysqli_query($conn, $insertAddImages)){
						$LastIdImagesGalleryDetail = mysqli_insert_id($conn);
						logging($now, $user, "Add new gallery images", "images/".$file_name, $LastIdImagesGalleryDetail);
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
// ========================= DELETE IMAGES ================================
	if(isset($_POST['btnDeleteGalleryImages'])){
		$delImagesQry = "DELETE FROM images WHERE idimages in (".implode($_POST['chekboxImagesDetail'], ',').")";

		// =================================================== LOGING
        foreach ($_POST['chekboxImagesDetail'] as $selectedIdImagesGallery) {
            $upPathImagesGallery = "SELECT path FROM images WHERE idimages = '".$selectedIdImagesGallery."'";

            if($resultUpImagesPath = mysqli_query($conn, $upPathImagesGallery) or die("Query failed :".mysqli_error($conn))){
                if(mysqli_num_rows($resultUpImagesPath) > 0){
                    $delrowImagesGallery = mysqli_fetch_array($resultUpImagesPath);
                    $delPathImages = $delrowImagesGallery['path'];

                    $logingText = "Name : ".$delPathImages;
                    logging($now, $user, "Delete Gallery Images", $logingText, $selectedIdImagesGallery);
                    unlink("../".$delPathImages);
                }
            }
        }
    // =================================================== LOGING
		if (mysqli_query($conn, $delImagesQry)) {
	        header('Location: ./index.php?menu=gallery&detail='.$idGallery.'');
	    }else{
		    $postMessages = "Error deleting record: " . mysqli_error($conn);
        	$colorMessages = "red-text";
	    }
	}
?>
<div class="row border-bottom">
	<div class="col s12 border-bottom grey lighten-2 mb-10">
        <h3 class="left-align">Images Album</h3>
    </div>
	<div class="col s12">
		<a href="./index.php?menu=gallery" class="waves-effect waves-light btn-large"><i class="material-icons left">keyboard_arrow_left</i>Back</a>
	</div>
	<div class="col s12">
	    <?php
	        if($_SESSION['privilege'] == '1'){
	            ?>
	                <a id="delSelectionImages" href="#modalDelGalleryImages" class="waves-effect waves-light btn red accent-4 disabled mt-30" disabled><i class="material-icons left">delete</i>Delete</a>
	            <?php
	        }
	    ?>
	    <a href="#addGalleryImagesModal" class="modal-trigger btn-floating btn-large waves-effect waves-light green darken-4 right mb-30" title="Add more images"><i class="material-icons">add</i></a>
	</div>
	<div class="col s12">
	    <span class="<?php echo $colorMessages;?>"><?php echo $postMessages;?></span>
	</div>
</div>
<form action="#" method="post" enctype="multipart/form-data">
	<div class="row">
			<?php
				$nameGalleryQry = "";
				$nameGalleryQry = "SELECT name FROM gallery WHERE idgallery = '".$idGallery."'";

				if($resultnameGallery = mysqli_query($conn, $nameGalleryQry) or die("Query failed :".mysqli_error($conn))){
		            if(mysqli_num_rows($resultnameGallery) > 0){
		                $rowresultnameGallery = mysqli_fetch_array($resultnameGallery);
		                $nameGallery = $rowresultnameGallery['name'];

		                $idProjectQry = "";
						$idProjectQry = "SELECT idproject FROM project WHERE name = '".$nameGallery."'";

						if($resultidProject = mysqli_query($conn, $idProjectQry) or die("Query failed :".mysqli_error($conn))){
				            if(mysqli_num_rows($resultidProject) > 0){
				                $rowresultidProject = mysqli_fetch_array($resultidProject);
				                $projectId = $rowresultidProject['idproject'];

				                $projectQry = " OR (owner = 'project' AND idowner = '".$projectId."')";
				            }else{
		                        $projectQry = "";
		                    }
				        }
				    }
				}

				$galleryGetImagesQry = "";
				$galleryGetImagesQry = "SELECT idimages, path, title FROM images WHERE ((owner = 'gallery' AND idowner = '".$idGallery."')".$projectQry.")";

				if($resultGetImagesGallery = mysqli_query($conn, $galleryGetImagesQry) or die("Query failed :".mysqli_error($conn))){
		            if(mysqli_num_rows($resultGetImagesGallery) > 0){
		                while($rowGetImagesGallery = mysqli_fetch_array($resultGetImagesGallery)){
		                    $idImagesGallery 	= $rowGetImagesGallery['idimages'];
		                    $pathImagesGallery 	= $rowGetImagesGallery['path'];
		                    $titleImagesGallery = $rowGetImagesGallery['title'];
		                    ?>
								<div class="col s12 m6 l3 bordered">
									<div class="col s12 lighten-1 italic">
										<p>
								            <input type="checkbox" id="<?php echo $idImagesGallery;?>" name="chekboxImagesDetail[]" value="<?php echo $idImagesGallery; ?>"/>
								            <label for="<?php echo $idImagesGallery;?>"></label>
							            </p>
									</div>
									<div class="col s12 center valign-wrapper responsive-img" style="height:350px">
										<div class="col s12">
											<img src="<?php echo "../".$pathImagesGallery;?>" alt="<?php echo $titleImagesGallery;?>" class="responsive-img" width="250px">
										</div>
									</div>
								</div>
		                	<?php
		                }
		            }
		        }
			?>
	</div>
	<div id="modalDelGalleryImages" class="modal">
	    <div class="modal-content">
	        <h4>Deleting Confirmation</h4>
	        <h5>Are you sure you want to delete selected item(s) ?</h5>
	    </div>
	    <div class="modal-footer col s12 mb-30">
	        <button type="submit" name="btnDeleteGalleryImages" class="waves-effect waves-light btn green darken-4 right">Yes</button>
	        <a href="#!" class="modal-action modal-close waves-effect waves-light btn blue darken-4 right">Cancel</a>
	    </div>
	</div>
</form>
<div id="addGalleryImagesModal" class="modal">
	<div class="modal-content">
		<div class="border-bottom mb-10"><h4>Add Images Gallery</h4></div>
		<div class="col s12 mt-30 center container">
			<form action="#" method="post" enctype="multipart/form-data">
				<div class="file-field input-field col s12">
					<div class="btn green darken-4">
						<span>Upload Image</span>
						<input id="changeImageFileGalleryDetail" name="addImageFileGalleryDetail[]" type="file" multiple required>
					</div>
					<div class="file-path-wrapper">
						<input placeholder="Select max. 20 images/upload and max. 8MB total/upload" id="addImagesPathGalleryDetail" name="addImagesPathGalleryDetail" class="file-path validate" type="text" required>
					</div>
				</div>
				<div class="input-field col s12 mb-50">
					<button type="submit" name="btnAddNewImagesGallery" class="waves-effect waves-light btn green darken-4 right">Add</button>
					<a href="#!" class="modal-action modal-close waves-effect waves-light btn blue darken-4 right">Cancel</a>
				</div>
			</form>
		</div>
	</div>
</div>
