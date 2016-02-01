<div class="row">
  <div class="col s12 border-bottom grey lighten-2 mb-10">
    <h3 class="left-align">Project List</h3>
  </div>
  <div class="col s12">
    <form action="#" method="post" enctype="multipart/form-data">
      <?php
        if(isset($_GET['det'])){
          include 'detailProject.php';
        }else{
          ?>
            <div class="col s12">
              <a href="#addProjectModal" class="modal-trigger btn-floating btn-large waves-effect waves-light green darken-4 right mb-30" title="Add more images"><i class="material-icons">add</i></a>
            </div>
            <div class="collection">
              <?php
                $nameProjectQry = "SELECT idproject, name FROM project";
                if($resultNameProject = mysqli_query($conn, $nameProjectQry)){
                  if(mysqli_num_rows($resultNameProject) > 0){
                    while($rowResultNameProject = mysqli_fetch_array($resultNameProject)){
                      $idproject    = $rowResultNameProject['idproject'];
                      $nameProject  = $rowResultNameProject['name'];

                      ?>
                        <a href="./index.php?menu=project&det=<?php echo $idproject; ?>" class="collection-item"><?php echo $nameProject;?></a>
                      <?php
                    }
                  }
                }
              ?>
            </div>
            <div id="addProjectModal" class="modal modal-fixed-footer">
              <div class="modal-content">
                <div class="col s12">
                  <div class="col s12 center">
                    <h4>Add New Project</h4>
                  </div>
                  <div class="col s12 border-bottom pdb-10">
                    <h5 class="col s12 m6 l6">Add Images</h5>
                  </div>
                  <div class="col s12">
                    <div class="file-field input-field">
                    <div class="btn">
                      <span>Images</span>
                      <input type="file" multiple>
                    </div>
                    <div class="file-path-wrapper">
                      <input class="file-path validate" type="text" placeholder="Upload one or more files">
                    </div>
                  </div>
                  </div>
                  <div class="col s12 border-bottom pdb-10">
                    <h5 class="col s12 m6 l6">Content</h5>
                  </div>
                  <div class="input-field col s12 m7 l7 mt-30">
                    <input id="titleProject" name="titleProject" type="text" class="validate">
                    <label for="titleProject">Project Name</label>
                  </div>
                  <div class="input-field col s12 m6 l6">
                    <input id="locationProject" name="locationProject" type="text" class="validate">
                    <label for="locationProject">Location</label>
                  </div>
                  <div class="input-field col s12 m6 l6">
                    <input id="dateProject" name="dateProject" type="date" class="datepicker">
                    <label for="dateProject">Date Project</label>
                  </div>
                  <div class="input-field col s12 m6 l6">
                    <select>
                      <option value="" disabled selected>Select Main Category</option>
                      <?php
                        $mainCatQry = "SELECT idcategory, main FROM category WHERE owner = 'project' GROUP BY main";
                        if ($resultMainCat = mysqli_query($conn, $mainCatQry)) {
                              if (mysqli_num_rows($resultMainCat) > 0) {
                            while($rowMainCat   = mysqli_fetch_array($resultMainCat)){
                              $idMainCat  = $rowMainCat['idcategory'];
                              $mainCat  = $rowMainCat['main'];
                              ?>
                                <option value="<?php echo $idMainCat;?>"><?php echo $mainCat;?></option>
                              <?php
                            }
                          }
                        }
                      ?>
                      <option>>Tambah Main Category</option>
                    </select>
                    <label>Main Category</label>
                  </div>
                  <div class="input-field col s12 m6 l6">
                    <select>
                      <option value="" disabled selected>Select Sub Category</option>
                      <?php
                        $subCatQry = "SELECT idcategory, sub FROM category WHERE owner = 'project' AND sub IS NOT NULL AND sub != ''";
                        echo $subCatQry;
                        if ($resultSubCat = mysqli_query($conn, $subCatQry)) {
                              if (mysqli_num_rows($resultSubCat) > 0) {
                            while($rowSubCat  = mysqli_fetch_array($resultSubCat)){
                              $idSubCat   = $rowSubCat['idcategory'];
                              $subCat   = $rowSubCat['sub'];
                              $selected   = ($subCat == $subDetCategory) ? 'selected' : '';
                              ?>
                                <option value="<?php echo $idSubCat;?>"><?php echo $subCat;?></option>
                              <?php
                            }
                          }
                        }
                      ?>
                    </select>
                    <label>Sub Category</label>
                  </div>
                  <div class="input-field col s12">
                    <textarea id="wysiwygEditor" class="materialize-textarea">Some text to this project..</textarea>
                  </div>
                </div>
                </div>
                <div class="modal-footer mt-30s">
                  <button name="<?php echo $idImagesDetProject; ?>" id="<?php echo $idImagesDetProject; ?>" class="red accent-4 white-text modal-action modal-close waves-effect waves-green btn-flat">Add</button>
                  <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Cancel</a>
                </div>
            </div>
          <?php
        }
      ?>
    </form>
  </div>
</div>