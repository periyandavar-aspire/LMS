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
            'updatedAt'
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
     * @param string $username Username
     *
     * @return array
     */
    public function getLentBooks(string $username): array
    {
        $books = [];
        $this->db->select('isbnNumber', 'name bookName', 'issued_book.id')
            ->selectAs(
                "IFNULL (issuedAt,'') issuedAt",
                "IF(returnAt='0000-00-00','Not Return Yet', returnAt) returnAt",
                "IFNULL(fine,'-') fine"
            );
        $this->db->from('issued_book')
            ->innerJoin('book')
            ->using('isbnNumber')
            ->innerJoin('user')
            ->using('userName');
        $this->db->where('userName', '=', $username)
            ->where('issuedAt', '!=', '0000-00-00')
            ->orderby('returnAt')->limit(10, 0)
            ->execute();
        while ($row = $this->db->fetch()) {
            $books[] = $row;
        }
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
            'issued_book.id',
            'requestedAt',
            'status.value status',
            'comments'
        );
        $this->db->from('issued_book');
        $this->db->innerJoin('status')
            ->on('status.code = issued_book.status')
            ->innerJoin('book')
            ->using('isbnNumber')
            ->innerJoin('user')
            ->using('userName');
        $this->db->where('userName', '=', $username)
            ->where('issuedAt', '=', '0000-00-00')
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
}
