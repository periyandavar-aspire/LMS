<?php
class Fields implements Iterator
{
    use FileUploader;
    /**
     * @var array $fields list of fields stored in array
     */
    private $fields;

    /**
     * @param array $fields null value or array of strings
     * constructor function used to initiate $fields
     */
    public function __construct(?array $fields = null)
    {
        if ($fields == null) {
            $this->fields = null;
        } else {
            foreach ($fields as $field) {
                $this->fields[$field]['data'] = null;
                $this->fields[$field]['rule'] = [];
            }
        }
    }
    /**
     * add passed set of fields(strings) to $fields
     */
    public function addFields(...$fields)
    {
        foreach ($fields as $field) {
            $this->fields[$field]['data'] = null;
            $this->fields[$field]['rule'] = [];
        }
    }
    /**
     * removes fields
     * removes the set of passed fields(strings) to $fields
     */
    public function removeFields(...$fields)
    {
        foreach ($fields as $field) {
            unset($this->$fields[$field]);
        }
        $this->fields = array_values($fields);
    }

    /**
     * @param array $values
     * sets the values for the fields
     */
    public function addValues(array $values)
    {
        foreach ($values as $key => $value) {
            if (isset($this->fields[$key])) {
                $this->fields[$key]['data'] = $value;
            }
        }
    }

    /**
     * @return array $values
     * gives all the values for the fields as array
     */
    public function getValues()
    {
        $values = [];
        foreach ($this->fields as $field => $value) {
            $fieldName = $field;
            $data = $value["data"];
            $values[$fieldName] = $data;
        }
        return $values;
    }

    /**
     * @param array $fieldsRules as (fields=>rules)
     */
    public function addRule(array $fieldsRules)
    {
        foreach ($fieldsRules as $key => $values) {
            if (isset($this->fields[$key])) {
                if (is_array($values)) {
                    foreach ($values as $value) {
                        $this->fields[$key]['rule'][] = $value;
                    }
                } else {
                    $this->fields[$key]['rule'][] = $values;
                }
            }
        }
    }

    /**
     * sets the required fields
     */
    public function setRequiredFields(...$fields)
    {
        foreach ($fields as $field) {
            if (isset($this->fields[$field])) {
                $this->fields[$field]['rule'][] = 'required';
            }
        }
    }

    /**
     * renmae the field
     */
    public function renameFieldName(string $oldName, string $newName)
    {
        if (array_key_exists($oldName, $this->fields)) {
            $this->fields[$newName] = $this->fields[$oldName];
            unset($this->fields[$oldName]);
        }
    }
    /**
     * return fields data values as association array
     */
    public function getData(): array
    {
        $fieldsData=[];
        foreach ($this->fields as $key => $value) {
            if (isset($value['data'])) {
                $fieldsData[$key] = $value['data'];
            }
        }
        return $fieldsData;
    }

    /**
     * adds  the custom rule to the fields
     * @param string $field fieldname
     * @param ValidationRule $vr ValidationRule Object
     */
    public function addCustomeRule(string $field, ValidationRule $vr)
    {
        if (isset($this->fields[$field])) {
            $this->fields[$field]['rule'][] = $vr;
        }
    }

    /**
     * change the data value for the fields
     * @param string $key field name
     * @param string $value filed value
     */
    public function setData(string $key, string $value)
    {
        if (isset($this->fields[$key])) {
            $this->fields[$key]['data'] = $value;
        }
    }

    public function rewind()
    {
        reset($this->fields);
    }

    public function valid(): bool
    {
        $flag = key($this->fields);
        $flag = ($flag !== null);
        return $flag;
    }

    public function key(): string
    {
        return key($this->fields);
    }

    public function current(): array
    {
        return current($this->fields);
    }

    public function next()
    {
        return next($this->fields);
    }
}
