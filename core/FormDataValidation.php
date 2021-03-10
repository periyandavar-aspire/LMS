<?php
class FormDataValidation 
{
    public function customizeInput($data,ValidationRule $vr)
    {
        if ($vr->validate($data)) {
            return $vr->format($data);
        }
        return null;
    }
}