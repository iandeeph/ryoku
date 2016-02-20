<?php
	$catGallery = $_GET['cat'];
	$idGallery = $_GET['detail'];

	if($catGallery == 'product' && isset($idGallery)){
		$prodDetGallery = "SELECT
		                    idproduct,
		                    name
		                    FROM product
		                    WHERE idproduct = '".$idGallery."'";
	    if($resultDetProdGallery = mysqli_query($conn, $prodDetGallery) or die("Query failed :".mysqli_error($conn))){
	        if(mysqli_num_rows($resultDetProdGallery) > 0){
	            $rowProdDetGallery = mysqli_fetch_array($resultDetProdGallery);
                $idProductDetail   	= $rowProdDetGallery['idproduct'];
                $nameProdDetGallery = $rowProdDetGallery['name'];
			    ?>
					<div class="col s12 mt-30 border-bottom pdb-30">
						<div class="left col m6 l6 s12"><h4><?php echo $nameProdDetGallery;?></h4></div>
						<div class="col m6 l6 s12 right-align hide-on-small-only">
							<a class="btn-large waves-effect waves-light blue darken-2" href="./index.php?menu=gallery&cat=<?php echo $catGallery; ?>"><i class="material-icons left">keyboard_return</i>Back to Gallery</a>
						</div>
					</div>
					<div class="col s12 pdb-30">
						<div class="col m6 l6 s12 center hide-on-med-and-up right-align">
							<a class="btn waves-effect waves-light blue darken-2 mt-30" href="./index.php?menu=gallery&cat=<?php echo $catGallery; ?>"><i class="material-icons left">keyboard_return</i>Back to Gallery</a>
						</div>
						<?php
					        $imagesProdDetGallery = "SELECT path FROM images WHERE (owner = 'Product' AND idowner = '".$idProductDetail."')";
							if ($resultImagesProdDetGallery = mysqli_query($conn, $imagesProdDetGallery)) {
					        	if (mysqli_num_rows($resultImagesProdDetGallery) > 0) {
									while($rowImagesProdDetGallery 	= mysqli_fetch_array($resultImagesProdDetGallery)){
										$pathImagesProdDetGallery  	= $rowImagesProdDetGallery['path'];
										?>
											<img class="materialboxed responsive-img col s12 m6 l3 mt-30 mb-30" data-caption="<?php echo $nameProdDetGallery;?>" src="<?php echo $pathImagesProdDetGallery;?>">
										<?php
									}
								}
							}
						?>
					</div>
				<?php
	        }
	    }
	}elseif($catGallery == 'project' && isset($idGallery)){
		$projectDetGallery = "SELECT
			                    idproject,
			                    name
			                    FROM project
			                    WHERE idproject = '".$idGallery."'";
	    if($resultDetProjectGallery = mysqli_query($conn, $projectDetGallery) or die("Query failed :".mysqli_error($conn))){
	        if(mysqli_num_rows($resultDetProjectGallery) > 0){
	            $rowProjectDetGallery = mysqli_fetch_array($resultDetProjectGallery);
                $idProjectDetail   	= $rowProjectDetGallery['idproject'];
                $nameProjectDetGallery = $rowProjectDetGallery['name'];
                ?>
					<div class="col s12 mt-30 border-bottom pdb-30">
						<div class="left col m6 l6 s12"><h4><?php echo $nameProjectDetGallery;?></h4></div>
						<div class="col m6 l6 s12 right-align hide-on-small-only">
							<a class="btn-large waves-effect waves-light blue darken-2" href="./index.php?menu=gallery&cat=<?php echo $catGallery; ?>"><i class="material-icons left">keyboard_return</i>Back to Gallery</a>
						</div>
					</div>
					<div class="col s12 pdb-30">
						<div class="col m6 l6 s12 center hide-on-med-and-up right-align">
							<a class="btn waves-effect waves-light blue darken-2 mt-30" href="./index.php?menu=gallery&cat=<?php echo $catGallery; ?>"><i class="material-icons left">keyboard_return</i>Back to Gallery</a>
						</div>
						<?php
					        $imagesProdDetGallery = "SELECT path FROM images WHERE (owner = 'Project' AND idowner = '".$idProjectDetail."')";
							if ($resultImagesProjectDetGallery = mysqli_query($conn, $imagesProdDetGallery)) {
					        	if (mysqli_num_rows($resultImagesProjectDetGallery) > 0) {
									while($rowImagesProjectDetGallery 	= mysqli_fetch_array($resultImagesProjectDetGallery)){
										$pathImagesProjectDetGallery  		= $rowImagesProjectDetGallery['path'];
										?>
											<img class="materialboxed responsive-img col s12 m6 l3 mt-30 mb-30" data-caption="<?php echo $nameProjectDetGallery;?>" src="<?php echo $pathImagesProjectDetGallery;?>">
										<?php
									}
								}
							}
						?>
					</div>
				<?php
	        }
	    }
	}
?>
</div>