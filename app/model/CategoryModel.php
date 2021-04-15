<?php
/**
 * CategoryModel File Doc Comment
 * php version 7.3.5
 *
 * @category Model
 * @package  Model
 * @author   Periyandavar <periyandavar@gmail.com>
 * @license  http://license.com license
 * @link     http://url.com
 */
/**
 * CategoryModel Class Handles the CategoryController class data base operations
 *
 * @category   Model
 * @package    Model
 * @subpackage CategoryModel
 * @author     Periyandavar <periyandavar@gmail.com>
 * @license    http://license.com license
 * @link       http://url.com
 */
class CategoryModel extends BaseModel
{
    /**
     * Adds new category
     *
     * @param array $category Category Details
     *
     * @return boolean
     */
    public function add(array $category): bool
    {
        $result = $this->db->insert('category', $category)->execute();
        return $result;
    }

    /**
     * Returns all available categories
     *
     * @return array
     */
    public function getAll(): array
    {
        $category = [];
        $result = $this->db->select("id", "name", "createdAt", "updatedAt", "status")
            ->from('category');
        $this->db->where('deletionToken', '=', "N/A")->execute();
        while ($row = $this->db->fetch()) {
            $category[] = $row;
        }
        return $category;
    }

    /**
     * Returns the category details
     *
     * @param int $id Category Id
     *
     * @return object
     */
    public function get(int $id): object
    {
        $this->db->select('id', 'name')->from('category')->where('id', '=', $id);
        $this->db->where('deletionToken', '=', "N/A")->limit(1)->execute();
        return $this->db->fetch();
    }

    /**
     * Deletes the category
     *
     * @param int $id category Id
     *
     * @return boolean
     */
    public function delete(int $id): bool
    {
        $deletionToken = uniqid();
        $field = [ 'deletionToken' => $deletionToken];
        $this->db->update('category', $field)->where('id', '=', $id);
        return $this->db->execute();
    }

    /**
     * Updates the category
     *
     * @param array $fields Category Details
     * @param int   $id     Category Id
     *
     * @return boolean
     */
    public function update(array $fields, int $id): bool
    {
        $this->db->update('category', $fields)->where('id', '=', $id)
            ->where('deletionToken', '=', 'N/A');
        return $this->db->execute();
    }

    /**
     * Returns all the categories matching given search key
     *
     * @param string $Searchkey  Search Key
     * @param string $ignoreList Category codes with , seperator
     *                           which are ignored on search result
     *
     * @return array
     */
    public function getCategoriesLike(string $Searchkey, string $ignoreList): array
    {
        $result = [];
        $this->db->select("id code", "name value")
            ->from('category')
            ->where('name', 'LIKE', "%" . $Searchkey . "%");
        $this->db->where('deletionToken', '=', "N/A")
            ->where('status', '=', 1);
        $this->db->where("NOT find_in_set(id, '$ignoreList')");
        $orderClause = "case when name like '$Searchkey%' THEN 0"
            . "WHEN name like '% %$Searchkey% %' THEN 1 "
            . "WHEN name like '%$Searchkey' THEN 2 "
            . "else 3 end, name";
        $this->db->orderBy($orderClause)->execute();
        while ($row = $this->db->fetch()) {
            $result[] = $row;
        }
        return $result;
    }
}
