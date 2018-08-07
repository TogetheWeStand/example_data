<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Messages;

$form = ActiveForm::begin();

echo $form->field($model, 'barcode');
echo $form->field($model, 'article');
echo '<div class="form-group">';
echo Html::submitButton(Messages::get('check'), ['class' => 'btn btn-primary']);
echo '</div>';

ActiveForm::end();