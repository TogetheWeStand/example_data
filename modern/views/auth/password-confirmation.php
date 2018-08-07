<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $msg app\controllers\AuthController */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\Messages;

$this->title = 'Подтверждение регистрации';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="password-confirmation">
    <text><?= $msg ?></text>
</div>
