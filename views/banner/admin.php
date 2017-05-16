<?php

use thyseus\banner\models\Banner;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BannerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('banner', 'Banner');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="banner-index">

    <?php Pjax::begin(); ?>

    <p> <?= Html::a(Yii::t('banner', 'Register new Banner'), ['create'], ['class' => 'btn btn-success']) ?> </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'title',
            'client',
            'url:url',
            [
                'filter' => ArrayHelper::map(Banner::find()->select('adspace')->groupBy('adspace')->all(), 'adspace', 'adspace'),
                'attribute' => 'adspace',
            ],
            [
                'filter' => [
                    0 => Yii::t('banner', 'No'),
                    1 => Yii::t('banner', 'Yes'),
                ],
                'attribute' => 'active',
                'value' => function($data) { return $data->active ? Yii::t('banner', 'Yes') : Yii::t('banner', 'No'); },
            ],
            'visit_count',
            'valid_from',
            'valid_until',
            [
                'class' => 'yii\grid\ActionColumn',
                'urlCreator' => function ($action, $model, $key, $index) {
                    return Url::to(['banner/' . $action, 'id' => $model->slug]);
                }
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
