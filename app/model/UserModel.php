<?php

class UserModel extends BaseModel
{
    public function getProfile(string $username)
    {
        $this->db->select('fullName', 'userName', 'value gender', 'mobile', 'email', 'updatedAt')->from('user u');
        $this->db->innerJoin('gender g')->on('g.code = u.gender')->where('username', '=', $username)->execute();
        $result = $this->db->fetch();
        return $result;
    }

    public function updateProfile(string $username, array $userData)
    {
        $result = $this->db->update('user', $userData)->where('username', '=', $username)->execute();
        return $result;
    }

    public function updatePassword(string $username, string $password)
    {
        $result = $this->db->update('user', ['password' => md5($password)])->where('username', '=', $username)->execute();
        return $result;
    }

    public function getLentBooks(string $username)
    {
        $books = [];
        $this->db->select('isbnNumber', 'name bookName', "IFNULL(issuedAt,'')", "IFNULL(returnAt,'NotReturnYet')", 'issued_book.id', 'fine');
        $this->db->from('issued_book')->innerJoin('book')->using('isbnNumber')->innerJoin('user')->using('userName');
        $this->db->where('userName', '=', $username)->limit(10, 0)->execute();
        while ($row = $this->db->fetch()) {
            $books[] = $row;
        }
        return $books;
    }
}
