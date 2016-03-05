<?php
$postMessages = isset($postMessages)?$postMessages:'';
$colorMessages = isset($colorMessages)?$colorMessages:'';
if(isset($_POST['btnUpdateAboutContact'])){
	$postnameCompany 	= $_POST['nameCompany'];
	$postphoneCompany 	= $_POST['phoneCompany'];
	$postfaxCompany 	= $_POST['faxCompany'];
	$postaddressCompany = $_POST['addressCompany'];

	$uploadOk = 1;
	if(isset($_POST['changeImagePathAboutContact']) && $_POST['changeImagePathAboutContact'] != ''){
		$target_dir = "../images/";
		$target_file = $target_dir . basename($_FILES["changeImageFileAboutContact"]["name"]);
		$filePath = "images/" . basename($_FILES["changeImageFileAboutContact"]["name"]);
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// Check if image file is a actual image or fake image
	    $check = getimagesize($_FILES["changeImageFileAboutContact"]["tmp_name"]);
	    if($check !== false) {
	        $postMessages = "File is an image - " . $check["mime"] . ".";
	        $colorMessages = "green-text";
	        $uploadOk = 1;
	    } else {
	        $uploadImages = "File is not an image.";
	        $colorMessages = "red-text";
	        $uploadOk = 0;
	    }
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		    $postMessages = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	        $colorMessages = "green-text";
		    $uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
		    $postMessages = "Sorry, your file was not uploaded.";
	        $colorMessages = "red-text";
		// if everything is ok, try to upload file
		} else {
			$filename=basename($target_file,$imageFileType);
            $newFileName=$filename.time().".".$imageFileType;
            $filenameAdmin=basename($filePath,$imageFileType);
            $newFileNameAdmin=$filenameAdmin.time().".".$imageFileType;
		    if (move_uploaded_file($_FILES["changeImageFileAboutContact"]["tmp_name"], "../images/".$newFileName)) {

		    	$delPrevImagesAboutContact = "SELECT idimages, path FROM images WHERE owner = 'company' AND idowner = '1'";
		    	if($resultAboutContact = mysqli_query($conn, $delPrevImagesAboutContact)){
					if(mysqli_num_rows($resultAboutContact) > 0){
						$rowDeleteAboutContact = mysqli_fetch_array($resultAboutContact);
						$idImagesAboutContact = $rowDeleteAboutContact['idimages'];
						$pathImagesAboutContact = $rowDeleteAboutContact['path'];
						unlink("../".$pathImagesAboutContact);
					}
				}

				$updateChangeImagesFile = "UPDATE images SET path = 'images/".$newFileNameAdmin."' WHERE owner = 'company' AND idowner = '1'";
				if(mysqli_query($conn, $updateChangeImagesFile)){
					logging($now, $user, "Update Images Contact", $target_file, $idImagesAboutContact);
					$postMessages = "Images Updated";
			        $colorMessages = "green-text";
					// header('Location: ./index.php?menu=about&cat=contact');
			    }else{
			    	$postMessages = "ERROR: Could not able to execute ".$updateChangeImagesFile.". " . mysqli_error($conn);
		        	$colorMessages = "red-text";
			    }
		    } else {
		        $postMessages = "Sorry, there was an error changing your file.";
	        	$colorMessages = "red-text";
		    }
		}
	}else {
        $postMessages = "Sorry, there was an error changing your file.";
    	$colorMessages = "red-text";
    }
    // ======================================= LOGING
    $upcompanyQry = "SELECT
				company.idcompany,
				company.name,
				outlet.idoutlet,
				outlet.address
				FROM company, outlet";

	if($upresultCompanyQry = mysqli_query($conn, $upcompanyQry)){
		if(mysqli_num_rows($upresultCompanyQry) > 0){
			$uprowCompanyQry = mysqli_fetch_array($upresultCompanyQry);
			$upidcompany    	= $uprowCompanyQry['idcompany'];
			$upnameCompany  	= $uprowCompanyQry['name'];
			$upidoutlet       	= $uprowCompanyQry['idoutlet'];
			$upaddressoutlet  	= $uprowCompanyQry['address'];

			$upphoneCompanyQry = "SELECT * FROM phone WHERE idoutlet = '".$upidoutlet."' LIMIT 1";
			if($upresultPhoneCompanyQry = mysqli_query($conn, $upphoneCompanyQry)){
				if(mysqli_num_rows($upresultPhoneCompanyQry) > 0){
					$uprowPhoneCompanyQry = mysqli_fetch_array($upresultPhoneCompanyQry);
					$upidphone      = $uprowPhoneCompanyQry['idphone'];
					$upphoneCompany = $uprowPhoneCompanyQry['phone'];
					$upfaxCompany   = $uprowPhoneCompanyQry['fax'];
				}
			}
		}
	}
    // ======================================= LOGING
    $updateCompanyQry	= "UPDATE company SET name = '".$postnameCompany."'";
    $updateOutletQry 	= "UPDATE outlet SET address = '".$postaddressCompany."'";
    $updatePhoneQry 	= "UPDATE phone SET phone = '".$postphoneCompany."', fax = '".$postfaxCompany."'";

    if($postnameCompany != $upnameCompany || $postaddressCompany != $upaddressoutlet || $postphoneCompany != $upphoneCompany || $postfaxCompany != $upfaxCompany){
	    if (mysqli_query($conn, $updateCompanyQry) && mysqli_query($conn, $updateOutletQry) && mysqli_query($conn, $updatePhoneQry)){
	    	$loggingContentText = "Old Name : ".$upnameCompany."<br>Old Address : ".$upaddressoutlet."<br>Old Phone : ".$upphoneCompany."<br>Old Fax : ".$upfaxCompany."<br><br>New Name : ".$postnameCompany."<br>New Address : ".$postaddressCompany."<br>New Phone : ".$postphoneCompany."<br>New Fax : ".$postfaxCompany;
	    	logging($now, $user, "Update Company", $loggingContentText, '1');
		    $postMessages =  "Record update successfully";
			$colorMessages = "green-text";
		} else {
		    $postMessages = "Error updating record: " . mysqli_error($conn);
	    	$colorMessages = "red-text";
		}
    }
}

