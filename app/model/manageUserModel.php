<?php
/**
 * ManageUserModel File Doc Comment
 * php version 7.3.5
 *
 * @category Model
 * @package  Model
 * @author   Periyandavar <periyandavar@gmail.com>
 * @license  http://license.com license
 * @link     http://url.com
 */
/**
 * ManageUserModel Class Handles the ManageUserController class data base operations
 *
 * @category   Model
 * @package    Model
 * @subpackage ManageUserModel
 * @author     Periyandavar <periyandavar@gmail.com>
 * @license    http://license.com license
 * @link       http://url.com
 */
class ManageUserModel extends BaseModel
{
    /**
     * Returns all user details except the user having the given email id
     *
     * @param string $email Email Id of the user to be ignored
     *
     * @return array
     */
    public function getAllUsers(string $email = ""): array
    {
        $users = [];
        $this->db->select(
            'id',
            'fullName',
            'userName',
            'email',
            'role',
            'mobile',
            'status'
        )->selectAs(
            "date_format(createdAt, '%d-%m-%Y %h:%i:%s') createdAt",
        )->from('all_user');
        $this->db->where('email', '!=', $email)->orderBy('id')->execute();
        while ($row = $this->db->fetch()) {
            $users[] = $row;
        }
        return $users;
    }

    /**
     * Returns all the registered users
     *
     * @return array
     */
    public function getRegUsers(): array
    {
        $users = [];
        $this->db->select(
            'id',
            'fullName',
            'userName',
            'email',
            'mobile',
        )->selectAs(
            "date_format(createdAt, '%d-%m-%Y %h:%i:%s') createdAt",
        )->from('all_user');
        $result = $this->db->where('role', '=', 'user')->orderby('id');
        $this->db->execute();
        while ($row = $this->db->fetch()) {
            $users[] = $row;
        }
        return $users;
    }

    /**
     * Returns the role codes and values
     *
     * @return array
     */
    public function getAllRoles(): array
    {
        $authors = [];
        $this->db->select('code', 'value')->from('role')->execute();
        while ($row = $this->db->fetch()) {
            $authors[] = $row;
        }
        return $authors;
    }

    /**
     * Adds new admin user
     *
     * @param array $user User details
     *
     * @return boolean
     */
    public function addAdminUser(array $user): bool
    {
        $user['password'] = md5($user['password']);
        $flag = $this->db->insert('admin_user', $user)->execute();
        return  $flag;
    }

    /**
     * Deletes the user
     *
     * @param string  $role User Role
     * @param integer $id   User Id
     *
     * @return boolean
     */
    public function delete(string $role, int $id): bool
    {
        $deletionToken = uniqid();
        $field = [ 'deletionToken' => $deletionToken];
        $table = ($role == "User") ? "user" : "admin_user";
        $this->db->update($table, $field)->where('id', '=', $id);
        return $this->db->execute();
    }

    /**
     * Returns all Role codes
     *
     * @return array
     */
    public function getRoleCodes(): array
    {
        $result = [];
        $this->db->select('code')->from('role');
        $this->db->execute();
        while ($row = $this->db->fetch()) {
            $result[] = $row->code;
        }
        return $result;
    }
}
