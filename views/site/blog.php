<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\LinkPager;

$this->title = 'Blog';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="site-animal">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php foreach ($models as $model): ?>
    <div class="row">
    <div class="col-lg-5">
   	 <h2><?= $model->subject ?></h2>
	</div>
    <div class="col-lg-7">
    <h3>Escrito Em: <?= date("d/m/Y à\s H:i:s", strtotime($model->created_at)) ?> </h3>
    </div>
</div>
<div class="row">
<div class="col-lg-12">
    <p><?= $model->body ?></p>
    </div>
    </div>

<?php endforeach; ?>

<?=
LinkPager::widget([
    'pagination' => $pages,
]);
?>
    

    

    
</div>