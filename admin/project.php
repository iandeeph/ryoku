<div class="row">
    <?php
        switch ($cat) {
          case 'list':
            include 'project-list.php';
            break;

          case 'client':
            include 'project-client.php';
            break;

          default:
            include 'project-list.php';
            break;
        }
    ?>
</div>