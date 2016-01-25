<div class="row">
	<div class="col s12 border-bottom grey lighten-2 mb-50">
		<h3 class="left-align">Top Banner</h3>
	</div>
	<div class="col s12">
		<form action="#" method="post" enctype="multipart/form-data">
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
						<td>
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
							<img src="<?php echo "../".$pathImagesBanner; ?>" class="responsive-img">
						</td>
						<td>
							<div class="input-field col s12">
								<textarea id="textarea1" class="materialize-textarea"><?php echo $titleImagesBanner; ?></textarea>
							</div>
						</td>
						<td>
							<div class="input-field col s12">
								<textarea id="textarea1" class="materialize-textarea"><?php echo $contentWord; ?></textarea>
							</div>
						</td>
					</tr>
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