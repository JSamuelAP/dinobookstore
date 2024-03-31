<?php
require 'core/FrontController.php';

try {
  FrontController::main();
} catch (Exception $e) {
  echo $e->getMessage();
}
