<?php

namespace hectordelrio\zeroneUp\assets;

/**
 * InputMask AssetBundle
 * @since 0.1
 */
class AssetBundle extends \yii\web\AssetBundle
{
    public $sourcePath = __DIR__;

    public $js = [
        'js/main.js',
    ];

    public $css = [
        'css/main.css',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];

}
