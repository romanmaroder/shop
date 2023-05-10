<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%core_reviews}}`.
 */
class m230510_153609_create_core_reviews_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable(
            '{{%core_reviews}}',
            [
                'id'         => $this->primaryKey(),
                'created_at' => $this->integer()->unsigned()->notNull(),
                'product_id' => $this->integer()->notNull(),
                'user_id'    => $this->integer()->notNull(),
                'vote'       => $this->integer()->notNull(),
                'text'       => $this->text()->notNull(),
                'active'     => $this->boolean()->notNull(),
            ],
            $tableOptions
        );

        $this->createIndex('{{%idx-core_reviews-product_id}}', '{{%core_reviews}}', 'product_id');
        $this->createIndex('{{%idx-core_reviews-user_id}}', '{{%core_reviews}}', 'user_id');

        $this->addForeignKey(
            '{{%fk-core_reviews-product_id}}',
            '{{%core_reviews}}',
            'product_id',
            '{{%core_products}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );
        $this->addForeignKey(
            '{{%fk-core_reviews-user_id}}',
            '{{%core_reviews}}',
            'product_id',
            '{{%users}}',
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
        $this->dropIndex('{{%idx-core_reviews-product_id}}', '{{%core_reviews}}');
        $this->dropIndex('{{%idx-core_reviews-user_id}}', '{{%core_reviews}}');
        $this->dropForeignKey('{{%fk-core_reviews-product_id}}', '{{%core_reviews}}');
        $this->dropForeignKey('{{%fk-core_reviews-user_id}}', '{{%core_reviews}}');

        $this->dropTable('{{%core_reviews}}');
    }
}
