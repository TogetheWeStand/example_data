<?php

/* @var $this yii\web\View */
/* @var $msg app\controllers\service\ProductAuthenticationController */
/* @var $data app\controllers\service\ProductAuthenticationController */
/* @var $model app\controllers\service\ProductAuthenticationController */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Messages;

echo $msg . "<br>";
echo "Штрихкод: " . $data['barcode'] . "<br>";
echo "Артикул: " . $data['article'] . "<br><br>";

$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);

echo $form->field($model, 'fio');
echo $form->field($model, 'email_phone');
echo $form->field($model, 'shop_name');
echo $form->field($model, 'shop_address');
echo $form->field($model, 'product_photo')->fileInput();
echo $form->field($model, 'cheque_photo')->fileInput();

echo '<div class="form-group">';
echo Html::submitButton(Messages::get('complaint'), ['class' => 'btn btn-primary']);
echo '</div>';

ActiveForm::end();