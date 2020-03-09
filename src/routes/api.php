<?php

$router->get('/dashboard','DashboardController@index');

$router->get('/','ProductController@list');
$router->get('/product/delete','ProductController@delete');
$router->get('/product/form','ProductController@formRegister');
$router->post('/product/store','ProductController@store');
$router->post('/product/update','ProductController@update');

$router->get('/categories','CategoryController@list');
$router->get('/category/delete','CategoryController@delete');
$router->get('/category/form','CategoryController@formRegister');
$router->post('/category/store','CategoryController@store');
$router->post('/category/update','CategoryController@update');


// Router::group([
//   #< Products ------------------------------------
//   [
//     'method'    => 'GET',
//     'path'      => '/',
//     'callback'  => 'ProductController@list'
//   ],
//   [
//     'method'    => 'POST',
//     'path'      => '/product/store',
//     'callback'  => 'ProductController@store'
//   ],
//   [
//     'method'    => 'PUT',
//     'path'      => '/product/{id}',
//     'callback'  => 'ProductController@update'
//   ],
//   [
//     'method'    => 'GET',
//     'path'      => '/product/{id}',
//     'callback'  => 'ProductController@get'
//   ],
//   [
//     'method'    => 'DELETE',
//     'path'      => '/product/{id}',
//     'callback'  => 'ProductController@delete'
//   ],  
//   #End products ----------------------------------/>
//   #< Categories -----------------------------------
//   [
//     'method'    => 'GET',
//     'path'      => '/categories',
//     'callback'  => 'CategoryController@list'
//   ],
//   [
//     'method'    => 'POST',
//     'path'      => '/category/store',
//     'callback'  => 'CategoryController@store'
//   ],
//   [
//     'method'    => 'PUT',
//     'path'      => '/category/{id}',
//     'callback'  => 'CategoryController@update'
//   ],
//   [
//     'method'    => 'GET',
//     'path'      => '/category/{id}',
//     'callback'  => 'CategoryController@get'
//   ],
//   [
//     'method'    => 'DELETE',
//     'path'      => '/category/{id}',
//     'callback'  => 'CategoryController@delete'
//   ],
//   #End categories ---------------------------------/>
// ]);