<?php
class InputData
{
    /**
     * post data values
     */
    private $postData;
    /**
     * get data values
     */
    private $getData;
    /**
     * get session values
     */

    private $sessionData;
    /**
     * get files values
     */
    
    private $filesData;
    
    public function __construct()
    {
        $this->postData = $_POST;
        $this->getData = $_GET;
        $this->sessionData = $_SESSION;
        $this->filesData = $_FILES;
    }

    public function get($key = null, $default = null)
    {
        $value = $this->checkKey($this->getData, $key, $default);
        if(is_array($value)) {
            return $value;
        }
        return htmlspecialchars($value);
    }

    public function post($key = null, $default = null)
    {
        $value = $this->checkKey($this->postData, $key, $default);
        if(is_array($value)) {
            return $value;
        }
        return htmlspecialchars($value);
    }

    public function session($key = null, $default = null)
    {
        return $this->checkKey($this->sessionData, $key, $default);
    }

    public function files($key = null, $default = null)
    {
        return $this->checkKey($this->filesData, $key, $default);
    }

    private function checkKey($data, $key = null, $default = null)
    {
        if ($key) {
            if (isset($data[$key])) {
                return $data[$key];
            } else {
                return $default;
            }
        }
        return $data;
    }
}