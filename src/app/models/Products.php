<?php

namespace AssessmentBackendxp\App\Models;

class Products extends Model 
{

    protected $table = 'products';
    protected $fillable = array(
      'name',
      'sku',
      'category_id',
      'price',
      'quantity',
      'description',
      'photo',
      'created_at'
    );

    public function __construct($data = null)
    {
      parent::__construct($data);
    }

    public function allWitchCategories()
    {
      return $this->db->connection()->query("
      SELECT products.* , 
        categories.name as categorie_name 
      FROM 
        {$this->table} 
      INNER JOIN categories 
        ON {$this->table}.category_id = categories.id"
      )->fetchAll();
    }

    public function recents($number)
    {
      return $this->db->connection()->query("
      SELECT products.* , 
        categories.name as categorie_name 
      FROM 
        {$this->table} 
      INNER JOIN categories 
        ON {$this->table}.category_id = categories.id
        ORDER BY products.created_at DESC LIMIT {$number}"
      )->fetchAll();
      return $this;
    }

    public function chartGenerate()
    {
      return $this->db->connection()->query("
        SELECT SUM(quantity) AS total,
        month(created_at) as month
        FROM 
          products
        GROUP BY month(created_at)"
      )->fetchAll();
    }


    public function totalOfCategory()
    {
      return $this->db->connection()->query("
        SELECT SUM(1) AS total,
        month(products.created_at) as month,
        categories.name as categorie_name,
        categories.id
        FROM 
          products
        INNER JOIN categories 
          ON {$this->table}.category_id = categories.id
        GROUP BY category_id"
      )->fetchAll();
    }
  
}