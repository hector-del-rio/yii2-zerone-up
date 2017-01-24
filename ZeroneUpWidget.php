<?php

namespace hectordelrio\zeroneUp;

use hectordelrio\zerone\ZeroneWidget;
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

    public $ratio = null;
    public $url = null;
    public $size = null;
    public $zoom = null;

    public function run()
    {
        $id = $this->getId();

        $fileInput = $this->hasModel()
            ? Html::activeFileInput($this->model, $this->attribute, $this->options)
            : Html::fileInput($this->name, $this->value, $this->options);

        $removeInput = $this->hasModel()
            ? Html::activeHiddenInput($this->model, $this->attribute)
            : Html::hiddenInput($this->name, $this->value);

        $imageWidget = ZeroneWidget::widget([
            'ratio' => $this->ratio,
            'url' => $this->url,
            'size' => $this->size,
            'zoom' => $this->zoom,
        ]);

        \Yii::$app->view->registerJs(<<<JS
(function ($) {
    
    $('#$id')
        .on('click', '.remove-image-btn', $.fn.zeroneRemove)
        .on('change', '.image-input', $.fn.zeroneSelect);
    
})(window.jQuery);
JS
        );


        return $this->render('main', compact(
            'id',
            'fileInput',
            'removeInput',
            'imageWidget'
        ));

    }

}