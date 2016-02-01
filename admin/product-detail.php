<?php
	$idDetProd = $_GET['detail'];
	$prodDetQry = "SELECT 
                    product.idproduct as idproduct,
                    product.name as name,
                    product.contentWord as contentWord,
                    product.idcategory as idcategory,
                    brand.name as brandName,
                    category.main as main,
                    category.sub as sub
                    FROM 
                        product,
                        brand,
                        category
                    WHERE product.idbrand = brand.idbrand AND product.idcategory = category.idcategory AND product.idproduct = ".$idDetProd."";

    if($resultProdDetail = mysqli_query($conn, $prodDetQry) or die("Query failed :".mysqli_error($conn))){
        if(mysqli_num_rows($resultProdDetail) > 0){
            $rowProdDetail = mysqli_fetch_array($resultProdDetail);
            $idProduct         		= $rowProdDetail['idproduct'];
            $nameProdDetail       	= $rowProdDetail['name'];
            $contentWordProdDetail  = $rowProdDetail['contentWord'];
            $idCatProdDetail      	= $rowProdDetail['idcategory'];
            $nameBrandProdDetail  	= $rowProdDetail['brandName'];
            $mainCatProdDetail  	= $rowProdDetail['main'];
            $subCatProdDetail  		= $rowProdDetail['sub'];
        }
    }
?>
<div class="col s12">
	<div class="col s12 center">
		<h4><?php echo $nameProdDetail;?></h4>
	</div>
	<div class="col s12 border-bottom pdb-10">
		<h5 class="col s12 m6 l6">Manage Image</h5>
		<a class="btn-floating btn-large waves-effect waves-light green darken-4 right mb-30" title="Add more images"><i class="material-icons">add</i></a>
	</div>
	<div class="col s12 red-text">
		*klick images for delete
	</div>
	<div class="col s12 mt-30">
		<?php
		$imagesDetProductQry = "SELECT idimages, path FROM images WHERE (owner = 'Product' AND idowner = '".$idDetProd."')";
		if ($resultImagesDetProductQry = mysqli_query($conn, $imagesDetProductQry)) {
        	if (mysqli_num_rows($resultImagesDetProductQry) > 0) {
				while($rowImagesDetProduct 	= mysqli_fetch_array($resultImagesDetProductQry)){
					$idImagesDetProduct  = $rowImagesDetProduct['idimages'];
					$pathImagesDetProduct  = $rowImagesDetProduct['path'];
					?>
						<div class="col l2 m4 s12">
							<a href="<?php echo "#modalProject".$idImagesDetProduct; ?>" class="modal-trigger">
								<img src="<?php echo "../".$pathImagesDetProduct; ?>" class="responsive-img ml-10 mr-10" title="klick to delete image">
							</a>
						</div>
						<div id="<?php echo "modalProject".$idImagesDetProduct; ?>" class="modal">
							<div class="modal-content center">
								<div class="border-bottom mb-10"><h4>Image Delete</h4></div>
								<p>Are you sure want to delete this image ?</p>
								<img src="<?php echo "../".$pathImagesDetProduct; ?>" class="responsive-img ml-10 mr-10">
							</div>
							<div class="modal-footer">
								<button name="$idImagesDetProduct" id="$idImagesDetProduct" class="red accent-4 white-text modal-action modal-close waves-effect waves-green btn-flat">Yes..!!</button>
								<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">NO..</a>
							</div>
						</div>
					<?php
				}
			}
		}
		?>
	</div>
	<div class="row">
		<div class="col s12">
			<div class="center">
				<ul class="pagination">
				    <li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>
				    <li class="active"><a href="#!">1</a></li>
				    <li class="waves-effect"><a href="#!">2</a></li>
				    <li class="waves-effect"><a href="#!">3</a></li>
				    <li class="waves-effect"><a href="#!">4</a></li>
				    <li class="waves-effect"><a href="#!">5</a></li>
				    <li class="waves-effect"><a href="#!"><i class="material-icons">chevron_right</i></a></li>
		  		</ul>
			</div>
		</div>
	</div>
	<div class="col s12 border-bottom pdb-10">
		<h5 class="col s12 m6 l6">Manage Content</h5>
	</div>
	<div class="input-field col s12 m7 l7 mt-30">
		<input id="titleProduct" name="titleProduct" type="text" class="validate" value="<?php echo $nameProdDetail; ?>">
		<label for="titleProduct">Product Name</label>
	</div>
	<div class="input-field col s12 m7 l7">
		<select class="brandProdDetail" name="brandProdDetail">
			<option value="" disabled>Select Brand</option>
			<?php
				$brandProdDetQry = "SELECT name FROM brand";
				if ($resultProdDet = mysqli_query($conn, $brandProdDetQry)) {
		        	if (mysqli_num_rows($resultProdDet) > 0) {
						while($rowProdDet 	= mysqli_fetch_array($resultProdDet)){
							$nameBrandProd 	= $rowProdDet['name'];
							$selected 	= ($nameBrandProd == $nameBrandProdDetail) ? 'selected' : '';
							?>
								<option value="<?php echo $idMainCat;?>" <?php echo $selected;?>><?php echo $nameBrandProd;?></option>
							<?php
						}
					}
				}
			?>
		</select>
		<label>Select Brand</label>
		<div class="col s12 mb-30"><a href="#modalAddBrand" class="modal-trigger">[+]Add Brand</a></div>
	</div>
	<div class="input-field col s12 m6 l6">
		<select class="mainCatBrandProd" name="mainCatBrandProd">
			<option value="" disabled>Select Main Category</option>
			<?php
				$mainCatQry = "SELECT idcategory, main FROM category WHERE owner = 'product' GROUP BY main";
				if ($resultMainCat = mysqli_query($conn, $mainCatQry)) {
		        	if (mysqli_num_rows($resultMainCat) > 0) {
						while($rowMainCat 	= mysqli_fetch_array($resultMainCat)){
							$idMainCat 	= $rowMainCat['idcategory'];
							$mainCat 	= $rowMainCat['main'];
							$selected 	= ($mainCat == $mainCatProdDetail) ? 'selected' : '';
							?>
								<option value="<?php echo $idMainCat;?>" <?php echo $selected;?>><?php echo $mainCat;?></option>
							<?php
						}
					}
				}
			?>
		</select>
		<label>Main Category</label>
		<div class="col s12"><a href="#modalAddMainCat" class="modal-trigger">[+]Add Main Category</a></div>
	</div>
	<div class="input-field col s12 m6 l6">
		<select class="subCatProject" name="subCatProject">
			<option selected disabled>Select Sub Category</option>
			<?php
				$subCatQry = "SELECT idcategory, sub, main FROM category WHERE owner = 'product' AND main = '".$mainCat."' AND sub IS NOT NULL AND sub != '' GROUP BY sub";
				if ($resultSubCat = mysqli_query($conn, $subCatQry)) {
		        	if (mysqli_num_rows($resultSubCat) > 0) {
						while($rowSubCat 	= mysqli_fetch_array($resultSubCat)){
							$idSubCat 	= $rowSubCat['idcategory'];
							$subCat 	= $rowSubCat['sub'];
							$selected 	= ($subCat == $subCatProdDetail) ? 'selected' : '';
							?>
								<option value="<?php echo $idSubCat;?>" <?php echo $selected;?>><?php echo $subCat;?></option>
							<?php
						}
					}
				}
			?>
		</select>
		<label>Sub Category</label>
		<div class="col s12"><a href="#modalAddSubCat" class="modal-trigger">[+]Add Sub Category</a></div>
	</div>
	<div class="input-field col s12 mt-30">
		<textarea id="wysiwygEditor" class="materialize-textarea"><?php echo $contentWordProdDetail; ?></textarea>
	</div>
	<div class="col s12">
		<a class="mt-30 right waves-effect waves-light btn blue darken-4 disabled"><i class="material-icons left">subdirectory_arrow_left</i>Update</a>
	</div>
