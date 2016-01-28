<div class="col s12 border-bottom grey lighten-2 mb-50">
	<h3 class="left-align">Clients</h3>
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
					<td width="800px">
						Name
					</td>
				</tr>
			</thead>
			<tbody>
				<?php
			    	$clientQry = "SELECT * FROM client";
					if($resultClientQry = mysqli_query($conn, $clientQry)){
						if(mysqli_num_rows($resultClientQry) > 0){
							while ($rowClientQry = mysqli_fetch_array($resultClientQry)) {
								$idclient 	= $rowClientQry['idclient'];
								$nameClient	= $rowClientQry['name'];

								$imagesClientQry = "SELECT * FROM images WHERE owner = 'client' AND idowner = '".$idclient."' LIMIT 1";
								if($resultImagesClientQry = mysqli_query($conn, $imagesClientQry)){
									if(mysqli_num_rows($resultImagesClientQry) > 0){
										$rowImagesClientQry = mysqli_fetch_array($resultImagesClientQry);
										$idimagesClient	= $rowImagesClientQry['idimages'];
										$pathClient 	= $rowImagesClientQry['path'];
										?>
										<tr>
											<td>
												<p>
													<input type="checkbox" id="<?php echo $idimagesClient; ?>" />
													<label for="<?php echo $idimagesClient; ?>"></label>
												</p>
											</td>
											<td>
												<a href="<?php echo "#uploadModal".$idimagesClient; ?>" class="modal-trigger"><img src="<?php echo "../".$pathClient; ?>" class="responsive-img" title="klick to change image"></a>
											</td>
											<td>
												<div class="input-field">
													<input class="validate" value="<?php echo $nameClient; ?>">
												</div>
											</td>
										</tr>
										 <div id="<?php echo "uploadModal".$idimagesClient; ?>" class="modal">
											<div class="modal-content">
												<div class="border-bottom mb-10"><h4>Change Image</h4></div>
												<div class="col s12 mb-30 mt-30 center container">
													<img src="<?php echo "../".$pathClient; ?>" class="responsive-img" title="klick to change image">
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