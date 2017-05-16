<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $banner thyseus\banner\models\Banner */

$this->title = $banner->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('banner', 'Banner'), 'url' => ['admin']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="banner-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('banner', 'Update'), ['update', 'id' => $banner->slug], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('banner', 'Delete'), ['delete', 'id' => $banner->slug], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('banner', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $banner,
        'attributes' => [
            'id',
            'title',
            'slug',
            'image',
            'url:url',
            'client',
            'adspace',
            'visit_count',
            'created_at',
            'updated_at',
            'valid_from',
            'valid_until',
            'comment:ntext',
        ],
    ]) ?>

</div>