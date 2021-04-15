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

    public function get(?string $key = null, ?string $default = null)
    {
        $data = $this->checkKey($this->getData, $key, $default);
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $data[$key] = htmlspecialchars(trim($value));
            }
            return $data;
        }
        return htmlspecialchars(trim($data));
    }

    public function post(?string $key = null, ?string $default = null)
    {
        $data = $this->checkKey($this->postData, $key, $default);
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $data[$key] = htmlspecialchars(trim($value));
            }
            return $data;
        }
        return htmlspecialchars(trim($data));
    }

    public function session(?string $key, ?string $default = null): string
    {
        return base64_decode($this->checkKey($this->sessionData, $key, $default));
    }

    public function files(?string $key = null, ?string $default = null)
    {
        return $this->checkKey($this->filesData, $key, $default);
    }

    private function checkKey($data, ?string $key = null, ?string $default = null)
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
