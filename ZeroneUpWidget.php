<?php

namespace hectordelrio\zeroneUp;

use Yii;
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

    // the name of remove attribute
    public $removeAttribute = null;

    // input options
    public $inputOptions = [];
    public $inputButtonOptions = [];

    // remove-input options
    public $removeInputOptions = [];
    public $removeButtonOptions = [];

    // options for zerone-widget
    public $ratio = null;
    public $url = null;
    public $size = null;
    public $zoom = null;

    private $_width = null;
    private $_widthUnit = null;

    public function init()
    {

        if (($this->name === null or $this->removeAttribute === null) and !$this->hasModel()) {

            throw new InvalidConfigException("Either 'name', or 'model', 'attribute' and 'removeAttribute' properties must be specified.");

        }

        if (!isset($this->options['id'])) {

            $this->options['id'] = $this->getId();

        }

        if (!isset($this->inputOptions['id'])) {

            $this->inputOptions['id'] = $this->hasModel()
                ? Html::getInputId($this->model, $this->attribute)
                : $this->getId() . '-file-input';

        }

        if (empty($this->url)) {

            Html::addCssClass($this->options, 'empty');

        }

        Html::addCssClass($this->options, 'zerone-up-widget-container');
        Html::addCssClass($this->removeInputOptions, 'zerone-up-image-removed-input');
        Html::addCssClass($this->removeButtonOptions, 'btn btn-danger zerone-up-remove-image-btn');
        Html::addCssClass($this->inputOptions, 'zerone-up-select-image-input');
        Html::addCssClass($this->inputButtonOptions, 'btn btn-success zerone-up-select-image-btn');

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
        $ret = '';
        $id = $this->options['id'];
        $fileInputID = $this->inputOptions['id'];
        $width = $this->_width . $this->_widthUnit;

        \hectordelrio\zeroneUp\assets\AssetBundle::register(\Yii::$app->view);

        \Yii::$app->view->registerCss("#$id { width: $width; }");

        \Yii::$app->view->registerJs(<<<JS
(function ($) {

    $(document)
        .on('change', '#$id > #$fileInputID', $.fn.zeroneSelect)
        .on('click', '#$id > .zerone-up-remove-image-btn', $.fn.zeroneRemove);

})(window.jQuery);
JS
        );

        $ret .= Html::beginTag('div', $this->options);

        $ret .= ZeroneWidget::widget([
            'ratio' => $this->ratio,
            'url' => $this->url,
            'size' => $this->size,
            'zoom' => $this->zoom,
        ]);

        $ret .= Html::label(
            Yii::t('app', 'Select an image...'),
            $fileInputID,
            $this->inputButtonOptions
        );


        $ret .= Html::label(
            Yii::t('app', 'Remove image'),
            null,
            $this->removeButtonOptions
        );

        $ret .= $this->hasModel()
            ? Html::activeFileInput($this->model, $this->attribute, $this->inputOptions)
            : Html::fileInput($this->name, $this->value, $this->inputOptions);

        $ret .= $this->hasModel()
            ? Html::activeHiddenInput($this->model, $this->removeAttribute, $this->removeInputOptions)
            : Html::hiddenInput($this->name, $this->value, $this->removeInputOptions);


        $ret .= Html::endTag('div');

        return $ret;

    }

}