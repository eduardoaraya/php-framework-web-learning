<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?=getenv('APP_NAME')?></title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="<?=URL?>assets/css/custom.css">
  <link rel="icon" type="imagem/png" href="<?=URL?>assets/images/go-logo.png" />
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>
</head>
<body class="bg-default">
  <header class="shadow-sm">
      <nav class="navbar navbar-light bg-info">
        <div class="container p-2">
          <img src="<?=URL?>assets/images/go-jumpers.png" alt="logo" width="150px">
          <nav>
            <ul class="nav">
                <li class="nav-item">
                  <a class="nav-link active text-white" href="<?=URL?>">Products</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-white" href="<?=URL?>categories">Categories</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-white" href="<?=URL?>dashboard">Dashboard</a>
                </li>
              </ul>
          </nav>
        </div>
      </nav>
  </header>
  <div class="banner">
  </div>
  <main class="container shadow-sm p-5 bg-white">
      <?php include __DIR__.DIRECTORY_SEPARATOR.$path_view ?> 
  </main>
  <footer class="bg-dark p-2 mt-5">
    <div class="container p-2">
      <div class="row d-flex flex-row justify-content-between">
        <div class="col-2">
            <nav>
              <ul class="nav d-flex flex-column">
                <li><img  class="logo-footer" src="<?=URL?>assets/images/go-logo.png" alt="logo" width="50px"></li>
                <li class="nav-item">
                  <a class="nav-link active text-white" href="<?=URL?>">Produtos</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-white" href="<?=URL?>categories">Categories</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-white" href="<?=URL?>categories">Logs</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-white" href="<?=URL?>dashboard">Dashboard</a>
                </li>
              </ul>
          </nav>
        </div>
        <div class="col-4">
            <nav class="info-footer">
                <ul class="nav">
                <li class="nav-item">
                  <p class="text-white mr-3">
                  Copyright © <?=Date('Y')?> all rights reserved </p>
                </li>
                <li>
                <!-- <a class="nav-link active text-white" target="_blank" href="https://github.com/eduardoaraya">
                    <svg class="octicon octicon-mark-github v-align-middle" height="32" viewBox="0 0 16 16" version="1.1" width="32" aria-hidden="true"><path fill-rule="evenodd" d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.013 8.013 0 0016 8c0-4.42-3.58-8-8-8z"></path></svg>
                    Eduardo Araya</a>
                </li> -->
              </ul>
          </nav>
        </div>
      </div>
    </div>
  </footer>
  <script src="https://kit.fontawesome.com/d5650edc64.js" crossorigin="anonymous"></script>
</body>
</html>