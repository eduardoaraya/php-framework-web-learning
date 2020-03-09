<?php

namespace AssessmentBackendxp\App\Controllers;

abstract class Controller
{ 

    private $errorsMessage = array();
    private $has_error = false;

    public function view(string $path_view,$data = null)
    { 
      $path_view = $path_view.'.php';
      require __DIR__.'/../../views/layout.php';
      return $this;
    }  

    public function redirect($route,$data = null)
    {   
      if(!empty($data)){
        session_start();
        session_name(URL);
        $_SESSION = $data;
      }
      $url = URL.$route;
      header("Location: {$url}");
    }

    public function errors()
    {
      return $this->errorsMessage;
    }

    public function hasError()
    {
      return $this->has_error;
    }

    public function validate($params,$request)
    {
        $this->has_error = false;
        foreach($params as $key => $res){
          if( $params[$key] === 'required' && !$request[$key] ){
              $this->has_error = true;
              $capitalize = ucfirst($key);
              array_push($this->errorsMessage,[
                'message' => "<strong>{$capitalize}</strong> is required",
                'name' => $key
              ]);
          }
        }

        return $this;
    }
}