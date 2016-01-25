<div class="row">
	<div class="col s12 border-bottom grey lighten-2 mb-50">
		<h3 class="left-align">Top Banner</h3>
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
							Title
						</td>
						<td width="500px">
							Content
						</td>
					</tr>
				</thead>
				<tbody>
					<?php
					if($resultBannerQry = mysqli_query($conn, "SELECT * FROM banner")){
				        if (mysqli_num_rows($resultBannerQry) > 0) {
				          while ($rowBanner = mysqli_fetch_array($resultBannerQry)) {
				            $idbanner = $rowBanner['idbanner'];
				            $contentWord = $rowBanner['contentWord'];

				            $imagesBannerQry = "SELECT * FROM images WHERE (owner = 'banner' AND idowner = '".$idbanner."') LIMIT 1";
				            
				            if ($resultImagesBannerQry = mysqli_query($conn, $imagesBannerQry)) {
								$rowImagesBanner = mysqli_fetch_array($resultImagesBannerQry);
				            	$idimages 			= $rowImagesBanner['idimages'];
								$titleImagesBanner  = $rowImagesBanner['title'];
								$pathImagesBanner   = $rowImagesBanner['path'];
				            }
					?>
					<tr>
						<td>
							<p>
								<input type="checkbox" id="<?php echo $idimages; ?>" />
								<label for="<?php echo $idimages; ?>"></label>
							</p>
						</td>
						<td>
							<a href="<?php echo "#uploadModal".$idimages; ?>" class="modal-trigger"><img src="<?php echo "../".$pathImagesBanner; ?>" class="responsive-img" title="klick to change image"></a>
						</td>
						<td>
							<div class="input-field col s12">
								<textarea class="materialize-textarea"><?php echo $titleImagesBanner; ?></textarea>
							</div>
						</td>
						<td>
							<div class="input-field col s12">
								<textarea class="materialize-textarea"><?php echo $contentWord; ?></textarea>
							</div>
						</td>
					</tr>
					 <div id="<?php echo "uploadModal".$idimages; ?>" class="modal">
						<div class="modal-content">
							<div class="border-bottom mb-10"><h4>Change Image</h4></div>
							<div class="col s12 mb-30 mt-30 center container">
								<img src="<?php echo "../".$pathImagesBanner; ?>" class="responsive-img" title="klick to change image">
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
					?>
				</tbody>
			</table>
		</form>
	</div>
</div>