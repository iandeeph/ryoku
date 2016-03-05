<?php
	$idGallery = $_GET['album'];
	$detGallery = "";
	$detGallery = "SELECT * FROM gallery WHERE idgallery = '".$idGallery."'";
    if($resultDetGallery = mysqli_query($conn, $detGallery) or die("Query failed :".mysqli_error($conn))){
        if(mysqli_num_rows($resultDetGallery) > 0){
            $rowDetGallery = mysqli_fetch_array($resultDetGallery);
            $nameGalleryDetail = $rowDetGallery['name'];

            $idProjectQry = "";
            $idProjectQry = "SELECT idproject FROM project WHERE name = '".$nameGalleryDetail."'";

            if($resultidProject = mysqli_query($conn, $idProjectQry) or die("Query failed :".mysqli_error($conn))){
                if(mysqli_num_rows($resultidProject) > 0){
                    $rowresultidProject = mysqli_fetch_array($resultidProject);
                    $projectId = $rowresultidProject['idproject'];

                    $projectQry = " OR (owner = 'project' AND idowner = '".$projectId."')";
                }else{
                    $projectQry = "";
                }
            }
		    ?>
				<div class="col s12 mt-30 border-bottom pdb-30">
					<div class="left col m6 l6 s12"><h4 class="blue-text"><?php echo $nameGalleryDetail;?></h4></div>
					<div class="col m6 l6 s12 right-align hide-on-small-only">
						<a class="btn-large waves-effect waves-light blue darken-2" href="./index.php?menu=gallery"><i class="material-icons left">keyboard_return</i>Back to Albums</a>
					</div>
				</div>
				<div class="col s12 pdb-30">
					<div class="col m6 l6 s12 center hide-on-med-and-up right-align">
						<a class="btn waves-effect waves-light blue darken-2 mt-30" href="./index.php?menu=gallery"><i class="material-icons left">keyboard_return</i>Back to Albums</a>
					</div>
					<?php
						$imagesDetGallery = "";
				        $imagesDetGallery = "SELECT * FROM images WHERE (owner = 'gallery' AND idowner = '".$idGallery."')".$projectQry." ORDER BY idimages DESC";
					    if($resultDetImages = mysqli_query($conn, $imagesDetGallery) or die("Query failed :".mysqli_error($conn))){
					        if(mysqli_num_rows($resultDetImages) > 0){
					            while($rowDetImages = mysqli_fetch_array($resultDetImages)){
					            	$pathImagesDetail 	= $rowDetImages['path'];
									?>

									<div class="col s12 m6 l3 hoverable center valign-wrapper responsive-img" style="height:350px">
										<div class="col s12">
											<img class="responsive-img materialboxed" data-caption="<?php echo $nameGalleryDetail;?>" src="<?php echo $pathImagesDetail;?>">
										</div>
									</div>
									<?php
					            }
							}
						}
					?>
				</div>
			<?php
        }
    }
?>
</div>