<?php
	$idProject = $_GET['det'];
	$nameDetProjectQry = "SELECT * FROM project WHERE idproject = '$idProject' LIMIT 1";
	if($resultNameDetProject = mysqli_query($conn, $nameDetProjectQry)){
		if(mysqli_num_rows($resultNameDetProject) > 0){
			$rowResultNameDetProject = mysqli_fetch_array($resultNameDetProject);
			$idDetProject 			= $rowResultNameDetProject['idproject'];
			$nameDetProject 		= $rowResultNameDetProject['name'];
			$locationDetProject 	= $rowResultNameDetProject['location'];
			$dateDetProject 		= $rowResultNameDetProject['date'];
			$idCategoryDetProject 	= $rowResultNameDetProject['idcategory'];
			$contentWordDetProject 	= $rowResultNameDetProject['contentWord'];

			$catQry = "SELECT * FROM category WHERE idcategory = '".$idCategoryDetProject."' LIMIT 1";
			if($resultDetCategory = mysqli_query($conn, $catQry)){
				if(mysqli_num_rows($resultDetCategory) > 0){
					$rowResultDetCategory = mysqli_fetch_array($resultDetCategory);
					$mainDetCategory 	= $rowResultDetCategory['main'];
					$subDetCategory 	= $rowResultDetCategory['sub'];
				}
			}
		}
	}
?>
<div class="col s12">
	<div class="col s12 center">
		<h4><?php echo $nameDetProject;?></h4>
	</div>
	<div class="col s12 border-bottom pdb-10">
		<h5 class="col s12 m6 l6">Manage Image</h5>
		<a class="btn-floating btn-large waves-effect waves-light green darken-4 right mb-30" title="Add more images"><i class="material-icons">add</i></a>
	</div>
	<div class="col s12 mt-30">
		<?php
		$imagesDetProjectQry = "SELECT idimages, path FROM images WHERE (owner = 'project' AND idowner = '".$idProject."')";
		if ($resultImagesDetProjectQry = mysqli_query($conn, $imagesDetProjectQry)) {
        	if (mysqli_num_rows($resultImagesDetProjectQry) > 0) {
				while($rowImagesDetProject 	= mysqli_fetch_array($resultImagesDetProjectQry)){
					$idImagesDetProject  = $rowImagesDetProject['idimages'];
					$pathImagesDetProject  = $rowImagesDetProject['path'];
					?>
						<div class="col l2 m4 s12">
							<a href="<?php echo "#modalProject".$idImagesDetProject; ?>" class="modal-trigger">
								<img src="<?php echo "../".$pathImagesDetProject; ?>" class="responsive-img ml-10 mr-10" title="klick to delete image">
							</a>
						</div>
						<div id="<?php echo "modalProject".$idImagesDetProject; ?>" class="modal">
							<div class="modal-content center">
								<div class="border-bottom mb-10"><h4>Image Delete</h4></div>
								<p>Are you sure want to delete this image ?</p>
								<img src="<?php echo "../".$pathImagesDetProject; ?>" class="responsive-img ml-10 mr-10">
							</div>
							<div class="modal-footer">
								<button name="$idImagesDetProject" id="$idImagesDetProject" class="red accent-4 white-text modal-action modal-close waves-effect waves-green btn-flat">Yes..!!</button>
								<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">NO..</a>
							</div>
						</div>
					<?php
				}
			}
		}
		?>
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
	<div class="col s12 border-bottom pdb-10">
		<h5 class="col s12 m6 l6">Manage Content</h5>
	</div>
	<div class="input-field col s12 m7 l7 mt-30">
		<input id="titleProject" name="titleProject" type="text" class="validate" value="<?php echo $nameDetProject; ?>">
		<label for="titleProject">Project Name</label>
	</div>
	<div class="input-field col s12 m6 l6">
		<input id="locationProject" name="locationProject" type="text" class="validate" value="<?php echo $locationDetProject; ?>">
		<label for="locationProject">Location</label>
	</div>
	<div class="input-field col s12 m6 l6">
		<input id="dateProject" name="dateProject" type="date" class="datepicker" value="<?php echo $dateDetProject; ?>">
		<label for="dateProject">Date Project</label>
	</div>
	<div class="input-field col s12 m6 l6">
		<select>
			<option value="" disabled>Select Main Category</option>
			<?php
				$mainCatQry = "SELECT idcategory, main FROM category WHERE owner = 'project' GROUP BY main";
				if ($resultMainCat = mysqli_query($conn, $mainCatQry)) {
		        	if (mysqli_num_rows($resultMainCat) > 0) {
						while($rowMainCat 	= mysqli_fetch_array($resultMainCat)){
							$idMainCat 	= $rowMainCat['idcategory'];
							$mainCat 	= $rowMainCat['main'];
							$selected 	= ($mainCat == $mainDetCategory) ? 'selected' : '';
							?>
								<option value="<?php echo $idMainCat;?>" <?php echo $selected;?>><?php echo $mainCat;?></option>
							<?php
						}
					}
				}
			?>
		</select>
		<label>Main Category</label>
	</div>
	<div class="input-field col s12 m6 l6">
		<select>
			<option value="" disabled>Select Sub Category</option>
			<?php
				$subCatQry = "SELECT idcategory, sub FROM category WHERE owner = 'project' AND main = '".$mainDetCategory."' AND sub IS NOT NULL AND sub != ''";
				if ($resultSubCat = mysqli_query($conn, $subCatQry)) {
		        	if (mysqli_num_rows($resultSubCat) > 0) {
						while($rowSubCat 	= mysqli_fetch_array($resultSubCat)){
							$idSubCat 	= $rowSubCat['idcategory'];
							$subCat 	= $rowSubCat['sub'];
							$selected 	= ($subCat == $subDetCategory) ? 'selected' : '';
							?>
								<option value="<?php echo $idSubCat;?>" <?php echo $selected;?>><?php echo $subCat;?></option>
							<?php
						}
					}
				}
			?>
		</select>
		<label>Sub Category</label>
	</div>
	<div class="input-field col s12">
		<textarea id="wysiwygEditor" class="materialize-textarea"><?php echo $contentWordDetProject; ?></textarea>
	</div>
	<div class="col s12">
		<a class="mt-30 right waves-effect waves-light btn blue darken-4 disabled"><i class="material-icons left">subdirectory_arrow_left</i>Update</a>
	</div>
</div>