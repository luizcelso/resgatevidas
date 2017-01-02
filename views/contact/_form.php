<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use \dmstr\bootstrap\Tabs;

/**
* @var yii\web\View $this
* @var app\models\Contact $model
* @var yii\widgets\ActiveForm $form
*/

?>

<div class="contact-form">

    <?php $form = ActiveForm::begin([
    'id' => 'Contact',
    'layout' => 'horizontal',
    'enableClientValidation' => true,
    'errorSummaryCssClass' => 'error-summary alert alert-error'
    ]
    );
    ?>

    <div class="">
        <?php $this->beginBlock('main'); ?>

        <p>
            
			<?= $form->field($model, 'id')->textInput() ?>
			<?= $form->field($model, 'email_from')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'name_from')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'ip_address_from')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'subject')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>
			<?= $form->field($model, 'created_at')->textInput() ?>
			<?= $form->field($model, 'phone_number')->textInput(['maxlength' => true]) ?>
        </p>
        <?php $this->endBlock(); ?>
        
        <?=
    Tabs::widget(
                 [
                   'encodeLabels' => false,
                     'items' => [ [
    'label'   => $model->getAliasModel(),
    'content' => $this->blocks['main'],
    'active'  => true,
], ]
                 ]
    );
    ?>
        <hr/>

        <?php echo $form->errorSummary($model); ?>

        <?= Html::submitButton(
        '<span class="glyphicon glyphicon-check"></span> ' .
        ($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save')),
        [
        'id' => 'save-' . $model->formName(),
        'class' => 'btn btn-success'
        ]
        );
        ?>

        <?php ActiveForm::end(); ?>

    </div>

</div>

