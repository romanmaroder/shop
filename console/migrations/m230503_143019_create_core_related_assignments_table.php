<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%core_related_assignments}}`.
 */
class m230503_143019_create_core_related_assignments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable(
            '{{%core_related_assignments}}',
            [
                'product_id' => $this->integer()->notNull(),
                'related_id' => $this->integer()->notNull(),
            ],
            $tableOptions
        );
        $this->addPrimaryKey(
            '{{%pk-core_related_assignments}}',
            '{{%core_related_assignments}}',
            ['product_id', 'related_id']
        );

        $this->createIndex(
            '{{%idx-core_related_assignments-product_id}}',
            '{{%core_related_assignments}}',
            'product_id'
        );
        $this->createIndex(
            '{{%idx-core_related_assignments-related_id}}',
            '{{%core_related_assignments}}',
            'related_id'
        );

        $this->addForeignKey(
            '{{%fk-core_related_assignments-product_id}}',
            '{{%core_related_assignments}}',
            'product_id',
            '{{%core_products}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );
        $this->addForeignKey(
            '{{%fk-core_related_assignments-related_id}}',
            '{{%core_related_assignments}}',
            'related_id',
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
        $this->dropForeignKey('{{%fk-core_related_assignments-related_id}}', '{{%core_related_assignments}}');
        $this->dropForeignKey('{{%fk-core_related_assignments-product_id}}', '{{%core_related_assignments}}');

        $this->dropIndex('{{%idx-core_related_assignments-related_id}}', '{{%core_related_assignments}}');
        $this->dropIndex('{{%idx-core_related_assignments-product_id}}', '{{%core_related_assignments}}');

        $this->dropPrimaryKey('{{%pk-core_related_assignments}}', '{{%core_related_assignments}}');
        
        $this->dropTable('{{%core_related_assignments}}');
    }
}
