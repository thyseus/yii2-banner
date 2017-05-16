<?php
/**
 * This is the main module class for yii2-banner.
 *
 * @property array $modelMap
 *
 * @author Herbert Maschke <thyseus@gmail.com>
 */

namespace thyseus\banner;

use yii;
use yii\base\Module as BaseModule;
use yii\i18n\PhpMessageSource;

class Module extends BaseModule
{
    const VERSION = '0.1.0-dev';

    public $defaultRoute = 'banner/banner/admin';

    public $allowedRoles = ['admin', 'banner'];

    public function init()
    {
        if (!isset(Yii::$app->get('i18n')->translations['banner*'])) {
            Yii::$app->get('i18n')->translations['banner*'] = [
                'class' => PhpMessageSource::className(),
                'basePath' => __DIR__ . '/messages',
                'sourceLanguage' => 'en-US'
            ];
        }

        return parent::init();
    }
}
