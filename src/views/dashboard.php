<div class="row mt-5">
    <div class="col-12">
      <canvas id="myChart" height="100px"></canvas>
    </div>
</div>
<div class="row mt-5">
    <div class="col-12">
      <canvas id="myChart2" height="100px"></canvas>
    </div>
</div>
<div class="p-5">
  <h3 class='mt-5'>Last products registed</h3>
  <div class="row d-flex align-items-stretch justfy-content-center">
    <?php foreach($data['products_recents'] as $product): ?>
        <div class="col-4 d-flex mt-5">
            <div class="card align-self-stretch" style="width: 18rem;">
              <img src="<?=$product['photo']?>"  class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title"><?=$product['name']  ?? ''?></h5>
                <small><?=$product['categorie_name']  ?? ''?></small>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content<?=$product['description'] ?? ''?>.</p>
                <strong class="text-success">R$ <?=number_format( $product['price'] / 100, 2,',','.')?></strong>
              </div>
            </div>
        </div>
    <?php endforeach; ?>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script>
(function loadChart1(){
  const totalProductsByMonth = <?=$data['chart']?>;
  const ctx1 = document.getElementById('myChart').getContext('2d');
  const data = totalProductsByMonth.map(item => item.total)
  const chart = new Chart(ctx1, {
      type: 'line',
      data: {
          labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
          datasets: [{
              label: 'Total products in stock registred by month',
              backgroundColor: 'rgb(255, 99, 132)',
              borderColor: 'rgb(255, 99, 132)',
              data
          }]
      },
      options: {}
  });
})();

(function loadChart2(){
  const totalOfCategory = <?=$data['totalOfCategory']?>;
  const ctx2 = document.getElementById('myChart2').getContext('2d');
  const labels = totalOfCategory.map(cat => cat.categorie_name);
  const data = totalOfCategory.map(total => total.total);
  
  console.log(labels,data);
  const chart2 = new Chart(ctx2, {
      type: 'bar',
      data: {
          labels,
          datasets: [{
             label: 'Total of category by product',
              backgroundColor: 'rgb(155, 99, 132)',
              borderColor: 'rgb(55, 99, 132)',
              data
          }]
      },
      options: {}
  });
})();

</script>