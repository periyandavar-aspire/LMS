<?php

abstract class Dbhandler
{
    public function __construct()
    {
        $this->connect = makeConnection();
    }   

    public function __destruct()
    {
        closeConnection($this->connect);
    }

    abstract function makeConnection();
    abstract function executeQuery(string $query);
    abstract public function fetchQuery(string $query): array;
    abstract function closeConnection($connect);
}