<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel c006\widget\banner\models\search\WidgetBanner */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Banners');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="widget-banner-index">

    <h1 class="title-large"><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div>
        <?= Html::a(Yii::t('app', 'Create Banner Group'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Banner Files'), ['/banner/files/index'], ['class' => 'btn btn-primary']) ?>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'columns'      => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'name',
            [
                'attribute' => 'transition',
                'value'     => 'bannerTransitions.name'
            ],
            [
                'attribute' => 'type',
                'value'     => 'bannerTransitionTypes.name'
            ],
            'transition_time',
            'active',
            [
                'attribute' => 'Items',
                'format'    => 'raw',
                'value'     => function ($model) {
                    return Html::a(Yii::t('app', 'edit'), ['/banner/items/index', 'widget_banner_id' => $model->id], ['class' => 'btn btn-success']);
                }
            ],
            [
                'class'    => 'yii\grid\ActionColumn',
                'template' => '<div class="nowrap">{update} {delete}</div>'
            ],
        ],
    ]); ?>

</div>
