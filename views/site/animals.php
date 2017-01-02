<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\LinkPager;
use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\Map;
use dosamigos\google\maps\overlays\Marker;
$this->title = 'Animais Abandonados Atualmente na Rua';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="site-animal">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php foreach ($models as $model): ?>
    <div class="row">
    <div class="col-lg-4 col-md-4">
   	 <p><img src="<?= Yii::getAlias('@web') ?>/images/<?= $model->photo ?>" class="img-rounded"  width="304" height="236"></p>
	</div>

    
    <div class="col-lg-4 col-md-4">
    
<?php
    
    $location = explode(';', $model->location);
    $lat = $location[0];
    $lng = $location[1];
    $coord = new LatLng(['lat' => $lat, 'lng' => $lng]);
    $map = new Map([
    'center' => $coord,
    'zoom' => 14,
    ]);

    $marker = new Marker([
    'position' => $coord,
    'title' => $location[2],
    ]);

    $map->addOverlay($marker);

    $map->width = 304;
    $map->height = 236;
    echo $map->display();
     ?>
     
    </div>

    <div class="col-lg-4 col-md-4">
    <p>Nome: <?= $model->name ?> </p>
    <p>Tipo: <?= $model->animalType->name ?> </p>
    <p>Status: <?= $model->status->name ?> </p>
    <p>Informações Extras: <?= $model->extra_information ?> </p>
    <p>Data de Registro: <?= date('d/m/Y', strtotime($model->created_at)) ?> </p>
    <?= Html::a( Yii::t('app', 'Perfil'), ['view-animal', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
    </div>
</div>

<?php endforeach; ?>

<?=
LinkPager::widget([
    'pagination' => $pages,
]);
?>
    

    

    
</div>