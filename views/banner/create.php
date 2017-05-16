<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model thyseus\banner\models\Banner */

$this->title = Yii::t('banner', 'Register new Banner');
$this->params['breadcrumbs'][] = ['label' => Yii::t('banner', 'Banner'), 'url' => ['admin']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="banner-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
