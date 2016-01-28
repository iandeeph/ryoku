<div class="row">
	<div class="col s12 center">
      	<h3 class="black-text">OUR PROJECT</h3>
    </div>
	<div class="col hide-on-med-and-down l2 pinned">
		<ul class="section table-of-contents">
			<?php
				$titleProjectQry = "SELECT idproject, name FROM project";
				if($resultTitleProject = mysqli_query($conn, $titleProjectQry)){
					if(mysqli_num_rows($resultTitleProject) > 0){
						while($rowResultTitleProject = mysqli_fetch_array($resultTitleProject)){
							$idproject 		= $rowResultTitleProject['idproject'];
							$nameProject 	= $rowResultTitleProject['name'];

							?>
							<li><a href="<?php echo "#".$idproject; ?>"><?php echo $nameProject; ?></a></li>
							<?php
						}
					}
				}
			?>
		</ul>
	</div>
	<div class="container">
		<div class="col s12 m12 l12">
			<?php
				$projectQry = "SELECT * FROM project";
				if($resultProject = mysqli_query($conn, $projectQry)){
					if(mysqli_num_rows($resultProject) > 0){
						while($rowResultProject = mysqli_fetch_array($resultProject)){
							$idproject 			= $rowResultProject['idproject'];
							$nameProject 		= $rowResultProject['name'];
							$locationProject 	= $rowResultProject['location'];
							$dateProject 		= $rowResultProject['date'];
							$idCategoryProject 	= $rowResultProject['idcategory'];
							$contentProject 	= $rowResultProject['contentWord'];

							$categoryQry = "SELECT * FROM category WHERE idcategory = '".$idCategoryProject."' LIMIT 1";
							if($resultCategory = mysqli_query($conn, $categoryQry)){
								if(mysqli_num_rows($resultCategory) > 0){
									$rowResultCategory = mysqli_fetch_array($resultCategory);
									$mainCategory 	= $rowResultCategory['main'];
									$subCategory 	= $rowResultCategory['sub'];
									?>
									<div id="<?php echo $idproject; ?>" class="section scrollspy mb-30">
										<div class="col s12 border-bottom">
											<h5 class="blue-text darken-2-text"><?php echo $nameProject; ?></h5>
											<div class="col s6 m6 l4">
												<span>Date : <?php echo $dateProject; ?></span><br>
												<span>Location : <?php echo $locationProject; ?></span>
											</div>
											<div class="col s6 m6 l4">
												<span>Category : <a href="#"><?php echo $mainCategory; ?></a></span><br>
												<span>Sub Category : <a href="#"><?php echo $subCategory; ?></a></span>
											</div>
										</div>
										<div class="col s12">
											<div class="slider mt-30">
												<ul class="slides">
													<?php
													$imagesProjectQry = "SELECT path FROM images WHERE (owner = 'project' AND idowner = '".$idproject."')";
													if ($resultImagesProjectQry = mysqli_query($conn, $imagesProjectQry)) {
										            	if (mysqli_num_rows($resultImagesProjectQry) > 0) {
															while($rowImagesProject 	= mysqli_fetch_array($resultImagesProjectQry)){
																$pathImagesProject  = $rowImagesProject['path'];
																?>
																	<li>
																		<img src="<?php echo $pathImagesProject; ?>">
																	</li>
																<?php
															}
														}
													}
													?>
												</ul>
											</div>
										</div>
										<div class="col s12">
											<p style="text-align:justify">
												<?php echo $contentProject; ?>
											</p>
										</div>
										<a class="waves-effect waves-light btn blue darken-3">More Image on Gallery</a>
									</div>
									<?php
								}
							}
						}
					}
				}
			?>
		</div>
	</div>
</div>
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