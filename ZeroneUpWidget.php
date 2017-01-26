<?php

namespace hectordelrio\zeroneUp;

use hectordelrio\zerone\ZeroneWidget;
use yii\base\InvalidConfigException;
use yii\base\Model;
use yii\helpers\Html;
use yii\widgets\InputWidget;


/**
 * Created by PhpStorm.
 * User: hector
 * Date: 20/01/17
 * Time: 15:05
 */
class ZeroneUpWidget extends InputWidget
{

    // remove-input options
    public $removeAttribute = null;
    public $removeName = null;

    // options for zerone-widget
    public $ratio = null;
    public $url = null;
    public $size = null;
    public $zoom = null;

    private $_width = null;
    private $_widthUnit = null;

    public function init()
    {

        if (($this->name === null or $this->removeName === null) and !$this->hasModel()) {

            throw new InvalidConfigException("Either 'name', or 'model', 'attribute' and 'removeAttribute' properties must be specified.");

        }

        if (!isset($this->options['id'])) {

            $this->options['id'] = $this->hasModel() ? Html::getInputId($this->model,
                $this->attribute) : $this->getId();

        }

        $this->_width = (float)filter_var($this->size, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $this->_widthUnit = substr($this->size, strlen($this->_width));

        if (empty($this->_widthUnit)) {

            $this->_widthUnit = 'px';

        }

    }

    protected function hasModel()
    {
        return ($this->model instanceof Model) and $this->attribute !== null and $this->removeAttribute !== null;
    }

    public function run()
    {
        $id = $this->getId();

        $fileInputID = $this->options['id'];

        $fileInput = $this->hasModel()
            ? Html::activeFileInput($this->model, $this->attribute, $this->options)
            : Html::fileInput($this->name, $this->value, $this->options);

        $removeInput = $this->hasModel()
            ? Html::activeHiddenInput($this->model, $this->removeAttribute,
                ['class' => 'zerone-up-image-removed-input'])
            : Html::hiddenInput($this->name, $this->value, ['class' => 'zerone-up-image-removed-input']);

        $imageWidget = ZeroneWidget::widget([
            'ratio' => $this->ratio,
            'url' => $this->url,
            'size' => $this->size,
            'zoom' => $this->zoom,
        ]);

        $width = $this->_width . $this->_widthUnit;

        \Yii::$app->view->registerCss(<<<CSS
#$id {
    width: $width;
}
CSS
        );


        \Yii::$app->view->registerJs(<<<JS
(function ($) {
    
    $(document).ready(function() {
        
        $('#$id')
            .on('change', '#$fileInputID', $.fn.zeroneSelect)
            .on('click', '.zerone-up-remove-image-btn', $.fn.zeroneRemove);
        
    });
    
})(window.jQuery);
JS
        );


        return $this->render('main', compact(
            'id',
            'fileInputID',
            'fileInput',
            'removeInput',
            'imageWidget'
        ));

    }

}