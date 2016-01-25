<?php
$cat = isset($_GET['cat'])?$_GET['cat']:'';
?>
<div class="row">
    <div class="container">
        <div class="col s12">
            <h3 class="center">
                PROJECT GALLERY
            </h3>
        </div>
        <div class="col s12">
        <?php
        if(isset($_GET['detail'])){
            include 'detailgallery.php';
        }else{
            include 'homegallery.php';
            
        }
        ?>
        </div>
    </div>
</div>