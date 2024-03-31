<?php
class DBManager
{
  private static ?DBManager $instance = null;
  private ?PDO $db = null;

  private function __construct()
  {
  }

  public static function getInstance(): DBManager
  {
    if (is_null(self::$instance)) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  public function getConnection(): PDO
  {
    if (is_null($this->db)) {
      $config = Config::getInstance();
      $host = $config->get('dbhost');
      $dbname = $config->get('dbname');
      $dbuser = $config->get('dbuser');
      $dbpass = $config->get('dbpass');

      $this->db = new PDO("mysql:host=$host;dbname=$dbname", $dbuser, $dbpass);
      $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }

    return $this->db;
  }
}
