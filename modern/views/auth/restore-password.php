<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\controllers\AuthController */
/* @var $msg app\controllers\AuthController */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\Messages;

$this->title = 'Восстановление пароля';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="restore-password">
    <?php if (!$msg): ?>
        <h1><?= Html::encode($this->title) ?></h1>

        <?php $form = ActiveForm::begin([
            'id' => 'password-restore-form',
            'layout' => 'horizontal',
            'fieldConfig' => [
                'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-7\">{error}</div>",
                'labelOptions' => ['class' => 'col-lg-2 control-label'],
            ],
        ]); ?>

        <?= $form->field($model, 'login')->textInput(['autofocus' => true]) ?>

        <div class="form-group">
            <div class="col-lg-offset-2 col-lg-10">
                <?= Html::submitButton(
                    Messages::get('sent'),
                    ['class' => 'btn btn-primary', 'name' => 'restore-password-button']
                ) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    <?php else: ?>
        <text><?= $msg ?></text>
    <?php endif; ?>
</div>
