<?php 
if(!empty($data['errors'])){
  ?>
    <div class="alert alert-danger">
      <ul>
        <?php foreach($data['errors'] as $error): ?> 
          <li><?=$error['message']?></li> 
        <?php endforeach; ?>
      </ul>
    </div>
  <?php
}
if(!empty($data['success'])){
  ?>
      <div class="alert alert-success">
          <?=$data['success']?>
      </div>
  <?php
}