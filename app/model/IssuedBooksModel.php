<?php
class IssuedBooksModel extends BaseModel
{
    public function getUserDetails(string $username)
    {
        $this->db->select('user.id', 'userName', 'fullName', 'value gender', 'mobile', 'email', 'createdAt')->from('user');
        $this->db->innerJoin('gender')->on('gender.code = user.gender')->where('username', '=', $username);
        $this->db->limit(1)->execute();
        $user = $this->db->fetch();
        return $user;
    }

    public function getBookDetails(string $isbnNumber)
    {
        $this->db->select('id', 'name', 'location', 'publication', 'price', 'stack', 'description', 'coverPic', 'status')->from('book')->where('isbnNumber', '=', $isbnNumber)->execute();
        $book = $this->db->fetch();
        return $book;
    }

    public function addIssuedBook(array $book)
    {
        $flag = $this->db->insert('issued_book', $book)->execute();
        return $flag;
    }

    public function getIssuedBooks()
    {
        $issuedBooks = [];
        $this->db->select('isbnNumber', 'name bookName', 'userName', 'issuedAt', 'returnAt', 'issued_book.id');
        $this->db->from('issued_book')->innerJoin('book')->using('isbnNumber')->innerJoin('user')->using('userName')->limit(10, 0)->execute();
        while ($row = $this->db->fetch()) {
            $issuedBooks[] = $row;
        }
        return $issuedBooks;
    }

    
}
