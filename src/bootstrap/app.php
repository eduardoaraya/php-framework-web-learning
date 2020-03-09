<?php 

namespace AssessmentBackendxp\Bootstrap;

use AssessmentBackendxp\App\Providers\RouterProvider; 
use Dotenv\Dotenv;

class App {

  private $url = null;
  private $dotenv;

  public $router;

  public function __construct()
  {
    require_once __DIR__."/../vendor/autoload.php";
  }

  public function loadEnv()
  {
    $this->dotenv = Dotenv::createImmutable(__DIR__.'../../');
    $this->dotenv->load();
  }

  public function setURL()
  {
    $this->url = getenv('HOST').':'.getenv('PORT').'/';
    define("URL",$this->url);
  }

  public function bootstrapRouter()
  {
      $this->router = new RouterProvider($this);
  }

  public function router($namespace,$path_router)
  {
     $this->router->group($namespace);
     $this->router->init($path_router);
     return $this->router;
  }

}

return new App();
