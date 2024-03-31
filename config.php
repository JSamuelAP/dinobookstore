<?php
$config = Config::getInstance();

$config->set('CONTROLLERS_FOLDER', 'controllers/');
$config->set('MODELS_FOLDERS', 'models/');
$config->set('VIEWS_FOLDER', 'views/');

$config->set('DEFAULT_CONTROLLER', 'books');
$config->set('DEFAULT_ACTION', 'getAll');

$config->set('dbhost', 'localhost');
$config->set('dbname', 'dinobookstore');
$config->set('dbuser', 'root');
$config->set('dbpass', '');
