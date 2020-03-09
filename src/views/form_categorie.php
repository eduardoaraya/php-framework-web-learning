<?php $action = (!empty($data['_categoryId'])) ? URL."category/update" : URL."category/store" ?>
<div class="row p-1">
  <h4 class="col-12">Category <?php if(!empty($data['_categoryId'])): echo 'Update'; else: echo 'Register'; endif;?></h4>
</div>
<?php include __DIR__.'/components/alerts.php' ?>
<div class="row mt-5 p-1">
  <div class="col-12">
  <form action="<?=$action?>" method="POST" enctype="multipart/form-data">
  <input type="hidden" value="<?= $data['_categoryId'] ?? '' ?>" name="id">
   <div class="row">
    <div class="col-12">
      <div class="row">
        <div class="form-group col-12">
            <labe>Name</label>
            <input type="text" class="form-control" value="<?=$data['values']['name'] ?? null ?>" name="name" aria-describedby="emailHelp">
          </div>
      </div>
      <div class="row">
        <div class="form-group col-12 d-flex flex-row-reverse">
            <button type="submit" class="btn btn-primary right">Submit</button>
          </div>
      </div>
    </div>
  </form>
  </div>
</div>
<script>
    const pic = document.getElementById('input_pic');
    pic.addEventListener('change',preview);

    function preview({target}){
      console.log(target.files);
      const img = document.getElementById('previewImg');
      if(target.files && target.files[0]){
        const reader = new FileReader();
        reader.onload = function(res) {
            img.setAttribute('src',res.target.result)
        };
        reader.readAsDataURL(target.files[0]);
      }
    }
</script>