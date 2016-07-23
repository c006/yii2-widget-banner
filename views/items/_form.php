<?php
use c006\activeForm\ActiveForm;
use c006\widget\banner\assets\AppHelpers;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model c006\widget\banner\models\WidgetBannerItems */
/* @var $form c006\activeForm\ActiveForm; */
?>

<div class="widget-banner-items-form">

    <?php $form = ActiveForm::begin([]); ?>

    <?
    $model_link = \c006\widget\banner\models\WidgetBanner::find()->orderBy('name')->all();
    $model_link = ArrayHelper::map($model_link, 'id', 'name');
    echo $form->field($model, 'banner_id')->dropDownList($model_link) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => TRUE]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => TRUE])->hint('Remember to add to Alias URL\'s') ?>

    <div class="table">
        <div class="table-cell" style="width: 50%">
            <?php // $form->field($model, 'date_start')->textInput() ?>
            <?= $form->field($model, 'date_start')->widget(\yii\jui\DatePicker::classname(), [
                'language'   => 'en',
                //'dateFormat' => 'dd-MM-yyyy',
                'options'    => ['class' => 'form-control', 'placeholder' => 'MM/DD/YYYY'],
            ]) ?>
        </div>
        <div
            class="table-cell"><?= $form->field($model, 'date_start_hour')->dropDownList(AppHelpers::minMaxRange(0, 23, TRUE)) ?></div>
    </div>
    <div class="table">
        <div class="table-cell" style="width: 50%">
            <?php // $form->field($model, 'date_end')->textInput() ?>
            <?= $form->field($model, 'date_end')->widget(\yii\jui\DatePicker::classname(), [
                'language'   => 'en',
               // 'dateFormat' => 'dd-MM-yyyy',
                'options'    => ['class' => 'form-control', 'placeholder' => 'MM/DD/YYYY'],
            ]) ?>
        </div>
        <div
            class="table-cell"><?= $form->field($model, 'date_end_hour')->dropDownList(AppHelpers::minMaxRange(0, 23, TRUE)) ?></div>
    </div>

    <div class="table">
        <div class="table-cell" style="width: 50%">  <?
            $model_link = \c006\widget\banner\models\WidgetBannerFiles::find()->orderBy('name')->all();
            $model_link = ArrayHelper::map($model_link, 'id', 'name');
            echo $form->field($model, 'file_id')->dropDownList($model_link)->label('Choose File') ?></div>
        <div class="table-cell"> <?= $form->field($model, 'alt_text')->textInput(['maxlength' => TRUE]) ?></div>
    </div>

    <?= $form->field($model, 'pause')->textInput(['maxlength' => TRUE])->hint('Delay is milliseconds ( 1000 milliseconds = 1 second )') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?= c006\spinner\SubmitSpinner::widget(['form_id' => $form->id]); ?>

<script type="text/javascript">
    jQuery(function () {

    });
</script>
