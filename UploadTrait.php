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

}
