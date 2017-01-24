<?php
/**
 * Created by PhpStorm.
 * User: hector
 * Date: 20/01/17
 * Time: 15:07
 *
 * @var string $id
 * @var \yii\base\Model $model
 * @var \yii\web\View $this
 * @var string $fileInput
 * @var string $removeInput
 * @var string $imageWidget
 */

\hectordelrio\zeroneUp\assets\AssetBundle::register($this);

?>

<div id="<?= $id ?>" class="zerone-widget-container">

    <?= $imageWidget ?>

    <div class="btn btn-success select-image-btn"><?= Yii::t('app', 'Select an image...') ?></div>

    <div class="btn btn-danger remove-image-btn"><?= Yii::t('app', 'Remove image') ?></div>

    <?= $fileInput ?>

    <?= $removeInput ?>

    <?

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
    ?>

</div>
