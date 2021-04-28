<?php
/**
 * UserModel File Doc Comment
 * php version 7.3.5
 *
 * @category Model
 * @package  Model
 * @author   Periyandavar <periyandavar@gmail.com>
 * @license  http://license.com license
 * @link     http://url.com
 */
defined('VALID_REQ') or exit('Invalid request');

/**
 * UserModel Class Handles the UserController class data base operations
 *
 * @category   Model
 * @package    Model
 * @subpackage IssuedBookModel
 * @author     Periyandavar <periyandavar@gmail.com>
 * @license    http://license.com license
 * @link       http://url.com
 */
class UserModel extends BaseModel
{
    /**
     * Returns the user details
     *
     * @param string $id UserId
     *
     * @return object
     */
    public function getProfile(string $id): object
    {
        $this->db->select(
            'fullName',
            'userName',
            'gender',
            'mobile',
            'email',
            'u.updatedAt'
        )->from('user u');
        $this->db->where('id', '=', $id);
        $this->db->where('u.deletionToken', '=', 'N/A')->execute();
        $result = $this->db->fetch();
        return $result;
    }

    /**
     * Updates the user details
     *
     * @param string $userId   UserId
     * @param array  $userData User details
     *
     * @return boolean
     */
    public function updateProfile(string $userId, array $userData): bool
    {
        $result = $this->db->update('user', $userData)
            ->where('id', '=', $userId)
            ->execute();
        return $result;
    }

    /**
     * Updates the user password
     *
     * @param string $userId   User Id
     * @param string $password password
     *
     * @return boolean
     */
    public function updatePassword(string $userId, string $password): bool
    {
        $result = $this->db->update('user', ['password' => md5($password)])
            ->where('id', '=', $userId)
            ->execute();
        return $result;
    }

    /**
     * Returns avaialbe gender values with code
     *
     * @return array
     */
    public function getGender(): array
    {
        $result = [];
        $i = 0;
        $this->db->select('code', 'value')->from('gender');
        $this->db->where('deletionToken', '=', 'N/A')->execute();
        while ($row = $this->db->fetch()) {
            $result[$i]['code'] = $row->code;
            $result[$i]['value'] = $row->value;
            $i++;
        }
        return $result;
    }

    /**
     * Returns the lent books details
     *
     * @param string      $userId User Id
     * @param null|int    $Tcount Total Records count
     * @param int         $offset Offset
     * @param int         $limit  Row count
     * @param string|null $search Search value
     *
     * @return array
     */
    public function getLentBooks(
        string $userId,
        ?int &$Tcount = null,
        int $offset = 0,
        int $limit = 5,
        ?string $search = null
    ): array {
        $books = [];
        $this->db->select('isbnNumber', 'name bookName', 'ib.id')
            ->selectAs(
                "date_format(issuedAt, '%d-%m-%Y %h:%i:%s') issuedAt",
                "IF(returnAt='0000-00-00','Not Return Yet', "
                . "date_format(returnAt, '%d-%m-%Y %h:%i:%s')) returnAt",
                "IFNULL(fine,'-') fine"
            );
        $this->db->from('issued_book ib')
            ->innerJoin('book')
            ->on('book.id = ib.bookId')
            ->innerJoin('user')
            ->on('user.id = ib.userId');
        $this->db->where('user.id', '=', $userId)
            ->where('issuedAt', '!=', '0000-00-00');
        if ($search != null) {
            $this->db->where('(name LIKE ? OR isbnNumber LIKE ?)');
            $this->db->appendBindValues(["%$search%", "%$search%"]);
        }
        $this->db->orderby('returnAt', 'DESC')->limit($limit, $offset)
            ->execute();
        while ($row = $this->db->fetch()) {
            $books[] = $row;
        }
        $this->db->selectAs(
            "COUNT(*) tCount",
        );
        $this->db->from('issued_book ib')
            ->innerJoin('book')
            ->on('book.id = ib.bookId')
            ->innerJoin('user')
            ->on('user.id = ib.userId');
        if ($search != null) {
            $this->db->where('(name LIKE ? OR isbnNumber LIKE ?)');
            $this->db->appendBindValues(["%$search%", "%$search%"]);
        }
        $this->db->where('user.id', '=', $userId)
            ->where('issuedAt', '!=', '0000-00-00')
            ->execute();
        $Tcount = $this->db->fetch()->tCount;
        return $books;
    }

    /**
     * Returns the requested books details
     *
     * @param string      $userId UserId
     * @param null|int    $Tcount Total Records count
     * @param int         $offset Offset
     * @param int         $limit  Row count
     * @param string|null $search Search value
     *
     * @return array
     */
    public function getRequestedBooks(
        string $userId,
        ?int &$Tcount = null,
        int $offset = 0,
        int $limit = 5,
        ?string $search = null
    ): array {
        $books = [];
        $this->db->select(
            'isbnNumber',
            'name bookName',
            'ib.id',
            'requestedAt',
            'status.value status',
            'comments'
        );
        $this->db->from('issued_book ib');
        $this->db->innerJoin('status')
            ->on('status.code = ib.status')
            ->innerJoin('book')
            ->on('book.id = ib.bookId')
            ->innerJoin('user')
            ->on('user.id = ib.userId');
        $this->db->where('user.id', '=', $userId)
            ->where('status.value', 'LIKE', STATUS_REQ);
        if ($search != null) {
            $this->db->where('(name LIKE ? OR isbnNumber LIKE ?  OR status.value LIKE ? OR comments LIKE ?)');
            $this->db->appendBindValues(["%$search%", "%$search%", "%$search%", "%$search%"]);
        }
        $this->db->orderby('returnAt')
            ->limit($limit, $offset)    
            ->execute();
        while ($row = $this->db->fetch()) {
            $books[] = $row;
        }
        $this->db->selectAs(
            "COUNT(*) tCount",
        );
        $this->db->from('issued_book ib');
        $this->db->innerJoin('status')
            ->on('status.code = ib.status')
            ->innerJoin('book')
            ->on('book.id = ib.bookId')
            ->innerJoin('user')
            ->on('user.id = ib.userId');
        $this->db->where('user.id', '=', $userId)
            ->where('status.value', 'LIKE', STATUS_REQ);
        if ($search != null) {
            $this->db->where('(name LIKE ? OR isbnNumber LIKE ?  OR status.value LIKE ? OR comments LIKE ?)');
            $this->db->appendBindValues(["%$search%", "%$search%", "%$search%", "%$search%"]);
        }
        $this->db->orderby('returnAt')
            ->execute();
        $Tcount = $this->db->fetch()->tCount;
        return $books;
    }

    /**
     * Removes user request
     *
     * @param integer $id   User request id
     * @param string  $user UserName
     *
     * @return bool
     */
    public function removeRequest(int $id, string $user): bool
    {
        $this->db->select('code')
            ->from('status')
            ->where('value', '=', 'Deleted Request')
            ->execute();
        $data['ib.status'] = $this->db->fetch()->code;
        $data['ib.deletionToken'] = uniqid();
        $this->db->update(
            'issued_book ib',
            $data,
            null,
            'Inner Join user on ib.userId = user.id'
        );
        $result = $this->db->where('ib.id', '=', $id)
            ->where('user.id', '=', $user)
            ->execute();
        return $result;
    }
}
