<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%core_tag_assignment}}`.
 */
class m230503_131817_create_core_tag_assignments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        $this->createTable(
            '{{%core_tag_assignments}}',
            [
                'product_id' => $this->integer()->notNull(),
                'tag_id'     => $this->integer()->notNull(),
            ],
            $tableOptions
        );

        $this->addPrimaryKey('{{%pk-core_tag_assignments}}', '{{core_tag_assignments}}', ['product_id', 'tag_id']);

        $this->createIndex('{{%idx-core_tag_assignments-product_id}}', '{{%core_tag_assignments}}', 'product_id');
        $this->createIndex('{{%idx-core_tag_assignments-tag_id}}', '{{%core_tag_assignments}}', 'tag_id');

        $this->addForeignKey(
            '{{%fk-core_tag_assignments-product_id}}',
            '{{%core_tag_assignments}}',
            'product_id',
            '{{%core_products}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );
        $this->addForeignKey(
            '{{%fk-core_tag_assignments-tag_id}}',
            '{{%core_tag_assignments}}',
            'tag_id',
            '{{%project_tags}}',
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
        $this->dropForeignKey('{{%fk-core_tag_assignments-tag_id}}', '{{%core_tag_assignments}}');
        $this->dropForeignKey('{{%fk-core_tag_assignments-product_id}}', '{{%core_tag_assignments}}');

        $this->dropIndex('{{%idx-core_tag_assignments-tag_id}}', '{{%core_tag_assignments}}');
        $this->dropIndex('{{%idx-core_tag_assignments-product_id}}', '{{%core_tag_assignments}}');

        $this->dropPrimaryKey('{{%pk-core_tag_assignments}}', '{{%core_tag_assignments}}');

        $this->dropTable('{{%core_tag_assignments}}');
    }
}
