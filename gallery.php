<?php
$cat = isset($_GET['cat'])?$_GET['cat']:'';
?>
<div class="row">
    <div class="container">
        <div class="col s12">
            <h3 class="center">
                <?php
                    if($cat == 'product'){
                        echo "PRODUCT GALLERY";
                    }elseif($cat == 'project'){
                        echo "PROJECT GALLERY";
                    }else{
                        echo "PRODUCT GALLERY";
                    }
                ?>
            </h3>
        </div>
        <div class="col s12">
        <?php
        if(isset($_GET['detail'])){
            include 'gallery-detail.php';
        }else{
            include 'gallery-home.php';
        }
        ?>
        </div>
    </div>
</div>