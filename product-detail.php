<div class="row">
	<?php
		$idbrand = $_GET['brand'];
		$mainCat = $_GET['mainCat'];
		$subCat = $_GET['subCat'];
		$detProd = $_GET['detProd'];

		$brandCatQry = "SELECT * FROM brand WHERE idbrand = '".$idbrand."' LIMIT 1";
		if($resultBrandCat = mysqli_query($conn, $brandCatQry) or die("Query failed :".mysqli_error($conn))){
			if(mysqli_num_rows($resultBrandCat) > 0){
				$rowProdCatd = mysqli_fetch_array($resultBrandCat);
				$idBrandCat 	= $rowProdCatd['idbrand'];
				$nameBrandCat	= $rowProdCatd['name'];

				$subCatBrandQry = "SELECT idproduct, name, contentWord FROM product WHERE idproduct = '".$detProd."'";
				if($resultSubCatBrand = mysqli_query($conn, $subCatBrandQry) or die("Query failed :".mysqli_error($conn))){
					if(mysqli_num_rows($resultSubCatBrand) > 0){
						while($rowSubCatBrand = mysqli_fetch_array($resultSubCatBrand)){
							$idSubCatBrand 				= $rowSubCatBrand['idproduct'];
							$nameProdCatBrand 			= $rowSubCatBrand['name'];
							$contentWordProdCatBrand 	= $rowSubCatBrand['contentWord'];
							?>
								<div class="col s12 mb-10 border-bottom">
									<span class="grey-text darken-4-text">
										<a class="blue-text darken-4-text" href="./index.php?menu=product&brand=<?php echo $idbrand;?>"><?php echo $nameBrandCat; ?></a> /
										<a class="blue-text darken-4-text" href="./index.php?menu=product&brand=<?php echo $idbrand;?>&mainCat=<?php echo $mainCat;?>"><?php echo $mainCat; ?></a> /
										<a class="blue-text darken-4-text" href="./index.php?menu=product&brand=<?php echo $idbrand;?>&mainCat=<?php echo $mainCat;?>&subCat=<?php echo $subCat;?>"><?php echo $subCat; ?></a> /
										<a class="blue-text darken-4-text" href="./index.php?menu=product&brand=<?php echo $idbrand;?>&mainCat=<?php echo $mainCat;?>&subCat=<?php echo $subCat;?>&detProd=<?php echo $idSubCatBrand;?>"><?php echo $nameProdCatBrand; ?></a>
									</span>
								</div>
								<div class="col s12 border-bottom grey lighten-2 blue-text darken-4-text">
									<h4>
										<?php echo $nameProdCatBrand; ?>
									</h4>
								</div>
								<div id="jssor_1" style="position: relative; margin: 0 auto; top: 0px; left: 0px; width: 700px; height: 700px; overflow: hidden; visibility: hidden;">
						        <!-- Loading Screen -->
						        <div data-u="loading" style="position: absolute; top: 0px; left: 0px;">
						            <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
						            <div style="position:absolute;display:block;background:url('images/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
						        </div>
						        <div data-u="slides" style="cursor: default; position: relative; top: 0px; left: 0px; width: 700px; height: 700px; overflow: hidden;">
							<?php
							$imagesCatBrandQry = "SELECT * FROM images WHERE idowner = '".$idSubCatBrand."' AND owner = 'product'";
							if($resultImagesCatBrand = mysqli_query($conn, $imagesCatBrandQry) or die("Query failed :".mysqli_error($conn))){
								if(mysqli_num_rows($resultImagesCatBrand) > 0){
									while($rowImagesCatBrand = mysqli_fetch_array($resultImagesCatBrand)){
										$nameImagesCatBrand = $rowImagesCatBrand['title'];
										$pathImagesCatBrand = $rowImagesCatBrand['path'];
										?>
											<div style="display: none;">
								                <img data-u="image" src="<?php echo $pathImagesCatBrand; ?>" />
								            </div>
										<?php
									}
									?>
									    </div>
									<?php
								}
							}
						}
					}
				}
			}
		}
	?>
</div>
	<div class="col s12 border-bottom grey lighten-2 blue-text darken-4-text">
		<h4>
			Product Specification
		</h4>
	</div>
	<div class="col s12">
		<p>
			<?php echo $contentWordProdCatBrand; ?>
		</p>
	</div>
