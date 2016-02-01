<div class="row">
	<div class="col s12 center">
      	<h3 class="black-text">OUR PRODUCT</h3>
    </div>
    <div class="col l2 hide-on-med-and-down">
    	<div class="col s12 grey-text darken-4-text">
    		<ul class="treeView">
    			<li>
    				<span class="grey-text darken-4-text">List of Product</span>
		    		<ul class="collapsibleList">
		    			<?php
		    				$brandTreeQry = "SELECT * FROM brand";
							if($resultBrandTree = mysqli_query($conn, $brandTreeQry)){
								$brandTreeNum = mysqli_num_rows($resultBrandTree);
								if($brandTreeNum > 0){
									$treeBrandNum = 1;
									while ($rowBrandTree = mysqli_fetch_array($resultBrandTree)) {
										$idbrandTree 	= $rowBrandTree['idbrand'];
										$nameBrandTree	= $rowBrandTree['name'];
										$idCatBrandTree	= $rowBrandTree['idcategory'];

										$lastChild = ($brandTreeNum == $treeBrandNum) ? "lastChild" : "";
										?>
											<li class="<?php echo $lastChild;?>">
							    				<a href="#"><span class="grey-text darken-4-text"><?php echo $nameBrandTree;?></span></a>
							    				<ul>
								    				<?php
									    				$brandCatQry = "SELECT main FROM category WHERE idowner = '".$idbrandTree."' AND owner = 'product' GROUP BY main";
									    				if($resultMainCatBrand = mysqli_query($conn, $brandCatQry)){
									    					$mainBrandTreeNum = mysqli_num_rows($resultMainCatBrand);
															if($mainBrandTreeNum > 0){
																$treemainBrandNum = 1;
																while($rowmainCatBrandQry = mysqli_fetch_array($resultMainCatBrand)){
																	$mainCatBrand = $rowmainCatBrandQry['main'];
																	
																	$lastChildMain = ($mainBrandTreeNum == $treemainBrandNum) ? "lastChild" : "";
																	?>
																		<li class="<?php echo $lastChildMain;?>">
														    				<a href="#"><span class="grey-text darken-4-text"><?php echo $mainCatBrand;?></span></a>
														    				<ul>
															    				<?php
															    					$brandSubCatQry = "SELECT idcategory, sub FROM category WHERE idowner = '".$idbrandTree."' AND owner = 'product' AND main = '".$mainCatBrand."' AND sub IS NOT NULL AND sub != ''";
																    				if($resultSubCatBrand = mysqli_query($conn, $brandSubCatQry)){
																    					$subBrandTreeNum = mysqli_num_rows($resultSubCatBrand);
																						if($subBrandTreeNum > 0){
																							$treeSubBrandNum = 1;
																							while($rowSubCatBrandQry = mysqli_fetch_array($resultSubCatBrand)){
																								$idSubCatBrand 	= $rowSubCatBrandQry['idcategory'];
																								$subCatBrand 	= $rowSubCatBrandQry['sub'];
																								
																								$lastChildSub = ($subBrandTreeNum == $treeSubBrandNum) ? "lastChild" : "";
																								?>
																									<li class="<?php echo $lastChildSub;?>">
																					    				<a href="#"><span class="grey-text darken-4-text"><?php echo $subCatBrand;?></span></a>
														    											<ul>
														    												<?php
																						    					$listProdQry = "SELECT name FROM product WHERE idbrand = '".$idbrandTree."' AND idcategory = '".$idSubCatBrand."'";
																							    				if($resultListProd = mysqli_query($conn, $listProdQry)){
																							    					$listProdTreeNum = mysqli_num_rows($resultListProd);
																													if($listProdTreeNum > 0){
																														$listProdNum = 1;
																														while($rowListProd = mysqli_fetch_array($resultListProd)){
																															$nameListProd = $rowListProd['name'];
																															
																															$lastChildProd = ($listProdTreeNum == $listProdNum) ? "lastChild" : "";
																															?>
																																<li class="<?php echo $lastChildProd;?>">
																												    				<a href="#"><span class="grey-text darken-4-text"><?php echo $nameListProd;?></span></a>
																												    			</li>
																												    		<?php
																												    		$listProdNum++;
																												    	}
																												    }
																												}
																											?>
																										</ul>
																				    				</li>
																				    			<?php
																								$treeSubBrandNum++;
																							}
																						}
																					}
															    				?>
														    				</ul>
														    			</li>
																	<?php
																	$treemainBrandNum++;
																}
															}
														}
								    				?>
							    				</ul>
							    			</li>
					    				<?php
					    				$treeBrandNum++;
									}
								}
							}
		    			?>
		    		</ul>
    			</li>
    		</ul>
    	</div>
    </div>
    <div class="col l10 s12 m12">
    	<?php
	    	if(!isset($_GET['brand']) && !isset($_GET['mainCat']) && !isset($_GET['subCat']) && !isset($_GET['detProd'])){
	        	include 'product-home.php';
	    	}elseif(isset($_GET['brand']) && !isset($_GET['mainCat']) && !isset($_GET['subCat']) && !isset($_GET['detProd'])){
	        	include 'product-main.php';
	    	}elseif(isset($_GET['brand']) && isset($_GET['mainCat']) && !isset($_GET['subCat']) && !isset($_GET['detProd'])){
	        	include 'product-sub.php';
	    	}elseif(isset($_GET['brand']) && isset($_GET['mainCat']) && isset($_GET['subCat']) && !isset($_GET['detProd'])){
	        	include 'product-list.php';
	    	}elseif(isset($_GET['brand']) && isset($_GET['mainCat']) && isset($_GET['subCat']) && isset($_GET['detProd'])){
	        	include 'product-detail.php';
	    	}else{
	        	include 'product-home.php';
	    	}
    	?>
    </div>
</div>