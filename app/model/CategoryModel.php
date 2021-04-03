<?php

class CategoryModel extends BaseModel
{
    public function addCategory(array $category)
    {
        $result = $this->db->insert('category', $category)->execute();
        return $result;
    }
    public function getCategories()
    {
        $category = [];
        $result = $this->db->select("id", "name", "createdAt", "updatedAt", "status")->from('category')->execute();
        while ($row = $this->db->fetch()) {
            $category[] = $row;
        }
        return $category;
    }
}
