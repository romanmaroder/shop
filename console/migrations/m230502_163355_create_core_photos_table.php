<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%core_photos}}`.
 */
class m230502_163355_create_core_photos_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable(
            '{{%core_photos}}',
            [
                'id'         => $this->primaryKey(),
                'product_id' => $this->integer()->notNull(),
                'file'       => $this->string()->notNull(),
                'sort'       => $this->integer()->notNull(),
            ],
            $tableOptions
        );

        $this->createIndex('{{%idx-core_photos-product_id}}', '{{%core_photos}}', 'product_id');
        $this->addForeignKey(
            '{{%fk-core_photos-product_id}}',
            '{{%core_photos}}',
            'product_id',
            '{{%core_products}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropForeignKey('{{%fk-core_photos-product_id}}', '{{%core_photos}}');
        $this->dropIndex('{{%idx-core_photos-product_id}}', '{{%core_photos}}');

        $this->dropTable('{{%core_photos}}');
    }
}
