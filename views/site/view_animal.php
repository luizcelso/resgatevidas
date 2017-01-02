<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\Map;
use dosamigos\google\maps\overlays\Marker;

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Animais', 'url' => ['animals']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="site-animal">
    <h1><?= Html::encode($this->title) ?></h1>

    <p><img src="<?= Yii::getAlias('@web') ?>/images/<?= $model->photo ?>" class="img-rounded"  width="304" height="236"></p>
    <?php
    //die(var_dump($model->location));
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

    $map->width = 300;
    $map->height = 300;
	echo $map->display();
	 ?>
    <p></p>
    <p>Nome: <?= $model->name ?> </p>
    <p>Tipo: <?= $model->animalType->name ?> </p>
    <p>Status: <?= $model->status->name ?> </p>
    <p>Informações Extras: <?= $model->extra_information ?> </p>
    <p>Data de Registro: <?= date('d/m/Y', strtotime($model->created_at)) ?> </p>
    

    

    
</div>