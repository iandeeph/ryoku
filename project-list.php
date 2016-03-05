<div class="row">
	<div class="col s12 center">
	<?php
		if($cat == 'engineering'){
			?>
				<h3 class="black-text">ENGINEERING PROJECT</h3>
			<?php
		}elseif($cat == 'civil'){
			?>
				<h3 class="black-text">CIVIL CONSTRUCTION PROJECT</h3>
			<?php
		}
	?>
	</div>
	<div class="col hide-on-med-and-down l2 pinned">
		<ul class="section table-of-contents">
			<?php
				$titleProjectQry = "";
				$titleProjectQry = "SELECT idproject, name FROM project WHERE category = '".$cat."' ORDER BY date DESC";
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
	<div class="col s12 m12 l11 offset-l1">
		<div class="container">
			<?php
				$projectQry = "";
				$projectQry = "SELECT * FROM project WHERE category = '".$cat."' ORDER BY date DESC";
				if($resultProject = mysqli_query($conn, $projectQry)){
					if(mysqli_num_rows($resultProject) > 0){
						while($rowResultProject = mysqli_fetch_array($resultProject)){
							$idproject 			= $rowResultProject['idproject'];
							$nameProject 		= $rowResultProject['name'];
							$locationProject 	= $rowResultProject['location'];
							$dateProject 		= date('j F, Y', strtotime($rowResultProject['date']));
							$contentProject 	= $rowResultProject['contentWord'];

							$idGalleryQry = "";
							$idGalleryQry = "SELECT idgallery FROM gallery WHERE name = '".$nameProject."'";

							if($resultIdGallery = mysqli_query($conn, $idGalleryQry) or die("Query failed :".mysqli_error($conn))){
					            if(mysqli_num_rows($resultIdGallery) > 0){
					                $rowresultIdGallery = mysqli_fetch_array($resultIdGallery);
					                $galleryId = $rowresultIdGallery['idgallery'];
					            }
					        }
							?>
								<div id="<?php echo $idproject; ?>" class="section scrollspy mb-30">
									<div class="row border-bottom">
										<h5 class="blue-text darken-2-text"><?php echo $nameProject; ?></h5>
										<div class="col s6 m6 l4">
											<span>Date : <?php echo $dateProject; ?></span><br>
											<span>Location : <?php echo $locationProject; ?></span>
										</div>
									</div>
									<div class="row">
										<div class="container center">
											<div class="col s12 m10 l10 offset-m1 offset-l1">
												<div class="slider mt-30">
													<ul class="slides">
														<?php
															$imagesProjectQry = "SELECT path FROM images WHERE (owner = 'project' AND idowner = '".$idproject."') LIMIT 5";
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
										</div>
									</div>
									<div class="row">
										<p style="text-align:justify">
											<?php echo $contentProject; ?>
										</p>
									</div>
									<div class="row center">
										<a href="./index.php?menu=gallery&album=<?php echo $galleryId;?>" class="waves-effect waves-light btn blue darken-3">More Image on Gallery</a>
									</div>
								</div>
							<?php
						}
					}
				}
			?>
		</div>
	</div>
</div>