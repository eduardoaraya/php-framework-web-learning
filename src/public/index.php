<?php

$app = require __DIR__.'/../bootstrap/app.php';

$app->loadEnv();
$app->setURL();

$app->bootstrapRouter();
$app->router(
  'AssessmentBackendxp\App\Controllers\\',
  __DIR__.'/../routes/api.php'
)->load();