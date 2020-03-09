<?php

namespace AssessmentBackendxp\App\Controllers;

use AssessmentBackendxp\App\Controllers\Controller;
use AssessmentBackendxp\App\Models\Categories;
use AssessmentBackendxp\App\Models\Products;
use AssessmentBackendxp\App\Providers\Request;

class DashboardController extends Controller 
{

  public function __construct()
  {
  }

  public function index()
  {
    try{
      $products_recents = (new Products())->recents(3);
      $chart = (new Products())->chartGenerate();
      $totalOfCategory = (new Products())->totalOfCategory();
      return $this->view('dashboard',[
        'products_recents' => $products_recents,
        'chart'            => json_encode($chart),
        'totalOfCategory'  => json_encode($totalOfCategory),
      ]);
    }catch(\Exception $e){
      return $this->view('500',[
        'message' => $e->getMessage()
      ]);
    }
  }
  
}