<div class="row">
	<?php
		$idbrand = $_GET['brand'];
		$mainCat = $_GET['mainCat'];
		$subCat = $_GET['subCat'];
		$detProd = $_GET['detProd'];

		$brandCatQry = "SELECT * FROM brand WHERE idbrand = '".$idbrand."' LIMIT 1";
		if($resultBrandCat = mysqli_query($conn, $brandCatQry) or die("Query failed :".mysqli_error($conn))){
			if(mysqli_num_rows($resultBrandCat) > 0){
				$rowProdCatd = mysqli_fetch_array($resultBrandCat);
				$idBrandCat 	= $rowProdCatd['idbrand'];
				$nameBrandCat	= $rowProdCatd['name'];
				$idCatBrand		= $rowProdCatd['idcategory'];

				$subCatBrandQry = "SELECT * FROM category WHERE idowner = '".$idBrandCat."' AND owner = 'Product' AND idcategory = '".$subCat."' LIMIT 1";
				if($resultSubCatBrand = mysqli_query($conn, $subCatBrandQry) or die("Query failed :".mysqli_error($conn))){
					if(mysqli_num_rows($resultSubCatBrand) > 0){
						$rowSubCatBrand = mysqli_fetch_array($resultSubCatBrand);
						$idSubCatBrand = $rowSubCatBrand['idcategory'];
						$nameMainCatBrand = $rowSubCatBrand['main'];
						$nameSubCatBrand = $rowSubCatBrand['sub'];
						
						$prodCatBrandQry = "SELECT * FROM product WHERE idproduct = '".$detProd."' LIMIT 1";
						if($resultProdCatBrand = mysqli_query($conn, $prodCatBrandQry) or die("Query failed :".mysqli_error($conn))){
							if(mysqli_num_rows($resultProdCatBrand) > 0){
								$rowProdCatBrand = mysqli_fetch_array($resultProdCatBrand);
								$idProdCatBrand 			= $rowProdCatBrand['idproduct'];
								$nameProdCatBrand 			= $rowProdCatBrand['name'];
								$contentWordProdCatBrand 	= $rowProdCatBrand['contentWord'];
								?>
									<div class="col s12 mb-10 border-bottom">
										<span class="grey-text darken-4-text">
										<a href="#"><?php echo $nameBrandCat; ?></a> /
										<a href="#"><?php echo $nameMainCatBrand; ?></a> /
										<a href="#"><?php echo $nameSubCatBrand; ?></a> /
										<a href="#"><?php echo $nameProdCatBrand; ?></a>
									</div>
									<div class="col s12 mb-10 border-bottom">
								<?php

								$imagesCatBrandQry = "SELECT * FROM images WHERE idowner = '".$idProdCatBrand."' AND owner = 'product'";
								if($resultImagesCatBrand = mysqli_query($conn, $imagesCatBrandQry) or die("Query failed :".mysqli_error($conn))){
									if(mysqli_num_rows($resultImagesCatBrand) > 0){
										while($rowImagesCatBrand = mysqli_fetch_array($resultImagesCatBrand)){
											$nameImagesCatBrand = $rowImagesCatBrand['title'];
											$pathImagesCatBrand = $rowImagesCatBrand['path'];
											?>
												<img class="materialboxed responsive-img col s12 m6 l3 mt-30 mb-30" data-caption="<?php echo $nameImagesCatBrand; ?>" src="<?php echo $pathImagesCatBrand; ?>">
											<?php
										}
										?>
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
	?>
</div>
	<div class="col s12">
		<h4>
			<?php echo $nameProdCatBrand; ?>
		</h4>
		<p>
			<?php echo $contentWordProdCatBrand; ?>
		</p>
	</div>
</div>