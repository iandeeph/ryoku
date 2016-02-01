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

	                $imagesProdGallery = "SELECT path FROM images WHERE (owner = 'Product' AND idowner = '".$idProduct."') LIMIT 1";
					if ($resultImagesProdGallery = mysqli_query($conn, $imagesProdGallery)) {
			        	if (mysqli_num_rows($resultImagesProdGallery) > 0) {
							$rowImagesProdGallery 	= mysqli_fetch_array($resultImagesProdGallery);
							$pathImagesProdGallery  	= $rowImagesProdGallery['path'];
							?>
								<div class="col l3 m6 s12 mt-30 mb-30 center">
									<a href="./index.php?menu=gallery&cat=product&detail=<?php echo $idProduct;?>"><img class="responsive-img" src="<?php echo $pathImagesProdGallery;?>"></a><br/>
									<h5 class="bold center"><?php echo $nameProdGallery;?></h5>
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

	                $imagesProjectGallery = "SELECT path FROM images WHERE (owner = 'Project' AND idowner = '".$idProject."') LIMIT 1";
					if ($resultImagesProjectGallery = mysqli_query($conn, $imagesProjectGallery)) {
			        	if (mysqli_num_rows($resultImagesProjectGallery) > 0) {
							$rowImagesProjectGallery 	= mysqli_fetch_array($resultImagesProjectGallery);
							$pathImagesProjectGallery  	= $rowImagesProjectGallery['path'];
							?>
								<div class="col l3 m6 s12 mt-30 mb-30 center">
									<a href="./index.php?menu=gallery&cat=project&detail=<?php echo $idProject;?>"><img class="responsive-img" src="<?php echo $pathImagesProjectGallery;?>"></a><br/>
									<h5 class="bold center"><?php echo $nameProjectGallery;?></h5>
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