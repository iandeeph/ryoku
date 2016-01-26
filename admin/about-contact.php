<?php
$companyQry = "SELECT * FROM company LIMIT 1";
if($resultCompanyQry = mysqli_query($conn, $companyQry)){
  if(mysqli_num_rows($resultCompanyQry) > 0){
    $rowCompanyQry = mysqli_fetch_array($resultCompanyQry);
    $idcompany    = $rowCompanyQry['idcompany'];
    $nameCompany  = $rowCompanyQry['name'];

    $imagesCompanyQry = "SELECT * FROM images WHERE owner = 'company' AND idowner = '".$idcompany."' LIMIT 1";
    if($resultImagesCompanyQry = mysqli_query($conn, $imagesCompanyQry)){
      if(mysqli_num_rows($resultImagesCompanyQry) > 0){
        $rowImagesCompanyQry = mysqli_fetch_array($resultImagesCompanyQry);
        $idimagesCompany  = $rowImagesCompanyQry['idimages'];
        $titleCompany   = $rowImagesCompanyQry['title'];
        $pathCompany    = $rowImagesCompanyQry['path'];
      }
    }

    $outletCompanyQry = "SELECT * FROM outlet LIMIT 1";
    if($resultOutletCompanyQry = mysqli_query($conn, $outletCompanyQry)){
      if(mysqli_num_rows($resultOutletCompanyQry) > 0){
        $rowOutletCompanyQry = mysqli_fetch_array($resultOutletCompanyQry);
        $idoutlet       = $rowOutletCompanyQry['idoutlet'];
        $addressoutlet  = $rowOutletCompanyQry['address'];
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
<div class="row about-contact">
	<div class="col s12 border-bottom grey lighten-2 mb-50">
		<h3 class="left-align">Company Contact</h3>
	</div>
	<div class="col s12">
		<form action="#" method="post" enctype="multipart/form-data">
			<div class="col s12">
				<img width="300px" class="responsive-img img-center mb-30" src="<?php echo "../".$pathCompany; ?>" alt="<?php echo $titleCompany; ?>" title="<?php echo $nameCompany; ?>">
				<div class="file-field input-field container">
					<div class="btn green darken-4">
						<span>Change</span>
						<input type="file">
					</div>
					<div class="file-path-wrapper">
						<input class="file-path validate" type="text">
					</div>
				</div>
			</div>
			<div class="input-field col s12 l4 m12">
				<input value="<?php echo $nameCompany; ?>" id="nameCompany" type="text" class="validate">
				<label for="nameCompany">Company Name</label>
			</div>
			<div class="input-field col s12 l4 m12">
				<input value="<?php echo $phoneCompany; ?>" id="phoneCompany" type="text" class="validate">
				<label for="phoneCompany">Phone</label>
			</div>
			<div class="input-field col s12 l4 m12">
				<input value="<?php echo $faxCompany; ?>" id="faxCompany" type="text" class="validate">
				<label for="faxCompany">Fax</label>
			</div>
			<div class="input-field col s12">
				<textarea id="addressCompany" class="materialize-textarea"><?php echo $addressoutlet; ?></textarea>
				<label for="addressCompany">Address</label>
			</div>
			<div class="col s12">
				<a class="waves-effect waves-light btn blue darken-4 disabled"><i class="material-icons left">subdirectory_arrow_left</i>Update</a>
			</div>
		</form>
	</div>
</div>