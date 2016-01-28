<div class="col s12 border-bottom grey lighten-2 mb-50">
	<h3 class="left-align">Service</h3>
</div>
<div class="col s12">
	<form action="#" method="post" enctype="multipart/form-data">
		<div class="col s12">
			<a class="waves-effect waves-light btn red accent-4 disabled"><i class="material-icons left">delete</i>Delete</a>
			<a class="waves-effect waves-light btn blue darken-4 disabled"><i class="material-icons left">subdirectory_arrow_left</i>Update</a>
			<a class="btn-floating btn-large waves-effect waves-light green darken-4 right"><i class="material-icons">add</i></a>
		</div>
		<table class="highlight">
			<thead>
				<tr>
					<td width="50px">
						<p>
							<input type="checkbox" id="checkAll" />
							<label for="checkAll"></label>
						</p>
					</td>
					<td width="250px">
						Images
					</td>
					<td width="300px">
						Name
					</td>
					<td width="800px">
						Content Word
					</td>
				</tr>
			</thead>
			<tbody>
				<?php
					if($resultServiceQry = mysqli_query($conn, "SELECT * FROM service")){
						if (mysqli_num_rows($resultServiceQry) > 0) {
							while ($rowService = mysqli_fetch_array($resultServiceQry)) {
								$idservice          = $rowService['idservice'];
								$nameService        = $rowService['name'];
								$contentWordService = $rowService['contentWord'];

								$imagesServiceQry = "SELECT * FROM images WHERE (owner = 'Service' AND idowner = '".$idservice."') LIMIT 1";

								if ($resultImagesServiceQry = mysqli_query($conn, $imagesServiceQry)) {
									if (mysqli_num_rows($resultImagesServiceQry) > 0) {
										$rowImagesService = mysqli_fetch_array($resultImagesServiceQry);
										$idimages           = $rowImagesService['idimages'];
										$pathImagesService  = $rowImagesService['path'];
										?>
											<tr>
												<td>
													<p>
														<input type="checkbox" id="<?php echo $idimages; ?>" />
														<label for="<?php echo $idimages; ?>"></label>
													</p>
												</td>
												<td>
													<a href="<?php echo "#uploadModal".$idimages; ?>" class="modal-trigger"><img src="<?php echo "../".$pathImagesService; ?>" class="responsive-img" title="klick to change image"></a>
												</td>
												<td>
													<div class="input-field">
														<input class="validate" value="<?php echo $nameService; ?>">
													</div>
												</td>
												<td>
													<div class="input-field">
														<textarea class="materialize-textarea"><?php echo $contentWordService; ?></textarea>
													</div>
												</td>
											</tr>
											<div id="<?php echo "uploadModal".$idimages; ?>" class="modal">
												<div class="modal-content">
													<div class="border-bottom mb-10"><h4>Change Image</h4></div>
													<div class="col s12 mb-30 mt-30 center container">
														<img src="<?php echo "../".$pathImagesService; ?>" class="responsive-img" title="klick to change image">
														<div class="file-field input-field">
															<div class="btn green darken-4">
																<span>Change</span>
																<input type="file">
															</div>
															<div class="file-path-wrapper">
																<input class="file-path validate" type="text">
															</div>
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
				?>
			</tbody>
		</table>
	</form>
</div>