</div>
<div id="modalAddBrand" class="modal">
	<div class="modal-content">
		<div class="border-bottom mb-10"><h4>Add Brands</h4></div>
		<div class="col s12 mt-30 center container">
			<div class="file-field input-field">
				<input id="addBrandProdDet" name="addBrandProdDet" type="text" class="validate">
				<label for="addBrandProdDet">Brand Name</label>
			</div>
			<div class="input-field col s12 mb-50">
				<a class="waves-effect waves-light btn green darken-4 right">Add</a>
			</div>
		</div>
	</div>
</div>
<div id="modalAddMainCat" class="modal">
	<div class="modal-content">
		<div class="border-bottom mb-10"><h4>Add Main Category</h4></div>
		<div class="col s12 mt-30 center container">
			<div class="file-field input-field">
				<input id="addMainProductCategory" name="addMainProductCategory" type="text" class="validate">
				<label for="addMainProductCategory">Main Category</label>
			</div>
			<div class="input-field col s12 mb-50">
				<a class="waves-effect waves-light btn green darken-4 right">Add</a>
			</div>
		</div>
	</div>
</div>
<div id="modalAddSubCat" class="modal">
	<div class="modal-content">
		<div class="border-bottom mb-10"><h4>Add Sub Category</h4></div>
		<span>[Main Category : <?php echo $mainCatProdDetail;?>]</span>
		<div class="col s12 mt-30 center container">
			<div class="file-field input-field">
				<input id="addSubProductCategory" name="addSubProductCategory" type="text" class="validate">
				<label for="addSubProductCategory">Sub Category</label>
			</div>
			<div class="input-field col s12 mb-50">
				<a class="waves-effect waves-light btn green darken-4 right">Add</a>
			</div>
		</div>
	</div>
</div>