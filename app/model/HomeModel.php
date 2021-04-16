<?php
/**
 * HomeModel File Doc Comment
 * php version 7.3.5
 *
 * @category Model
 * @package  Model
 * @author   Periyandavar <periyandavar@gmail.com>
 * @license  http://license.com license
 * @link     http://url.com
 */
/**
 * HomeModel Class Handles the HomeController class data base operations
 *
 * @category   Model
 * @package    Model
 * @subpackage HomeModel
 * @author     Periyandavar <periyandavar@gmail.com>
 * @license    http://license.com license
 * @link       http://url.com
 */
class HomeModel extends BaseModel
{
    /**
     * Returns available gender codes
     *
     * @return array
     */
    public function getGenderCodes(): array
    {
        $result = [];
        $this->db->select('code')->from('gender');
        $this->db->where('deletionToken', '=', 'N/A')->execute();
        while ($row = $this->db->fetch()) {
            $result[] = $row->code;
        }
        return $result;
    }

    /**
     * Returns all the available books
     *
     * @return array
     */
    public function getAvailableBooks(): array
    {
        $books = [];
        $this->db->select(
            'b.id id',
            'b.name name',
            'a.name author',
            'description',
            'available',
            'coverPic'
        )
            ->from('book b')
            ->innerJoin('book_author ba')
            ->on('b.id = ba.bookId')
            ->innerJoin('author a')
            ->on('ba.authorId = a.id')
            ->where('b.deletionToken', '=', "N/A")
            ->where('b.status', '=', 1)
            ->orderby('RAND()')->execute();
        while ($row = $this->db->fetch()) {
            $books[] = $row;
        }
        return $books;
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
     * Returns the password of the given username
     *
     * @param string $username User Name
     *
     * @return string|null
     */
    public function getUserPass(string $username): ?string
    {
        $this->db->select('password');
        $this->db->from('user');
        $this->db->where('username', '=', $username);
        $this->db->where('deletionToken', '=', 'N/A')->where('status', '=', 1);
        $this->db->execute();
        $result = $this->db->fetch();
        if ($result != null) {
            return $result->password;
        } else {
            return null;
        }
    }

    /**
     * Creates new user account
     *
     * @param array $fields User details
     *
     * @return bool
     */
    public function createAccount(array $fields): bool
    {
        $fields['password'] = md5($fields['password']);
        $flag = $this->db->insert('user', $fields)->execute();
        return  $flag;
    }

    /**
     * Returns the footer area content
     *
     * @return object
     */
    public function getFooterData(): object
    {
        $this->db->select(
            'aboutUs',
            'address',
            'mobile',
            'email',
            'fbUrl',
            'ytUrl',
            'instaUrl'
        )->from('cms');
        $this->db->where('id', '=', 1)->limit(1)->execute();
        $result = $this->db->fetch();
        return $result;
    }

    /**
     * Returns the Vision
     *
     * @return string
     */
    public function getVision(): string
    {
        $this->db->select('vision')
            ->from('cms')
            ->where('id', '=', 1)
            ->limit(1)
            ->execute();
        $result = $this->db->fetch();
        return $result->vision;
    }

    /**
     * Returns the Mission
     *
     * @return string
     */
    public function getMission(): string
    {
        $this->db->select('mission')
            ->from('cms')
            ->where('id', '=', 1)
            ->limit(1)
            ->execute();
        $result = $this->db->fetch();
        return $result->mission;
    }
}
