<?php

class AuthorModel extends BaseModel
{
    public function getAll()
    {
        $authors = [];
        $result = $this->db->select("id", "name", "createdAt", "updatedAt", "isDeleted status")->from('author');
        $this->db->where('isDeleted', '!=', 2)->execute();
        while ($row = $this->db->fetch()) {
            $authors[] = $row;
        }
        return $authors;
    }
    public function add(array $author)
    {
        $result = $this->db->insert('author', $author)->execute();
        return $result;
    }
    public function get(int $id)
    {
        $this->db->select('id', 'name')->from('author')->where('id', '=', $id);
        $this->db->where('isDeleted', '!=', 2)->limit(1)->execute();
        return $this->db->fetch();
    }

    public function delete(int $id)
    {
        $this->db->delete('author')->where('id', '=', $id);
        return $this->db->execute();
    }

    public function update(array $fields, int $id)
    {
        $this->db->update('author', $fields)->where('id', '=', $id);
        return $this->db->execute();
    }
}
