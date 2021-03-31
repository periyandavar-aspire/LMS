<?php

class AdminModel extends BaseModel
{
    public function getProfile(string $email)
    {
        $this->db->select('fullName', 'email', 'updatedAt')->from('admin_user')->where('email', '=', $email)->execute();
        $result = $this->db->fetch();
        return $result;
    }

    public function updateProfile(string $email, array $userData)
    {
        $result = $this->db->update('admin_user', $userData)->where('email', '=', $email)->execute();
        return $result;
    }

    public function updatePassword(string $email, string $password)
    {
        $result = $this->db->update('admin_user', ['password' => md5($password)])->where('email', '=', $email)->execute();
        return $result;
    }
    public function addCategory(array $category)
    {
        $result = $this->db->insert('category', $category)->execute();
        return $result;
    }
    public function getCategories()
    {
        $category = [];
        $result = $this->db->select("id", "name", "createdAt", "updatedAt", "status")->from('category')->execute();
        while($row = $this->db->fetch()) {
            $category[] = $row;
        }
        return $category;
    }

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

    // public function getBooks()
    // {
    //     $book = [];
    //     $result = $this->db->select("id", "name", "location", "publication", "isbnNumber", "stack", "available", "createdAt", "updatedAt", "status")->from('book')->execute();
    //     while($row = $this->db->fetch()) {
    //         $book[] = $row;
    //     }
    //     return $book;
    // }
    // public function addBook(array $book)
    // {
    //     $result = $this->db->insert('book', $book)->execute();
    //     return $result;
    // }

    public function getConfigs()
    {
        $result = $this->db->select("maxBookLend", "maxLendDays", "fineAmtPerDay", "maxBookRequest", "updatedAt")->from("core_config")->where('id=1')->execute();
        return $this->db->fetch();
    }

    public function getCmsConfigs()
    {
        $result = $this->db->select("aboutUs", "address", "mobile", "email", "fbUrl", "ytUrl", "instaUrl", "vision", "mission", "updatedAt")->from("cms")->where('id=1')->execute();
        return $this->db->fetch();
    }

    public function updateSettings(array $data)
    {
        $result = $this->db->update('core_config', $data)->where('id', '=', 1)->execute();
        return $result;
    }
    public function updateCmsConfigs(array $data)
    {
        $result = $this->db->update('cms', $data)->where('id', '=', 1)->execute();
        return $result;
    }
}
