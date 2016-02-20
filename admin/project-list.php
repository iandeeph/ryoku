<div class="row">
<?php
    if(isset($_GET['menu']) == 'project' && isset($_GET['detail'])){
        include 'project-detail.php';
    }else{
        $projNameASC = "ORDER BY project.name ASC";
        $projNameDESC = "ORDER BY project.name DESC";
        $projDateASC = "ORDER BY project.date ASC";
        $projDateDESC = "ORDER BY project.date DESC";
        $projLocASC = "ORDER BY project.location ASC";
        $projLocDESC = "ORDER BY project.location DESC";
        $clienNameASC = "ORDER BY client.name ASC";
        $clienNameDESC = "ORDER BY client.name DESC";

        $sortProjList = isset($_GET['sortProjList'])?$_GET['sortProjList']:'';
        $sort = isset($_GET['sort'])?$_GET['sort']:'';

        if($menu == 'project' && $sortProjList == 'name' && $sort == 'asc'){
            $orderSortProjListQry = $projNameASC;
            $sortIconProject = '<i class="material-icons small">arrow_drop_down</i>';
            $sortIconDate = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
            $sortIconLocation = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
            $sortIconClient = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
        }
        elseif($menu == 'project' && $sortProjList == 'name' && $sort == 'desc')
        {
            $orderSortProjListQry = $projNameDESC;
            $sortIconProject = '<i class="material-icons small">arrow_drop_up</i>';
            $sortIconDate = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
            $sortIconLocation = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
            $sortIconClient = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
        }
        elseif($menu == 'project' && $sortProjList == 'location' && $sort == 'asc')
        {
            $orderSortProjListQry = $projLocASC;
            $sortIconDate = '<i class="material-icons small">arrow_drop_down</i>';
            $sortIconLocation = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
            $sortIconProject = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
            $sortIconClient = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
        }
        elseif($menu == 'project' && $sortProjList == 'location' && $sort == 'desc')
        {
            $orderSortProjListQry = $projLocDESC;
            $sortIconDate = '<i class="material-icons small">arrow_drop_up</i>';
            $sortIconLocation = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
            $sortIconClient = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
            $sortIconProject = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
        }
        elseif($menu == 'project' && $sortProjList == 'date' && $sort == 'asc')
        {
            $orderSortProjListQry = $projDateASC;
            $sortIconLocation = '<i class="material-icons small">arrow_drop_down</i>';
            $sortIconDate = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
            $sortIconClient = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
            $sortIconProject = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
        }
        elseif($menu == 'project' && $sortProjList == 'date' && $sort == 'desc')
        {
            $orderSortProjListQry = $projDateDESC;
            $sortIconLocation = '<i class="material-icons small">arrow_drop_up</i>';
            $sortIconDate = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
            $sortIconClient = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
            $sortIconProject = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
        }
        elseif($menu == 'project' && $sortProjList == 'client' && $sort == 'asc')
        {
            $orderSortProjListQry = $clienNameASC;
            $sortIconClient = '<i class="material-icons small">arrow_drop_down</i>';
            $sortIconDate = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
            $sortIconLocation = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
            $sortIconProject = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
        }
        elseif($menu == 'project' && $sortProjList == 'client' && $sort == 'desc')
        {
            $orderSortProjListQry = $clienNameDESC;
            $sortIconClient = '<i class="material-icons small">arrow_drop_up</i>';
            $sortIconDate = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
            $sortIconLocation = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
            $sortIconProject = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
        }else{
            $orderSortProjListQry = "";
            $sortIconClient = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
            $sortIconDate = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
            $sortIconLocation = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
            $sortIconProject = '<i class="material-icons small">arrow_drop_down</i><i class="material-icons small">arrow_drop_up</i>';
        }

// ========================================= ADD PROJECT SUBMIT =======================
    if(isset($_POST['btnAddProjectSubmit'])){
        $postaddProjName            = $_POST['addProjName'];
        $postclientProjAddSelect    = $_POST['clientProjAddSelect'];
        $postaddProjDate            = date("Y-m-d", strtotime(str_replace(',', '', mysqli_real_escape_string($conn, $_POST['addProjDate']))));
        $postaddProjLocation        = $_POST['addProjLocation'];
        $postaddContentWordProject  = $_POST['addContentWordProject'];

        $insertNewProject = "INSERT INTO project (name, idclient, date, location, contentWord) VALUES ('".$postaddProjName."', '".$postclientProjAddSelect."', '".$postaddProjDate."', '".$postaddProjLocation."', '".$postaddContentWordProject."')";
        if(mysqli_query($conn, $insertNewProject)){
            header('Location: ./index.php?menu=project&cat=list');
        }else{
            $postMessages = "ERROR: Could not able to execute ".$insertNewProject.". " . mysqli_error($conn);
            $colorMessages = "red-text";
        }
    }

// ==================================== BUTTON DELETE SUBMIT ===============================
    if(isset($_POST['btnDeleteProjectList'])){
        $delProjQry = "DELETE FROM project WHERE idproject in (".implode($_POST['checkboxProjectList'], ',').")";

        if(mysqli_query($conn, $delProjQry)){
            $delImagesQry = "DELETE FROM images WHERE owner = 'project' AND idowner in (".implode($_POST['checkboxProjectList'], ',').")";

            if(mysqli_query($conn, $delImagesQry)){
                $unsetImagesQry = "SELECT path FROM images WHERE owner = 'project' AND idowner in (".implode($_POST['checkboxProjectList'], ',').")";

                if($resultPathImages = mysqli_query($conn, $unsetImagesQry)){
                    if(mysqli_num_rows($resultPathImages) > 0){
                        $rowPathImages = mysqli_fetch_array($resultPathImages);
                        $pathImages = $rowPathImages['path'];
                        unlink("../".$pathImages);
                        header('Location: ./index.php?menu=project&cat=list');
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
            $postMessages = "ERROR: Could not able to execute ".$delProjQry.". " . mysqli_error($conn);
            $colorMessages = "red-text";
        }

    }
    ?>
        <div class="col s12 border-bottom grey lighten-2 mb-10">
            <h3 class="left-align">Project List</h3>
        </div>
        <div class="col s12">
            <a id="delSelectionProject" href="#modalDelProjectItems" class="modal-trigger waves-effect waves-light btn red accent-4 disabled mt-30"><i class="material-icons left">delete</i>Delete</a>
            <a href="#addProjectModal" class="modal-trigger btn-floating btn-large waves-effect waves-light green darken-4 right mb-30" title="Add more images"><i class="material-icons">add</i></a>
        </div>
        <div class="col s12">
            <form action="#" method="post" enctype="multipart/form-data">
                <table class="highlight responsive-table">
                    <thead>
                            <td width="50px">
                                <p>
                                    <input type="checkbox" id="checkAllProjList" />
                                    <label for="checkAllProjList"></label>
                                </p>
                            </td>
                            <td>
                                <div><a href="./index.php?menu=project&cat=list&sortProjList=name&sort=<?php echo ($sort == 'asc') ? 'desc':'asc' ?>">Project name<?php echo $sortIconProject; ?></a></div>
                            </td>
                            <td>
                                <div><a href="./index.php?menu=project&cat=list&sortProjList=location&sort=<?php echo ($sort == 'asc') ? 'desc':'asc' ?>"><span class="black-font">Location</span><?php echo $sortIconDate; ?></a></div>
                            </td>
                            <td>
                                <div><a href="./index.php?menu=project&cat=list&sortProjList=date&sort=<?php echo ($sort == 'asc') ? 'desc':'asc' ?>"><span class="black-font">Date</span><?php echo $sortIconLocation; ?></a></div>
                            </td>
                            <td>
                                <div><a href="./index.php?menu=project&cat=list&sortProjList=client&sort=<?php echo ($sort == 'asc') ? 'desc':'asc' ?>"><span class="black-font">Client</span><?php echo $sortIconClient; ?></a></div>
                            </td>
                            <td>
                                Total Images
                            </td>
                            <td>
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            
                            $projListQry = "SELECT 
                                            project.idproject as idproject,
                                            project.name as name,
                                            project.location as location,
                                            project.date as date,
                                            client.name as clientName
                                            FROM 
                                                project,
                                                client
                                            WHERE project.idclient = client.idclient
                                            ".$orderSortProjListQry."";

                            if($resultProjList = mysqli_query($conn, $projListQry) or die("Query failed :".mysqli_error($conn))){
                                if(mysqli_num_rows($resultProjList) > 0){
                                    while($rowProjList = mysqli_fetch_array($resultProjList)){
                                        $idProject          = $rowProjList['idproject'];
                                        $nameProjList       = $rowProjList['name'];
                                        $nameClientProjList  = $rowProjList['location'];
                                        $dateProjList    = $rowProjList['date'];
                                        $clientNameList     = $rowProjList['clientName'];

                                        $totImagesProjList = "SELECT count(*) as totalImagesProjList FROM images WHERE owner = 'project' AND idowner = '".$idProject."'";
                                        if($resultImagesProjList = mysqli_query($conn, $totImagesProjList)){
                                            if(mysqli_num_rows($resultImagesProjList) > 0){
                                                $rowImagesProjQry = mysqli_fetch_array($resultImagesProjList);
                                                $totalImagesProjList = $rowImagesProjQry['totalImagesProjList'];
                                            }
                                        }
                                        ?>
                                            <tr>
                                                <td>
                                                    <p>
                                                        <input name="checkboxProjectList[]" type="checkbox" id="<?php echo $idProject; ?>" value="<?php echo $idProject; ?>" />
                                                        <label for="<?php echo $idProject; ?>"></label>
                                                    </p>
                                                </td>
                                                <td>
                                                    <?php echo $nameProjList; ?>
                                                </td>
                                                <td>
                                                    <?php echo $nameClientProjList; ?>
                                                </td>
                                                <td>
                                                    <?php echo $dateProjList; ?>
                                                </td>
                                                <td>
                                                    <?php echo $clientNameList; ?>
                                                </td>
                                                <td>
                                                    <?php echo $totalImagesProjList; ?>
                                                </td>
                                                <td>
                                                    <div class="col s12">
                                                        <a href="./index.php?menu=project&cat=list&detail=<?php echo $idProject; ?>" class="waves-effect waves-light btn green darken-4" id="<?php echo $idProject; ?>"><i class="material-icons left">edit</i>Edit</a>
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
                <div id="modalDelProjectItems" class="modal">
                    <div class="modal-content">
                        <h4>Deleting Confirmation</h4>
                        <h5>Are you sure you want to delete selected item(s) ?</h5>
                    </div>
                    <div class="modal-footer col s12 mb-50">
                        <button type="submit" name="btnDeleteProjectList" class="waves-effect waves-light btn green darken-4 right">Yes</button>
                        <a href="#!" class="modal-action modal-close waves-effect waves-light btn blue darken-4 right">Cancel</a>
                    </div>
                </div>
            </form>
            <div id="addProjectModal" class="modal">
                <form action="#" method="post" enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="col s12">
                            <div class="col s12 border-bottom pdb-10">
                                <h5 class="col s12 m6 l6">Add New Project</h5>
                            </div>

            <!-- ========================================== PROJECT NAME -->
                            <div class="input-field col s12 m7 l7 mt-30">
                                <input id="addProjName" name="addProjName" type="text" class="validate" required>
                                <label for="addProjName">Project Name</label>
                            </div>

            <!-- ========================================== PROJECT CLIENT -->
                            <div id="selectClientWrapper" class="input-field col s12 m7 l7">
                                <select id="clientProjAddSelect" name="clientProjAddSelect" required>
                                    <option selected disabled>Select Client</option>
                                    <?php
                                        $brandProjListQry = "SELECT idclient, name FROM client ORDER BY name ASC";
                                        if ($resultProjList = mysqli_query($conn, $brandProjListQry)) {
                                            if (mysqli_num_rows($resultProjList) > 0) {
                                                while($rowProjList   = mysqli_fetch_array($resultProjList)){
                                                    $idClientProjList  = $rowProjList['idclient'];
                                                    $nameClientProjList  = $rowProjList['name'];
                                                    ?>
                                                        <option value="<?php echo $idClientProjList;?>"><?php echo $nameClientProjList;?></option>
                                                    <?php
                                                }
                                            }
                                        }
                                    ?>
                                </select>
                                <label>Select Brand</label>
                            </div>

            <!-- ========================================== PROJECT DATE -->    
                            <div class="input-field col s12 m6 l6">
                              <input id="addProjDate" name="addProjDate" type="date" class="datepicker">
                              <label for="addProjDate">Date Project</label>
                            </div>

            <!-- ========================================== PROJECT LOCATION -->
                            <div class="input-field col s12 m6 l6">
                              <input id="addProjLocation" name="addProjLocation" type="text" class="validate">
                              <label for="addProjLocation">Location</label>
                            </div>

            <!-- ========================================== PROJECT CONTENT WORD -->
                            <div class="input-field col s12 mt-30">
                                <textarea id="wysiwygEditor" name="addContentWordProject" class="materialize-textarea" required>Some text to project description</textarea>
                            </div>

            <!-- ========================================== PROJECT BUTTON SUBMIT -->
                            <div class="col s12">
                                <button type="submit" name="btnAddProjectSubmit" class="ml-30 mt-30 mb-30 right waves-effect waves-light btn green darken-4">Add</button>
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