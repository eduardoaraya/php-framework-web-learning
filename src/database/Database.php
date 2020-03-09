<?php

namespace AssessmentBackendxp\Database;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\DBAL\DriverManager;

use PDO;

class Database {

  private $conn;
  
  public function config()
  {
    try{
      $this->conn = new PDO($this->getURI(),getenv('DB_USERNAME'),getenv('DB_PASSWORD'),
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
      );
    }catch(\PDOException $e){
      die('Server Error');
    }
    return $this;
  }

  private function getURI()
  {
    return getenv('DB_DRIVER').':host='.getenv('DB_HOST').';dbname='.getenv('DB_NAME');
  }

  function connection()
  { 
    return $this->conn;
  }

}

