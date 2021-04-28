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
defined('VALID_REQ') or exit('Invalid request');

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
            'id',
            'name',
            'authors',
            'description',
            'available',
            'coverPic'
        )->from('book_detail');
        // $this->db->innerJoin('book_author ba')->on('b.id = ba.bookId')
        //     ->innerJoin('author a')
        //     ->on('ba.authorId = a.id');
        $this->db->where('status', '=', 1)//->where('b.deletionToken', '=', 'N/A')
            ->orderby('RAND()')
            ->limit(12)
            ->execute();
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
     * @return object|null
     */
    public function getUser(string $username): ?object
    {
        $this->db->select('password', 'id');
        $this->db->from('user');
        $this->db->where('username', '=', $username);
        $this->db->where('deletionToken', '=', 'N/A')->where('status', '=', 1);
        $this->db->execute();
        if ($result = $this->db->fetch()) {
            return $result;
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
