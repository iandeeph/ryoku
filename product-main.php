<div class="row">
	<?php
		$idbrand = $_GET['brand'];

		$brandCatQry = "SELECT * FROM brand WHERE idbrand = '".$idbrand."' LIMIT 1";
		if($resultBrandCat = mysqli_query($conn, $brandCatQry) or die("Query failed :".mysqli_error($conn))){
			if(mysqli_num_rows($resultBrandCat) > 0){
				$rowProdCatd = mysqli_fetch_array($resultBrandCat);
				$idBrandCat 	= $rowProdCatd['idbrand'];
				$nameBrandCat	= $rowProdCatd['name'];
				$idCatBrand		= $rowProdCatd['idcategory'];
				?>
					<div class="col s12">
						<span class="grey-text darken-4-text">
							<a href="#"> <?php echo $nameBrandCat; ?> </a> /
					</div>
				<?php

				$mainCatBrandQry = "SELECT * FROM category WHERE idowner = '".$idBrandCat."' AND owner = 'Product' GROUP BY main";
				if($resultMainCatBrand = mysqli_query($conn, $mainCatBrandQry) or die("Query failed :".mysqli_error($conn))){
					if(mysqli_num_rows($resultMainCatBrand) > 0){
						while($rowMainCatBrand = mysqli_fetch_array($resultMainCatBrand)){
							$idMainCatBrand	= $rowMainCatBrand['idcategory'];
							$mainCatBrand 	= $rowMainCatBrand['main'];
							$subCatBrand 	= $rowMainCatBrand['sub'];

							$subCatBrandQry = "SELECT idcategory FROM category WHERE idowner = '".$idBrandCat."' AND owner = 'Product' AND main = '".$mainCatBrand."' AND sub IS NOT NULL AND sub != '' LIMIT 1";
							if($resultSubCatBrand = mysqli_query($conn, $subCatBrandQry) or die("Query failed :".mysqli_error($conn))){
								if(mysqli_num_rows($resultSubCatBrand) > 0){
									$rowSubCatBrand = mysqli_fetch_array($resultSubCatBrand);
									$idSubCatBrand = $rowSubCatBrand['idcategory'];

									$prodCatBrandQry = "SELECT idproduct FROM product WHERE idbrand = '".$idBrandCat."' AND idcategory = '".$idSubCatBrand."' LIMIT 1";
									if($resultProdCatBrand = mysqli_query($conn, $prodCatBrandQry) or die("Query failed :".mysqli_error($conn))){
										if(mysqli_num_rows($resultProdCatBrand) > 0){
											$rowProdCatBrand = mysqli_fetch_array($resultProdCatBrand);
											$idProdCatBrand = $rowProdCatBrand['idproduct'];

											$imagesCatBrandQry = "SELECT * FROM images WHERE idowner = '".$idProdCatBrand."' AND owner = 'product' LIMIT 1";
											if($resultImagesCatBrand = mysqli_query($conn, $imagesCatBrandQry) or die("Query failed :".mysqli_error($conn))){
												if(mysqli_num_rows($resultImagesCatBrand) > 0){
													$rowImagesCatBrand = mysqli_fetch_array($resultImagesCatBrand);
													$nameImagesCatBrand = $rowImagesCatBrand['title'];
													$pathImagesCatBrand = $rowImagesCatBrand['path'];
													?>
														<div class="col s12 m6 l3 mt-30">
															<div class="col s12">

																<a href="./index.php?menu=product&brand=<?php echo $idbrand;?>&mainCat=<?php echo $idMainCatBrand;?>">
																	<img src="<?php echo $pathImagesCatBrand;?>" alt="<?php echo $nameImagesCatBrand;?>" title="<?php echo $mainCatBrand;?>" class="responsive-img">
																</a>
															</div>
															<div class="col s12 center">
																<h5><?php echo $mainCatBrand;?></h5>
															</div>
														</div>
													<?php
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}
	?>
</div>