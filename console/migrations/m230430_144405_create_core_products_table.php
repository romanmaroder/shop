<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%core_products}}`.
 */
class m230430_144405_create_core_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable(
            '{{%core_products}}',
            [
                'id'            => $this->primaryKey(),
                'category_id'   => $this->integer()->notNull(),
                'brand_id'      => $this->integer()->notNull(),
                'created_at'    => $this->integer()->unsigned()->notNull(),
                'code'          => $this->string()->notNull(),
                'name'          => $this->string()->notNull(),
                'description'   => $this->text(),
                'price_old'     => $this->integer(),
                'price_new'     => $this->integer(),
                'rating'        => $this->decimal(3, 2),
                'meta_json'     => $this->text(),
                'main_photo_id' => $this->integer(),
                'status'        => $this->smallInteger()->defaultValue(1)->notNull(),
            ],
            $tableOptions
        );

        $this->createIndex('{{%idx-core_products-code}}', '{{%core_products}}', 'code', true);
        $this->createIndex('{{%idx-core_products-category_id}}', '{{%core_products}}', 'category_id');
        $this->createIndex('{{%idx-core_products-brand_id}}', '{{%core_products}}', 'brand_id');
        $this->createIndex('{{%idx-core_products-main_photo_id}}', '{{%core_products}}', 'main_photo_id');

        $this->addForeignKey(
            '{{%fk-core_products-category_id}}',
            '{{%core_products}}',
            'category_id',
            '{{%core_categories}}',
            'id'
        );
        $this->addForeignKey(
            '{{%fk-core_products-brand_id}}',
            '{{%core_products}}',
            'brand_id',
            '{{%core_categories}}',
            'id'
        );
        $this->addForeignKey(
            '{{%fk-core_products-main_photo_id}}',
            '{{%core_products}}',
            'main_photo_id',
            '{{%core_photos}}',
            'id',
            'SET NULL',
            'RESTRICT'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropForeignKey('{{%fk-core_products-category_id}}', '{{%core_products}}');
        $this->dropForeignKey('{{%fk-core_products-brand_id}}', '{{%core_products}}');
        $this->dropForeignKey('{{%fk-core_products-main_photo_id}}', '{{%core_products}}');

        $this->dropIndex('{{%idx-core_products-code}}', '{{%core_products}}');
        $this->dropIndex('{{%idx-core_products-category_id}}', '{{%core_products}}');
        $this->dropIndex('{{%idx-core_products-brand_id}}', '{{%core_products}}');
        $this->dropIndex('{{%idx-core_products-main_photo_id}}', '{{%core_products}}');

        $this->dropTable('{{%core_products}}');
    }
}