$companyQry = "SELECT
				company.idcompany,
				company.name,
				outlet.idoutlet,
				outlet.address
				FROM company, outlet";

if($resultCompanyQry = mysqli_query($conn, $companyQry)){
  if(mysqli_num_rows($resultCompanyQry) > 0){
    $rowCompanyQry = mysqli_fetch_array($resultCompanyQry);
    $idcompany    	= $rowCompanyQry['idcompany'];
    $nameCompany  	= $rowCompanyQry['name'];
    $idoutlet       = $rowCompanyQry['idoutlet'];
    $addressoutlet  = $rowCompanyQry['address'];

    $imagesCompanyQry = "SELECT * FROM images WHERE owner = 'company' AND idowner = '".$idcompany."' LIMIT 1";
    if($resultImagesCompanyQry = mysqli_query($conn, $imagesCompanyQry)){
      if(mysqli_num_rows($resultImagesCompanyQry) > 0){
        $rowImagesCompanyQry = mysqli_fetch_array($resultImagesCompanyQry);
        $idimagesCompany  = $rowImagesCompanyQry['idimages'];
        $titleCompany   = $rowImagesCompanyQry['title'];
        $pathCompany    = $rowImagesCompanyQry['path'];
      }
    }

    $phoneCompanyQry = "SELECT * FROM phone WHERE idoutlet = '".$idoutlet."' LIMIT 1";
    if($resultPhoneCompanyQry = mysqli_query($conn, $phoneCompanyQry)){
      if(mysqli_num_rows($resultPhoneCompanyQry) > 0){
        $rowPhoneCompanyQry = mysqli_fetch_array($resultPhoneCompanyQry);
        $idphone      = $rowPhoneCompanyQry['idphone'];
        $phoneCompany = $rowPhoneCompanyQry['phone'];
        $faxCompany   = $rowPhoneCompanyQry['fax'];
      }
    }
  }
}
?>
<div class="row">
	<div class="col s12 border-bottom grey lighten-2 mb-50">
		<h3 class="left-align">Company Contact</h3>
	</div>
	<div class="col s12">
		<form action="#" method="post" enctype="multipart/form-data">
			<div class="col s12 center">
				<div class="border-dotted pdl-20 pdr-20">
					<img id="image_upload_preview_about_contact" width="300px" class="responsive-img img-center mb-30" src="<?php echo "../".$pathCompany; ?>" alt="<?php echo $titleCompany; ?>" title="<?php echo $nameCompany; ?>">
				</div>
				<div class="file-field input-field container">
					<div class="btn green darken-4">
						<span>Change</span>
						<input id="changeImageFileAboutContact" name="changeImageFileAboutContact" type="file">
					</div>
					<div class="file-path-wrapper">
						<input id="changeImagePathAboutContact" name="changeImagePathAboutContact" class="file-path validate" type="text">
					</div>
				</div>
			</div>
			<div class="input-field col s12 l4 m12">
				<input value="<?php echo $nameCompany; ?>" id="nameCompany" name="nameCompany" type="text" class="validate" required >
				<label for="nameCompany">Company Name</label>
			</div>
			<div class="input-field col s12 l4 m12">
				<input value="<?php echo $phoneCompany; ?>" id="phoneCompany" name="phoneCompany" type="text" class="validate" required>
				<label for="phoneCompany">Phone</label>
			</div>
			<div class="input-field col s12 l4 m12">
				<input value="<?php echo $faxCompany; ?>" id="faxCompany" name="faxCompany" type="text" class="validate" required>
				<label for="faxCompany">Fax</label>
			</div>
			<div class="input-field col s12">
				<textarea id="addressCompany" name="addressCompany" class="materialize-textarea" required><?php echo $addressoutlet; ?></textarea>
				<label for="addressCompany">Address</label>
			</div>
			<div class="col s12">
				<button type="submit" id="btnUpdateAboutContact" name="btnUpdateAboutContact" class="waves-effect waves-light btn blue darken-4 disabled" disabled><i class="material-icons left">subdirectory_arrow_left</i>Update</button>
			</div>
			<div class="col s12">
				<span class="<?php echo $colorMessages;?>"><?php echo $postMessages;?></span>
			</div>
		</form>
	</div>
</div>