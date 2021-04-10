<?php

class BookModel extends BaseModel
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getCategories()
    {
        $category = [];
        $this->db->select('id code', 'name value')->from('category')->where('deletionToken', '=', 'N/A');
        $this->db->where('status', '=', 1)->execute();
        while ($row = $this->db->fetch()) {
            $category[] = $row;
        }
        return $category;
    }
    public function getAuthors()
    {
        $author = [];
        $this->db->select('id code', 'name value')->from('author')->where('deletionToken', '=', "N/A");
        $this->db->where('status', '=', 1)->execute();
        while ($row = $this->db->fetch()) {
            $author[] = $row;
        }
        return $author;
    }
    public function addBook(array $book)
    {
        $categoryId = $book['category'];
        $authorId = $book['author'];
        unset($book['category']);
        unset($book['author']);
        $this->db->set("autocommit", 0);
        $this->db->begin();
        $flag1 = $this->db->insert('book', $book)->execute();
        $bookId = $this->db->insertId();
        if ($flag2) {
            foreach ($categories as $categoryId) {
                $category = ['bookId' => $bookId, 'catId' => $categoryId];
                $flag2 = $this->db->insert('book_category', $category)->execute();
                if (!$flag2) {
                    break;
                }
            }
        }
        $flag3 = $this->db->delete('book_author')->where('bookId', '=', $bookId)->execute();
        if ($flag3) {
            foreach ($authors as $authorId) {
                $author = ['bookId' => $bookId, 'authorId' => $authorId];
                $flag3 = $this->db->insert('book_author', $author)->execute();
                if (!$flag3) {
                    break;
                }
            }
        }
        if ($flag1 && $flag2 && $flag3) {
            return $this->db->commit();
        }
        $this->db->rollback();
        return false;
    }
    public function getBooks()
    {
        $book = [];
        $result = $this->db->select("id", "name", "location", "publication", "isbnNumber", "stack", "available", "createdAt", "updatedAt", "status")->from('book');
        $this->db->where('deletionToken', '=', 'N/A')->execute();
        while ($row = $this->db->fetch()) {
            $book[] = $row;
        }
        return $book;
    }
    
    public function getAvailableBooks()
    {
        $book = [];
        $this->db->select('b.id id', 'b.name name', 'a.name author', 'description', 'available', 'coverPic')->from('book b');
        $this->db->innerJoin('book_author ba')->on('b.id = ba.bookId')->innerJoin('author a')->on('ba.authorId = a.id');
        $this->db->where('b.status', '=', 1)->where('b.deletionToken', '=', 'N/A')->orderby('RAND()')->execute();
        while ($row = $this->db->fetch()) {
            $book[] = $row;
        }
        return $book;
    }

    public function getBookDetails(int $bookId)
    {
        $this->db->select('id', 'name', 'authors', 'description', 'available', 'coverpic', 'categories', 'location', 'isbnNumber')->from('book_detail');
        $this->db->where('id', '=', $bookId);
        $this->db->where('status', '=', '1')->execute();
        $result = $this->db->fetch();
        return $result;
    }

    public function delete(int $id)
    {
        $deletionToken = uniqid();
        $field = [ 'deletionToken' => $deletionToken];
        $this->db->update('book', $field)->where('id', '=', $id);
        return $this->db->execute();
    }
    public function get(int $id)
    {
        $this->db->select('id', 'name', 'publication', 'isbnNumber', 'location', 'price', 'stack', 'description', 'available', 'coverPic', 'authors', 'authorCodes', 'categories', 'categoryCodes')->from('book_detail');
        $this->db->where('id', '=', $id)->execute();
        return $this->db->fetch();
    }
    public function update(array $book, int $bookId)
    {
        print_r($book);
        $categories = explode(",", $book['category']);
        $authors = explode(",", $book['author']);
        unset($book['category']);
        unset($book['author']);
        $this->db->set("autocommit", 0);
        $this->db->begin();
        $flag1 = $this->db->update('book', $book)->where('id', '=', $bookId)->execute();
        $flag2 = $this->db->delete('book_category')->where('bookId', '=', $bookId)->execute();
        if ($flag2) {
            foreach ($categories as $categoryId) {
                $category = ['bookId' => $bookId, 'catId' => $categoryId];
                $flag2 = $this->db->insert('book_category', $category)->execute();
                if (!$flag2) {
                    break;
                }
            }
        }
        $flag3 = $this->db->delete('book_author')->where('bookId', '=', $bookId)->execute();
        if ($flag3) {
            foreach ($authors as $authorId) {
                $author = ['bookId' => $bookId, 'authorId' => $authorId];
                $flag3 = $this->db->insert('book_author', $author)->execute();
                if (!$flag3) {
                    break;
                }
            }
        }
        if ($flag1 && $flag2 && $flag3) {
            return $this->db->commit();
        }
        $this->db->rollback();
    }

    public function updateBook(array $fields, int $id)
    {
        $this->db->update('book', $fields)->where('id', '=', $id);
        return $this->db->execute();
    }
    public function getBooksLike(string $Searchkey)
    {
        $result = [];
        $this->db->select("id code", "isbnNumber value")->from('book')->where('isbnNumber', 'LIKE', "%" . $Searchkey . "%");
        $this->db->where('deletionToken', '=', 'N/A')->where('status', '=', 1);
        $orderClause = "case when isbnNumber like '$Searchkey%' THEN 0 WHEN isbnNumber like '% %$Searchkey% %' THEN 1 WHEN isbnNumber like '%$Searchkey' THEN 2 else 3 end, isbnNumber";
        $this->db->orderBy($orderClause)->execute();
        while ($row = $this->db->fetch()) {
            $result[] = $row;
        }
        return $result;
    }
}
