<?php
class Config
{
  private array $vars;
  private static $instance;

  private function __construct()
  {
    $this->vars = array();
  }

  public function set(string $name, $value)
  {
    if (!isset($this->vars[$name]))
      $this->vars[$name] = $value;
  }

  public function get(string $name)
  {
    if (isset($this->vars[$name]))
      return $this->vars[$name];
  }

  public static function getInstance(): Config
  {
    if (!isset(self::$instance)) {
      $class = __CLASS__;
      self::$instance = new $class();
    }
    return self::$instance;
  }
}
