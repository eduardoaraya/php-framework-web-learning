<div class="row p-1">
  <h4 class="col-9 mt-5">Produtos</h4>
  <button type="button" onClick="document.location.href='<?=URL?>product/form'" class="col-3 mt-5 btn btn-info btn-lg"><i class="fas fa-plus"></i> Add Product</button>
  <small class="col-12">Amount products registred: <?= $data['total'] ?? 0 ?></small>
</div>
<div class="row mt-5 p-1">
  <div class="col-12">
    <?php require __DIR__."/components/alerts.php" ?>
  </div>
  <div class="col-12">
      <table class="table ">
        <thead>
          <tr>
            <th scope="col">Code</th>
            <th scope="col">Name</th>
            <th scope="col">SKU</th>
            <th scope="col" class="text-center">Price</th>
            <th scope="col" class="text-center">Quantity</th>
            <th scope="col" class="text-center">Category</th>
            <th scope="col" class="text-center">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($data['products'] as $product): ?>
          <tr>
            <td><?=$product['id']?></td>
            <td><?=$product['name']?></td>
            <td><?=$product['sku']?></td>
            <td class="text-center">R$ <?=number_format( $product['price'] / 100, 2,',','.')?></td>
            <td class="text-center"><?= $product['quantity'] ?></td>
            <td class="text-center"><?=$product['categorie_name']?></td>
            <td class="d-flex flex-row justify-content-center">
              <a href="<?=URL.'product/form?_id='.$product['id']?>"  class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
              <a href="#" onClick="confirmDelet(<?=$product['id']?>)" class="delete btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
  </div>
</div>
<script>
   function confirmDelet(id) {
        const delet = confirm('Do you really want to delete this product?')
        if(delet){
          document.location.href = "<?=URL.'product/delete?_id='?>" + id
        }
   }
</script>