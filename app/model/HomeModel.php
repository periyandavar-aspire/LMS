<?php

class HomeModel extends BaseModel
{
    public function __construct()
    {
        parent::__construct();
    }

    // public function getData()
    // {
    //     $result = $this->db->runQuery("SELECT * FROM user");
    //     $result = $this->db->fetch();
    //     print_r($result);

    //     $this->db->selectAll()->from('user')->execute();
    //     $result = $this->db->fetch();
    //     print_r($result);
    // }

    public function getGenderCodes()
    {
        $result = [];
        $this->db->select('code')->from('gender');
        $this->db->where('isDeleted', '=', 0)->execute();
        while ($row = $this->db->fetch()) {
            $result[] = $row->code;
        }
        return $result;
    }

    public function getAvailableBooks()
    {
        $book = [];
        $this->db->select('b.id id', 'b.name name', 'a.name author', 'description', 'available', 'coverPic')->from('book b');
        $this->db->innerJoin('book_author ba')->on('b.id = ba.bookId')->innerJoin('author a')->on('ba.authorId = a.id');
        $this->db->where('b.isDeleted', '=', 0)->orderby('RAND()')->execute();
        while ($row = $this->db->fetch()) {
            $book[] = $row;
        }
        return $book;
    }

    public function getGender()
    {
        $result = [];
        $i = 0;
        $this->db->select('code', 'value')->from('gender');
        $this->db->where('isDeleted', '=', 0)->execute();
        while ($row = $this->db->fetch()) {
            $result[$i]['code'] = $row->code;
            $result[$i]['value'] = $row->value;
            $i++;
        }
        return $result;
    }

    public function getUserPass(string $username)
    {
        $this->db->select('password');
        $this->db->from('user');
        $this->db->where('username', '=', $username);
        $this->db->where('isDeleted', '=', 0);
        $this->db->execute();
        $result = $this->db->fetch();
        if ($result != null) {
            return $result->password;
        } else {
            return null;
        }
    }

    public function createAccount(array $fields)
    {
        $fields['password'] = md5($fields['password']);
        $flag = $this->db->insert('user', $fields)->execute();
        return  $flag;
    }

    public function getFooterData()
    {
        $this->db->select('aboutUs', 'address', 'mobile', 'email', 'fbUrl', 'ytUrl', 'instaUrl')->from('cms');
        $this->db->where('id', '=', 1)->limit(1)->execute();
        $result = $this->db->fetch();
        return $result;
    }
    
    public function getVision()
    {
        $this->db->select('vision')->from('cms')->where('id', '=', 1)->limit(1)->execute();
        $result = $this->db->fetch();
        return $result->vision;
    }

    public function getMission()
    {
        $this->db->select('mission')->from('cms')->where('id', '=', 1)->limit(1)->execute();
        $result = $this->db->fetch();
        return $result->mission;
    }
    
    // public function getAboutUs()
    // {
    //     $this->db->select('aboutUs')->from('cms')->where('id','=',1)->limit(1)->execute();
    //     $result = $this->db->fetch();
    //     return $result->aboutUs;
    // }
}
