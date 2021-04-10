<?php

class AuthorModel extends BaseModel
{
    public function getAll()
    {
        $authors = [];
        $result = $this->db->select("id", "name", "createdAt", "updatedAt", "status")->from('author');
        $this->db->where('deletionToken', '=', 'N/A')->execute();
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
        $this->db->where('deletionToken', '=', 'N/A')->limit(1)->execute();
        return $this->db->fetch();
    }

    public function delete(int $id)
    {
        $deletionToken = uniqid();
        $field = [ 'deletionToken' => $deletionToken];
        $this->db->update('author', $field)->where('id', '=', $id);
        return $this->db->execute();
    }

    public function update(array $fields, int $id)
    {
        $this->db->update('author', $fields)->where('id', '=', $id);
        $this->db->where('deletionToken', '=', 'N/A');
        return $this->db->execute();
    }

    public function getAuthorsLike(string $Searchkey, string $ignoreList)
    {
        $result = [];
        $this->db->select("id code", "name value")->from('author')->where('name', 'LIKE', "%" . $Searchkey . "%");
        $this->db->where('deletionToken', '=', 'N/A')->where('status', '=', 1);
        $this->db->where("NOT find_in_set(id, '$ignoreList')");
        $orderClause = "case when name like '$Searchkey%' THEN 0 WHEN name like '% %$Searchkey% %' THEN 1 WHEN name like '%$Searchkey' THEN 2 else 3 end, name";
        $this->db->orderBy($orderClause)->execute();
        while ($row = $this->db->fetch()) {
            $result[] = $row;
        }
        return $result;
    }
}
