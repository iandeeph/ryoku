<?php
	if($cat == 'product')  {
		$prodGallery = "SELECT
                    idproduct,
                    name
                    FROM product";
	    if($resultProdGallery = mysqli_query($conn, $prodGallery) or die("Query failed :".mysqli_error($conn))){
	        if(mysqli_num_rows($resultProdGallery) > 0){
	            while($rowProdGallery = mysqli_fetch_array($resultProdGallery)){
	                $idProduct          	= $rowProdGallery['idproduct'];
	                $nameProdGallery       	= $rowProdGallery['name'];

	                $imagesProdGallery = "SELECT path FROM images WHERE (owner = 'Product' AND idowner = '".$idProduct."') ORDER BY RAND() LIMIT 1";
					if ($resultImagesProdGallery = mysqli_query($conn, $imagesProdGallery)) {
			        	if (mysqli_num_rows($resultImagesProdGallery) > 0) {
							$rowImagesProdGallery 	= mysqli_fetch_array($resultImagesProdGallery);
							$pathImagesProdGallery  	= $rowImagesProdGallery['path'];
							?>
								<div class="col l3 m6 s12 mt-30 mb-30 center">
									<div style="height:300px"class="col s12">
										<a href="./index.php?menu=gallery&cat=product&detail=<?php echo $idProduct;?>">
											<img class="responsive-img" src="<?php echo $pathImagesProdGallery;?>">
										</a>
									</div>
									<div class="col s12">
										<h5 class="bold center"><?php echo $nameProdGallery;?></h5>
									</div>
								</div>
							<?php
						}
					}
	            }
	        }
	    }
	}elseif($cat == 'project'){
		$projectGallery = "SELECT 
                    idproject,
                    name
                    FROM project";
	    if($resultProjectGallery = mysqli_query($conn, $projectGallery) or die("Query failed :".mysqli_error($conn))){
	        if(mysqli_num_rows($resultProjectGallery) > 0){
	            while($rowProjectGallery = mysqli_fetch_array($resultProjectGallery)){
	                $idProject          = $rowProjectGallery['idproject'];
	                $nameProjectGallery	= $rowProjectGallery['name'];

	                $imagesProjectGallery = "SELECT path FROM images WHERE (owner = 'Project' AND idowner = '".$idProject."') ORDER BY RAND() LIMIT 1";
					if ($resultImagesProjectGallery = mysqli_query($conn, $imagesProjectGallery)) {
			        	if (mysqli_num_rows($resultImagesProjectGallery) > 0) {
							$rowImagesProjectGallery 	= mysqli_fetch_array($resultImagesProjectGallery);
							$pathImagesProjectGallery  	= $rowImagesProjectGallery['path'];
							?>
								<div class="col l3 m6 s12 mt-30 mb-30 center">
									<div style="height:300px" class="col s12">
										<a href="./index.php?menu=gallery&cat=project&detail=<?php echo $idProject;?>"><img class="responsive-img" src="<?php echo $pathImagesProjectGallery;?>"></a><br/>
									</div>
									<div class="col s12">
										<h5 class="bold center"><?php echo $nameProjectGallery;?></h5>
									</div>
								</div>
							<?php
						}
					}
	            }
	        }
	    }
	}else{
		header('Location: ./');
	}
?>