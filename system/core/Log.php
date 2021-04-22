<?php
/**
 * Loader File
 * php version 7.3.5
 *
 * @category   Loader
 * @package    SYS
 * @subpackage Libraries
 * @author     Periyandavar <periyandavar@gmail.com>
 * @license    http://license.com license
 * @link       http://url.com
 */

defined('VALID_REQ') or exit('Not a valid Request');

/**
 * Loader Class autoloads the files
 *
 * @category   Loader
 * @package    SYS
 * @subpackage Libraries
 * @author     Periyandavar <periyandavar@gmail.com>
 * @license    http://license.com license
 * @link       http://url.com
 */
class Log
{
    /**
     * Activity log file name
     *
     * @var null|string
     */
    private $_activity = null;

    /**
     * Error log file name
     *
     * @var null|string
     */
    private $_error = null;

    private $_levels = [
        0 => 0, 
        'FATAL' => 1, 
        'ERROR' => 2, 
        'WARNING' => 3, 
        'DEBUG' => 4, 
        'INFO' => 5, 
        'ALL' => 6
    ];

    /**
     * Directory name
     *
     * @var string
     */
    private $_dir;

    private $_level;

    private static $_instance;

    /**
     * Undocumented function
     *
     * @param string $level Levels
     */
    public function __construct($level = 'ALL')
    {
        global $config;
        $this->_level = in_array($level, array_keys($this->_levels))
            ? $level
            : "ALL";
        $this->_dir = $config['logs'];
        $this->initialize();
    }

    /**
     * Ini
     *
     * @return void
     */
    public function initialize()
    {
        $dir = opendir($this->_dir);
        while (($log = readdir($dir)) !== false) {
            if ($log == '.'
                || $log == '..'
                || !(Utility::endswith($log, '-error.log'))
            ) {
                continue;
            }
            if (filectime($this->_dir . '/' . $log) <= time() - 14 * 24 * 60 * 60) {
                unlink($this->_dir . '/' . $log);
            }
        }
        closedir($dir);
        $prefix = Date('Y-m-d');
        $this->_error = $this->_error ?? $prefix . '-error.log';
        $this->_activity = $this->_activity ?? $prefix . '-activity.log';
        if (!file_exists($this->_dir .'/'. $this->_error)) {
            fclose(fopen($this->_dir .'/'. $this->_error, 'w'));
        }
        if (!file_exists($this->_dir .'/'. $this->_activity)) {
            fclose(fopen($this->_dir .'/'. $this->_activity, 'w'));
        }
    }

    /**
     * Returns the instance of Log
     *
     * @param string $level Default ALL
     *
     * @return Log
     */
    public static function getInstance($level = 'ALL'): Log
    {
        self::$_instance = self::$_instance ?? new Log($level);
        return self::$_instance;
    }

    /**
     * Add contents to Error log with ERROR Level
     *
     * @param string $msg  Error message
     * @param string $data data to be append
     *
     * @return bool
     */
    public function error($msg, $data = null): bool
    {
        if ($this->_levels[$this->_level] >= $this->_levels['ERROR']) {
            $msg = $this->format($msg, 'ERROR', date("m/d/Y h:i:s"));
            return $this->_add($this->_dir . '/' . $this->_error, $msg, $data);
        }
        return true;
    }

    /**
     * Add contents to Error log with INFO Level
     *
     * @param string $msg  Error message
     * @param string $data data to be append
     *
     * @return bool
     */
    public function info($msg, $data = null): bool
    {
        if ($this->_levels[$this->_level] >= $this->_levels['INFO']) {
            $msg = $this->format($msg, 'INFO', date("m/d/Y h:i:s"));
            return $this->_add($this->_dir . '/' . $this->_error, $msg, $data);
        }
        return true;
    }

    /**
     * Add contents to Error log with WARNING Level
     *
     * @param string $msg  Error message
     * @param string $data data to be append
     *
     * @return bool
     */
    public function warning($msg, $data = null): bool
    {
        if ($this->_levels[$this->_level] >= $this->_levels['WARNING']) {
            $msg = $this->format($msg, 'WARNING', date("m/d/Y h:i:s"));
            return $this->_add($this->_dir . '/' . $this->_error, $msg, $data);
        }
        return true;
    }

    /**
     * Add contents to Error log with FATAL Level
     *
     * @param string $msg  Error message
     * @param string $data data to be append
     *
     * @return bool
     */
    public function fatal($msg, $data = null): bool
    {
        if ($this->_levels[$this->_level] >= $this->_levels['FATAL']) {
            $msg = $this->format($msg, 'FATAL', date("m/d/Y h:i:s"));
            return $this->_add($this->_dir . '/' . $this->_error, $msg, $data);
        }
        return true;
    }

    /**
     * Add contents to Error log with DEBUG Level
     *
     * @param string $msg  Error message
     * @param string $data data to be append
     *
     * @return bool
     */
    public function debug($msg, $data = null): bool
    {
        if ($this->_levels[$this->_level] >= $this->_levels['DEBUG']) {
            $msg = $this->format($msg, 'DEBUG', date("m/d/Y h:i:s"));
            return $this->_add($this->_dir . '/' . $this->_error, $msg, $data);
        }
        return true;
    }

    /**
     * Add contents to activity log
     *
     * @param string $msg  Error message
     * @param string $data data to be append
     *
     * @return bool
     */
    public function activity($msg, $data = null): bool
    {
        $msg = $this->format($msg, 'INFO', date("m/d/Y h:i:s"));
        return $this->_add($this->_dir . '/' . $this->_activity, $msg, $data);
    }

    /**
     * Add contents to activity log
     *
     * @param string $file Filename
     * @param string $msg  Error message
     * @param string $data data to be append
     *
     * @return bool
     */
    protected function custom($file, $msg, $data = null): bool
    {
        $msg .= "[" . date("m/d/Y h:i:s") . "]";
        return $this->_add($this->_dir . '/' . $file, $msg, $data);
    }

    /**
     * Format the log message
     *
     * @param string $msg   Message
     * @param string $level Level
     * @param string $date  Date
     *
     * @return string
     */
    protected function format(string $msg, string $level, string $date): string
    {
        $format = "[$date] [$level] : " . $msg;
        return $format;
    }

    /**
     * Writes to log file
     *
     * @param string $file Filename
     * @param string $msg  Message
     * @param array  $data Data
     *
     * @return bool
     */
    private function _add(string $file, string $msg, array $data)
    {
        $fp = fopen($file, "a") or null;
        if ($fp != null) {
            fwrite($fp, $msg);
            fwrite($fp, " Data : " . print_r($data, true) . "\n");
            fclose($fp);
            return true;
        } else {
            return false;
        }
    }
}
