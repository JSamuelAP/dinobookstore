<?php
class Books_Model extends Base_Model
{
  function getBooks(): array
  {
    $result = $this->db->query('SELECT * FROM books WHERE status = TRUE');
    $books = array();
    while ($book = $result->fetch())
      $books[] = $book;

    return $books;
  }

  function getBook($isbn)
  {
    $query = 'SELECT * FROM books WHERE isbn = ? AND status = TRUE';
    $stmt = $this->db->prepare($query);
    $stmt->execute(array($isbn));
    $book = $stmt->fetch();
    return $book;
  }

  function createBook(array $book, array $files): bool
  {
    if (empty(trim($book['author']))) $book['author'] = 'Anonymous';
    if (empty(trim($book['price']))) $book['price'] = 0.0;
    $book['cover_url'] = $this->saveImage($files);

    $query = '
      INSERT INTO books (ISBN, title, author, description, price, year, cover_url)
      VALUES (?, ?, ?, ?, ?, ?, ?);
    ';
    $stmt = $this->db->prepare($query);
    $stmt->execute(array(
      $book['isbn'],
      $book['title'],
      $book['author'],
      $book['description'],
      $book['price'],
      $book['year'],
      $book['cover_url'],
    ));
    return $stmt instanceof PDOStatement;
  }

  function updateBook(string $isbn, array $book, array $files): bool
  {
    if (empty(trim($book['author']))) $book['author'] = 'Anonymous';
    if (empty(trim($book['price']))) $book['price'] = 0.0;

    if (isset($book['noCover'])) { // Delete cover
      $book['cover_url'] = 'defaultcover.svg';
      $this->deleteImage($book['actualCover']);
    } else if (empty($files['cover_url']['name'])) { // No update cover
      $book['cover_url'] = $book['actualCover'];
    } else { // Update cover and delete last cover
      $book['cover_url'] = $this->saveImage($files);
      $this->deleteImage($book['actualCover']);
    }

    $query = '
      UPDATE books SET
        ISBN = ?, title = ?, author = ?, description = ?, price = ?, year = ?, cover_url = ?
      WHERE ISBN = ?;
    ';
    $stmt = $this->db->prepare($query);
    $stmt->execute(array(
      $book['isbn'],
      $book['title'],
      $book['author'],
      $book['description'],
      $book['price'],
      $book['year'],
      $book['cover_url'],
      $isbn
    ));
    return $stmt instanceof PDOStatement;
  }

  function deleteBook(string $isbn): bool
  {
    $query = 'UPDATE books SET status = FALSE WHERE ISBN = ?;';
    echo $query;
    $stmt = $this->db->prepare($query);
    $stmt->execute(array($isbn));
    return $stmt instanceof PDOStatement;
  }

  private function saveImage(array $files): string
  {
    if (empty($files['cover_url']['name'])) return "defaultcover.svg";

    $mimeType = exif_imagetype($files['cover_url']['tmp_name']);
    if ($mimeType !== false) {
      $extension = strtolower(pathinfo($files['cover_url']['name'], PATHINFO_EXTENSION));
      $name = time() . '.' . $extension;
      move_uploaded_file(
        $files['cover_url']['tmp_name'],
        'uploads/' . $name
      );
      return $name;
    } else {
      return "defaultcover.svg";
    }
  }

  private function deleteImage(string $file)
  {
    if ($file != 'defaultcover.svg')
      unlink('uploads/' . $file);
  }

  function getBooksByTitle(string $title)
  {
    $query = "SELECT * FROM books WHERE title LIKE ? AND status = TRUE";
    $stmt = $this->db->prepare($query);
    $stmt->execute(array('%' . $title . '%'));
    $books = $stmt->fetchAll();
    return $books;
  }

  function getBooksByISBN(string $isbn)
  {
    return $this->getBook($isbn);
  }

  function getBooksByAuthor(string $author)
  {
    $query = "SELECT * FROM books WHERE author LIKE ? AND status = TRUE";
    $stmt = $this->db->prepare($query);
    $stmt->execute(array('%' . $author . '%'));
    $books = $stmt->fetchAll();
    return $books;
  }
}
