<?php

namespace hectordelrio\zeroneUp;

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
        $input = $this->hasModel()
            ? Html::activeFileInput($this->model, $this->attribute, $this->options)
            : Html::fileInput($this->name, $this->value, $this->options);

        return $this->render('main', [
            'input' => $input,
            'imageWidgetOptions' => [
                'ratio' => $this->ratio,
                'url' => $this->url,
                'size' => $this->size,
                'zoom' => $this->zoom,
            ],
        ]);

    }

}