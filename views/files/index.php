<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel c006\widget\banner\models\search\WidgetBannerFiles */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Banner Files');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Banners'), 'url' => ['/banner']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="widget-banner-files-index">

    <h1 class="title-large"><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="item-container margin-top-30 margin-bottom-20">
        <?= Html::a(Yii::t('app', 'Upload Banner Files'), ['create'], ['class' => 'btn btn-secondary']) ?>
        <?= Html::a(Yii::t('app', 'Banners'), ['/banner'], ['class' => 'btn btn-primary']) ?>


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
                        return '<div><img src="' . Yii::$app->params['frontend'] . '/images/widget/banner/' . $model->file . '?' . time() . '" height="100" /></div>';
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
</div>
