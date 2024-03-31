<?php
abstract class Base_Model
{
  protected PDO $db;

  public function __construct()
  {
    $this->db = DBManager::getInstance()->getConnection();
  }
}
