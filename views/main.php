<?php
/**
 * Created by PhpStorm.
 * User: hector
 * Date: 20/01/17
 * Time: 15:07
 *
 * @var \yii\base\Model $model
 * @var \yii\web\View $this
 * @var string $input
 * @var array $imageWidgetOptions
 */

\hectordelrio\zeroneUp\assets\AssetBundle::register($this);

echo '<div class="zerone-widget-container">';

echo \hectordelrio\zerone\ZeroneWidget::widget($imageWidgetOptions);

// button select image
echo '<div class="btn btn-success">';
echo Yii::t('app', 'Select an image...');

echo $input;

//echo $form
//    ->field(
//        $langModel,
//        "[$languageCode]fileUpload",
//        [
//            'template' => '{input}',
//            'options' => ['tag' => false]
//        ]
//    )
//    ->fileInput(['class' => 'image-input']);

echo '</div>';

// button remove image
echo '<div class="btn btn-danger">';
echo Yii::t('app', 'Remove image');

//echo $form
//    ->field(
//        $langModel,
//        "[$languageCode]fileRemoved",
//        [
//            'template' => '{input}',
//            'options' => ['tag' => false]
//        ]
//    )
//    ->hiddenInput([
//        'class' => 'image-removed-input',
//        'value' => '0',
//    ]);
echo '</div>';
echo '</div>';