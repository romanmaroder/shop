<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%core_values}}`.
 */
class m230502_122347_create_core_values_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable(
            '{{%core_values}}',
            [
                'id'                => $this->primaryKey(),
                'product_id'        => $this->integer()->notNull(),
                'characteristic_id' => $this->integer()->notNull(),
                'values'            => $this->string(),
            ],
            $tableOptions
        );

        $this->addPrimaryKey('{{%pk-core_values}}', '{{%core_values}}', ['product_id', 'characteristic_id']);

        $this->createIndex('{{%idx-core_values-product_id}}', '{{%core_values}}', 'product_id');
        $this->createIndex('{{%idx-core_values-characteristic_id}}', '{{%core_values}}', 'characteristic_id');

        $this->addForeignKey(
            '{{%fk-core_values-product_id}}',
            '{{%core_values}}',
            'product_id',
            '{{%core_products}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );
        $this->addForeignKey(
            '{{%fk-core_values-characteristic_id}}',
            '{{%core_values}}',
            'characteristic_id',
            '{{%core_characteristic}}',
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
        $this->dropForeignKey('{{%fk-core_values-characteristic_id}}', '{{%core_values}}');
        $this->dropForeignKey('{{%fk-core_values-product_id}}', '{{%core_values}}');

        $this->dropIndex('{{%idx-core_values-characteristic_id}}', '{{%core_values}}');
        $this->dropIndex('{{%idx-core_values-product_id}}', '{{%core_values}}');

        $this->dropPrimaryKey('{{%pk-core_values}}', '{{%core_values}}');

        $this->dropTable('{{%core_values}}');
    }
}
