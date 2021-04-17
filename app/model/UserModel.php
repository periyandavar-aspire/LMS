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
     * @param string $username Username
     *
     * @return object
     */
    public function getProfile(string $username): object
    {
        $this->db->select(
            'fullName',
            'userName',
            'value gender',
            'mobile',
            'email',
            'u.updatedAt'
        )->from('user u');
        $this->db->innerJoin('gender g')
            ->on('g.code = u.gender')
            ->where('username', '=', $username);
        $this->db->where('u.deletionToken', '=', 'N/A')->execute();
        $result = $this->db->fetch();
        return $result;
    }

    /**
     * Updates the user details
     *
     * @param string $username Username
     * @param array  $userData User details
     *
     * @return boolean
     */
    public function updateProfile(string $username, array $userData): bool
    {
        $result = $this->db->update('user', $userData)
            ->where('username', '=', $username)
            ->execute();
        return $result;
    }

    /**
     * Updates the user password
     *
     * @param string $username Username
     * @param string $password password
     *
     * @return boolean
     */
    public function updatePassword(string $username, string $password): bool
    {
        $result = $this->db->update('user', ['password' => md5($password)])
            ->where('username', '=', $username)
            ->execute();
        return $result;
    }

    /**
     * Returns the lent books details
     *
     * @param string      $username Username
     * @param null|int    $Tcount   Total Records count
     * @param int         $offset   Offset
     * @param int         $limit    Row count
     * @param string|null $search   Search value
     *
     * @return array
     */
    public function getLentBooks(
        string $username,
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
        $this->db->where('userName', '=', $username)
            ->where('issuedAt', '!=', '0000-00-00');
        if ($search != null) {
            $this->db->where('(name LIKE ? OR isbnNumber LIKE ?)');
            $this->db->appendBindValues(["%$search%", "%$search%"]);
        }
        $this->db->orderby('returnAt')->limit($limit, $offset)
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
        $this->db->where('userName', '=', $username)
            ->where('issuedAt', '!=', '0000-00-00')
            ->execute();
        $Tcount = $this->db->fetch()->tCount;
        return $books;
    }

    /**
     * Returns the requested books details
     *
     * @param string $username Username
     *
     * @return array
     */
    public function getRequestedBooks(string $username): array
    {
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
        $this->db->where('userName', '=', $username)
            ->where('status.value', 'LIKE', 'Requested%')
            ->limit(10, 0)
            ->execute();
        while ($row = $this->db->fetch()) {
            $books[] = $row;
        }
        return $books;
    }

    /**
     * Returns the users matching given search keys
     *
     * @param string $Searchkey SearchKey
     *
     * @return array
     */
    public function getUsersLike(string $Searchkey): array
    {
        $result = [];
        $this->db->select("id code", "userName value")
            ->from('user')->where('userName', 'LIKE', "%" . $Searchkey . "%")
            ->where('deletionToken', '=', "N/A")->where('status', '=', 1);
        $orderClause = "case when userName like '$Searchkey%' THEN 0 "
            . "WHEN userName like '% %$Searchkey% %' THEN 1 "
            . "WHEN userName like '%$Searchkey' THEN 2 else 3 end, userName";
        $this->db->orderBy($orderClause)->execute();
        while ($row = $this->db->fetch()) {
            $result[] = $row;
        }
        return $result;
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
            ->where('userName', '=', $user)
            ->execute();
        return $result;
    }
}
