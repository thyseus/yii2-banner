<?php

use thyseus\banner\models\Banner;
use yii\helpers\Html;
use yii\helpers\Url;

$now = date('Y-m-d G:i:s');
$query = Banner::find();

if ($adspace) {
    $query->andWhere(['adspace' => $adspace]);
}

$query->andWhere(['active' => 1]);
$query->andWhere(['<=', 'valid_from', $now]);
$query->andWhere(['>=', 'valid_until', $now]);

$query->orderBy('rand()');

$banner = $query->one();

if ($banner) {
    echo Html::a("<img src=\"{$banner->url}\"></img>", ['//banner/banner/visit', 'id' => $banner->slug], ['target' => '_blank']);
}