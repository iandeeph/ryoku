<div class="row">
    <div class="col s12 center">
        <h3 class="black-text">GALLERY</h3>
    </div>
    <div class="container">
        <!-- LIST OF ALBUMS -->
        <div class="row">
            <?php
                if (isset($_GET['album'])){
                    include 'gallery-detail.php';
                }else{
                    include 'gallery-home.php';
                }
            ?>
        </div>
    </div>
</div>