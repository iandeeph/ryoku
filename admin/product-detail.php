<?php
$detail = isset($_GET['detail'])?$_GET['detail']:'';
// ========================================== add new images start ===============================
	if(isset($_POST['btnAddNewProductDetail']) && isset($_POST['addImagesPathProductDetail']) && $_POST['addImagesPathProductDetail'] != ''){
		extract($_POST);
		$error=array();
		$extension=array("jpeg","jpg","png");
		foreach($_FILES["addImageFileProductDetail"]["tmp_name"] as $key=>$tmp_name){
			$file_name=$_FILES["addImageFileProductDetail"]["name"][$key];
			$file_tmp=$_FILES["addImageFileProductDetail"]["tmp_name"][$key];
			$ext=pathinfo($file_name,PATHINFO_EXTENSION);
			if(in_array($ext,$extension)){
				if(!file_exists("../images/".$file_name)){
					move_uploaded_file($file_tmp=$_FILES["addImageFileProductDetail"]["tmp_name"][$key],"../images/".$file_name);
					$insertAddImages = "INSERT INTO images (title, path, owner, idowner) VALUES ('Product Images', 'images/".$file_name."', 'product', '".$detail."')";
					if(!mysqli_query($conn, $insertAddImages)){
						$postMessages = "ERROR: Could not able to execute ".$insertAddImages.". " . mysqli_error($conn);
			        	$colorMessages = "red-text";
				    }
				}else{
					$filename=basename($file_name,$ext);
					$newFileName=$filename.time().".".$ext;
					move_uploaded_file($file_tmp=$_FILES["addImageFileProductDetail"]["tmp_name"][$key],"../images/".$newFileName);
					$insertAddImages = "INSERT INTO images (title, path, owner, idowner) VALUES ('Product Images', 'images/".$newFileName."', 'product', '".$detail."')";
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
// ========================================== add new Brand start ===============================
	if(isset($_POST['addBrandDetproduct']) && isset($_POST['addImagesPathAddProductBrand']) && $_POST['addImagesPathAddProductBrand'] != ''){
		$postBrand = $_POST['addBrandProdDet'];
		$uploadOk = 1;
		$target_dir = "../images/";
		$target_file = $target_dir . basename($_FILES["addImageFileAddProductBrand"]["name"]);
		$filePath = "images/" . basename($_FILES["addImageFileAddProductBrand"]["name"]);
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// Check if image file is a actual image or fake image
	    $check = getimagesize($_FILES["addImageFileAddProductBrand"]["tmp_name"]);
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
		    if (move_uploaded_file($_FILES["addImageFileAddProductBrand"]["tmp_name"], $target_file)) {
				$insertAddProductDetail = "INSERT INTO brand (name) VALUES ('".$postBrand."')";
				if(mysqli_query($conn, $insertAddProductDetail)){
					$LastIdProductDetail = mysqli_insert_id($conn);

					$insertAddImages = "INSERT INTO images (title, path, owner, idowner) VALUES ('Brand Images', '".$filePath."', 'brand', '".$LastIdProductDetail."')";
					if(mysqli_query($conn, $insertAddImages)){
				        header('Location: ./index.php?menu=product&cat=list&detail='.$detail.'');
				    }else{
				    	$postMessages = "ERROR: Could not able to execute ".$insertAddImages.". " . mysqli_error($conn);
			        	$colorMessages = "red-text";
				    }
				} else{
					$postMessages = "ERROR: Could not able to execute ".$insertAddProductDetail.". " . mysqli_error($conn);
			        $colorMessages = "red-text";
				}
		    } else {
		        $postMessages = "Sorry, there was an error uploading your file.";
	        	$colorMessages = "red-text";
		    }
		}
	}
// ========================================== add new Brand ends ================================
// ========================================== add new Main Category start ===============================
	if(isset($_POST['btnAddMainProductCategory'])){
		$idProdMain		= $_POST['idproductMain'];
		$postNewMainCat = $_POST['addMainProductCategory'];
		$insertNewMainCat = "UPDATE product SET mainCategory = '".$postNewMainCat."' WHERE idproduct = '".$idProdMain."'";
		if(mysqli_query($conn, $insertNewMainCat)){
	        header('Location: ./index.php?menu=product&cat=list&detail='.$detail.'');
	    }else{
	    	$postMessages = "ERROR: Could not able to execute ".$insertNewMainCat.". " . mysqli_error($conn);
        	$colorMessages = "red-text";
	    }
	}
// ========================================== add new Main Category ends ===============================
// ========================================== add new Sub Category start ===============================
	if(isset($_POST['btnAddSubProductCategory'])){
		$idProdSub 		= $_POST['idproductSub'];
		$postNewSubCat 	= $_POST['addSubProductCategory'];
		$insertNewSubCat = "UPDATE product SET subCategory = '".$postNewSubCat."' WHERE idproduct = '".$idProdSub."'";
		if(mysqli_query($conn, $insertNewSubCat)){
	        header('Location: ./index.php?menu=product&cat=list&detail='.$detail.'');
	    }else{
	    	$postMessages = "ERROR: Could not able to execute ".$insertNewSubCat.". " . mysqli_error($conn);
        	$colorMessages = "red-text";
	    }
	}
// ========================================== add new Sub Category ends ===============================
// ========================================== Update Content Start ===============================
	if(isset($_POST['btnSubmitContentProductList'])){
		$postidProduct 				= $_POST['idproduct'];
		$posttitleProduct 			= $_POST['titleProduct'];
		$postbrandProdDetail 		= $_POST['brandProdDetail'];
		$postmainCatBrandProd 		= $_POST['mainCatBrandProd'];
		$postsubCatProject 			= $_POST['subCatProject'];
		$postcontentWordProductList = $_POST['contentWordProductList'];

		$brandIdQry = "SELECT idbrand FROM brand WHERE name = '".$postbrandProdDetail."'";

		if($resultbrandIdQry = mysqli_query($conn, $brandIdQry) or die("Query failed :".mysqli_error($conn))){
	        if(mysqli_num_rows($resultbrandIdQry) > 0){
	            $rowBrandId = mysqli_fetch_array($resultbrandIdQry);
	            $idbrand = $rowBrandId['idbrand'];
	        }
	    }

		$updateProductContent = "UPDATE product SET
									name = '".$posttitleProduct."',
									idbrand = '".$idbrand."',
									mainCategory = '".$postmainCatBrandProd."',
									subCategory = '".$postsubCatProject."',
									contentWord = '".$postcontentWordProductList."'
									WHERE idproduct = '".$postidProduct."'";
		if(mysqli_query($conn, $updateProductContent)){
	        header('Location: ./index.php?menu=product&cat=list&detail='.$detail.'');
	    }else{
	    	$postMessages = "ERROR: Could not able to execute ".$updateProductContent.". " . mysqli_error($conn);
        	$colorMessages = "red-text";
	    }
	}
// ========================================== Update Content Ends ===============================
	$idDetProd = $_GET['detail'];
	$prodDetQry = "SELECT 
                    product.idproduct as idproduct,
                    product.name as name,
                    product.contentWord as contentWord,
                    product.mainCategory as mainCategory,
                    product.subCategory as subCategory,
                    brand.name as brandName
                    FROM 
                        product,
                        brand
                    WHERE product.idbrand = brand.idbrand AND product.idproduct = '".$idDetProd."'";

    if($resultProdDetail = mysqli_query($conn, $prodDetQry) or die("Query failed :".mysqli_error($conn))){
        if(mysqli_num_rows($resultProdDetail) > 0){
            $rowProdDetail = mysqli_fetch_array($resultProdDetail);
            $idProduct         		= $rowProdDetail['idproduct'];
            $nameProdDetail       	= $rowProdDetail['name'];
            $contentWordProdDetail  = $rowProdDetail['contentWord'];
            $nameBrandProdDetail  	= $rowProdDetail['brandName'];
            $mainCatProdDetail      = $rowProdDetail['mainCategory'];
            $subCatProdDetail  		= $rowProdDetail['subCategory'];
        }
    }
?>
<div class="col s12">
	<div class="col s12 mt-20 center">
		<h4><?php echo $nameProdDetail;?></h4>
	</div>

	<div class="col s12">
		<a href="./index.php?menu=product&cat=list" class="waves-effect waves-light btn-large"><i class="material-icons left">keyboard_arrow_left</i>Back</a>
	</div>
	<div class="col s12 border-bottom pdb-10">
		<h5 class="col s12 m6 l6">Manage Image</h5>
		<a href="#modalAddProductDetailItems" class="modal-trigger btn-floating btn-large waves-effect waves-light green darken-4 right mb-30" title="Add more images"><i class="material-icons">add</i></a>
	</div>
	<?php
        if($_SESSION['privilege'] == '1'){
            ?>
				<div class="col s12 red-text">
					*klick images for delete
				</div>
			<?php
		}
	?>
	<div class="col s12 mt-30 border-bottom">
		<?php
		$imagesDetProductQry = "SELECT idimages, path FROM images WHERE (owner = 'Product' AND idowner = '".$idDetProd."')";
		if ($resultImagesDetProductQry = mysqli_query($conn, $imagesDetProductQry)) {
        	if (mysqli_num_rows($resultImagesDetProductQry) > 0) {
				while($rowImagesDetProduct 	= mysqli_fetch_array($resultImagesDetProductQry)){
					$idImagesDetProduct  = $rowImagesDetProduct['idimages'];
					$pathImagesDetProduct  = $rowImagesDetProduct['path'];
					?>
						<form action="#" method="post" enctype="multipart/form-data">
							<div style="height: 300px;" class="col l2 m4 s12">
								<a href="<?php echo ($_SESSION['privilege'] == '1')? "#modalProject".$idImagesDetProduct : "" ?>" class="<?php echo ($_SESSION['privilege'] == '1')? "modal-trigger" : "" ?>">
									<img src="<?php echo "../".$pathImagesDetProduct; ?>" class="responsive-img ml-10 mr-10" title="<?php echo ($_SESSION['privilege'] == '1')? "Click to delete image" : "" ?>">
								</a>
							</div>
							<!-- =========================================== modal =========================== -->
							<div id="<?php echo "modalProject".$idImagesDetProduct; ?>" class="modal">
								<div class="modal-content center">
									<div class="border-bottom mb-10"><h4>Image Delete</h4></div>
									<p>Are you sure want to delete this image ?</p>
									<img src="<?php echo "../".$pathImagesDetProduct; ?>" class="responsive-img ml-10 mr-10">
								</div>
								<div class="modal-footer">
									<button name="<?php echo "btnDelImagesDetProduct".$idImagesDetProduct; ?>" id="<?php echo "btnDelImagesDetProduct".$idImagesDetProduct; ?>" class="red accent-4 white-text modal-action modal-close waves-effect waves-green btn-flat">Yes..!!</button>
									<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">NO..</a>
								</div>
							</div>
							<!-- =========================================== modal =========================== -->
							<?php
								if(isset($_POST['btnDelImagesDetProduct'.$idImagesDetProduct])){
									$delImagesQry = "DELETE FROM images WHERE idimages = '".$idImagesDetProduct."'";

									if (mysqli_query($conn, $delImagesQry)) {
								        header('Location: ./index.php?menu=product&cat=list&detail='.$detail.'');
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
			<input id="titleProduct" name="titleProduct" type="text" class="validate" value="<?php echo $nameProdDetail; ?>">
			<label for="titleProduct">Product Name</label>
		</div>
		<div class="input-field col s12 m7 l7">
			<select id="brandProdDetail" name="brandProdDetail">
				<option value="" class="red-text" disabled>Select Brand</option>
				<?php
					$brandProdDetQry = "SELECT name FROM brand ORDER BY name ASC";
					if ($resultProdDet = mysqli_query($conn, $brandProdDetQry)) {
			        	if (mysqli_num_rows($resultProdDet) > 0) {
							while($rowProdDet 	= mysqli_fetch_array($resultProdDet)){
								$nameBrandProd 	= $rowProdDet['name'];
								$selected 	= ($nameBrandProd == $nameBrandProdDetail) ? 'selected' : '';
								?>
									<option value="<?php echo $nameBrandProd;?>" <?php echo $selected;?>><?php echo $nameBrandProd;?></option>
								<?php
							}
						}
					}
				?>
			</select>
			<label>Select Brand</label>
			<div class="col s12 mb-30"><a href="#modalAddBrand" class="modal-trigger blue-text">[+]Add Brand</a></div>
		</div>
		<div class="input-field col s12 m6 l6">
			<select id="mainCatBrandProd" name="mainCatBrandProd">
				<option value="" class="red-text" selected disabled>Select Main Category</option>
				<?php
					$mainCatQry = "SELECT mainCategory FROM product WHERE mainCategory IS NOT NULL AND mainCategory != ''GROUP BY mainCategory";
					if ($resultMainCat = mysqli_query($conn, $mainCatQry)) {
			        	if (mysqli_num_rows($resultMainCat) > 0) {
							while($rowMainCat 	= mysqli_fetch_array($resultMainCat)){
								$mainCat 	= $rowMainCat['mainCategory'];
								$selected 	= ($mainCat == $mainCatProdDetail) ? 'selected' : '';
								?>
									<option value="<?php echo $mainCat;?>" <?php echo $selected;?>><?php echo $mainCat;?></option>
								<?php
							}
						}
					}
				?>
			</select>
			<label>Main Category</label>
			<div class="col s12"><a href="#modalAddMainCat" class="modal-trigger blue-text">[+]Add Main Category</a></div>
		</div>
		<div class="input-field col s12 m6 l6">
			<select id="subCatProject" name="subCatProject">
				<option class="red-text" selected disabled>Select Sub Category</option>
				<?php
					$subCatQry = "SELECT subCategory FROM product WHERE subCategory IS NOT NULL AND subCategory != '' GROUP BY subCategory";
					if ($resultSubCat = mysqli_query($conn, $subCatQry)) {
			        	if (mysqli_num_rows($resultSubCat) > 0) {
							while($rowSubCat 	= mysqli_fetch_array($resultSubCat)){
								$subCat 	= $rowSubCat['subCategory'];
								$selected 	= ($subCat == $subCatProdDetail) ? 'selected' : '';
								?>
									<option value="<?php echo $subCat;?>" <?php echo $selected;?>><?php echo $subCat;?></option>
								<?php
							}
						}
					}
				?>
			</select>
			<label>Sub Category</label>
			<div class="col s12"><a href="#modalAddSubCat" class="modal-trigger blue-text">[+]Add Sub Category</a></div>
		</div>
		<div class="input-field col s12 mt-30">
			<textarea id="wysiwygEditor" name="contentWordProductList" class="materialize-textarea"><?php echo $contentWordProdDetail; ?></textarea>
		</div>
		<div class="col s12">
			<input value="<?php echo $idProduct?>" name="idproduct" type="hidden">
			<button name="btnSubmitContentProductList" class="mt-30 right waves-effect waves-light btn blue darken-4"><i class="material-icons left">subdirectory_arrow_left</i>Update</button>
		</div>
	</form>
</div>
<div id="modalAddBrand" class="modal">
	<form action="#" method="post" enctype="multipart/form-data">
		<div class="modal-content">
			<div class="border-bottom mb-10"><h4>Add Brands</h4></div>
			<div class="col s12 mt-30 center container">
				<div class="file-field input-field col s12">
					<img id="image_upload_preview_add_brand" max-width="500px" class="image_upload_preview responsive-img img-center mb-30" src="<?php echo "../images/emptyimages.bmp"; ?>">
					<div class="btn green darken-4">
						<span>Upload Image</span>
						<input id="changeImageFileAddProductBrand" name="addImageFileAddProductBrand" type="file" required>
					</div>
					<div class="file-path-wrapper">
						<input id="addImagesPathAddProductBrand" name="addImagesPathAddProductBrand" class="file-path validate" type="text" required>
					</div>
				</div>
				<div class="file-field input-field col s12">
					<input id="addBrandProdDet" name="addBrandProdDet" type="text" class="validate" required>
					<label for="addBrandProdDet">Brand Name</label>
				</div>
				<div class="input-field col s12 mb-50">
					<button name="addBrandDetproduct" class="waves-effect waves-light btn green darken-4 right">Add Brand</button>
				</div>
			</div>
		</div>
	</form>
</div>
<div id="modalAddMainCat" class="modal">
	<form action="#" method="post" enctype="multipart/form-data">
		<div class="modal-content">
			<div class="border-bottom mb-10"><h4>Add Main Category</h4></div>
			<div class="col s12 mt-30 center container">
				<div class="file-field input-field">
					<input id="addMainProductCategory" name="addMainProductCategory" type="text" class="validate">
					<label for="addMainProductCategory">Main Category</label>
				</div>
				<div class="input-field col s12 mb-50">
					<input value="<?php echo $idProduct?>" name="idproductMain" type="hidden">
					<button name="btnAddMainProductCategory" class="waves-effect waves-light btn green darken-4 right">Add Main Category</button>
				</div>
			</div>
		</div>
	</form>
</div>
<div id="modalAddSubCat" class="modal">
	<form action="#" method="post" enctype="multipart/form-data">
		<div class="modal-content">
			<div class="border-bottom mb-10"><h4>Add Sub Category</h4></div>
			<div class="col s12 mt-20 center container">
				<div class="file-field input-field">
					<input id="addSubProductCategory" name="addSubProductCategory" type="text" class="validate">
					<label for="addSubProductCategory">Sub Category</label>
				</div>
				<div class="input-field col s12 mb-50">
					<input value="<?php echo $idProduct?>" name="idproductSub" type="hidden">
					<button name="btnAddSubProductCategory" class="waves-effect waves-light btn green darken-4 right">Add Sub Category</button>
				</div>
			</div>
		</div>
	</form>
</div>
<div id="modalAddProductDetailItems" class="modal">
	<div class="modal-content">
		<div class="border-bottom mb-10"><h4>Add Product Images</h4></div>
		<div class="col s12 mt-30 center container">
			<form action="#" method="post" enctype="multipart/form-data">
				<div class="file-field input-field col s12">
					<div class="btn green darken-4">
						<span>Upload Image</span>
						<input id="changeImageFileProductDetail" name="addImageFileProductDetail[]" type="file" multiple required>
					</div>
					<div class="file-path-wrapper">
						<input placeholder="Select max. 20 images/upload and max. 8MB total/upload" id="addImagesPathProductDetail" name="addImagesPathProductDetail" class="file-path validate" type="text" required>
					</div>
				</div>
				<div class="input-field col s12 mb-50">
					<button type="submit" name="btnAddNewProductDetail" class="waves-effect waves-light btn green darken-4 right">Add</button>
					<a href="#!" class="modal-action modal-close waves-effect waves-light btn blue darken-4 right">Cancel</a>
				</div>
			</form>
		</div>
	</div>
</div>