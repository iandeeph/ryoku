<div class="row">
    <?php
        switch ($cat) {
          case 'engineering':
            include 'project-list.php';
            break;

          case 'civil':
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