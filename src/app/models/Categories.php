<?php

namespace AssessmentBackendxp\App\Models;

class Categories extends Model 
{

    protected $table = 'categories';
    protected $fillable = array('name');

    public function __construct($data = null)
    {
      parent::__construct($data);
    }

  
}