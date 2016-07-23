<?php
use c006\activeForm\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model c006\widget\banner\models\WidgetBannerFiles */
/* @var $form c006\activeForm\ActiveForm; */
?>

<div class="widget-banner-files-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => TRUE])->label('Reference Name') ?>

    <?= $form->field($model, 'file')->fileInput(['class' => 'form-control']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script type="text/javascript">
    jQuery(function(){
        jQuery('input[type=hidden][name^=WidgetBannerFiles]').val(jQuery('#widgetbannerfiles-file').attr('value'));
    });
</script>

<?= c006\spinner\SubmitSpinner::widget(['form_id' => $form->id]); ?>


