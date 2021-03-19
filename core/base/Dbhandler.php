<?php

abstract class Dbhandler
{
    protected $db;
    
    public function close() {
        $this->db = null;
    }

    // abstract public function open();
}