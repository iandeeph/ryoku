<?php
	$idbrand = $_GET['brand'];

	$productQry = "SELECT * FROM product WHERE idbrand = '".$idbrand."' LIMIT 1";
	if($resultproductQry = mysqli_query($conn, $productQry)){
		if(mysqli_num_rows($resultproductQry) > 0){
			$rowproductQry = mysqli_fetch_array($resultproductQry);
			$idproduct 			= $rowproductQry['idproduct'];
			$nameproduct		= $rowproductQry['name'];
			$idBrandproduct		= $rowproductQry['idbrand'];
			$idCatproduct		= $rowproductQry['idcategory'];
			$contentWordproduct	= $rowproductQry['contentWord'];

			$categoryproductQry = "SELECT * FROM category WHERE idcategory = '".$idCatproduct."' AND owner = 'Product' LIMIT 1";
			if($resultCatproductQry = mysqli_query($conn, $categoryproductQry)){
				if(mysqli_num_rows($resultCatproductQry) > 0){
					$rowCatproductQry = mysqli_fetch_array($resultCatproductQry);
					$idcategoryproduct	= $rowCatproductQry['idcategory'];
					$mainCatproduct 	= $rowCatproductQry['main'];
					$subCatproduct 		= $rowCatproductQry['sub'];
				}
			}

			$brandproductQry = "SELECT * FROM brand WHERE idbrand = '".$idBrandproduct."' LIMIT 1";
			if($resultbrandproductQry = mysqli_query($conn, $brandproductQry)){
				if(mysqli_num_rows($resultbrandproductQry) > 0){
					$rowbrandproductQry = mysqli_fetch_array($resultbrandproductQry);
					$idbrandproduct		= $rowbrandproductQry['idbrand'];
					$namebrandproduct 	= $rowbrandproductQry['name'];
					$idcatbrandproduct 	= $rowbrandproductQry['idcategory'];
				}
			}

			$imagesproductQry = "SELECT * FROM images WHERE owner = 'product' AND idowner = '".$idproduct."' LIMIT 1";
			if($resultImagesproductQry = mysqli_query($conn, $imagesproductQry)){
				if(mysqli_num_rows($resultImagesproductQry) > 0){
					$rowImagesproductQry = mysqli_fetch_array($resultImagesproductQry);
					$idImagesproduct	= $rowImagesproductQry['idimages'];
					$nameImagesproduct	= $rowImagesproductQry['title'];
					$pathproduct		= $rowImagesproductQry['path'];
				}
			}
		}
	}
?>
<div class="col s12">
	<img class="materialboxed responsive-img mt-30 mb-30" width="500" src="<?php echo $pathproduct; ?>" alt="<?php echo $nameImagesproduct; ?>" title="<?php echo $nameproduct; ?>">
</div>
<div class="col s12">
	<h4>
		<?php echo $nameproduct; ?>
	</h4>
	<p>
		<?php echo $contentWordproduct; ?>
	</p>
</div>