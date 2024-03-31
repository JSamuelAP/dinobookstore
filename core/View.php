<?php
class View
{
  public function show(string $name, $vars = array())
  {
    $config = Config::getInstance();
    $path = $config->get('VIEWS_FOLDER') . $name;

    if (!file_exists($path))
      throw new Exception("The '.$path.' template doesn't exists");

    if (is_array($vars)) {
      foreach ($vars as $key => $value) {
        $$key = $value;
      }
    }
    include($path);
  }
}
