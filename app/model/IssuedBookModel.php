<?php
/**
 * IssuedBookModel File Doc Comment
 * php version 7.3.5
 *
 * @category Model
 * @package  Model
 * @author   Periyandavar <periyandavar@gmail.com>
 * @license  http://license.com license
 * @link     http://url.com
 */
/**
 * IssuedBookModel Class Handles the IssuedBookController class data base operations
 *
 * @category   Model
 * @package    Model
 * @subpackage IssuedBookModel
 * @author     Periyandavar <periyandavar@gmail.com>
 * @license    http://license.com license
 * @link       http://url.com
 */
class IssuedBooksModel extends BaseModel
{
    /**
     * Returns the user details
     *
     * @param string $username User Name
     *
     * @return object
     */
    public function getUserDetails(string $username): object
    {
        $this->db->select('user.id', 'userName', 'fullName', 'mobile', 'email')
            ->selectAs(
                'COUNT(`ib`.`id`) lent',
                "SUM(IF(`issuedAt`='0000-00-00', 1, 0)) request"
            );
        $this->db->from('user')
            ->innerJoin('issued_book ib')
            ->using('username')
            ->where('returnAt', '=', '0000-00-00')
            ->where('username', '=', $username)
            ->where('user.status', '=', 1)
            ->where('deletionToken', '=', 'N/A')
            ->limit(1)
            ->execute();
        $user = $this->db->fetch();
        $user->lent = ($user->lent) - ($user->request);
        return $user;
    }

    /**
     * Returns the Maximum Lend Books
     *
     * @return integer|null
     */
    public function getMaxBooksToLend(): ?int
    {
        $this->db->select('maxBookLend')->from('core_config')->execute();
        return $this->db->fetch()->maxBookLend;
    }

    /**
     * Returns fine congigs (maximum lend days and fine amount per day)
     *
     * @return object
     */
    public function getFineConfigs(): object
    {
        $this->db->select('maxLendDays', 'fineAmtPerDay')
            ->from('core_config')
            ->execute();
        return $this->db->fetch();
    }

    /**
     * Returns maximum book request and maximum book lend
     *
     * @return object
     */
    public function getMaxVals(): object
    {
        $this->db->select('maxBookRequest', 'maxBookLend')
            ->from('core_config')
            ->execute();
        return $this->db->fetch();
    }

    /**
     * Returns the book details
     *
     * @param string $isbnNumber ISBN Number
     *
     * @return object
     */
    public function getBookDetails(string $isbnNumber): object
    {
        $this->db->select(
            'id',
            'name',
            'location',
            'publication',
            'price',
            'stack',
            'coverPic',
            'available',
            'isbnNumber'
        )->from('book')->where('isbnNumber', '=', $isbnNumber);
        $this->db->where('deletionToken', '=', 'N/A')
            ->where('status', '=', 1)
            ->limit(1)
            ->execute();
        $book = $this->db->fetch();
        return $book;
    }

    /**
     * Adds the details of the Issued book
     *
     * @param array $book IssuedBook details
     *
     * @return boolean
     */
    public function addIssuedBook(array $book): bool
    {
        $this->db->select('code')
            ->from('status')
            ->where('value', '=', 'Issued')
            ->execute();
        $book['status'] = $this->db->fetch()->code;
        $this->db->set("autocommit", 0);
        $this->db->begin();
        $flag1 = $this->db->insert('issued_book', $book, ['issuedAt' => 'NOW()'])
            ->execute();
        $this->db->update('book')
            ->setTo('available = available - 1')
            ->where('isbnNumber', '=', $book['isbnNumber']);
        $flag2 = $this->db->where('deletionToken', '=', 'N/A')->execute();
        if ($flag1 && $flag2) {
            return $this->db->commit();
        }
        $this->db->rollback();
        return false;
    }

    /**
     * Add the details of the requested book
     *
     * @param string $user       Username
     * @param string $isbnNumber ISBN Number
     *
     * @return boolean
     */
    public function requestBook(string $user, string $isbnNumber): bool
    {
        $fields = ['isbnNumber' => $isbnNumber, 'username' => $user];
        $flag = $this->db->insert('issued_book', $fields)->execute();
        return $flag;
    }

