<?php

namespace AssessmentBackendxp\App\Providers;

use AssessmentBackendxp\App\Providers\Storage;

class Request
{

    private $request;
    private $files = [];

    public function __construct($request)
    {
        $this->request = (object) $request;
    } 

    public function getRequest()
    {
      return $this->request;
    }

    public function files()
    {
      return $_FILES;
    }

    public function hasFiles($index)
    {
       if(empty($this->files()[$index]) || $this->files()[$index]['error'] !== 0)
        return false;

      return true;
    }

    public function toArray() : array
    {
      return (array) $this->request;
    }

    public function validateFile($index)
    {
        return Storage::validate($this->files()[$index]);
    }

}

