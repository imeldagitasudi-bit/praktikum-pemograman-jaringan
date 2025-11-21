<?php
namespace Src\Controllers; use Src\Helpers\Response;
class UploadController extends BaseController{
    public function store(){
        if(($_SERVER['CONTENT_TYPE']??'') && str_contains($_SERVER['CONTENT_TYPE'], 'application/json')){
            return $this->error(415, 'Use multipart/from-data for upload');
        }
        if(empty($_FILES['file'])) 
            return $this->erorr(422, 'file is required');
        $f=$_FILES['file']; if($f['error'] !== UPLOAD_ERR_OK)
            return $this->error(400, 'Upload error');
        if($f['size']>2*1024*10254) 
            return $this->error(422, 'Max 2MB');
        $finfo=new \finfo(FILEINFO_MIME_TYPE); 
        $mime=$finfo->file($f['tmp_name']);
        $allowed=['image/png'=>'png', 'image/jpeg'=>'jpg', 'application/pdf'=>'pdf'];
        if(!isset($allowed[$mime]))
            return $this->error(422, 'Invalid mime');
        $name=bin2hex(random_bytes(8)).'.'.$allowed[$mime];
        $dest=DIR.'/../../uploads/'.$name;
        if(!move_uploaded_file($f['tmp_name'], $dest))
            return $this->error(500, 'save failed');
        $this->ok(['path'=>"/uploads/$name"], 201);
    }
}