    /**
     * Returns the issued book details
     *
     * @return array
     */
    public function getIssuedBooks(): array
    {
        $issuedBooks = [];
        $this->db->select(
            'isbnNumber',
            'name bookName',
            'userName',
            'issuedAt',
            'ib.status',
            'ib.id',
            'status.value status',
            'fine'
        );
        $this->db->selectAs('DATEDIFF(NOW(), issuedAt) days');
        $this->db->from('issued_book ib')
            ->innerJoin('status')
            ->on('status.code = ib.status')
            ->innerJoin('book')
            ->using('isbnNumber')
            ->innerJoin('user')
            ->using('userName')
            ->where('ib.issuedAt', '!=', '0000-00-00')
            ->orderby('returnAt');
        $this->db->limit(10, 0)->execute();
        while ($row = $this->db->fetch()) {
            $issuedBooks[] = $row;
        }
        return $issuedBooks;
    }

    /**
     * Returns the book requests
     *
     * @return array
     */
    public function getRequestBooks(): array
    {
        $issuedBooks = [];
        $this->db->select(
            'isbnNumber',
            'name bookName',
            'userName',
            'requestedAt',
            'comments',
            'issued_book.status',
            'issued_book.id',
            'status.value status'
        );
        $this->db->from('issued_book')
            ->innerJoin('status')
            ->on('status.code = issued_book.status')
            ->innerJoin('book')
            ->using('isbnNumber')
            ->innerJoin('user')
            ->using('userName');
        $this->db->where('status.value', 'LIKE', '%Request%');
        $this->db->limit(10, 0)->execute();
        while ($row = $this->db->fetch()) {
            $issuedBooks[] = $row;
        }
        return $issuedBooks;
    }

    /**
     * Returns the book request details
     *
     * @param int $id Request Id
     *
     * @return object
     */
    public function getRequestDetails(int $id): object
    {
        $this->db->select('userName', 'isbnNumber', 'comments')
            ->from('issued_book')
            ->where('id', '=', $id)
            ->limit(1);
        $this->db->execute();
        $result = $this->db->fetch();
        return $result;
    }

    /**
     * Mark the Issued book as Returned
     *
     * @param integer $id IssuedBook Id
     *
     * @return boolean
     */
    public function bookReturned(int $id): bool
    {
        $finSettings = $this->getFineConfigs();
        $this->db->select('code')
            ->from('status')
            ->where('value', '=', 'Returned')
            ->execute();
        $book['status'] = $this->db->fetch()->code;
        $data = [
            'returnAt = NOW()',
            'fine = IF('
                . $finSettings->maxLendDays
                . '< DATEDIFF(now(), issuedAt), ((DATEDIFF(now(), issuedAt)-'
                .$finSettings->maxLendDays.') * '
                . $finSettings->fineAmtPerDay
                . ') ,0)'
        ];
        $this->db->update('issued_book', $book)
            ->setTo(...$data)
            ->where('id', '=', $id);
        return $this->db->execute();
    }

    /**
     * Update the Book request Details
     *
     * @param int    $id       Request Id
     * @param int    $status   Status Id
     * @param string $comments Comment
     *
     * @return boolean
     */
    public function updateRequest(int $id, int $status, string $comments): bool
    {
        $status = ($status == 1) ? 'Request Accepted' : 'Request Rejected';
        $this->db->select('code')
            ->from('status')
            ->where('value', '=', $status)
            ->execute();
        $status = $this->db->fetch()->code;
        $values = [
            'status' => $status,
            'comments' => $comments
        ];
        // $query = $this->db->getQuery();
        // $values = $this->db->getbindValues();
        // $this->db->update('issued_book')->setTo("status = ($query)")
        //  ->appendBindValues($values)->where('id', '=', $id);
        $this->db->update('issued_book', $values)->where('id', '=', $id);
        return $this->db->execute();
    }
}
