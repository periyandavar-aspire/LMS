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
        $this->db->select('id code', 'name value')->from('category')->where('isDeleted', '=', 0);
        $this->db->where('isDeleted', '=', 0)->execute();
        while ($row = $this->db->fetch()) {
            $category[] = $row;
        }
        return $category;
    }
    public function getAuthors()
    {
        $author = [];
        $this->db->select('id code', 'name value')->from('author')->where('isDeleted', '=', 0);
        $this->db->where('isDeleted', '=', 0)->execute();
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
        $category = ['bookId' => $bookId, 'catId' => $categoryId];
        $flag2 = $this->db->insert('book_category', $category)->execute();
        $author = ['bookId' => $bookId, 'authorId' => $authorId];
        $flag3 = $this->db->insert('book_author', $author)->execute();
        if ($flag1 && $flag2 && $flag3) {
            return $this->db->commit();
        }
        $this->db->rollback();
        return false;
    }
    public function getBooks()
    {
        $book = [];
        $result = $this->db->select("id", "name", "location", "publication", "isbnNumber", "stack", "available", "createdAt", "updatedAt", "isDeleted status")->from('book');
        $this->db->where('isDeleted', '!=', 2)->execute();
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
        $this->db->where('b.isDeleted', '=', 0)->orderby('RAND()')->execute();
        while ($row = $this->db->fetch()) {
            $book[] = $row;
        }
        return $book;
    }

    public function getBookDetails(int $bookId)
    {
        $this->db->select('id', 'name', 'author', 'description', 'available', 'coverpic', 'category', 'location', 'isbnNumber')->from('book_detail');
        $this->db->where('id', '=', $bookId);
        $this->db->where('isDeleted', '!=', 2)->execute();
        $result = $this->db->fetch();
        return $result;
    }

    public function delete(int $id)
    {
        $this->db->delete('book')->where('id', '=', $id);
        $this->db->where('isDeleted', '=', 0);
        return $this->db->execute();
    }
    public function get(int $id)
    {
        $this->db->select('b.id id', 'b.name name', 'a.name author', 'publication', 'isbnNumber', 'location', 'price', 'stack', 'description', 'available', 'keywords', 'coverPic')->from('book b');
        $this->db->innerJoin('book_author ba')->on('b.id = ba.bookId')->innerJoin('author a')->on('ba.authorId = a.id');
        $this->db->where("b.id=$id");
        $this->db->where('isDeleted', '!=', 2)->execute();
        return $this->db->fetch();
    }
    public function update(array $book, int $bookId)
    {
        $categoryId = $book['category'];
        $authorId = $book['author'];
        unset($book['category']);
        unset($book['author']);
        $this->db->set("autocommit", 0);
        $this->db->begin();
        $flag1 = $this->db->update('book', $book)->where('id', '=', $bookId)->execute();
        $category = ['bookId' => $bookId, 'catId' => $categoryId];
        $flag2 = $this->db->update('book_category', $category)->execute();
        $author = ['bookId' => $bookId, 'authorId' => $authorId];
        $flag3 = $this->db->insert('book_author', $author)->execute();
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
}
