<?php

class CategoryModel extends BaseModel
{
    public function add(array $category)
    {
        $result = $this->db->insert('category', $category)->execute();
        return $result;
    }
    public function getAll()
    {
        $category = [];
        $result = $this->db->select("id", "name", "createdAt", "updatedAt", "status")->from('category');
        $this->db->where('deletionToken', '=', "N/A")->execute();
        while ($row = $this->db->fetch()) {
            $category[] = $row;
        }
        return $category;
    }

    public function get(int $id)
    {
        $this->db->select('id', 'name')->from('category')->where('id', '=', $id);
        $this->db->where('deletionToken', '=', "N/A")->limit(1)->execute();
        return $this->db->fetch();
    }

    public function delete(int $id)
    {
        $deletionToken = uniqid();
        $field = [ 'deletionToken' => $deletionToken];
        $this->db->update('category', $field)->where('id', '=', $id);
        return $this->db->execute();
    }

    public function update(array $fields, int $id)
    {
        $this->db->update('category', $fields)->where('id', '=', $id)->where('deletionToken', '=', 'N/A');
        return $this->db->execute();
    }

    public function getCategoriesLike(string $Searchkey, string $ignoreList)
    {
        $result = [];
        $this->db->select("id code", "name value")->from('category')->where('name', 'LIKE', "%" . $Searchkey . "%");
        $this->db->where('deletionToken', '=', "N/A")->where('status', '=', 1);
        $this->db->where("NOT find_in_set(id, '$ignoreList')");
        $orderClause = "case when name like '$Searchkey%' THEN 0 WHEN name like '% %$Searchkey% %' THEN 1 WHEN name like '%$Searchkey' THEN 2 else 3 end, name";
        $this->db->orderBy($orderClause)->execute();
        while ($row = $this->db->fetch()) {
            $result[] = $row;
        }
        return $result;
    }
}
