<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel c006\widget\banner\models\search\WidgetBannerFiles */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = Yii::t('app', 'Banner Files');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Banners'), 'url' => ['/banner']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="widget-banner-files-index">

    <h1 class="title-large"><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Upload Banner Files'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Banners'), ['/banner'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'columns'      => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'name',
            [
                'attribute' => 'image',
                'format'    => 'raw',
                'value'     => function ($model) {
                    return '<div><img src="//' . str_replace('manage.', '', $_SERVER['SERVER_NAME']) . '/images/widget/banner/' . $model->file . '?' . time() . '" height="100" /></div>';
                },
            ],
            'file',
            'width',
            'height',
            [
                'class'    => 'yii\grid\ActionColumn',
                'template' => '<div class="nowrap">{update} {delete}</div>',
            ],
        ],
    ]); ?>

</div>
