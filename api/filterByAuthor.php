<?php
require '../core/Config.php';
require '../config.php';
require '../core/DBManager.php';
require '../core/Base_Model.php';
require '../models/Books_Model.php';

$books_model = new Books_Model();
$books = $books_model->getBooksByAuthor($_POST['author']);

echo json_encode($books);
