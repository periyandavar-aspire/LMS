<?php
/**
 * AdminModel File Doc Comment
 * php version 7.3.5
 *
 * @category Model
 * @package  Model
 * @author   Periyandavar <periyandavar@gmail.com>
 * @license  http://license.com license
 * @link     http://url.com
 */
/**
 * AdminModel Class Handles the AdminController class data base operations
 *
 * @category   Model
 * @package    Model
 * @subpackage AdminModel
 * @author     Periyandavar <periyandavar@gmail.com>
 * @license    http://license.com license
 * @link       http://url.com
 */
class AdminModel extends BaseModel
{
    /**
     * Returns the admin details
     *
     * @param string $email Email id
     *
     * @return object
     */
    public function getProfile(string $email): object
    {
        $this->db->select('fullName', 'email', 'updatedAt')
            ->from('admin_user')
            ->where('email', '=', $email);
        $this->db->where('deletionToken', '=', 'N/A')->execute();
        $result = $this->db->fetch();
        return $result;
    }

    /**
     * Updates the admin details
     *
     * @param string $email    Email Id
     * @param array  $userData details
     *
     * @return bool
     */
    public function updateProfile(string $email, array $userData): bool
    {
        $result = $this->db->update('admin_user', $userData)
            ->where('email', '=', $email)
            ->execute();
        return $result;
    }

    /**
     * Updates the admin password
     *
     * @param string $email    admin Email Id
     * @param string $password admin New Password
     *
     * @return bool
     */
    public function updatePassword(string $email, string $password): bool
    {
        $result = $this->db->update('admin_user', ['password' => md5($password)])
            ->where('email', '=', $email)
            ->execute();
        return $result;
    }
    
    /**
     * Returns the details of the admin_user
     *
     * @param string $email Email Id
     *
     * @return object
     */
    public function getAdminUser(string $email): object
    {
        $this->db->select("password", "role.value type")
            ->from('admin_user')
            ->innerJoin('role')
            ->on('admin_user.role=role.code');
        $this->db->where('email', '=', $email)->where('admin_user.status', '=', 1);
        $this->db->where('admin_user.deletionToken', '=', "N/A")->execute();
        $result = $this->db->fetch();
        return $result;
    }

    /**
     * Returns core configuration details
     *
     * @return object
     */
    public function getConfigs(): object
    {
        $result = $this->db->select(
            "maxBookLend",
            "maxLendDays",
            "fineAmtPerDay",
            "maxBookRequest",
            "updatedAt"
        )->from("core_config")->where('id=1')->execute();
        return $this->db->fetch();
    }

    /**
     * Returns the cms details
     *
     * @return object
     */
    public function getCmsConfigs(): object
    {
        $result = $this->db->select(
            "aboutUs",
            "address",
            "mobile",
            "email",
            "fbUrl",
            "ytUrl",
            "instaUrl",
            "vision",
            "mission",
            "updatedAt"
        )->from("cms")->where('id=1')->execute();
        return $this->db->fetch();
    }

    /**
     * Updates the core config details
     *
     * @param array $data core configs
     *
     * @return boolean
     */
    public function updateSettings(array $data): bool
    {
        $result = $this->db->update('core_config', $data)->where('id', '=', 1);
        $this->db->execute();
        return $result;
    }

    /**
     * Updates the cms details
     *
     * @param array $data cms details
     *
     * @return boolean
     */
    public function updateCmsConfigs(array $data): bool
    {
        $result = $this->db->update('cms', $data)->where('id', '=', 1)->execute();
        return $result;
    }
}
