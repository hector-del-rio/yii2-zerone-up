<?php
/**
 * Created by PhpStorm.
 * User: hector
 * Date: 20/01/17
 * Time: 15:07
 *
 * @var string $id
 * @var string $fileInputID
 * @var \yii\base\Model $model
 * @var \yii\web\View $this
 * @var string $fileInput
 * @var string $removeInput
 * @var string $imageWidget
 */

\hectordelrio\zeroneUp\assets\AssetBundle::register($this);

?>

<div id="<?= $id ?>" class="zerone-up-widget-container">

    <?= $imageWidget ?>

    <label class="btn btn-success zerone-up-select-image-btn" for="<?= $fileInputID ?>"><?= Yii::t('app',
            'Select an image...') ?></label>

    <div class="btn btn-danger zerone-up-remove-image-btn"><?= Yii::t('app', 'Remove image') ?></div>

    <?= $fileInput ?>

    <?= $removeInput ?>

</div>
