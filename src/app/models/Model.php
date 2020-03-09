<?php

namespace AssessmentBackendxp\App\Models;

use AssessmentBackendxp\Database\Database;
use PDO;

abstract class Model {

  protected $db;
  private $data;
  
  public function __construct($create = null)
  {
    $this->db = new Database();
    $this->db->config();
    if(!empty($create) && is_array($create)){
      $this->create($create);
    }
  } 

  public static function requestFormatString($request,$fillable)
  {   
      $data = self::requestFormatArray($request,$fillable);
      return implode(',',array_map(function($req) {
          return "'{$req}'";
      },$data));
  }

  public static function requestFormatArray($request,$fillable)
  {   
      $data = array();
      foreach($fillable as $column){
        if(empty($request[$column]))
          throw new \Exception('Fillable is null: $fillable["'.$column.'"]');
        $data[] = $request[$column];
      }
      return $data;
  }

  public function create($data)
  {
    $data['created_at'] = Date('Y-m-d h:i:s');
    return $this->db->connection()->prepare("
      INSERT INTO {$this->table} (".implode(',',$this->fillable).")
      VALUES (".self::requestFormatString($data,$this->fillable).")
    ")->execute();
  }

  public function find($id)
  {
      $result = $this->db->connection()->query("
          SELECT * FROM {$this->table} WHERE id='{$id}'
      ",PDO::FETCH_ASSOC)->fetch();
      
      if(!$result){
        throw new \Exception("{$this->table} not found by ID:". $id);
      }
      $this->data = $result;
      return $this;
  }


  public function delete($id)
  {
    return $this->db->connection()->prepare("
       DELETE FROM {$this->table} WHERE id='{$id}'
    ")->execute();
  }

  public function update($data)
  {
    $fillable = implode(', ',array_map(function($row){
      return $row.'=?';
    },$this->fillable));
    return $this->db->connection()->prepare("
        UPDATE {$this->table} SET {$fillable} WHERE id='{$this->data['id']}'
    ")->execute(self::requestFormatArray($data,$this->fillable));
  }

  public function get()
  {
    return $this->data;
  }

  public function __get($propoty)
  {
    if(method_exists($this,$propoty)){
      return call_user_func([$this,$propoty],null);
    }
    if(!empty($this->data) && !empty($this->data[$propoty])){
      return $this->data[$propoty];
    }
  }

  public function All()
  {
    return $this->db->connection()->query("SELECT * FROM {$this->table}")->fetchAll();
  }

}