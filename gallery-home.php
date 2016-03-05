<?php
    $albumQry = "SELECT * FROM gallery ORDER BY idgallery DESC";
    if($resultAlbumsQry = mysqli_query($conn, $albumQry)){
        if(mysqli_num_rows($resultAlbumsQry) > 0){
            while ($rowAlbumtQry = mysqli_fetch_array($resultAlbumsQry)) {
                $idAlbum        = $rowAlbumtQry['idgallery'];
                $nameAlbum      = $rowAlbumtQry['name'];

                $idProjectQry = "";
                $idProjectQry = "SELECT idproject FROM project WHERE name = '".$nameAlbum."'";

                if($resultidProject = mysqli_query($conn, $idProjectQry) or die("Query failed :".mysqli_error($conn))){
                    if(mysqli_num_rows($resultidProject) > 0){
                        $rowresultidProject = mysqli_fetch_array($resultidProject);
                        $projectId = $rowresultidProject['idproject'];

                        $projectQry = " OR (owner = 'project' AND idowner = '".$projectId."')";
                    }else{
                        $projectQry = "";
                    }
                }

                $imagesAlbumQry = "SELECT * FROM images WHERE (owner = 'gallery' AND idowner = '".$idAlbum."')".$projectQry." ORDER BY RAND() LIMIT 1";
                if($resultImagesAlbumQry = mysqli_query($conn, $imagesAlbumQry)){
                    if(mysqli_num_rows($resultImagesAlbumQry) > 0){
                        $rowImagesAlbumQry = mysqli_fetch_array($resultImagesAlbumQry);
                        $pathAlbum          = $rowImagesAlbumQry['path'];
                        ?>
                            <div class="col s12 m6 l3 mt-30 gallery-images-wrapper hoverable">
                                <a href="<?php echo './index.php?menu=gallery&album='.$idAlbum; ?>">
                                    <div class="col s12 center height-300 valign-wrapper border-bottom">
                                        <div class="col s12">
                                            <img src="<?php echo $pathAlbum;?>" alt="<?php echo $nameAlbum;?>" title="<?php echo $nameAlbum;?>" class="responsive-img" width="250px">
                                        </div>
                                    </div>
                                    <div class="col s12 valign-wrapper center blue-text height-100">
                                        <div class="col s12">
                                            <h5 class="center"><?php echo strtoupper($nameAlbum);?></h5>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php
                    }
                }
            }
        }
    }
?>