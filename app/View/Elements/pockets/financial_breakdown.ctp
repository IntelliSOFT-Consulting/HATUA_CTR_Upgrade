<?php
  $pocket = $this->requestAction(
    '/pockets/view/1'
  );
?>
<div class="well">
  <?php
    echo $pocket['Pocket']['content'];
  ?>
</div>
