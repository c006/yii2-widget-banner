<?php

use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model c006\widget\banner\models\WidgetBanner */
/* @var $form yii\widgets\ActiveForm; */
?>

<div class="widget-banner-form">

    <?php $form = ActiveForm::begin([]); ?>

    <?= $form->field($model, 'id')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => TRUE])->label('Group Name')->hint('Example: Home Page or Catalog Page') ?>

    <div class="table">
        <div class="table-cell"><?
            $model_link = \c006\widget\banner\models\WidgetBannerTransitions::find()->orderBy('name')->all();
            $model_link = ArrayHelper::map($model_link, 'id', 'name');
            echo $form->field($model, 'transition_id')->dropDownList($model_link)->label('Transition') ?></div>
        <div class="table-cell"><?
            $model_link = \c006\widget\banner\models\WidgetBannerTransitionTypes::find()->orderBy('id')->all();
            $model_link = ArrayHelper::map($model_link, 'id', 'name');
            echo $form->field($model, 'transition_type_id')->dropDownList($model_link)->label('Easing')->hint('Examples page <a href="https://jqueryui.com/easing/" target="_blank">jquery ui demo</a>') ?></div>
        <div class="table-cell"><?= $form->field($model, 'transition_time')->textInput(['maxlength' => TRUE])->label('Transition Time')->hint('Milliseconds ( 1000ms = 1 second )') ?></div>
    </div>

    <?= $form->field($model, 'css')->textarea()->hint('.WidgetBanner {} and .WidgetBanner-item {}') ?>

    <?= $form->field($model, 'active')->dropDownList(['No', 'Yes']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?= c006\spinner\SubmitSpinner::widget(['form_id' => $form->id]); ?>


