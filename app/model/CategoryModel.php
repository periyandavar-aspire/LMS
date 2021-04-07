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
        $result = $this->db->select("id", "name", "createdAt", "updatedAt", "status")->from('category')->execute();
        while ($row = $this->db->fetch()) {
            $category[] = $row;
        }
        return $category;
    }

    public function get(int $id)
    {
        $this->db->select('id', 'name')->from('category')->where('id', '=', $id)->limit(1)->execute();
        return $this->db->fetch();
    }

    public function delete(int $id)
    {
        $this->db->delete('category')->where('id', '=', $id);
        return $this->db->execute();
    }

    public function update(array $fields, int $id)
    {
        $this->db->update('category', $fields)->where('id', '=', $id);
        return $this->db->execute();
    }
}
