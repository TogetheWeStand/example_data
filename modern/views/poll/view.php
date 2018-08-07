<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Poll;

/* @var $this yii\web\View */
/* @var $model app\models\Poll */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Polls', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="poll-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="b-page-main">
        <div class="b-poll container">
            <div class="row">
                <div class="col-xs-12 polls-header-title">
                    <h2>Примите участие в опросе №<?= $model->id ?></h2>
                </div>
                <div class="col-xs-12">
                    <?php
                    $userLogin = 'Admin';
                    if (!empty($model->webanketa_key)) {
                        ?>
                        <script type="text/javascript">var WebAnketaParams = ["<?=$model->webanketa_key?>", "<?=$model->title?>", "", "", "arg.user=<?=$userLogin?>&arg.poll=<?=$model->webanketa_key?>&arg.pollcode=<?=$model->code?>&arg.pollid=<?=$model->id?>"];
                            document.write(unescape("<" + "script src='http" + (/^https:\/\//.test(document.URL) ? "s" : "") + "://webanketa.com/direct/js/embed.js' type='text/javascript'><" + "/script>"));
                        </script>
                        <noscript><a href="http://webanketa.com/forms/<?= $model->webanketa_key ?>/"
                                     target="_blank"><?= $model->title ?></a></noscript>
                    <?php } ?>

                </div>
            </div>
        </div>
    </div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'active',
            'completed',
            'date_create',
            'date_update',
            'start_date',
            'end_date',
            'title',
            'code',
            'sort',
            'created_by',
            'modify_by',
            'webanketa_key',
            'cost',
            'users_finished',
            'users_viewed'
        ],
    ]) ?>

    <?php
    $model = Poll::findOne(['id' => $model->id]);

    if ($model) {
        $model->users_viewed = $model->users_viewed == '' ? 1 : $model->users_viewed + 1;
        $model->save();
    }

    ?>

</div>
