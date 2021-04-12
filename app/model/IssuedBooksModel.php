<?php
class IssuedBooksModel extends BaseModel
{
    public function getUserDetails(string $username)
    {
        $this->db->select('user.id', 'userName', 'fullName', 'mobile', 'email')->selectAs('COUNT(`ib`.`id`) lent', "SUM(IF(`issuedAt`='0000-00-00', 1, 0)) request")->from('user');
        $this->db->innerJoin('issued_book ib')->using('username')->where('returnAt', '=', '0000-00-00');
        $this->db->where('username', '=', $username)->where('user.status', '=', 1);
        $this->db->where('deletionToken', '=', 'N/A')->limit(1)->execute();
        $user = $this->db->fetch();
        $user->lent = $user->lent - $user->request;
        return $user;
    }

    public function getMaxBooksToLend()
    {
        $this->db->select('maxBookLend')->from('core_config')->execute();
        return $this->db->fetch()->maxBookLend;
    }

    public function getFineConfigs()
    {
        $this->db->select('maxLendDays', 'fineAmtPerDay')->from('core_config')->execute();
        return $this->db->fetch();
    }

    public function getMaxVals()
    {
        $this->db->select('maxBookRequest', 'maxBookLend')->from('core_config')->execute();
        return $this->db->fetch();
    }

    public function getBookDetails(string $isbnNumber)
    {
        $this->db->select('id', 'name', 'location', 'publication', 'price', 'stack', 'coverPic', 'available', 'isbnNumber')->from('book')->where('isbnNumber', '=', $isbnNumber);
        $this->db->where('deletionToken', '=', 'N/A')->where('status', '=', 1)->limit(1)->execute();
        $book = $this->db->fetch();
        return $book;
    }

    public function addIssuedBook(array $book)
    {
        $this->db->select('code')->from('status')->where('value', '=', 'Issued')->execute();
        $book['status'] = $this->db->fetch()->code;
        $this->db->set("autocommit", 0);
        $this->db->begin();
        $flag1 = $this->db->insert('issued_book', $book, ['issuedAt' => 'NOW()'])->execute();
        $this->db->update('book')->setTo('available = available - 1')->where('isbnNumber', '=', $book['isbnNumber']);
        $flag2 = $this->db->where('deletionToken', '=', 'N/A')->execute();
        if ($flag1 && $flag2) {
            return $this->db->commit();
        }
        $this->db->rollback();
        return false;
    }

    public function requestBook($user, $isbnNumber)
    {
        $fields = ['isbnNumber' => $isbnNumber, 'username' => $user];
        $flag = $this->db->insert('issued_book', $fields)->execute();
        return $flag;
    }

    public function getIssuedBooks()
    {
        $issuedBooks = [];
        $this->db->select('isbnNumber', 'name bookName', 'userName', 'issuedAt', 'ib.status', 'ib.id', 'status.value status', 'fine');
        $this->db->selectAs('DATEDIFF(NOW(), issuedAt) days');
        $this->db->from('issued_book ib')->innerJoin('status')->on('status.code = ib.status')->innerJoin('book')->using('isbnNumber')->innerJoin('user')->using('userName');
        $this->db->where('ib.issuedAt', '!=', '0000-00-00')->orderby('returnAt');//->where('issuedAt', '!=', '0000-00-00');
        $this->db->limit(10, 0)->execute();
        while ($row = $this->db->fetch()) {
            $issuedBooks[] = $row;
        }
        return $issuedBooks;
    }

    public function getRequestBooks()
    {
        $issuedBooks = [];
        $this->db->select('isbnNumber', 'name bookName', 'userName', 'requestedAt', 'comments', 'issued_book.status', 'issued_book.id', 'status.value status');
        $this->db->from('issued_book')->innerJoin('status')->on('status.code = issued_book.status')->innerJoin('book')->using('isbnNumber')->innerJoin('user')->using('userName');
        $this->db->where('status.value', 'LIKE', '%Request%');
        $this->db->limit(10, 0)->execute();
        while ($row = $this->db->fetch()) {
            $issuedBooks[] = $row;
        }
        return $issuedBooks;
    }

    public function getRequestDetails($id)
    {
        $this->db->select('userName', 'isbnNumber', 'comments')->from('issued_book')->where('id', '=', $id)->limit(1);
        $this->db->execute();
        $result = $this->db->fetch();
        return $result;
    }
    public function bookReturned($id)
    {
        $finSettings = $this->getFineConfigs();
        $this->db->select('code')->from('status')->where('value', '=', 'Returned')->execute();
        $book['status'] = $this->db->fetch()->code;
        $data = [
            'returnAt = NOW()',
            'fine = IF(' . $finSettings->maxLendDays . '<' . 'DATEDIFF(now(), issuedAt), ((DATEDIFF(now(), issuedAt)-'.$finSettings->maxLendDays.') * ' . $finSettings->fineAmtPerDay . ') ,0)'
        ];
        $this->db->update('issued_book', $book)->setTo(...$data)->where('id', '=', $id);
        return $this->db->execute();
    }

    public function updateRequest($id, $status, $comments)
    {
        $status = ($status == 1) ? 'Request Accepted' : 'Request Rejected';
        $this->db->select('code')->from('status')->where('value', '=', $status)->execute();
        $status = $this->db->fetch()->code;
        $values = [
            'status' => $status,
            'comments' => $comments
        ];
        // $query = $this->db->getQuery();
        // $values = $this->db->getbindValues();
        // $this->db->update('issued_book')->setTo("status = ($query)")->appendBindValues($values)->where('id', '=', $id);
        $this->db->update('issued_book', $values)->where('id', '=', $id);
        return $this->db->execute();
    }
}
