<?php
class Books_Controller extends Base_Controller
{
  function getAll()
  {
    require 'models/Books_Model.php';
    $books_model = new Books_Model();
    $books = $books_model->getBooks();

    $variables = array();
    $variables['books'] = $books;
    $this->view->show("books_list.php", $variables);
  }

  function getOne()
  {
    if (!isset($_GET['isbn']))
      die('Book ISBN not specified.');

    $isbn = $_GET['isbn'];

    require 'models/Books_Model.php';
    $books_model = new Books_Model();
    $book = $books_model->getBook($isbn);

    if ($book === null || !$book)
      $this->view->show('404.php');
    else {
      $variables = array();
      $variables['book'] = $book;
      $this->view->show('books_getOne.php', $variables);
    }
  }

  function create()
  {
    if (isset($_POST['isbn'])) {
      require 'models/Books_Model.php';
      $books_model = new Books_Model();

      try {
        $books_model->createBook($_POST, $_FILES);
        header('Location: ?controller=books&action=getOne&isbn=' . $_POST['isbn']);
      } catch (PDOException $e) {
        $variables = array();
        $variables['error'] = $e->getCode() == 23000
          ? $variables['error'] = 'The ISBN or title already exists'
          : $variables['error'] = $e->getMessage();
        $this->view->show('books_create.php', $variables);
      }
    } else {
      $this->view->show('books_create.php');
    }
  }

  function edit()
  {
    if (!isset($_GET['isbn']))
      die('Book ISBN not specified.');

    if (isset($_POST['actualISBN'])) {
      require 'models/Books_Model.php';
      $books_model = new Books_Model();

      try {
        $books_model->updateBook($_POST['actualISBN'], $_POST, $_FILES);
        header('Location: ?controller=books&action=getOne&isbn=' . $_POST['isbn']);
      } catch (PDOException $e) {
        $variables = array();
        $variables['error'] = $e->getCode() == 23000
          ? $variables['error'] = 'The ISBN or title already exists'
          : $variables['error'] = $e->getMessage();
        $this->view->show('books_create.php', $variables);
      }
    } else {
      require 'models/Books_Model.php';
      $books_model = new Books_Model();
      $book = $books_model->getBook($_GET['isbn']);

      if ($book === null || !$book)
        $this->view->show('404.php');
      else {
        $variables = array();
        $variables['book'] = $book;
        $this->view->show('books_edit.php', $variables);
      }
    }
  }

  function delete()
  {
    if (!isset($_GET['isbn']))
      die('Book ISBN not specified.');

    require 'models/Books_Model.php';
    $books_model = new Books_Model();
    $books_model->deleteBook($_GET['isbn']);
    header('Location: ./');
  }

  function filter()
  {
    $this->view->show('books_filters.php');
  }
}
