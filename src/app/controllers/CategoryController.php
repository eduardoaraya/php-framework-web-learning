<?php

namespace AssessmentBackendxp\App\Controllers;

use AssessmentBackendxp\App\Controllers\Controller;
use AssessmentBackendxp\App\Models\Categories;
use AssessmentBackendxp\App\Providers\Request;

class CategoryController extends Controller 
{

  public function __construct()
  {
    session_start();
  }

  public function store(Request $request)
  {
    try{
    
      $validate = $this->validate([
        'name'        => 'required',
      ],$request->toArray());
        
      if($validate->hasError()){
        return $this->redirect('category/form?redirect=true',[
          'errors'  => $validate->errors(),
          'olds'    => $request->toArray()
        ]);
      }

      $data = $request->getRequest();
      $category = new Categories([
        'name' => $data->name,
      ]);

      if(!$category){
        $error = array('message' => 'An error occurred while trying to register the category');
        return $this->redirect('category/form?redirect=true',[
          'errors'   => [$error],
          'olds'    => $request->toArray()
        ]);
      }
      return $this->redirect('category/form?redirect=true',[
        'success' => 'Category registred'
      ]);

    }catch(\Exception $e){
        die('Error (500) Internal server Error '.$e->getMessage());
    }
  }

  public function update($request)
  { 

    try{
    
      $validate = $this->validate([
        'id'     => 'required',
        'name'   => 'required',
      ],$request->toArray());
        
      if($validate->hasError()){
        return $this->redirect('category/form?redirect=true',[
          'errors'  => $validate->errors(),
          'olds'    => $request->toArray()
        ]);
      }

      $data = $request->getRequest();
      $category = (new Categories)->find($data->id);
      $category->update([
        'name' => $data->name,
      ]);

      if(!$category){
        $error = array('message' => 'An error occurred while trying to register the category');
        return $this->redirect('category/form?redirect=true',[
          'errors'   => [$error],
          'olds'    => $request->toArray()
        ]);
      }
      return $this->redirect('category/form?redirect=true&_id='.$data->id,[
        'success' => 'Category updated'
      ]);

    }catch(\Exception $e){
      return $this->view('500',[
        'message' => 'Error (500) Internal server error:: '.$e->getMessage()
      ]);
    }
  }

  public function delete(Request $request)
  {
    try{

      $validate = $this->validate([
        '_id' => 'required',
      ],$request->toArray());

      if($validate->hasError())
        return $this->redirect('categories?redirect=true',[
          'errors' => $validate->errors()
        ]);

      $product = (new Categories)->delete($request->getRequest()->_id);
      return $this->redirect('categories?redirect=true',[
        'success' => 'Category deleted'
      ]);
    }catch(\Exception $e){
      return $this->view('500',[
        'message' => 'Error (500) Internal server error:: '.$e->getMessage()
      ]);
    }
  }

  public function list(Request $request)
  {
    try{
      $categories = (new Categories())->all();
      if(!empty($request->getRequest()->redirect)){
        $success = $_SESSION['success'] ?? null;
        $errors = $_SESSION['errors'] ?? null;
      }
      return $this->view('categories',[
       'categories' => $categories,
       'total'    => count($categories),
       'success'  => $success ?? null,
       'errors'   => $errors ?? null
      ]);
    }catch(\Exception $e){
      return $this->view('500',[
        'message' => 'Error (500) Internal server error:: '.$e->getMessage()
      ]);
    }
  }

  public function formRegister(Request $request)
  { 
    try{

      if(!empty($request->getRequest()->redirect)){ 
        session_destroy();
        $success = $_SESSION['success'] ?? null;
        $errors = $_SESSION['errors'] ?? null;
        $olds = $_SESSION['olds'] ?? null;
      }

      if(!empty($request->getRequest()->_id)){
        $category = (new Categories())->find($request->getRequest()->_id)->get();
        if(!$category)
          return $this->redirect('');
        
        return $this->view('form_categorie',[
          '_categoryId'  => $category->id ?? null,
          'values'      => (array) $category ?? [],
          'success'     => $success ?? null,
          'errors'      => $errors ?? null
        ]);
      }
      return $this->view('form_categorie',[
        'values'      => $olds ?? null,
        'errors'      => $_SESSION['errors'] ?? [],
        'success'     => $_SESSION['success'] ?? null,
      ]);
    }catch(\Exception $e){
      return $this->view('500',[
        'message' => 'Error (500) Internal server error:: '.$e->getMessage()
      ]);
    }
  }
  
}