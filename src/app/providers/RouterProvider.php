<?php

namespace AssessmentBackendxp\App\Providers;

use AssessmentBackendxp\App\Providers\Request;

class RouterProvider 
{
  
  public $routes = [];
  private $app;
  private $parameter = null;

  public function __construct($app)
  {
    $this->app = $app;
    if(empty($_SERVER['REQUEST_METHOD'])){
      die("Not request");
    }
  }

  public function group($namespace)
  {
      $this->namespace = $namespace;
  }

  public function init($path)
  {
    $router = $this;
    require $path;
  }

  public function addRoute(array $route)
  {   
      return $this->routes[$route['method'].'::'.$route['path']] = $route;
  }

  public function request($handler)
  {
    if($_SERVER['REQUEST_METHOD'] !== $handler['method'])
      die('Error (405) Method not alowad');

    // if($_SERVER['REQUEST_METHOD'] === 'GET'){
    //   preg_match_all('/\{.*?\}/',$_SERVER['REQUEST_URI'],$result);
    //   $this->parameter = $result;
    // }
    return [(new Request($_REQUEST))];
  }

  public function load()
  {     
      if(empty($_SERVER['PATH_INFO']))
        $_SERVER['PATH_INFO'] = '/';
      
      $handler = $this->routes[$_SERVER['REQUEST_METHOD'].'::'.$_SERVER['PATH_INFO']] ?? null;
      if($handler){
          return $this->handleCallback($handler);
      }else{
        $path_view = '404.php';
        require __DIR__.'/../../views/layout.php';
        return;
      }
  }

  public function instanceController($className)
  {
      $Class = $this->namespace.$className;
      return new $Class;
  }

  public function formatCallback($callback)
  {
    $call = explode('@',$callback);
    if(is_array($call) AND count($call) === 2)  
      return [
        'Controller' => $this->instanceController($call[0]),
        'Method'     => $call[1]
      ];

    return $callback;
  }

  public function handleCallback($handler)
  {    
    
      $methodController = $this->formatCallback($handler['callback']);
      return call_user_func_array([
          $methodController['Controller'],
          $methodController['Method']
        ],
        $this->request($handler) 
      );
      return call_user_func_array($handler['callback'],$this->request($handler));
  }

  public function get($params,$call)
  {
    $this->addRoute([
      'method' => 'GET',
      'path' => $params,
      'callback' => $call
    ]);
    return $this;
  }

  public function post($params,$call)
  {
    $this->addRoute([
      'method'=>'POST',
      'path' => $params,
      'callback' => $call
    ]);
    return $this;
  }

  public function put($params,$call)
  {
    $this->addRoute([
      'method' => 'PUT',
      'path' => $params,
      'callback' => $call
    ]);
    return $this;
  }

  public function delete($params,$call)
  {
    $this->addRoute([
      'method' => 'DELETE',
      'path' => $params,
      'callback' => $call
    ]);
    return $this;
  }

}

