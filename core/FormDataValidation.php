<?php
/**
 * FormDataValidation File Doc Comment
 * php version 7.3.5
 *
 * @category FormDataValidation
 * @package  FormDataValidation
 * @author   Periyandavar <periyandavar@gmail.com>
 * @license  http://license.com license
 * @link     http://url.com
 */
/**
 * Fields Class used to store the input fields
 * User defined Error controller should implement this interface
 *
 * @category FormDataValidation
 * @package  FormDataValidation
 * @author   Periyandavar <periyandavar@gmail.com>
 * @license  http://license.com license
 * @link     http://url.com
 */
class FormDataValidation
{
    /**
     * Performs the custom validation
     *
     * @param string         $data data to be validate
     * @param ValidationRule $vr   ValidationRule Object defining custom validation
     * @param string         $msg  where the error msg will be stored
     *
     * @return bool
     */
    public function customValidation(
        string $data,
        ValidationRule $vr,
        ?string &$msg = null
    ): bool {
        return $vr->validate($data, $msg);
    }

    /**
     * Check whether the values are in the given set of values
     *
     * @param string $data     data
     * @param mixed  ...$value values set
     *
     * @return [type]
     */
    public function valuesInValidation(string $data, ...$value)
    {
        return in_array($data, $value);
    }

    /**
     * Performs mobile number validation
     *
     * @param string $data data
     *
     * @return bool
     */
    public function mobileNumberValidation(string $data): bool
    {
        return preg_match('/^[6789]\d{9}$/', $data);
    }

    /**
     * Performs alpha and space validation
     *
     * @param string $data Data
     *
     * @return bool
     */
    public function alphaSpaceValidation(string $data): bool
    {
        return preg_match('/^[A-Za-z ]*$/', $data);
    }

    /**
     * Performs email validation
     *
     * @param string $data Data
     *
     * @return bool
     */
    public function emailValidation(string $data): bool
    {
        return preg_match(
            '/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/',
            $data
        );
    }

    /**
     * Performs numeric validation and range validation
     *
     * @param string       $data  Data
     * @param integer|null $start Starting Index
     * @param integer|null $end   Ending Index
     *
     * @return boolean
     */
    public function numericValidation(
        string $data,
        ?int $start = null,
        ?int $end = null
    ): bool {
        $flag = is_numeric($data);
        if ($flag) {
            if (isset($start)) {
                $flag = (int)$data > $start;
            }
            if (isset($end)) {
                $flag = (int)$flag && ($data < $end);
            }
        }
        return $flag;
    }

    /**
     * Check whether the data is valid positive number or not
     *
     * @param string $data Data
     *
     * @return bool
     */
    public function positiveNumberValidation(string $data): bool
    {
        return $this->numericValidation($data, -1);
    }

    /**
     * Performs custom reqular expression validation
     *
     * @param string $data       Data
     * @param string $expression Regular expression pattern
     *
     * @return bool
     */
    public function expressValidation(string $data, string $expression): bool
    {
        return preg_match($expression, $data);
    }

    /**
     * Validates the length
     *
     * @param string $data      Data
     * @param int    $minlength Minimum Length
     * @param int    $maxlength Maximum Length
     *
     * @return bool
     */
    public function lengthValidation(
        string $data,
        ?int $minlength,
        ?int $maxlength = null
    ): bool {
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
     * Required fields validation
     *
     * @param string $data Data
     *
     * @return bool
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
     * Validates all the passed $fields and returns the validation result
     *
     * @param Fields $fields       Fields object to be validate
     * @param string $invalidField string refernce where the invalid field
     *                             will be stored on this variable
     *
     * @return bool
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
                        }
                    } else {
                        $params = explode(" ", $rule);
                        $rule = array_shift($params);
                        if (method_exists($this, $rule)) {
                            if (count($params) == 0) {
                                if ($data == null) {
                                    if (in_array("required", (array)$rules)) {
                                        $invalidField = $fieldName;
                                        return false;
                                    } else {
                                        continue;
                                    }
                                } elseif (!$this->$rule($data)) {
                                    $invalidField = $fieldName;
                                    return false;
                                }
                            } elseif (count($params) != 0) {
                                if ($data == null) {
                                    if (in_array("required", (array)$rules)) {
                                        $invalidField = $fieldName;
                                        return false;
                                    } else {
                                        continue;
                                    }
                                } elseif (!$this->$rule($data, ...$params)) {
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
