<!-- SLIDER BANNER START -->
<div class="row">
  <div class="s12">
    <div id="owl-demo" class="owl-carousel" style="opacity: 1; display: block;">
      <?php
      if($resultBannerQry = mysqli_query($conn, "SELECT * FROM banner ORDER BY idbanner DESC")){
        if (mysqli_num_rows($resultBannerQry) > 0) {
          while ($rowBanner = mysqli_fetch_array($resultBannerQry)) {
            $idbanner = $rowBanner['idbanner'];
            $contentWord = $rowBanner['contentWord'];

            $imagesBannerQry = "SELECT * FROM images WHERE (owner = 'banner' AND idowner = '".$idbanner."') LIMIT 1";
            
            if ($resultImagesBannerQry = mysqli_query($conn, $imagesBannerQry)) {
              $rowImagesBanner = mysqli_fetch_array($resultImagesBannerQry);
              $titleImagesBanner  = $rowImagesBanner['title'];
              $pathImagesBanner   = $rowImagesBanner['path'];
            }
            ?>
            <div class="item">
              <img class="lazyOwl" data-src="<?php echo $pathImagesBanner;?>" alt="Images Banner" style="display: inline;">
              <a href="<?php echo $pathImagesBanner;?>" class="swipebox" title="<?php echo $titleImagesBanner;?>">
                <div class="pdt-0 portfolio_head hide-on-med-and-down">
                  <h3><?php echo $titleImagesBanner;?></h3>
                  <p><?php echo $contentWord;?></p>
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
      <div class="col s12 center border-bottom">
        <h3 class="white-text">LATEST PROJECT</h3>
      </div>
      <div class="col s12 left border-bottom">              
        <div class="col s12 left">
          <a href="#">
            <h5 class="white-text">PERAKITAN PIPA BAWAH LAUT</h5>
          </a>
        </div>
        <div class="col s12 center">
          <div class="col s12 m6 l3 center mt-30">
            <img class="materialboxed responsive-img" src="images/pic.jpg">
          </div>
          <div class="col s12 m6 l3 center mt-30">
            <img class="materialboxed responsive-img" src="images/pic1.jpg">
          </div>
          <div class="col s12 m6 l3 center mt-30">
            <img class="materialboxed responsive-img" src="images/pic2.jpg">
          </div>
          <div class="col s12 m6 l3 center mt-30">
            <img class="materialboxed responsive-img" src="images/pic.jpg">
          </div>
        </div>
        <div class="col s12 left">
          <a class="waves-effect waves-light btn mb-30 mt-30 blue darken-3">Detail</a>
        </div>
      </div>
      <div class="col s12 left border-bottom">              
        <div class="col s12 left">
          <a href="#">
            <h5 class="white-text">PERAKITAN POMPA AIR BERSIH</h5>
          </a>
        </div>
        <div class="col s12 left">
          <div class="col s12 m6 l3 center mt-30">
            <img class="materialboxed responsive-img" src="images/pic.jpg">
          </div>
          <div class="col s12 m6 l3 center mt-30">
            <img class="materialboxed responsive-img" src="images/pic1.jpg">
          </div>
          <div class="col s12 m6 l3 center mt-30">
            <img class="materialboxed responsive-img" src="images/pic2.jpg">
          </div>
          <div class="col s12 m6 l3 center mt-30"> 
            <img class="materialboxed responsive-img" src="images/pic.jpg">
          </div>
        </div>
        <div class="col s12 left">
          <a class="waves-effect waves-light btn mb-30 mt-30 blue darken-3">Detail</a>
        </div>
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