<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\LinkPager;

$this->title = 'Adoção de Animais Resgatados';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="site-animal">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php foreach ($models as $model): ?>
    <div class="row">
    <div class="col-lg-4">
   	 <p><img src="<?= Yii::getAlias('@web') ?>/images/<?= $model->photo ?>" class="img-rounded"  width="304" height="236"></p>
	</div>
    <div class="col-lg-8">
    <p>Nome: <?= $model->name ?> </p>
    <p>Tipo: <?= $model->animalType->name ?> </p>
    <p>Status: <?= $model->status->name ?> </p>
    <p>Informações Extras: <?= $model->extra_information ?> </p>
    <p>Data de Registro: <?= date('d/m/Y à\s H:i:s', strtotime($model->created_at)) ?> </p>
     <?= Html::a( Yii::t('app', 'Adotar'), ['adopt', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
    </div>
</div>

<?php endforeach; ?>

<?=
LinkPager::widget([
    'pagination' => $pages,
]);
?>
    

    

    
</div>