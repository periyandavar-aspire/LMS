<?php
interface ValidationRule
{
    public function validate($data);
    public function format($data);
}