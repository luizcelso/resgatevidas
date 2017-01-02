<?php
use yii\helpers\Html;
use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\Map;
use dosamigos\google\maps\overlays\Marker;
/* @var $this yii\web\View */

$this->title = 'Resgate Vidas';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Achou um animal na rua?</h1>

        

       
        <?= Html::a('<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('app', 'CADASTRE AQUI'), ['create-animal'], ['class' => 'btn btn-success']) ?>
    </div>

    <div class="body-content">

        <div class="row">
            <?php foreach ($animals as $animal): ?>
            <div class="col-lg-4 col-md-4 col-xs-12">
                <h2><?= $animal->name ?></h2>

                <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p> -->
                    <img src="<?= Yii::getAlias('@web') ?>/images/<?= $animal->photo ?>" class="img-rounded"  width="304" height="236">
                    <p>
                        <?php
    
    $location = explode(';', $animal->location);
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
                        
                         <?= Html::a( Yii::t('app', 'Detalhes'), ['view-animal', 'id' => $animal->id], ['class' => 'btn btn-default']) ?>
                    </p>
            </div>
                <?php endforeach; ?>

                
        </div>

    </div>
</div>
