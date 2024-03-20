<?php

class ImageUploader
{
    private $image_name;
    private $image_type;
    private $image_tmp;
    private $image_size;
    private $upload_folder = __DIR__ . "/../storage/img/";
    private $max_size = 2 * 1024 * 1024;
    private $allowed_types = ["image/jpeg", "image/jpg", "image/png", "image/gif"];
    public $error;

    public function __construct($file)
    {
        $this->image_name = $file["image"]["name"];
        $this->image_size = $file["image"]["size"];
        $this->image_type = $file["image"]["type"];
        $this->image_tmp = $file["image"]["tmp_name"];

        $this->isEmpty();

        if ($this->error == null) $this->isImage();
        if ($this->error == null) $this->checkFileType();
        if ($this->error == null) $this->imageRename();
        if ($this->error == null) $this->sizeValidation();
        if ($this->error == null) $this->moveFile();
        //if ($this->error == null) $this->storeImage();
    }

    private function isEmpty()
    {
        if (empty($this->image_name)) {
            return $this->error = "Please select an image";
        }
    }

    private function isImage()
    {
        if (getimagesize($this->image_tmp) == null) {
            return $this->error = "Please select a valid image";
        }
    }

    private function checkFileType()
    {
        if (!in_array($this->image_type, $this->allowed_types)) {
            return $this->error = "Only (JPEG, JPG, PNG and GIF) images are allowed";
        }
    }

    private function imageRename()
    {
        $ext = pathinfo($this->image_name, PATHINFO_EXTENSION);
        $this->image_name = pathinfo($this->image_name, PATHINFO_FILENAME).'-'.date("d-m-Y-H-i-s") . "." . $ext;
    }

    private function sizeValidation()
    {
        if ($this->image_size > $this->max_size) {
            return $this->error = "Your image exceeds 2MB";
        }
    }

    private function moveFile()
    {
        if (!move_uploaded_file($this->image_tmp, $this->upload_folder.$this->image_name)) {
            $this->error = "File not stored, an error occurred, please try again";
        }
    }

    public function storeImage()
    {
        return '/storage/img/' . $this->image_name;
    }


}