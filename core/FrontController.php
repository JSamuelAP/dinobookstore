<?php
function my_autoloader(string $name)
{
  require 'core/' . $name . '.php';
}
spl_autoload_register('my_autoloader');

class FrontController
{
  static function main()
  {
    require './config.php';

    $controller = $config->get('DEFAULT_CONTROLLER');
    if (!empty($_GET['controller']))
      $controller = $_GET['controller'];

    $action = $config->get('DEFAULT_ACTION');
    if (!empty($_GET['action']))
      $action = $_GET['action'];

    $controller .= "_Controller";
    $controller_path = $config->get('CONTROLLERS_FOLDER') . $controller . '.php';
    if (!is_file($controller_path))
      throw new Exception("The " . $controller_path . " controller doesn't exists - 404 not found");

    require $controller_path;

    if (!method_exists($controller, $action))
      throw new Exception($controller . "->" . $action . " doesn't exist - 404 not found");

    $controller = new $controller();
    $controller->$action();
  }
}
