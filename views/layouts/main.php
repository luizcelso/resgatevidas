<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title>Resgate Vidas</title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Resgate Vidas',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    if (Yii::$app->user->isGuest) {

        echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Principal', 'url' => ['/site/index']],
            ['label' => 'Animais', 'url' => ['/site/animals']],
            ['label' => 'Adoção', 'url' => ['/site/adoption']],
            ['label' => 'Blog', 'url' => ['/site/blog']],
            ['label' => 'Contato', 'url' => ['/site/contact']],
            
            
            
                ['label' => 'Login', 'url' => ['/site/login']],
                
        ],
    ]);
    
    } else {
        if (Yii::$app->user->identity->role_id == 1) {
            echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Principal', 'url' => ['/site/index']],
            ['label' => 'Animais', 'url' => ['/site/animals']],
            ['label' => 'Adoção', 'url' => ['/site/adoption']],
            ['label' => 'Blog', 'url' => ['/site/blog']],
            ['label' => 'Contato', 'url' => ['/site/contact']],
            [
            'label' => 'Administração',
            'items' => [
                 ['label' => 'Contatos', 'url' => ['/contact/index']],
                 ['label' => 'Animais', 'url' => ['/animal/index']],
                 ['label' => 'Usuários', 'url' => ['/user/index']],
                 ['label' => 'Blog', 'url' => ['/blog/index']],
            ]],
            
            
                [
                    'label' => 'Sair (' . Yii::$app->user->identity->name . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                
        ],
        
        ],
    ]);
        } else {
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Principal', 'url' => ['/site/index']],
            ['label' => 'Animais', 'url' => ['/site/animals']],
            ['label' => 'Adoção', 'url' => ['/site/adoption']],
            ['label' => 'Blog', 'url' => ['/site/blog']],
            ['label' => 'Contato', 'url' => ['/site/contact']],
            
            
            
                [
                    'label' => 'Sair (' . Yii::$app->user->identity->name . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                
        ],
        ],
    ]); } }
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Resgate Vidas <?= date('Y') ?></p>

        <p class="pull-right">Luiz Celso Pergentino</p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
