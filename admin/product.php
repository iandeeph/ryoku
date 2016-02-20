<div class="row">
    <?php
        switch ($cat) {
          case 'list':
            include 'product-list.php';
            break;

          case 'brand':
            include 'product-brand.php';
            break;

          default:
            include 'product-list.php';
            break;
        }
    ?>
</div>