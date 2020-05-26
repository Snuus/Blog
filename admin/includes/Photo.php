<?php


class Photo extends Db_object
{

    protected static $db_table = "photo";
    protected static $db_table_fields = array('title', 'description','filename','type','size');
    public $photo_id;
    public $title;
    public $description;
    public $filename;
    public $type;
    public $size;

    public $tmp_path;
    public $upload_directory = 'ímg';
    public $errors = array();
    public $upload_errors_array = array(
        UPLOAD_ERR_OK =>"There is no error",
        UPLOAD_ERR_INI_SIZE => "The Upload file exceeds the maximum filesize",
        UPLOAD_ERR_FORM_SIZE => "The upload file exceeds Max file size",
        UPLOAD_ERR_NO_FILE => "There is no file uploaded",
        UPLOAD_ERR_PARTIAL=> "the file was partially uploaded",
        UPLOAD_ERR_NO_TMP_DIR=> "Missing Temp folder",
        UPLOAD_ERR_CANT_WRITE=> "Failed to write to disk",
        UPLOAD_ERR_EXTENSION=> "A php extension stopped your upload"
    );

    public function set_file($file){
        if(empty($file) || !$file || !is_array($file)){
            $this->errors[] = "No file uploaded";
            return false;
        }elseif($file['error'] != 0){
            $this->errors[] = $this->upload_errors_array[$file['error']];
            return false;
        }else{
            $this->filename = basename($file['name']);
            $this->tmp_path = $file['tmp_path'];
            $this->type = $file['type'];
            $this->size = $file['size'];
        }
    }

    public function save(){
        if($this->photo_id){
            $this->update();
        }else{
            if(!empty($this->error)){
                return false;
            }

        if(empty($this->filemname) || empty($this->temp_path)){
            $this->errors[] = "File not available";
            return false;
        }
        $target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_directory . DS . $this->filename;

        if (file_exists($target_path)){
            $this->errors[] = "File {$this->filename} exists";
            return false;
        }
        if(move_uploaded_file($this->tmp_path,$target_path)) {
            if($this->create()){
                unset($this->$this->tmp_path);
                return true;
            }
          }else{
            $this->errors[] = "This folder has no write rights";
            return false;
        }

        }
    }
}
