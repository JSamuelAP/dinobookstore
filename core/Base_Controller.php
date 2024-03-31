<?php
abstract class Base_Controller
{
  protected View $view;

  function __construct()
  {
    $this->view = new View();
  }
}
