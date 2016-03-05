<div class="row">
<?php
    $postMessages = isset($postMessages)?$postMessages:'';
    $colorMessages = isset($colorMessages)?$colorMessages:'';
    if(isset($_GET['menu']) == 'gallery' && isset($_GET['detail'])){
        include 'gallery-detail.php';
    }else{
        $galleryNameASC = "ORDER BY name ASC";
        $galeryNameDESC = "ORDER BY name DESC";

        $sortProjList = isset($_GET['sortProjList'])?$_GET['sortProjList']:'';
        $sort = isset($_GET['sort'])?$_GET['sort']:'';

        if($menu == 'gallery' && $sortProjList == 'name' && $sort == 'asc'){
            $orderSortProjListQry = $galleryNameASC;
            $sortIconName = '<i class="material-icons small">arrow_drop_down</i>';
        }
        elseif($menu == 'gallery' && $sortProjList == 'name' && $sort == 'desc')
        {
            $orderSortProjListQry = $galeryNameDESC;
            $sortIconName = '<i class="material-icons small">arrow_drop_up</i>';
        }else{
            $orderSortProjListQry = "";
            $sortIconName = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
        }

// ========================================= ADD PROJECT SUBMIT =======================
    if(isset($_POST['btnAddGallerySubmit'])){
        $postaddGalleryName            = $_POST['addGalleryName'];

        $insertNewGallery = "INSERT INTO gallery (name) VALUES ('".$postaddGalleryName."')";
        // ================================================= LOGING
            $logingText = "Name : ".$postaddGalleryName;
        // ================================================= LOGING
        if(mysqli_query($conn, $insertNewGallery)){
            logging($now, $user, "Add New Gallery", $logingText, $postclientProjAddSelect);
            header('Location: ./index.php?menu=gallery');
        }else{
            $postMessages = "ERROR: Could not able to execute ".$insertNewGallery.". " . mysqli_error($conn);
            $colorMessages = "red-text";
        }
    }

// ==================================== BUTTON DELETE SUBMIT ===============================
    if(isset($_POST['btnDeleteGalleryList'])){
        $delGallery = "DELETE FROM gallery WHERE idgallery in (".implode($_POST['checkboxGallery'], ',').")";

    // =================================================== LOGING
        foreach ($_POST['checkboxGallery'] as $selectedIdGallery) {
            $upNameGallery = "SELECT name FROM gallery WHERE idgallery = '".$selectedIdGallery."'";

            if($resultUpGalleryName = mysqli_query($conn, $upNameGallery) or die("Query failed :".mysqli_error($conn))){
                if(mysqli_num_rows($resultUpGalleryName) > 0){
                    $delrowNameGallery = mysqli_fetch_array($resultUpGalleryName);
                    $delnameGallery = $delrowNameGallery['name'];

                    $logingText = "Name : ".$delnameGallery;
                    logging($now, $user, "Delete Gallery Items", $logingText, $selectedIdGallery);

                    // delete file from disk
                     $delPathImagesGallery = "SELECT path FROM images WHERE owner = 'gallery' AND idowner = '".$selectedIdGallery."'";

                    if($resultDelImagesPath = mysqli_query($conn, $delPathImagesGallery) or die("Query failed :".mysqli_error($conn))){
                        if(mysqli_num_rows($resultDelImagesPath) > 0){
                            $delrowImagesGallery = mysqli_fetch_array($resultDelImagesPath);
                            $delPathImages = $delrowImagesGallery['path'];

                            unlink("../".$delPathImages);
                        }
                    }
                }
            }
        }
    // =================================================== LOGING
        if(mysqli_query($conn, $delGallery)){
            $delImagesQry = "DELETE FROM images WHERE owner = 'gallery' AND idowner in (".implode($_POST['checkboxGallery'], ',').")";

            if(mysqli_query($conn, $delImagesQry)){
                $unsetImagesQry = "SELECT path FROM images WHERE owner = 'gallery' AND idowner in (".implode($_POST['checkboxGallery'], ',').")";

                if($resultPathImages = mysqli_query($conn, $unsetImagesQry)){
                    if(mysqli_num_rows($resultPathImages) > 0){
                        $rowPathImages = mysqli_fetch_array($resultPathImages);
                        $pathImages = $rowPathImages['path'];
                        unlink("../".$pathImages);
                        header('Location: ./index.php?menu=gallery');
                    }
                }else{
                    $postMessages = "ERROR: Could not able to execute ".$unsetImagesQry.". " . mysqli_error($conn);
                    $colorMessages = "red-text";
                }

            }else{
                $postMessages = "ERROR: Could not able to execute ".$delImagesQry.". " . mysqli_error($conn);
                $colorMessages = "red-text";
            }

        }else{
            $postMessages = "ERROR: Could not able to execute ".$delGallery.". " . mysqli_error($conn);
            $colorMessages = "red-text";
        }

    }
    ?>
        <div class="col s12 border-bottom grey lighten-2 mb-10">
            <h3 class="left-align">Images Album</h3>
        </div>
        <div class="col s12">
            <?php
                if($_SESSION['privilege'] == '1'){
                    ?>
                        <a id="delSelectionAlbum" href="#modalDelGalleryItems" class="waves-effect waves-light btn red accent-4 disabled mt-30" disabled><i class="material-icons left">delete</i>Delete</a>
                    <?php
                }
            ?>
            <a href="#addGalleryModal" class="modal-trigger btn-floating btn-large waves-effect waves-light green darken-4 right mb-30" title="Add more images"><i class="material-icons">add</i></a>
        </div>
        <div class="col s12">
            <span class="<?php echo $colorMessages;?>"><?php echo $postMessages;?></span>
        </div>
        <div class="col s12">
            <form action="#" method="post" enctype="multipart/form-data">
                <table class="striped responsive-table">
                    <thead>
                        <tr class="hide-on-small-only">
                            <th width="05%">
                                <p>
                                    <input type="checkbox" id="checkAllGallery" />
                                    <label for="checkAllGallery"></label>
                                </p>
                            </th>
                            <th width="30%">
                                <div><a href="./index.php?menu=gallery&sortProjList=name&sort=<?php echo ($sort == 'asc') ? 'desc':'asc' ?>">Album Name<?php echo $sortIconName; ?></a></div>
                            </th>
                            <th width="10%">
                                Total Images
                            </th>
                            <th width="10%">
                            </th>
                        </tr>
                        <tr class="hide-on-med-and-up">
                            <th><p><input type="checkbox" id="checkAllGallery" /><label for="checkAllGallery"></label></p></th>
                            <th>Album Name</th>
                            <th>Total Images</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $galleryListQry = "SELECT * FROM gallery ".$orderSortProjListQry."";

                            if($resultGalleryList = mysqli_query($conn, $galleryListQry) or die("Query failed :".$galleryListQry." ".mysqli_error($conn))){
                                if(mysqli_num_rows($resultGalleryList) > 0){
                                    while($rowGalleryList = mysqli_fetch_array($resultGalleryList)){
                                        $idGallery          = $rowGalleryList['idgallery'];
                                        $nameGalleryList    = $rowGalleryList['name'];

                                        $idProjectQry = "";
                                        $idProjectQry = "SELECT idproject FROM project WHERE name = '".$nameGalleryList."'";

                                        if($resultidProject = mysqli_query($conn, $idProjectQry) or die("Query failed :".mysqli_error($conn))){
                                            if(mysqli_num_rows($resultidProject) > 0){
                                                $rowresultidProject = mysqli_fetch_array($resultidProject);
                                                $projectId = $rowresultidProject['idproject'];

                                                $projectQry = " OR (owner = 'project' AND idowner = '".$projectId."')";
                                            }else{
                                                $projectQry = "";
                                            }
                                        }

                                        $totImagesGalleryList = "SELECT count(*) as totalImagesGalleryList FROM images WHERE (owner = 'gallery' AND idowner = '".$idGallery."')".$projectQry;
                                        if($resultImagesGalleryList = mysqli_query($conn, $totImagesGalleryList)){
                                            if(mysqli_num_rows($resultImagesGalleryList) > 0){
                                                $rowImagesGalleryQry = mysqli_fetch_array($resultImagesGalleryList);
                                                $totalImagesGalleryList = intval($rowImagesGalleryQry['totalImagesGalleryList']);
                                            }
                                        }
                                        ?>
                                            <tr>
                                                <td>
                                                    <p>
                                                        <input name="checkboxGallery[]" type="checkbox" id="<?php echo $idGallery; ?>" value="<?php echo $idGallery; ?>" />
                                                        <label for="<?php echo $idGallery; ?>"></label>
                                                    </p>
                                                </td>
                                                <td>
                                                    <?php echo $nameGalleryList; ?>
                                                </td>
                                                <td>
                                                    <?php echo $totalImagesGalleryList; ?>
                                                </td>
                                                <td>
                                                    <div class="col s12">
                                                        <a href="./index.php?menu=gallery&detail=<?php echo $idGallery; ?>" class="waves-effect waves-light btn green darken-4" id="<?php echo $idGallery; ?>"><i class="material-icons left">edit</i>Edit</a>
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
                <div id="modalDelGalleryItems" class="modal">
                    <div class="modal-content">
                        <h4>Deleting Confirmation</h4>
                        <h5>Are you sure you want to delete selected item(s) ?</h5>
                    </div>
                    <div class="modal-footer col s12 mb-30">
                        <button type="submit" name="btnDeleteGalleryList" class="waves-effect waves-light btn green darken-4 right">Yes</button>
                        <a href="#!" class="modal-action modal-close waves-effect waves-light btn blue darken-4 right">Cancel</a>
                    </div>
                </div>
            </form>
            <div id="addGalleryModal" class="modal">
                <form action="#" method="post" enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="col s12">
                            <div class="col s12 border-bottom pdb-10">
                                <h5 class="col s12 m6 l6">Add New Gallery</h5>
                            </div>

            <!-- ========================================== PROJECT NAME -->
                            <div class="input-field col s12 m7 l7 mt-30">
                                <input id="addGalleryName" name="addGalleryName" type="text" class="validate" required>
                                <label for="addGalleryName">Gallery Name</label>
                            </div>

            <!-- ========================================== PROJECT BUTTON SUBMIT -->
                            <div class="col s12">
                                <button type="submit" name="btnAddGallerySubmit" class="ml-30 mt-30 mb-30 right waves-effect waves-light btn green darken-4">Add</button>
                                <a href="#!" class="mt-30 mb-30 modal-action modal-close waves-effect waves-light btn blue darken-4 right">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    <?php
    }
    ?>
</div>