<div class="row">
	<?php
		$idbrand = $_GET['brand'];
		$mainCat = $_GET['mainCat'];

		$brandCatQry = "SELECT * FROM brand WHERE idbrand = '".$idbrand."' LIMIT 1";
		if($resultBrandCat = mysqli_query($conn, $brandCatQry) or die("Query failed :".mysqli_error($conn))){
			if(mysqli_num_rows($resultBrandCat) > 0){
				$rowProdCatd = mysqli_fetch_array($resultBrandCat);
				$idBrandCat 	= $rowProdCatd['idbrand'];
				$nameBrandCat	= $rowProdCatd['name'];
				?>
					<div class="col s12">
						<span class="grey-text darken-4-text">
							<a class="blue-text darken-4-text" href="./index.php?menu=product&brand=<?php echo $idbrand;?>"><?php echo $nameBrandCat; ?></a> /
							<a class="blue-text darken-4-text" href="./index.php?menu=product&brand=<?php echo $idbrand;?>&mainCat=<?php echo $mainCat;?>"><?php echo $mainCat; ?></a> /
						</span>
					</div>
				<?php

				$subCatBrandQry = "SELECT idproduct, subCategory FROM product WHERE mainCategory = '".$mainCat."' AND idbrand = '".$idBrandCat."' AND subCategory IS NOT NULL AND subCategory != ''";
				if($resultSubCatBrand = mysqli_query($conn, $subCatBrandQry) or die("Query failed :".mysqli_error($conn))){
					if(mysqli_num_rows($resultSubCatBrand) > 0){
						while($rowSubCatBrand = mysqli_fetch_array($resultSubCatBrand)){
							$idSubCatBrand 	= $rowSubCatBrand['idproduct'];
							$subCatBrand 	= $rowSubCatBrand['subCategory'];

							$imagesCatBrandQry = "SELECT * FROM images WHERE idowner = '".$idSubCatBrand."' AND owner = 'product' ORDER BY RAND() LIMIT 1";
							if($resultImagesCatBrand = mysqli_query($conn, $imagesCatBrandQry) or die("Query failed :".mysqli_error($conn))){
								if(mysqli_num_rows($resultImagesCatBrand) > 0){
									$rowImagesCatBrand = mysqli_fetch_array($resultImagesCatBrand);
									$nameImagesCatBrand = $rowImagesCatBrand['title'];
									$pathImagesCatBrand = $rowImagesCatBrand['path'];
									?>
										<div class="col s12 m6 l3 mt-30">
											<div class="col s12 center" style="height:300px">
												<a href="./index.php?menu=product&brand=<?php echo $idbrand;?>&mainCat=<?php echo $mainCat;?>&subCat=<?php echo $subCatBrand;?>">
													<img src="<?php echo $pathImagesCatBrand;?>" alt="<?php echo $nameImagesCatBrand;?>" title="<?php echo $subCatBrand;?>" class="responsive-img" width="250px">
												</a>
											</div>
											<div class="col s12 center">
												<h5><?php echo $subCatBrand;?></h5>
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
	?>
</div>