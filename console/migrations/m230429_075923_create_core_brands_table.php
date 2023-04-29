<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%core_brands}}`.
 */
class m230429_075923_create_core_brands_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';

        $this->createTable(
            '{{%core_brands}}',
            [
                'id'        => $this->primaryKey(),
                'name'      => $this->string()->notNull(),
                'slug'      => $this->string()->notNull(),
                'meta_json' => 'JSON NOT NULL',
            ],
            $tableOptions
        );
        $this->createIndex('{{%idx-core_brands-slug}}', '{{%core_brands}}', 'slug', true);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%core_brands}}');
    }
}
