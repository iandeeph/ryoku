<div class="row">
    <?php
        switch ($cat) {
          case 'list':
            include 'project-list.php';
            break;

          case 'experience':
            include 'project-experience.php';
            break;

          default:
            include 'project-experience.php';
            break;
        }
    ?>
</div>