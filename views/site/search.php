<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use \dmstr\bootstrap\Tabs;
use yii\web\JsExpression;
use kartik\select2\Select2;
$this->title = 'Busca Específica de Animal';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    

        <hr/>
           

        <div class="row">
            <div class="col-lg-5">

                <?php $form = ActiveForm::begin(['id' => 'Animal']); ?>

                  
                   <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>
                   <?= $form->field($model, 'animal_type_id')->dropDownList(\app\models\Animal::getAnimalTypes(), ['prompt' => '']) ?>
                   


                   <?php
        echo '<label class="control-label">Sua Localização</label>';
        $url = \yii\helpers\Url::to(['gmaps-list']);
        echo Select2::widget([
            'model' => $model,
            'attribute' => 'location',
            // 'name' => 'Animal[location]',
            // 'id' => 'animal-location',
            //'initValueText' => $cityDesc, // set the initial display text
            'options' => ['placeholder' => 'Procure pelo endereço...'],
            'pluginOptions' => [
                'allowClear' => true,
                'minimumInputLength' => 5,
                'language' => [
                    'errorLoading' => new JsExpression("function () { return 'Buscando resultados...'; }"),
                ],
                'ajax' => [
                    'url' => $url,
                    'dataType' => 'json',
                    //'data' => new JsExpression('function(params) { return {q:params.formatted_address}; }')
                    'data' => new JsExpression('function(params) { return {q:params.term}; }')
                ],
                'templateResult' => new JsExpression('function(result) { return result.text; }'),
                'templateSelection' => new JsExpression('function(result) { return result.text; }'),
                //'escapeMarkup' => new JsExpression('function(result) { return result; }'),
                'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                //'templateResult' => new JsExpression('function(city) { return city.text; }'),
                //'templateSelection' => new JsExpression('function (city) { return city.text; }'),
            ],
        ]);
?>
<br>
<?= $form->field($model, 'location_range')->dropDownList(array('' => null, '5' => '5km', '10' => '10km', '15' => '15km', 'more' => 'Mais de 15km')) ?>
<br>
                    
            
            

                    <div class="form-group">
                        <?= Html::submitButton('Buscar', ['class' => 'btn btn-primary', 'name' => 'animal-button']) ?>
                    </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>

    
</div>
