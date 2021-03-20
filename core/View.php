<?php
    class View
    {
        private static $viewFolder = 'view';
        
        public static function load($file)
        {
            require_once 'app/'.self::$viewFolder.'/'.$file;
        }
    }
