<?php $action = (!empty($data['_productId'])) ? URL."product/update" : URL."product/store" ?>
<div class="row p-1">
  <h4 class="col-12">Product <?php if(!empty($data['_productId'])): echo 'Update'; else: echo 'Register'; endif;?></h4>
</div>
<?php include __DIR__.'/components/alerts.php' ?>
<div class="row mt-5 p-1">
  <div class="col-12">
  <form action="<?=$action?>" method="POST" enctype="multipart/form-data">
  <input type="hidden" value="<?= $data['_productId'] ?? '' ?>" name="id">
   <div class="row">
    <div class="col-6">
      <div class="row">
        <div class="form-group col-12">
            <labe>Product SKU</label>
            <input type="text" class="form-control" value="<?=$data['values']['sku'] ?? null ?>" name="sku" aria-describedby="emailHelp">
          </div>
      </div>
      <div class="row">
        <div class="form-group col-12">
            <label>Product Name</label>
            <input type="text" class="form-control" value="<?=$data['values']['name'] ?? ''?>" name="name" aria-describedby="emailHelp">
          </div>
      </div>
      <div class="row">
        <div class="form-group col-12">
            <label>Product Price</label>
            <input type="text" class="form-control" id="price" value="<?=$data['values']['price'] ?? ''?>" name="price" aria-describedby="emailHelp">
          </div>
      </div>
      <div class="row">
        <div class="form-group col-12">
            <img src="<?=$data['values']['photo'] ?? URL.'assets/images/default.png' ?>" id="previewImg" alt="..." class="img-thumbnail">
            <label>Picture</label>
            <input type="file" class="form-control-file" id="input_pic" value="<?=$data['values']['photo'] ?? ''?>" name="photo">
          </div>
      </div>
    </div>
    <div class="col-6">
    <div class="row">
        <div class="form-group col-12">
            <label>Product Categories</label>
            <select name="category_id" value="<?=$data['values']['category_id'] ?? ''?>" class="form-control form-control-sm">
              <?php foreach( $data['categories'] as $categorie ): ?>
                <option value="<?=$categorie['id']?>" ><?=$categorie['name']?></option>
              <?php endforeach; ?>
            </select>
          </div>
      </div>
      <div class="row">
        <div class="form-group col-12">
          <div class="form-group">
            <label>Quantity</label>
            <input type="number" value="<?=$data['values']['quantity'] ?? ''?>" name="quantity"  min="0" class="form-control"  aria-describedby="emailHelp">
            </div>
          </div>
      </div>
      <div class="row">
        <div class="form-group col-12">
          <div class="form-group">
            <label>Product Description</label>
              <textarea  class="form-control" name="description" rows="3"><?=$data['values']['description'] ?? ''?></textarea>
            </div>
          </div>
      </div>
      <div class="row">
        <div class="form-group col-12 d-flex flex-row-reverse">
            <button type="submit" class="btn btn-primary right">Submit</button>
          </div>
      </div>
    </div>
   </div>
  </form>
  </div>
</div>

<script>
$(document).ready(function(){
  $('#price').mask('0000,00');
})
</script>
<script>
    const pic = document.getElementById('input_pic');
    pic.addEventListener('change',preview);
    function preview({target}){
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