<?php

/* @var $this yii\web\View */
/* @var $subscribed app\controllers\SiteController */

use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div    class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        This is the About page. You may modify the following file to customize its content:
    </p>

    <code><?= __FILE__ ?></code> <br><br>

    <?php if (!Yii::$app->user->isGuest /*&& !$subscribed*/): ?>
        <?= Html::button('Следить за изменениями', ['class' => 'btn btn-primary subscribe']) ?>
    <?php endif;?>
</div>
