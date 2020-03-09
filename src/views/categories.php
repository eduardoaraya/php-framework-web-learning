<div class="row p-1">
  <h4 class="col-9 mt-5">Categories</h4>
  <button type="button" onClick="document.location.href='<?=URL?>category/form'" class="col-3 mt-5 btn btn-info btn-lg"><i class="fas fa-plus"></i> Add Category</button>
  <small class="col-12">Amount categories registred: <?= $data['total'] ?? 0 ?></small>
</div>
<div class="row mt-5 p-1">
  <div class="col-12">
    <?php require __DIR__."/components/alerts.php" ?>
  </div>
  <div class="col-12">
      <table class="table ">
        <thead>
          <tr>
            <th scope="col" class="text-left">Code</th>
            <th scope="col">Name</th>
            <th scope="col" class="text-right">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($data['categories'] as $category): ?>
          <tr>
            <td class="text-left"><?=$category['id']?></td>
            <td><?=$category['name']?></td>
            <td class="d-flex flex-row justify-content-end">
              <a href="<?=URL.'category/form?_id='.$category['id']?>"  class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
              <a href="#" onClick="confirmDelet(<?=$category['id']?>)" class="delete btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
  </div>
</div>
<script>
   function confirmDelet(id) {
        const delet = confirm('Do you really want to delete this category?')
        if(delet){
          document.location.href = "<?=URL.'category/delete?_id='?>" + id
        }
   }
</script>