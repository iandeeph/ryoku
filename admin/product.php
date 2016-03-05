<div class="row">
    <?php
        $postMessages = isset($postMessages)?$postMessages:'';
        $colorMessages = isset($colorMessages)?$colorMessages:'';
    // ============================== BUTTON UPDATE CLICK ==========================================================

    if(isset($_POST['updateSelectionProductBrandButton'])){
        foreach ($_POST['checkboxProductBrand'] as $selectedIdProductBrand) {
            $postUpdateTitleProductBrand    = $_POST['titleProductBrand'.$selectedIdProductBrand];
            $postUpdateOriginProductBrand   = $_POST['originProductBrand'.$selectedIdProductBrand];
            $postUpdateCategoryProductBrand = $_POST['categoryProductBrand'.$selectedIdProductBrand];
            $postUpdateDescProductBrand     = $_POST['descriptionProductBrand'.$selectedIdProductBrand];

            $updateProductBrandQry = "UPDATE brand SET name = '".$postUpdateTitleProductBrand."', origin = '".$postUpdateOriginProductBrand."', category = '".$postUpdateCategoryProductBrand."', description = '".$postUpdateDescProductBrand."' WHERE idbrand = '".$selectedIdProductBrand."'";
        // ================================== LOGGING
            $nameUpdateProductBrandQry = "";
            $nameUpdateProductBrandQry = "SELECT * FROM brand WHERE idbrand = '".$selectedIdProductBrand."' LIMIT 1";
            if($resultUpdateProductBrandQry = mysqli_query($conn, $nameUpdateProductBrandQry)){
                if (mysqli_num_rows($resultUpdateProductBrandQry) > 0) {
                    $rowUpdateProductBrand = mysqli_fetch_array($resultUpdateProductBrandQry);
                    $nameUpdateProductBrand = $rowUpdateProductBrand['name'];
                    $originUpdateProductBrand = $rowUpdateProductBrand['origin'];
                    $categoryUpdateProductBrand = $rowUpdateProductBrand['category'];
                    $descUpdateProductBrand = $rowUpdateProductBrand['description'];
                    $logingContentText = "Old Name : ".$nameUpdateProductBrand."<br>Old Origin : ".$originUpdateProductBrand."<br>Old Category : ".$categoryUpdateProductBrand."<br>Old Description : ".$descUpdateProductBrand."<br><br>New Name : ".$postUpdateTitleProductBrand."<br>New Origin : ".$postUpdateOriginProductBrand."<br>New Category : ".$postUpdateCategoryProductBrand."<br>New Description : ".$postUpdateDescProductBrand;
                }
            }
        // ================================== LOGGING
            if($postUpdateTitleProductBrand != $nameUpdateProductBrand || $postUpdateOriginProductBrand != $originUpdateProductBrand || $postUpdateCategoryProductBrand != $categoryUpdateProductBrand || $postUpdateDescProductBrand != $descUpdateProductBrand){
                if (mysqli_query($conn, $updateProductBrandQry)){
                    logging($now, $user, "Update Brand Name", $logingContentText, $selectedIdProductBrand);
                    $postMessages =  "Record update successfully";
                    $colorMessages = "green-text";
                } else {
                    $postMessages = "Error updating record: " . mysqli_error($conn);
                    $colorMessages = "red-text";
                }
            }
        }
    }
    // ============================== BUTTON UPDATE CLICK ==========================================================
    // ========================================== add new Brand start ===============================
    if(isset($_POST['addBrandBtn']) && isset($_POST['addImagesPathBrand']) && $_POST['addImagesPathBrand'] != ''){
        $postBrandName      = $_POST['addBrandName'];
        $postBrandOrigin    = $_POST['addBrandOrigin'];
        $postBrandCategory  = $_POST['addBrandCategory'];
        $postBrandDesc      = $_POST['addBrandDesc'];

        $uploadOk = 1;
        $target_dir = "../images/";
        $target_file = $target_dir . basename($_FILES["addImageFileBrand"]["name"]);
        $filePath = "images/" . basename($_FILES["addImageFileBrand"]["name"]);
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["addImageFileBrand"]["tmp_name"]);
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
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
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
            if (move_uploaded_file($_FILES["addImageFileBrand"]["tmp_name"], "../images/".$newFileName)) {
                $insertAddBrand = "INSERT INTO brand (name, origin, category, description) VALUES ('".$postBrandName."', '".$postBrandOrigin."', '".$postBrandCategory."', '".$postBrandDesc."')";
                if(mysqli_query($conn, $insertAddBrand)){
                    $LastIdBrand = mysqli_insert_id($conn);

                    $insertAddImagesBrand = "INSERT INTO images (title, path, owner, idowner) VALUES ('Brand Images', 'images/".$newFileNameAdmin."', 'brand', '".$LastIdBrand."')";
                    if(mysqli_query($conn, $insertAddImagesBrand)){
                        logging($now, $user, "Add New Brand Item", "Brand Images : <a href=\'../images/".$newFileName."\' target=\'_blank\'>../images/".$newFileName."</a><br>Brand Name : ".$postBrandName."<br>Brand Origin : ".$postBrandOrigin."<br>Brand Category : ".$postBrandCategory."<br>Brand Description :<br> ".$postBrandDesc, $LastId);
                        header('Location: ./index.php?menu=product');
                    }else{
                        $postMessages = "ERROR: Could not able to execute ".$insertAddImagesBrand.". " . mysqli_error($conn);
                        $colorMessages = "red-text";
                    }
                } else{
                    $postMessages = "ERROR: Could not able to execute ".$insertAddBrand.". " . mysqli_error($conn);
                    $colorMessages = "red-text";
                }
            } else {
                $postMessages = "Sorry, there was an error uploading your file.";
                $colorMessages = "red-text";
            }
        }
    }
    // ========================================== add new Brand ends ================================
    // ==================================== BUTTON DELETE SUBMIT ===============================
    if(isset($_POST['btnDeleteBrand'])){
        if(isset($_POST['checkboxProductBrand'])){
            $delBrandQry = "DELETE FROM brand WHERE idbrand in (".implode($_POST['checkboxProductBrand'], ',').")";
            // ================================================= LOGING
            foreach ($_POST['checkboxProductBrand'] as $selectedIdProduct) {
                $nameDelBrandQry = "";
                $nameDelBrandQry = "SELECT * FROM brand WHERE idbrand = '".$selectedIdProduct."'";
                if($resultDelNameBrandQry = mysqli_query($conn, $nameDelBrandQry)){
                    if (mysqli_num_rows($resultDelNameBrandQry) > 0) {
                        while($rowDelNameBrand = mysqli_fetch_array($resultDelNameBrandQry)){
                            $nameDelBrand           = $rowDelNameBrand['name'];
                            $originDelBrand         = $rowDelNameBrand['origin'];
                            $categoryDelBrand       = $rowDelNameBrand['category'];
                            $descriptionDelBrand    = $rowDelNameBrand['description'];
                        }
                    }
                }
                $loggingText = "Name : ".$nameDelBrand."<br>Origin : ".$originDelBrand."<br>Category : ".$categoryDelBrand."<br>Description :<br>".$descriptionDelBrand;
                logging($now, $user, "Delete Brand Items", $loggingText, $selectedIdProduct);
            }
            // ================================================= LOGING
            if(mysqli_query($conn, $delBrandQry)){
                $delImagesBrandQry = "DELETE FROM images WHERE owner = 'brand' AND idowner in (".implode($_POST['checkboxProductBrand'], ',').")";

                if(mysqli_query($conn, $delImagesBrandQry)){
                    $unsetImagesBrandQry = "SELECT path FROM images WHERE owner = 'brand' AND idowner in (".implode($_POST['checkboxProductBrand'], ',').")";

                    if($resultPathImages = mysqli_query($conn, $unsetImagesBrandQry)){
                        if(mysqli_num_rows($resultPathImages) > 0){
                            $rowPathImagesBrand = mysqli_fetch_array($resultPathImages);
                            $pathImagesBrand = $rowPathImagesBrand['path'];
                            unlink("../".$pathImagesBrand);
                            header('Location: ./index.php?menu=product');
                        }
                    }else{
                        $postMessages = "ERROR: Could not able to execute ".$unsetImagesBrandQry.". " . mysqli_error($conn);
                        $colorMessages = "red-text";
                    }

                }else{
                    $postMessages = "ERROR: Could not able to execute ".$delImagesBrandQry.". " . mysqli_error($conn);
                    $colorMessages = "red-text";
                }

            }else{
                $postMessages = "ERROR: Could not able to execute ".$delBrandQry.". " . mysqli_error($conn);
                $colorMessages = "red-text";
            }
        }
    }
