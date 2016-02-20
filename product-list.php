<div class="row">
	<?php
		$idbrand = $_GET['brand'];
		$mainCat = $_GET['mainCat'];
		$subCat = $_GET['subCat'];

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
							<a class="blue-text darken-4-text" href="./index.php?menu=product&brand=<?php echo $idbrand;?>&mainCat=<?php echo $mainCat;?>&subCat=<?php echo $subCat;?>"><?php echo $subCat; ?></a> /
						</span>
					</div>
				<?php
				
				$subCatBrandQry = "SELECT idproduct, name FROM product WHERE subCategory = '".$subCat."' AND idbrand = '".$idBrandCat."'";
				if($resultSubCatBrand = mysqli_query($conn, $subCatBrandQry) or die("Query failed :".mysqli_error($conn))){
					if(mysqli_num_rows($resultSubCatBrand) > 0){
						while($rowSubCatBrand = mysqli_fetch_array($resultSubCatBrand)){
							$idSubCatBrand 		= $rowSubCatBrand['idproduct'];
							$nameProdCatBrand 	= $rowSubCatBrand['name'];

							$imagesCatBrandQry = "SELECT * FROM images WHERE idowner = '".$idSubCatBrand."' AND owner = 'product' ORDER BY RAND()  LIMIT 1";
							if($resultImagesCatBrand = mysqli_query($conn, $imagesCatBrandQry) or die("Query failed :".mysqli_error($conn))){
								if(mysqli_num_rows($resultImagesCatBrand) > 0){
									$rowImagesCatBrand = mysqli_fetch_array($resultImagesCatBrand);
									$nameImagesCatBrand = $rowImagesCatBrand['title'];
									$pathImagesCatBrand = $rowImagesCatBrand['path'];
									?>
										<div class="col s12 m6 l3 mt-30">
											<div class="col s12 center" style="height:300px">
												<a href="./index.php?menu=product&brand=<?php echo $idbrand;?>&mainCat=<?php echo $mainCat;?>&subCat=<?php echo $subCat;?>&detProd=<?php echo $idSubCatBrand;?>">
													<img src="<?php echo $pathImagesCatBrand;?>" alt="<?php echo $nameImagesCatBrand;?>" title="<?php echo $nameProdCatBrand;?>" class="responsive-img" width="250px">
												</a>
											</div>
											<div class="col s12 center">
												<h5><?php echo $nameProdCatBrand;?></h5>
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