<?php

/* @var $this yii\web\View */
/* @var $data app\controllers\BarcodeController */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Messages;

if ($data) {
    var_dump($data);
} else {
    $form = ActiveForm::begin();
    echo $form->field($model, 'barcode');
    echo '<div class="form-group">';
    echo Html::submitButton(Messages::get('registry'), ['class' => 'btn btn-primary']);
    echo '</div>';
    ActiveForm::end();
}
