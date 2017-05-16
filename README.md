# Yii2-banner

Place advertisements banners on your Page.
- Advertisements are valid from startdate to enddate
- Multiple places where banners can appear
- Active Banners are placed randomly 
- Uses slugs to identify banners over URL
- Counts banner visits

## Installation

```bash
$ composer require thyseus/yii2-banner
$ php yii migrate/up --migrationPath=@vendor/thyseus/yii2-banner/migrations
```

## Configuration

Add following lines to your main configuration file:

```php
'modules' => [
    'banner' => [
        'class' => 'thyseus\banner\Module',
        'allowedRoles' => ['admin', 'banner'], # which roles are allowed to administrate banners?
    ],
],
```

## Place Banner:

Place this snippet inside your view where you want the corresponding adspace to appear:
```php
<?php
    echo $this->render('@vendor/thyseus/yii2-banner/views/banner/_banner', ['adspace' => 'location_header_top']);
    echo $this->render('@vendor/thyseus/yii2-banner/views/banner/_banner', ['adspace' => 'location_header_right']);
    echo $this->render('@vendor/thyseus/yii2-banner/views/banner/_banner', ['adspace' => 'location_header_bottom']);
```
## Actions

The following Actions are possible:

* admin:  https://your-domain/banner/banner/admin
* create: https://your-domain/banner/banner/create
* visit:  https://your-domain/banner/banner/visit/<slug>
* view:   https://your-domain/banner/banner/view/<slug>
* update: https://your-domain/banner/banner/update/<slug>
* delete: https://your-domain/banner/banner/delete/<slug>

## Contributing to this project

Anyone and everyone is welcome to contribute.

## License

Yii2-banner is released under the GPLv3 License.
