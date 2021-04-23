<?php
/**
 * InputData File Doc Comment
 * php version 7.3.5
 *
 * @category InputData
 * @package  InputData
 * @author   Periyandavar <periyandavar@gmail.com>
 * @license  http://license.com license
 * @link     http://url.com
 */
/**
 * InputData Class used to access the GET, POST and SESSION values
 *
 * @category InputData
 * @package  InputData
 * @author   Periyandavar <periyandavar@gmail.com>
 * @license  http://license.com license
 * @link     http://url.com
 */
class InputData
{
    /**
     * Post data values
     *
     * @var array
     */
    private $_postData;

    /**
     * Get data values
     *
     * @var array
     */
    private $_getData;

    /**
     * Session Data values
     *
     * @var array
     */
    private $_sessionData;

    /**
     * File array values
     *
     * @var array
     */
    private $_fileData;

    /**
     * Instantiate new InputData instance
     */
    public function __construct()
    {
        $this->_postData = $_POST;
        $this->_getData = $_GET;
        $this->_sessionData = $_SESSION;
        $this->_fileData = $_FILES;
    }

    /**
     * This function is used to get the values form GET array
     *
     * @param string|null $key     key name
     * @param string|null $default default value
     *
     * @return void
     */
    public function get(?string $key = null, ?string $default = null)
    {
        $data = $this->_checkKey($this->_getData, $key, $default);
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $data[$key] = htmlspecialchars(trim($value));
            }
            return $data;
        }
        return htmlspecialchars(trim($data));
    }

    /**
     * This function is used to get the values form POST array
     *
     * @param string|null $key     key name
     * @param string|null $default default value
     *
     * @return void
     */
    public function post(?string $key = null, ?string $default = null)
    {
        $data = $this->_checkKey($this->_postData, $key, $default);
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $data[$key] = htmlspecialchars(trim($value));
            }
            return $data;
        }
        return htmlspecialchars(trim($data));
    }

    /**
     * This function is used to get the values form SESSION array
     *
     * @param string|null $key     key name
     * @param string|null $default default value
     *
     * @return void
     */
    public function session(?string $key, ?string $default = null): string
    {
        return base64_decode($this->_checkKey($this->_sessionData, $key, $default));
    }

    /**
     * This function is used to get the values form FILE array
     *
     * @param string|null $key     key name
     * @param string|null $default default value
     *
     * @return void
     */
    public function files(?string $key = null, ?string $default = null)
    {
        return $this->_checkKey($this->_fileData, $key, $default);
    }

    /**
     * This function is used to check the given key is exists in the array or not
     * and returns the value if the key is exists else false
     *
     * @param array       $data    Data
     * @param string|null $key     Key name
     * @param string|null $default Default value
     *
     * @return mixed
     */
    private function _checkKey(
        array $data,
        ?string $key = null,
        ?string $default = null
    ) {
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
