<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use \dmstr\bootstrap\Tabs;

$this->title = 'Contato';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>

        <div class="alert alert-success">
            Obrigado por ter entrado em contato. Retornaremos assim que possível.
        </div>

       

    <?php else: ?>

        <p>
            Se você tem alguma dúvida ou sugestão, entre em contato conosco.
        </p>

        <div class="row">
            <div class="col-lg-5">

                <?php $form = ActiveForm::begin(['id' => 'Contact']); ?>

                  
                   <?= $form->field($model, 'name_from')->textInput(['autofocus' => true]) ?>
                    <?= $form->field($model, 'email_from') ?>
                    <?= $form->field($model, 'phone_number') ?>
            
           
            <?= $form->field($model, 'subject') ?>
            <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>
            
            

                    <div class="form-group">
                        <?= Html::submitButton('Enviar', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                    </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>

    <?php endif; ?>
</div>
