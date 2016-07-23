<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model c006\widget\banner\models\WidgetBannerFiles */

$this->title = Yii::t('app', '', [
        'modelClass' => 'Banner File',
    ]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Banners'), 'url' => ['/banner']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Banner Files'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="widget-banner-files-update">

    <h1 class="title-large"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
