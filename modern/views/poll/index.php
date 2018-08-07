<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Polls';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="poll-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Poll', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'active',
            'completed',
            'date_create',
            'date_update',
            //'start_date',
            //'end_date',
            //'title',
            //'code',
            //'sort',
            //'created_by',
            //'modify_by',
            //'webanketa_key',
            //'cost',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
