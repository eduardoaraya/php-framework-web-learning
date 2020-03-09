<?php

namespace AssessmentBackendxp\App\Controllers;

use AssessmentBackendxp\App\Controllers\Controller;
use AssessmentBackendxp\App\Models\Products;
use AssessmentBackendxp\App\Models\Categories;
use AssessmentBackendxp\App\Providers\Request;
use AssessmentBackendxp\App\Providers\Storage;

class ProductController extends Controller 
{

  public function __construct()
  {
    session_start();
  }

  public function store(Request $request)
  {
    try{
      // die(var_dump($request->toArray()));
      $validate = $this->validate([
        'name'        => 'required',
        'quantity'    => 'required',
        'price'       => 'required',
        'sku'         => 'required',
        'category_id' => 'required',
        'description' => 'required',
      ],$request->toArray());
        
      if($validate->hasError()){
        return $this->redirect('product/form?redirect=true',[
          'errors'  => $validate->errors(),
          'olds'    => $request->toArray()
        ]);
      }

      $data = $request->getRequest();
      $category = (new Categories)->find($data->category_id);

      $photo = URL.'assets/images/default.png';
      

      if($request->hasFiles('photo')){
        $validate_file = $request->validateFile('photo');
        if($validate_file['error'] === true)
          return $this->redirect('product/form?redirect=true',[
            'errors'  => [
              array('message' =>  $validate_file['message'] )
            ],
            'olds'    => $request->toArray()
          ]);
      }else{
        $photo = Storage::disk($request->files()['photo'],'products');
      }

      $product = new Products([
        'name'        => $data->name,
        'sku'         => $data->sku,
        'category_id' => $category->id,
        'price'       => (int) str_replace([',','.'],'',$data->price),
        'quantity'    => $data->quantity,
        'description' => $data->description,
        'photo'       => $photo
      ]);
      if(!$product){
        $error = array('message' => 'An error occurred while trying to register the product');
        return $this->redirect('product/form?redirect=true',[
          'error'   => [$error],
          'olds'    => $request->toArray()
        ]);
      }
      return $this->redirect('product/form?redirect=true',[
        'success' => 'Prodcut registred'
      ]);
    }catch(\Exception $e){
      return $this->view('500',[
        'message' => 'Error (500) Internal server error:: '.$e->getMessage()
      ]);
    }
  }

  public function update(Request $request)
  { 
    try{
     
      $validate = $this->validate([
        'id'          => 'required',
        'product_id'  => 'required',
        'name'        => 'required',
        'quantity'    => 'required',
        'price'       => 'required',
        'sku'         => 'required',
        'category_id' => 'required',
        'description' => 'required',
      ],$request->toArray());
        
      if($validate->hasError()){
        return $this->redirect('product/form?redirect=true',[
          'errors'  => $validate->errors(),
          'olds'    => $request->toArray()
        ]);
      }

      $data = $request->getRequest();
      $product = (new Products)->find($data->id);

      $photo = $product->photo;
      if($request->hasFiles('photo')){
        $validate_file = $request->validateFile('photo');
        if($validate_file['error'] === true)
          return $this->redirect('product/form?redirect=true',[
            'errors'  => [
              array('message' =>  $validate_file['message'] )
            ],
            'olds'    => $request->toArray()
          ]);
      }else{
        $photo = Storage::disk($request->files()['photo'],'products');
      }

      $category = (new Categories)->find($data->category_id);
      $product->update([
        'name'        => $data->name,
        'sku'         => $data->sku,
        'category_id' => $category->get()->id,
        'price'       => (int) str_replace([',','.'],'',$data->price),
        'quantity'    => $data->quantity,
        'description' => $data->description,
        'photo'       => $photo
      ]);

      if(!$product){
        $error = array('message' => 'An error occurred while trying to update the product');
        return $this->redirect('product/form?redirect=true',[
          'error'   => [$error],
          'olds'    => $request->toArray()
        ]);
      }

      return $this->redirect('product/form?redirect=true&_id='.$data->id ,[
        'success' => 'Product updated'
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
        return $this->redirect('?redirect=true',[
          'errors' => $validate->errors()
        ]);

      $product = (new Products)->delete($request->getRequest()->_id);
      return $this->redirect('?redirect=true',[
        'success' => 'Produtc deleted!'
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

      $products = (new Products())->allWitchCategories();
      if(!empty($request->getRequest()->redirect)){
        $success = $_SESSION['success'] ?? null;
        $errors = $_SESSION['errors'] ?? null;
      }
      return $this->view('products',[
       'products' => $products,
       'total'    => count($products),
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

      $categories = (new Categories())->all();

      if(!empty($request->getRequest()->_id)){
        $product = (new Products())->find($request->getRequest()->_id)->get();
        if(!$product)
          return $this->redirect('');

        return $this->view('form_product',[
          '_productId'  => $product->id ?? null,
          'values'      => (array) $product ?? [],
          'success'     => $success ?? null,
          'errors'      => $errors ?? null,
          'categories'  => $categories
        ]);
      }
      return $this->view('form_product',[
        'values'      => $olds ?? null,
        'errors'      => $_SESSION['errors'] ?? [],
        'success'     => $_SESSION['success'] ?? null,
        'categories'  => $categories
      ]);
    }catch(\Exception $e){
      return $this->view('500',[
        'message' => 'Error (500) Internal server error:: '.$e->getMessage()
      ]);
    }
  }
  


}