?>
    <div class="col s12 border-bottom grey lighten-2 mb-50">
        <h3 class="left-align">Clients</h3>
    </div>
    <div class="col s12">
        <form action="#" method="post" enctype="multipart/form-data">
            <div class="col s12">
                <?php
                    if($_SESSION['privilege'] == '1'){
                        ?>
                            <a id="delSelectionBrand" href="#modalDelBrand" class="waves-effect waves-light btn red accent-4 disabled" disabled><i class="material-icons left">delete</i>Delete</a>
                        <?php
                    }
                ?>
                <button id="updateSelectionProductBrandButton" name="updateSelectionProductBrandButton" class="waves-effect waves-light btn blue darken-4 disabled" disabled><i class="material-icons left">subdirectory_arrow_left</i>Update</button>
                <a href="#addBrand" class="modal-trigger btn-floating btn-large waves-effect waves-light green darken-4 right" title="Add more images"><i class="material-icons">add</i></a>
            </div>
            <div class="col s12">
                <span class="<?php echo $colorMessages;?>"><?php echo $postMessages;?></span>
            </div>
            <table class="striped responsive-table col s12">
                <thead>
                    <tr class="hide-on-small-only">
                        <th width="05%">
                            <p>
                                <input type="checkbox" id="checkAll" />
                                <label for="checkAll"></label>
                            </p>
                        </th>
                        <th width="20%">
                            Images
                        </th>
                        <th width="10%">
                            Name
                        </th>
                        <th width="10%">
                            Origin
                        </th>
                        <th width="20%">
                            Category
                        </th>
                        <th width="30%">
                            Description
                        </th>
                    </tr>

                    <tr class="hide-on-med-and-up">
                        <th><p><input type="checkbox" id="checkAll" /><label for="checkAll"></label></p></th>
                        <th height="300px">Images</th>
                        <th>Name</th>
                        <th>Origin</th>
                        <th>Category</th>
                        <th>Description</th>
                        <th class="center">Total Product</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $brandQry = "";
                        $brandQry = "SELECT * FROM brand ORDER BY name ASC";
                        if($resultBrandQry = mysqli_query($conn, $brandQry)){
                            if(mysqli_num_rows($resultBrandQry) > 0){
                                while ($rowBrandQry = mysqli_fetch_array($resultBrandQry)) {
                                    $idbrand        = $rowBrandQry['idbrand'];
                                    $nameBrand      = $rowBrandQry['name'];
                                    $originBrand    = $rowBrandQry['origin'];
                                    $catBrand       = $rowBrandQry['category'];
                                    $descBrand      = $rowBrandQry['description'];

                                    $imagesBrandQry = "";
                                    $imagesBrandQry = "SELECT * FROM images WHERE owner = 'brand' AND idowner = '".$idbrand."' LIMIT 1";
                                    if($resultImagesBrandQry = mysqli_query($conn, $imagesBrandQry)){
                                        if(mysqli_num_rows($resultImagesBrandQry) > 0){
                                            $rowImagesBrandQry = mysqli_fetch_array($resultImagesBrandQry);
                                            $idimagesBrand  = $rowImagesBrandQry['idimages'];
                                            $pathBrand    = $rowImagesBrandQry['path'];
                                        ?>
                                            <tr>
                                                <td>
                                                    <p>
                                                        <input name="checkboxProductBrand[]" type="checkbox" id="<?php echo "checkboxProductBrand".$idimagesBrand; ?>" value="<?php echo $idbrand; ?>"/>
                                                        <label for="<?php echo "checkboxProductBrand".$idimagesBrand; ?>"></label>
                                                    </p>
                                                </td>
                                                <td height="300px">
                                                    <a href="<?php echo "#uploadModal".$idimagesBrand; ?>" class="modal-trigger"><img src="<?php echo "../".$pathBrand; ?>" class="responsive-img" title="klick to change image"></a>
                                                </td>
                                                <td>
                                                    <div class="input-field">
                                                        <input id="<?php echo "titleProductBrand".$idbrand; ?>" name="<?php echo "titleProductBrand".$idbrand; ?>" class="validate" value="<?php echo $nameBrand; ?>">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="input-field">
                                                        <input id="<?php echo "originProductBrand".$idbrand; ?>" name="<?php echo "originProductBrand".$idbrand; ?>" class="validate" value="<?php echo $originBrand; ?>">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="input-field col s12 m7 l7">
                                                        <select id="<?php echo "categoryProductBrand".$idbrand; ?>" name="<?php echo "categoryProductBrand".$idbrand; ?>">
                                                            <option value="" class="red-text" disabled>Select Category</option>
                                                            <option value="engineering" <?php echo ($catBrand == "engineering")?"selected":""; ?>>Engneering</option>
                                                            <option value="civil" <?php echo ($catBrand == "civil")?"selected":""; ?>>Civil Construction</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="input-field">
                                                        <textarea id="<?php echo "descriptionProductBrand".$idbrand; ?>" name="<?php echo "descriptionProductBrand".$idbrand; ?>" class="materialize-textarea"><?php echo $descBrand; ?></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- ======================== MODAL =========================================================== -->
                                            <div id="<?php echo "uploadModal".$idimagesBrand; ?>" class="modal">
                                                <div class="modal-content">
                                                    <div class="border-bottom mb-10"><h4>Change Image</h4></div>
                                                    <div class="col s12 mb-30 mt-30 center container">
                                                        <div class="file-field input-field col s12">
                                                            <img id="<?php echo "image_upload_preview_about_client".$idimagesBrand; ?>" max-width="500px" src="<?php echo "../".$pathBrand; ?>" class="responsive-img">
                                                            <div class="file-field input-field col s12">
                                                                <div class="btn green darken-4">
                                                                    <span>Change</span>
                                                                    <input id="<?php echo "changeImageFileProductBrand".$idimagesBrand; ?>" name="<?php echo "changeImageFileProductBrand".$idimagesBrand; ?>" type="file">
                                                                </div>
                                                                <div class="file-path-wrapper">
                                                                    <input id="<?php echo "changeImagesPathProductBrand".$idimagesBrand; ?>" name="<?php echo "changeImagesPathProductBrand".$idimagesBrand; ?>" class="file-path validate" type="text">
                                                                </div>
                                                            </div>
                                                            <div class="col s12">
                                                                <button type="submit" id="<?php echo "btnChangeImagesProductBrand".$idimagesBrand; ?>" name="<?php echo "btnChangeImagesProductBrand".$idimagesBrand; ?>" class="waves-effect waves-light btn blue darken-4 right"><i class="material-icons left">subdirectory_arrow_left</i>Update</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <!-- ======================== MODAL =========================================================== -->
                                        <?php
                                        $btnChangeImagesProductBrand  = "btnChangeImagesProductBrand".$idimagesBrand;
                                        $changeImageFileProductBrand  = "changeImageFileProductBrand".$idimagesBrand;
                                        $changeImagesPathProductBrand   = "changeImagesPathProductBrand".$idimagesBrand;
                                        if(isset($_POST[$btnChangeImagesProductBrand])){
                                            $uploadOk = 1;
                                            if(isset($_POST[$changeImagesPathProductBrand]) && $_POST[$changeImagesPathProductBrand] != ''){
                                                $target_dir = "../images/";
                                                $target_file = $target_dir . basename($_FILES[$changeImageFileProductBrand]["name"]);
                                                $filePath = "images/" . basename($_FILES[$changeImageFileProductBrand]["name"]);
                                                $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                                                // Check if image file is a actual image or fake image
                                                $check = getimagesize($_FILES[$changeImageFileProductBrand]["tmp_name"]);
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
                                                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
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
                                                    if (move_uploaded_file($_FILES[$changeImageFileProductBrand]["tmp_name"], "../images/".$newFileName)) {

                                                        $delPrevImagesProductBrand = "SELECT path, idowner FROM images WHERE owner = 'brand' AND idimages = '".$idimagesBrand."'";
                                                        if($resultProductBrand = mysqli_query($conn, $delPrevImagesProductBrand)){
                                                            if(mysqli_num_rows($resultProductBrand) > 0){
                                                                $rowDeleteProductBrand = mysqli_fetch_array($resultProductBrand);
                                                                $pathImagesProductBrand = $rowDeleteProductBrand['path'];
                                                                $idownerImagesProductBrand = $rowDeleteProductBrand['idowner'];
                                                                if(!unlink("../".$pathImagesProductBrand)){echo "";}
                                                            }
                                                        }

                                                        $upbrandQry = "";
                                                        $upbrandQry = "SELECT name FROM brand WHERE idbrand = '".$idownerImagesProductBrand."' LIMIT 1";
                                                        if($upresultBrandQry = mysqli_query($conn, $upbrandQry)){
                                                            if(mysqli_num_rows($upresultBrandQry) > 0){
                                                                $uprowBrandQry = mysqli_fetch_array($upresultBrandQry);
                                                                $upnameBrand  = $uprowBrandQry['name'];
                                                            }
                                                        }

                                                        $updateChangeImagesFile = "UPDATE images SET path = 'images/".$newFileNameAdmin."' WHERE owner = 'brand' AND idimages = '".$idimagesBrand."'";
                                                        $loggingContentText = "Images name : ".$upnameBrand."<br>Images Location : <a href=\'../images/".$newFileName."\' target=\'_blank\'>../images/".$newFileName."</a>";
                                                        if(mysqli_query($conn, $updateChangeImagesFile)){
                                                            logging($now, $user, "Update Images Brands", $loggingContentText, $idimagesBrand);
                                                            $postMessages = "Images Updated";
                                                            $colorMessages = "green-text";
                                                            header('Location: ./index.php?menu=product&cat=brand');
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
                                                $postMessages = "Sorry, file not selected";
                                                $colorMessages = "red-text";
                                            }
                                        }else{
                                            $postMessages = "";
                                            $colorMessages = "";
                                        }
                                    }else{

                                    }
                                    }
                                }
                            }
                        }
                    ?>
                </tbody>
            </table>
            <div id="modalDelBrand" class="modal">
                <div class="modal-content">
                    <h4>Deleting Confirmation</h4>
                    <h5>Are you sure want to delete selected item(s) ?</h5>
                </div>
                <div class="modal-footer col s12 mb-30">
                    <button type="submit" name="btnDeleteBrand" class="waves-effect waves-light btn green darken-4 right">Yes</button>
                    <a href="#!" class="modal-action modal-close waves-effect waves-light btn blue darken-4 right">Cancel</a>
                </div>
            </div>
        </form>
        <div id="addBrand" class="modal">
            <form action="#" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="border-bottom mb-10"><h4>Add Brands</h4></div>
                    <div class="col s12 mt-30 center container">
                        <div class="file-field input-field col s12">
                            <img id="image_upload_preview_add_brand" max-width="500px" class="image_upload_preview responsive-img img-center mb-30" src="<?php echo "../images/emptyimages.bmp"; ?>">
                            <div class="btn green darken-4">
                                <span>Upload Image</span>
                                <input id="changeImageFileBrand" name="addImageFileBrand" type="file" required>
                            </div>
                            <div class="file-path-wrapper">
                                <input id="addImagesPathBrand" name="addImagesPathBrand" class="file-path validate" type="text" required>
                            </div>
                        </div>
                        <div class="file-field input-field col s12 m6 l6">
                            <input id="addBrandName" name="addBrandName" type="text" class="validate" required>
                            <label for="addBrandName">Brand Name</label>
                        </div>
                        <div class="file-field input-field col s12 m6 l6">
                            <input id="addBrandOrigin" name="addBrandOrigin" type="text" class="validate" required>
                            <label for="addBrandOrigin">Brand Origin</label>
                        </div>
                        <div class="input-field col s12 m7 l7">
                            <select id="addBrandCategory" name="addBrandCategory" required>
                                <option value="" class="red-text" selected disabled>Select Category</option>
                                <option value="engineering">Engneering</option>
                                <option value="civil">Civil Construction</option>
                            </select>
                            <label>Select Category</label>
                        </div>
                        <div class="file-field input-field col s12">
                            <textarea id="addBrandDesc" name="addBrandDesc" class="materialize-textarea" required></textarea>
                            <label for="addBrandDesc">Brand Description</label>
                        </div>
                        <div class="input-field col s12 mb-50">
                            <button name="addBrandBtn" class="waves-effect waves-light btn green darken-4 right">Add Brand</button>
                            <a href="#!" class="modal-action modal-close waves-effect waves-light btn blue darken-4 right mr-10">Cancel</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>