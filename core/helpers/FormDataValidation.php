<?php
class FormDataValidation 
{
    /**
     * performs the custom validation
     * @param string $data data to be validate
     * @param ValidationRule $vr ValidationRule Object defining custom validation and format
     */
    public function customValidation(?string $data, ValidationRule $vr): bool
    {
        return $vr->validate($data);
    }

    /**
     * performs mobile number validation
     */
    public function mobileNumberValidation(string $data): bool
    {
        return preg_match('/^[6789]\d{9}$/', $data);
    }

    /**
     * performs mobile alpha and space validation
     */
    public function alphaSpaceValidation(string $data): bool
    {
        return preg_match('/^[A-Za-z ]*$/', $data);
    }

    /**
     * performs mail validation
     */
    public function mailValidation(string $data): bool
    {
        return preg_match('/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/', $data);
    }

    /**
     * performs custom reqular expression validation
     */
    public function expressValidation(string $data, string $expression): bool
    {
        return preg_match($expression, $data);
    }

    /**
     * validates length
     */
    public function lengthValidation(string $data, ?int $minlength, ?int $maxlength = null): bool
    {
        if ($minlength != null) {
            if (strlen($data) < $minlength) {
                return false;
            }
        }
        if ($maxlength != null) {
            if (strlen($data) > $maxlength) {
                return false;
            }
        }
        return true;
    }

    /**
     * required fields validation
     */
    public function required(?string $data): bool
    {
        if ($data == null) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * validate all the passed $fields and returns the validation result
     * @param Fields $fields Fields object to be validate
     */
    public function validate(Fields $fields, &$invalidField = null): bool
    {
        foreach ($fields as $field => $value) {
            $fieldName = $field;
            $data = $value["data"];
            $rules = $value["rule"];
            if ($rules != "" && $rules != null) {
                foreach ((array)$rules as $rule) {
                    if ($rule instanceof ValidationRule) {
                        $newValue = $this->customValidation($data, $rule);
                        if ($newValue === false) {
                            $invalidField = $fieldName;
                            return false; 
                        } else {
                            $fields->setData($fieldName, $newValue);
                        }
                    } else {
                        $params = explode(" ", $rule);
                        $rule = array_shift($params);
                        if (method_exists($this, $rule)) {
                            if (count($params) == 0) {
                                if (!$this->$rule($data)) {
                                    $invalidField = $fieldName;
                                    return false;
                                }
                            } else if (count($params) != 0) {
                                if (!$this->$rule($data, ...$params)) {
                                    $invalidField = $fieldName;
                                    return false;
                                }
                            }
                        }
                    }
                }
            }
        }
        return true;
    }
}