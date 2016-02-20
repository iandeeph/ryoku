<!-- LIST OF PRODUCT -->
<div class="row">
	<div class="grey lighten-2 col s12 left pdb-30 pdt-30">
      	<h4 class="black-text">Brand List</h4>
    </div>
	<?php
		$brandQry = "SELECT * FROM brand ORDER BY name ASC";
		if($resultBrandQry = mysqli_query($conn, $brandQry)){
			if(mysqli_num_rows($resultBrandQry) > 0){
				while ($rowBrandtQry = mysqli_fetch_array($resultBrandQry)) {
					$idbrand 	= $rowBrandtQry['idbrand'];
					$nameBrand	= $rowBrandtQry['name'];

					$imagesBrandQry = "SELECT * FROM images WHERE owner = 'brand' AND idowner = '".$idbrand."' LIMIT 1";
					if($resultImagesBrandQry = mysqli_query($conn, $imagesBrandQry)){
						if(mysqli_num_rows($resultImagesBrandQry) > 0){
							$rowImagesBrandQry = mysqli_fetch_array($resultImagesBrandQry);
							$idImagesBrand		= $rowImagesBrandQry['idimages'];
							$nameImagesBrand	= $rowImagesBrandQry['title'];
							$pathBrand			= $rowImagesBrandQry['path'];
						}
					}
					?>
						<div class="col s12 m6 l3 mt-30">
							<div class="col s12 center" style="height:300px">
								<a href="./index.php?menu=product&brand=<?php echo $idbrand;?>">
									<img src="<?php echo $pathBrand;?>" alt="<?php echo $nameImagesBrand;?>" title="<?php echo $nameBrand;?>" class="responsive-img" width="250px">
								</a>
							</div>
							<div class="col s12 center">
								<h5><?php echo $nameBrand;?></h5>
							</div>
						</div>
					<?php
				}
			}
		}
	?>
</div>