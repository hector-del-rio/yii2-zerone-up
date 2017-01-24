<?php

namespace hectordelrio\zeroneUp;

use yii\db\ActiveRecord;
use yii\web\UploadedFile;

/**
 * Class UploadTrait
 *
 * This trait adds two virtual attributes called fileUpload fileRemoved
 *
 * @package app\components
 */
trait UploadTrait
{
    private $_fileRemoved;
    private $_fileUpload;

    /**
     * @return mixed
     */
    public function getFileRemoved()
    {
        return $this->_fileRemoved;
    }

    /**
     * @param mixed $_fileRemoved
     */
    public function setFileRemoved($_fileRemoved)
    {
        $this->_fileRemoved = filter_var($_fileRemoved, FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * @return mixed
     */
    public function getFileUpload()
    {
        return $this->_fileUpload;
    }

    /**
     * @param $_fileUpload
     */
    public function setFileUpload($_fileUpload)
    {
        $this->_fileUpload = $_fileUpload;
    }

    /**
     * @return bool
     */
    public function beforeValidate()
    {

        $attribute = "fileUpload";

        /** @var ActiveRecord $this */
        if ($this->hasAttribute('language')) {

            $attribute = "[{$this->language}]fileUpload";

        }

        $uploadedFile = UploadedFile::getInstance($this, $attribute);

        if ($uploadedFile instanceof UploadedFile) {

            $this->setFileUpload($uploadedFile);

        }

        return true;

    }

    /**
     * @param $insert
     * @return bool
     */
    public function beforeSave($insert)
    {

        // handle file upload
        if (($file = $this->getFileUpload()) instanceof UploadedFile) {

            // base64 encode uploaded file
            $data = base64_encode(file_get_contents($file->tempName));
            $mime = mime_content_type($file->tempName);

            $this->image = "data:$mime;base64,$data";

        } elseif ($this->getFileRemoved() === true) {

            // remove file
            $this->image = null;

        }

        // save image hash
        if (!empty($this->image)) {

            $this->image_hash = md5($this->image);

        } else {

            $this->image_hash = null;

        }

        return true;

    }

}