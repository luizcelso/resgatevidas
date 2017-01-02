<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use \dmstr\bootstrap\Tabs;

$this->title = 'Contato Adoção';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('adoptFormSubmitted')): ?>

        <div class="alert alert-success">
            Obrigado por ter interesse em adotar um anjo. Retornaremos assim que possível.
        </div>

       

    <?php else: ?>

        <p>
            Preencha os dados abaixo para requisitar a adoção de um dos nossos animais.
        </p>

        <div class="row">
            <div class="col-lg-5">

                <?php $form = ActiveForm::begin(['id' => 'Contact']); ?>

                  
                   <?= $form->field($model, 'name_from')->textInput(['autofocus' => true, 'value' => Yii::$app->user->identity->name]) ?>
                    <?= $form->field($model, 'email_from')->textInput(['autofocus' => true, 'value' => Yii::$app->user->identity->email]) ?>
                    <?= $form->field($model, 'phone_number')->textInput(['autofocus' => true, 'value' => Yii::$app->user->identity->phone_number]) ?>
            
           
            <?= $form->field($model, 'subject')->textInput(['autofocus' => true, 'value' => 'Adoção do anjo ' . $animal->name]) ?>
            <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>
            
            

                    <div class="form-group">
                        <?= Html::submitButton('Enviar', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                    </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>

    <?php endif; ?>
</div>
