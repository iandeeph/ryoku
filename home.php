<!-- SLIDER BANNER START -->
<div class="row">
  <div class="s12">
    <div id="owl-demo" class="owl-carousel" style="opacity: 1; display: block;">
      <?php
      $bannerQry = "SELECT idproduct, contentWord, name FROM product ORDER BY RAND() LIMIT 10";
      if($resultBannerQry = mysqli_query($conn, $bannerQry)){
        if (mysqli_num_rows($resultBannerQry) > 0) {
          while ($rowBanner = mysqli_fetch_array($resultBannerQry)) {
            $idproduct          = $rowBanner['idproduct'];
            $nameProductBanner  = $rowBanner['name'];
            $contentWordProduct = substr($rowBanner['contentWord'], 0, 100);

            $imagesBannerQry = "SELECT path FROM images WHERE (owner = 'product' AND idowner = '".$idproduct."') ORDER BY RAND() LIMIT 1";
            
            if ($resultImagesBannerQry = mysqli_query($conn, $imagesBannerQry)) {
              $rowImagesBanner = mysqli_fetch_array($resultImagesBannerQry);
              $pathImagesBanner   = $rowImagesBanner['path'];
            }
            ?>
              <div class="item" style="height:250px">
                <img class="lazyOwl" data-src="<?php echo $pathImagesBanner;?>" alt="Images Banner" style="display: inline;">
                <a href="<?php echo $pathImagesBanner;?>" class="swipebox" title="<?php echo $nameProductBanner;?>">
                  <div class="pdt-0 portfolio_head hide-on-med-and-down">
                    <h3><?php echo $nameProductBanner;?></h3>
                    <p><?php echo $contentWordProduct."...";?></p>
                  </div>
                </a>
              </div>
            <?php
          }
        }else {
          echo "0 results";
        }
      }
      ?>
    </div>
  </div>
</div>
<!-- SLIDER BANNER END -->

<!-- SERVICE HOME START -->
<div class="row">
  <div class="col s12">
    <div class="container">
      <div class="divider"></div>
      <div class="col s12 center">
        <h3 class="grey-text">SERVICE</h3>
      </div>
      <div class="col s12 center">
        <?php
          if($resultServiceQry = mysqli_query($conn, "SELECT * FROM service")){
            if (mysqli_num_rows($resultServiceQry) > 0) {
              while ($rowService = mysqli_fetch_array($resultServiceQry)) {
                $idservice          = $rowService['idservice'];
                $nameService        = $rowService['name'];
                $contentWordService = $rowService['contentWord'];

                $imagesServiceQry = "SELECT * FROM images WHERE (owner = 'Service' AND idowner = '".$idservice."') LIMIT 1";
                
                if ($resultImagesServiceQry = mysqli_query($conn, $imagesServiceQry)) {
                  if (mysqli_num_rows($resultImagesServiceQry) > 0) {
                    $rowImagesService = mysqli_fetch_array($resultImagesServiceQry);
                    $idimages           = $rowImagesService['idimages'];
                    $titleImagesService = $rowImagesService['title'];
                    $pathImagesService  = $rowImagesService['path'];
                    ?>
                    <div class="col s12 m6 l4 center">
                      <img class="responsive-img" alt="<?php echo $titleImagesService;?>" title="<?php echo $nameService;?>" src="<?php echo $pathImagesService;?>">
                      <p class="center">
                        <?php echo $contentWordService;?>
                      </p>
                    </div>
                    <?php
                  }
                }
              }
            }
          }
        ?>
      </div>
    </div>
  </div>
</div>
<!-- SERVICE HOME END -->

<!-- PROJECT HOME START -->
<div class="row">
  <div class="col s12 project">
    <div class="container">
      <div class="col s12 center">
        <h3 class="white-text">LATEST PROJECT</h3>
      </div>
      <div class="col s12 section">              
        <?php
          $latesProjectQry = "SELECT idproject, name, contentWord FROM project ORDER BY date ASC LIMIT 3";
          if ($resultLatestProj = mysqli_query($conn, $latesProjectQry)) {
            if (mysqli_num_rows($resultLatestProj) > 0) {
              while($rowLatestProj  = mysqli_fetch_array($resultLatestProj)){
                $idLatestProj   = $rowLatestProj['idproject'];
                $nameLatestProj = $rowLatestProj['name'];
                $contentWordLatestProj = $rowLatestProj['contentWord'];
                ?>
                  <div class="col s12 left border-bottom">
                    <a href="#">
                      <h5 class="white-text"><?php echo strtoupper($nameLatestProj); ?></h5>
                    </a>
                  </div>
                  <div class="col s12 center border-bottom">
                    <?php
                      $imagesLatesProjQry = "SELECT path FROM images WHERE (owner = 'project' AND idowner = '".$idLatestProj."') LIMIT 4";
                      if ($resultImagesLatestProj = mysqli_query($conn, $imagesLatesProjQry)) {
                        if (mysqli_num_rows($resultImagesLatestProj) > 0) {
                          while($rowImagesLatestProj  = mysqli_fetch_array($resultImagesLatestProj)){
                            $pathImagesLatestProj  = $rowImagesLatestProj['path'];
                            ?>
                              <div class="col s12 m6 l3 center mt-30 mb-30">
                                <img class="materialboxed responsive-img" src="<?php echo $pathImagesLatestProj; ?>">
                              </div>
                            <?php
                          }
                        }
                      }
                    ?>
                  </div>
                  <div class="col s12 left">
                    <p class="left">
                        <?php echo substr($contentWordLatestProj, 0, 250)."<a href='./index.php?menu=project#".$idLatestProj."'> [... Read More]</a>";?>
                      </p>
                  </div>
                <?php
              }
            }
          }
        ?>
      </div>
    </div>
  </div>
</div>
<!-- PROJECT HOME END -->

<!-- COMPANY BANNER START -->
<div class="row pdb-30">
  <div class="col s12">
    <div class="col l6 m12 s12 blue-text darken-4-text center mt-50">
      <h2 class="center-align">CV. RYOKU PETROJAYA MANDIRI</h2>
    </div>
    <div class="col l6 m12 s12 center">
      <img class="responsive-img" src="images/banner.jpg">
    </div>
  </div>
</div>
<!-- COMPANY BANNER END -->