</div>
<script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
<script type="text/javascript">
// ======== JSSOR slider
jQuery(document).ready(function ($) {
	var jssor_1_SlideshowTransitions = [
	  {$Duration:1200,$Zoom:11,$Rotate:-1,$Easing:{$Zoom:$Jease$.$InQuad,$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$InQuad},$Opacity:2,$Round:{$Rotate:0.5},$Brother:{$Duration:1200,$Zoom:1,$Rotate:1,$Easing:$Jease$.$Swing,$Opacity:2,$Round:{$Rotate:0.5},$Shift:90}},
	  {$Duration:1400,x:0.25,$Zoom:1.5,$Easing:{$Left:$Jease$.$InWave,$Zoom:$Jease$.$InSine},$Opacity:2,$ZIndex:-10,$Brother:{$Duration:1400,x:-0.25,$Zoom:1.5,$Easing:{$Left:$Jease$.$InWave,$Zoom:$Jease$.$InSine},$Opacity:2,$ZIndex:-10}},
	  {$Duration:1200,$Zoom:11,$Rotate:1,$Easing:{$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$InQuad},$Opacity:2,$Round:{$Rotate:1},$ZIndex:-10,$Brother:{$Duration:1200,$Zoom:11,$Rotate:-1,$Easing:{$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$InQuad},$Opacity:2,$Round:{$Rotate:1},$ZIndex:-10,$Shift:600}},
	  {$Duration:1500,x:0.5,$Cols:2,$ChessMode:{$Column:3},$Easing:{$Left:$Jease$.$InOutCubic},$Opacity:2,$Brother:{$Duration:1500,$Opacity:2}},
	  {$Duration:1500,x:-0.3,y:0.5,$Zoom:1,$Rotate:0.1,$During:{$Left:[0.6,0.4],$Top:[0.6,0.4],$Rotate:[0.6,0.4],$Zoom:[0.6,0.4]},$Easing:{$Left:$Jease$.$InQuad,$Top:$Jease$.$InQuad,$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$InQuad},$Opacity:2,$Brother:{$Duration:1000,$Zoom:11,$Rotate:-0.5,$Easing:{$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$InQuad},$Opacity:2,$Shift:200}},
	  {$Duration:1500,$Zoom:11,$Rotate:0.5,$During:{$Left:[0.4,0.6],$Top:[0.4,0.6],$Rotate:[0.4,0.6],$Zoom:[0.4,0.6]},$Easing:{$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$InQuad},$Opacity:2,$Brother:{$Duration:1000,$Zoom:1,$Rotate:-0.5,$Easing:{$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$InQuad},$Opacity:2,$Shift:200}},
	  {$Duration:1500,x:0.3,$During:{$Left:[0.6,0.4]},$Easing:{$Left:$Jease$.$InQuad,$Opacity:$Jease$.$Linear},$Opacity:2,$Outside:true,$Brother:{$Duration:1000,x:-0.3,$Easing:{$Left:$Jease$.$InQuad,$Opacity:$Jease$.$Linear},$Opacity:2}},
	  {$Duration:1200,x:0.25,y:0.5,$Rotate:-0.1,$Easing:{$Left:$Jease$.$InQuad,$Top:$Jease$.$InQuad,$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$InQuad},$Opacity:2,$Brother:{$Duration:1200,x:-0.1,y:-0.7,$Rotate:0.1,$Easing:{$Left:$Jease$.$InQuad,$Top:$Jease$.$InQuad,$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$InQuad},$Opacity:2}},
	  {$Duration:1600,x:1,$Rows:2,$ChessMode:{$Row:3},$Easing:{$Left:$Jease$.$InOutQuart,$Opacity:$Jease$.$Linear},$Opacity:2,$Brother:{$Duration:1600,x:-1,$Rows:2,$ChessMode:{$Row:3},$Easing:{$Left:$Jease$.$InOutQuart,$Opacity:$Jease$.$Linear},$Opacity:2}},
	  {$Duration:1600,x:1,$Rows:2,$ChessMode:{$Row:3},$Easing:{$Left:$Jease$.$InOutQuart,$Opacity:$Jease$.$Linear},$Opacity:2,$Brother:{$Duration:1600,x:-1,$Rows:2,$ChessMode:{$Row:3},$Easing:{$Left:$Jease$.$InOutQuart,$Opacity:$Jease$.$Linear},$Opacity:2}},
	  {$Duration:1600,y:-1,$Cols:2,$ChessMode:{$Column:12},$Easing:{$Top:$Jease$.$InOutQuart,$Opacity:$Jease$.$Linear},$Opacity:2,$Brother:{$Duration:1600,y:1,$Cols:2,$ChessMode:{$Column:12},$Easing:{$Top:$Jease$.$InOutQuart,$Opacity:$Jease$.$Linear},$Opacity:2}},
	  {$Duration:1200,y:1,$Easing:{$Top:$Jease$.$InOutQuart,$Opacity:$Jease$.$Linear},$Opacity:2,$Brother:{$Duration:1200,y:-1,$Easing:{$Top:$Jease$.$InOutQuart,$Opacity:$Jease$.$Linear},$Opacity:2}},
	  {$Duration:1200,x:1,$Easing:{$Left:$Jease$.$InOutQuart,$Opacity:$Jease$.$Linear},$Opacity:2,$Brother:{$Duration:1200,x:-1,$Easing:{$Left:$Jease$.$InOutQuart,$Opacity:$Jease$.$Linear},$Opacity:2}},
	  {$Duration:1200,y:-1,$Easing:{$Top:$Jease$.$InOutQuart,$Opacity:$Jease$.$Linear},$Opacity:2,$ZIndex:-10,$Brother:{$Duration:1200,y:-1,$Easing:{$Top:$Jease$.$InOutQuart,$Opacity:$Jease$.$Linear},$Opacity:2,$ZIndex:-10,$Shift:-100}},
	  {$Duration:1200,x:1,$Delay:40,$Cols:6,$Formation:$JssorSlideshowFormations$.$FormationStraight,$Easing:{$Left:$Jease$.$InOutQuart,$Opacity:$Jease$.$Linear},$Opacity:2,$ZIndex:-10,$Brother:{$Duration:1200,x:1,$Delay:40,$Cols:6,$Formation:$JssorSlideshowFormations$.$FormationStraight,$Easing:{$Top:$Jease$.$InOutQuart,$Opacity:$Jease$.$Linear},$Opacity:2,$ZIndex:-10,$Shift:-100}},
	  {$Duration:1500,x:-0.1,y:-0.7,$Rotate:0.1,$During:{$Left:[0.6,0.4],$Top:[0.6,0.4],$Rotate:[0.6,0.4]},$Easing:{$Left:$Jease$.$InQuad,$Top:$Jease$.$InQuad,$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$InQuad},$Opacity:2,$Brother:{$Duration:1000,x:0.2,y:0.5,$Rotate:-0.1,$Easing:{$Left:$Jease$.$InQuad,$Top:$Jease$.$InQuad,$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$InQuad},$Opacity:2}},
	  {$Duration:1600,x:-0.2,$Delay:40,$Cols:12,$During:{$Left:[0.4,0.6]},$SlideOut:true,$Formation:$JssorSlideshowFormations$.$FormationStraight,$Assembly:260,$Easing:{$Left:$Jease$.$InOutExpo,$Opacity:$Jease$.$InOutQuad},$Opacity:2,$Outside:true,$Round:{$Top:0.5},$Brother:{$Duration:1000,x:0.2,$Delay:40,$Cols:12,$Formation:$JssorSlideshowFormations$.$FormationStraight,$Assembly:1028,$Easing:{$Left:$Jease$.$InOutExpo,$Opacity:$Jease$.$InOutQuad},$Opacity:2,$Round:{$Top:0.5}}}
	];

	var jssor_1_options = {
	  $AutoPlay: true,
	  $FillMode: 5,
	  $SlideshowOptions: {
	    $Class: $JssorSlideshowRunner$,
	    $Transitions: jssor_1_SlideshowTransitions,
	    $TransitionsOrder: 1
	  },
	  $BulletNavigatorOptions: {
	    $Class: $JssorBulletNavigator$
	  }
	};

	var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

	//responsive code begin
	//you can remove responsive code if you don't want the slider scales while window resizing
	function ScaleSlider() {
	    var refSize = jssor_1_slider.$Elmt.parentNode.clientWidth;
	    if (refSize) {
	        refSize = Math.min(refSize, 600);
	        jssor_1_slider.$ScaleWidth(refSize);
	    }
	    else {
	        window.setTimeout(ScaleSlider, 30);
	    }
	}
	ScaleSlider();
	$(window).bind("load", ScaleSlider);
	$(window).bind("resize", ScaleSlider);
	$(window).bind("orientationchange", ScaleSlider);
});
</script>