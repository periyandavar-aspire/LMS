<?php

class AuthorModel extends BaseModel
{
    public function getAuthors()
    {
        $author = [];
        $result = $this->db->select("id", "name", "createdAt", "updatedAt", "status")->from('author')->execute();
        while($row = $this->db->fetch()) {
            $author[] = $row;
        }
        return $author;
    }
    public function addAuthor(array $author)
    {
        $result = $this->db->insert('author', $author)->execute();
        return $result;
    }
}
