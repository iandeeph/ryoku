<div class="row">
	<div class="col s12 center">
      	<h3 class="black-text"><?php echo ($cat == "engineering")?"ENGINEERING":"CIVIL CONSTRUCTION"; ?></h3>
    </div>
    <div class="container">
    	<!-- LIST OF PRODUCT -->
		<div class="row">
			<?php
				$brandQry = "SELECT * FROM brand WHERE category = '".$cat."' ORDER BY name ASC";
				if($resultBrandQry = mysqli_query($conn, $brandQry)){
					if(mysqli_num_rows($resultBrandQry) > 0){
						while ($rowBrandtQry = mysqli_fetch_array($resultBrandQry)) {
							$idBrand 		= $rowBrandtQry['idbrand'];
							$nameBrand		= $rowBrandtQry['name'];
							$originBrand	= $rowBrandtQry['origin'];
							$descBrand		= $rowBrandtQry['description'];

							$imagesBrandQry = "SELECT * FROM images WHERE owner = 'brand' AND idowner = '".$idBrand."' LIMIT 1";
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
									<div class="col s12 center brand-images-wrapper valign-wrapper z-depth-2 height-300">
										<img src="<?php echo $pathBrand;?>" alt="<?php echo $nameImagesBrand;?>" title="<?php echo $nameBrand;?>" class="responsive-img" width="250px">
									</div>
									<div class="col s12 brand-name-wrapper no-padding z-depth-2">
										<div class="col s7 blue darken-2 white-text">
											<span class="bold"><?php echo $nameBrand;?></span>
										</div>
										<div class="col s5 white">
											<span><?php echo $originBrand;?></span>
										</div>
									</div>
									<div class="col s12 brand-desc-wrapper grey lighten-1 z-depth-2 italic">
										<span>"<?php echo $descBrand;?>"</span>
									</div>
								</div>
							<?php
						}
					}
				}
			?>
		</div>
    </div>
</div>