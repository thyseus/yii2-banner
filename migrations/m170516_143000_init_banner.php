<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * @author Herbert Maschke <thyseus@gmail.com
 */
class m170516_143000_init_banner extends Migration
{
    public function up()
    {
        $tableOptions = '';

        if (Yii::$app->db->driverName == 'mysql')
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';

        $this->createTable('{{%banner}}', [
            'id'                   => $this->primaryKey(),
            'title'                => $this->string()->notNull()->unique(),
            'slug'                 => $this->string()->notNull()->unique(),
            'image'                => $this->string()->notNull(),
            'url'                  => $this->string()->notNull(),
            'client'               => $this->string(),
            'adspace'              => $this->string(),
            'visit_count'          => $this->integer(),
            'created_at'           => $this->date(),
            'updated_at'           => $this->date(),
            'valid_from'           => $this->date(),
            'valid_until'          => $this->date(),
            'comment'              => $this->text(),
            'active'               => $this->boolean()->defaultValue(true),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%banner}}');
    }
}
