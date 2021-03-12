<?php
class FormDataValidation 
{
    /**
     * performs the custom validation
     * @param string $data data to be validate
     * @param ValidationRule $vr ValidationRule Object defining custom validation and format
     */
    public function customValidation(string $data, ValidationRule $vr): bool
    {
        if ($vr->validate($data)) {
            return $vr->format($data);
        } else {
                return false;
        }
    }

    /**
     * performs mobile number validation
     */
    public function mobileNumberValidation(string $data): bool
    {
        return preg_match('/^[6789]\d{9}$/', $data);
    }

    /**
     * performs mail validation
     */
    public function mailValidation(string $data): bool
    {
        return preg_match('/^[a-zA-Z0-9+_.-]+@[a-zA-Z0-9.-]+$/', $data);
    }

    /**
     * validate all the passed $fields and returns the validation result
     * @param Fields $fields Fields object to be validate
     */
    public function validate(Fields $fields): bool
    {
        foreach ($fields as $field => $value) {
            $fieldName = $field;
            $data = $value["data"];
            $rule = $value["rule"];
            if ($rule instanceof ValidationRule) {
                $newValue = $this->customValidation($data, $rule);
                if ($newValue === false) {
                    return false; 
                } else {
                    $fields->setData($fieldName, $newValue);
                }
            } else if ($rule != "") {
                if (method_exists($this,$rule)) {
                    if (!$this->$rule($data)) {
                        return false;
                    }
                }
            }
        }
        return true;
    }
}