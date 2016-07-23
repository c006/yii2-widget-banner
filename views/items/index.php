<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel c006\widget\banner\models\search\WidgetBannerItems */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Banner Items');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Banners'), 'url' => ['/banner']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="widget-banner-items-index">

    <h1 class="title-large"><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Banner Item'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Banners'), ['/banner'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Banner Files'), ['/banner/files/index'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'columns'      => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'banner',
                'value'     => 'banner.name'
            ],
            'name',
            'url:url',
            [
                'attribute' => 'image',
                'format'    => 'raw',
                'value'     => function ($model) {
                    $m = \c006\widget\banner\models\WidgetBannerFiles::findOne($model->file_id);
                    if (is_object($m)) {
                        return '<div><img src="//' . str_replace('manage.', '', $_SERVER['SERVER_NAME']) . '/images/widget/banner/' . $m->file . '" height="100" /></div>';
                    }

                    return 'ID: ' . $model->file_id;
                },
            ],
            [
                'attribute' => 'date_start',
                'value'     => function ($model) {
                    return '' . date('M d, Y', $model->date_start) . ' ' . substr("000" . $model->date_start_hour, -2) . ':00';
                }
            ],
            [
                'attribute' => 'date_end',
                'value'     => function ($model) {
                    return '' . date('M d, Y', $model->date_end) . ' ' . substr("000" . $model->date_end_hour, -2) . ':00';
                }
            ],
            'pause',
            [
                'class'    => 'yii\grid\ActionColumn',
                'template' => '<div class="nowrap">{update} {delete}</div>'
            ],
        ],
    ]); ?>

</div>
