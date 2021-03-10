<?php

trait FileUploader
{   
    /**
     * @var array allowedFiles allowed files for uploading
     */
    private $allowedFiles = "*";
    /**
     * @var string maxFileSize maximum file size of the uploaded file
     */
    private $maxFileSize = 200000;
    
    public function setAllowedFile($extensions)
    {
        $this->allowedFiles = $extensions;
    }

    /**
     * @param int size
     * this function sets the maximum file uploaded size
     */
    public function setMaxFileSize(int $size)
    {
        $this->maxFileSize = $size;
    }

    public function checkExtension($filename)
    {
        $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        if ($this->allowedFiles == "*") {
            return true;
        } else if (is_array($this->allowedFiles)) {
            return in_array($extension, $this->allowedFiles);
        } else if (strtolower($this->allowedFiles) == $extension) {
            return true;
        }
        return false;
    }

    public function validateSize($size)
    {
        if ($this->maxFileSize < $size) {
            return false;
        } else {
            return true;
        }
    }

    // public function checkFileExists($file)
    // {
    //     return file_exists($file);
    // }

    public function validateFile($file)
    {
        if ($this->checkExtension($file['name']) && $this->validateSize($file['size'])) {
            return true;
        }
        return false;
    }

    public function uploadFile($file, $destination, $overwrite = false) 
    {
        if ($this->validateFile($file)) {
            if (!$overwrite) {
                if (file_exists($destination)) {
                    return false;
                }
            }
            move_uploaded_file($file['tmp_name'], $destination);
            return true;
        }
        return false; 
    }
}