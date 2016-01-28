<div class="row">
	<div class="col s12 border-bottom grey lighten-2 mb-50">
		<h3 class="left-align">Social</h3>
	</div>
	<div class="col s12">
		<form action="#" method="post" enctype="multipart/form-data">
			<div class="col s12">
				<a class="waves-effect waves-light btn red accent-4 disabled"><i class="material-icons left">delete</i>Delete</a>
				<a class="waves-effect waves-light btn blue darken-4 disabled"><i class="material-icons left">subdirectory_arrow_left</i>Update</a>
				<a class="btn-floating btn-large waves-effect waves-light green darken-4 right"><i class="material-icons">add</i></a>
			</div>
			<table class="highlight border-bottom">
				<thead>
					<tr>
						<td width="50px">
							<p>
								<input type="checkbox" id="checkAll" />
								<label for="checkAll"></label>
							</p>
						</td>
						<td width="100px">
							Images
						</td>
						<td width="300px">
							Name
						</td>
						<td width="500px">
							Link
						</td>
					</tr>
				</thead>
				<tbody>
					<?php
					if($resultSocialQry = mysqli_query($conn, "SELECT * FROM social")){
				        if (mysqli_num_rows($resultSocialQry) > 0) {
					        while ($rowSocial = mysqli_fetch_array($resultSocialQry)) {
					            $idsocial = $rowSocial['idsocial'];
					            $nameSocial = $rowSocial['name'];
					            $linkSocial = $rowSocial['link'];

					            $imagesSocialQry = "SELECT * FROM images WHERE (owner = 'social' AND idowner = '".$idsocial."') LIMIT 1";
					            
					            if ($resultImagesSocialQry = mysqli_query($conn, $imagesSocialQry)) {
					            	if (mysqli_num_rows($resultImagesSocialQry) > 0) {
										$rowImagesSocial = mysqli_fetch_array($resultImagesSocialQry);
						            	$idimages 			= $rowImagesSocial['idimages'];
										$titleImagesSocial  = $rowImagesSocial['title'];
										$pathImagesSocial  	= $rowImagesSocial['path'];
										?>
											<tr>
												<td>
													<p>
														<input type="checkbox" id="<?php echo $idimages; ?>" />
														<label for="<?php echo $idimages; ?>"></label>
													</p>
												</td>
												<td>
													<a href="<?php echo "#uploadModal".$idimages; ?>" class="modal-trigger"><img width="100px" src="<?php echo "../".$pathImagesSocial; ?>" class="responsive-img" title="klick to change image"></a>
												</td>
												<td>
													<div class="input-field col s12">
														<input class="validate" value="<?php echo $nameSocial; ?>">
													</div>
												</td>
												<td>
													<div class="input-field col s12">
														<input class="validate" value="<?php echo $linkSocial; ?>">
													</div>
												</td>
											</tr>
											 <div id="<?php echo "uploadModal".$idimages; ?>" class="modal">
												<div class="modal-content">
													<div class="border-bottom mb-10"><h4>Change Image</h4></div>
													<div class="col s12 mb-30 mt-30 center container">
														<img src="<?php echo "../".$pathImagesSocial; ?>" width="50%" class="responsive-img" title="klick to change image">
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
			<div class="col s12 mt-50">
				<?php
                  $contactWordQty = "SELECT contentWord FROM social LIMIT 1";
                  if($resultWord = mysqli_query($conn, $contactWordQty)){
                    $rowWord = mysqli_fetch_array($resultWord);
                    $contentWordAbout = $rowWord['contentWord'];
                  }
                ?>
				<textarea id="wysiwygEditor" class="materialize-textarea"><?php echo $contentWordAbout; ?></textarea>
			</div>
			<div class="col s12 mt-30">
				<a class="right waves-effect waves-light btn blue darken-4 disabled"><i class="material-icons left">subdirectory_arrow_left</i>Update</a>
			</div>
		</form>
	</div>
</div>